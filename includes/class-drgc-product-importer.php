<?php
/** Products and categories import core functions (for ajax & cron)
 *
 * @link       https://www.digitalriver.com
 * @since      2.0.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/includes
 */

class DRGC_Product_Importer {

  /**
   * @var string $type
   */
  public $type;

  /**
   * Cached DR products
   *
   * @var array|bool
   */
  private $dr_products;

  /**
   * DRGC_Product_Importer constructor.
   *
   * @param string $type: AJAX|CRON
   */
  public function __construct( $type ) {
    $this->type = $type;
  }

  public function import_categories() {
    $data = DRGC()->site->get_categories( array( 'expand' => 'category.categories' ) );
    $categories = $data['categories']['category'];

    if ( is_array( $categories ) ) {
      foreach ( $categories as $key => $category ) {
        $term = new DRGC_Category( $category['displayName'] );
        $term->save();

        if ( isset( $category['categories'] ) ) {
          $subcategories = $category['categories']['category'];
          $this->recursive_import_subcategories( $subcategories, $category['displayName'] );
        }
      }
    }
    if ( $this->type === 'AJAX' ) {
      wp_send_json_success( $data );
    } else {
      return true;
    }
  }

  private function recursive_import_subcategories( $subcategories, $parent_category_name ) {
    foreach ( $subcategories as $key => $subcategory ) {
      $term = new DRGC_Category( $subcategory['displayName'], $parent_category_name );
      $term->save();

      $data_by_uri = DRGC()->site->fetch_data_by_uri( $subcategory['uri'] );
      $category_by_uri = $data_by_uri['category'];
      if ( isset( $category_by_uri['categories'] ) ) {
        return $this->recursive_import_subcategories( $category_by_uri['categories']['category'], $category_by_uri['displayName'] );
      }
    }
  }

  public function fetch_and_cache_products() {
    $res = DRGC()->site->get_products( $this->basic_product_query_params() );
    $this->dr_products = $res['products']['product'] ?? array();

    if ( count( $this->dr_products ) > 0 ) {
      $this->recursive_fetch_more_products( $res['products'] );
      $this->filter_out_share_product();

      // Cache dr_products at most 1 hour
      set_transient( 'dr_products', $this->dr_products, HOUR_IN_SECONDS );
      if ( $this->type === 'AJAX' ) {
        wp_send_json_success( $this->dr_products );
      } else {
        return count( $this->dr_products );
      }
    } else {
      if ( $this->type === 'AJAX' ) {
        wp_send_json_error( array( 'error' => __( 'No products found.', 'digital-river-global-commerce' ) ) );
      } else {
        return false;
      }
    }
  }

  private function recursive_fetch_more_products( $products_data ) {
    if ( isset( $products_data['nextPage'] ) ) {
      $res = DRGC()->site->fetch_data_by_uri( $products_data['nextPage']['uri'], $this->basic_product_query_params() );
      $next_page_products = $res['products']['product'] ?? array();
      $this->dr_products = array_merge( $this->dr_products, $next_page_products );
      $this->recursive_fetch_more_products( $res['products'] );
    }
  }

  public function import_each_product( $idx = null ) {
    $this->dr_products = get_transient( 'dr_products' );
    $idx = ( $this->type === 'AJAX' && isset( $_POST['idx'] ) ) ? intval( $_POST['idx'] ) : $idx;

    if ( false !== $this->dr_products && isset( $idx ) ) {
      $product = $this->dr_products[$idx];
      $gc_id = $product['id'] ?? 0;

      // Get terms ID of product categories
      $categories_res = DRGC()->site->get_product_categories( $gc_id );
      $product_categories = $categories_res['categories']['category'] ?? array();
      $terms_ids = array();
      foreach ( $product_categories as $key => $category ) {
        $term = new DRGC_Category( $category['displayName'] );
        $terms_ids[] = $term->get_numeric_term_id();
      }
      $default_term = new DRGC_Category( 'Uncategorized' );
      $terms_ids[] = $default_term->get_numeric_term_id();

      // Base product
      $parent_post_id = drgc_get_product_by_gc_id( $gc_id );
      $parent_post = new DRGC_Product( $parent_post_id );
      $parent_post->set_data( $product );
      $parent_post->set_categories( $terms_ids );
      $parent_post->save();

      // Variation product
      if ( isset( $product['variations'] ) ) {
        foreach ( $product['variations']['product'] as $key => $variation_product ) {
          $gc_id = $variation_product['id'] ?? 0;
          $variation_post_id  = drgc_get_product_by_gc_id( $gc_id, true );
          $variation_post = new DRGC_Product( $variation_post_id, 'dr_product_variation' );
          $variation_post->set_data( $variation_product );
          $variation_post->set_parent( $parent_post->id );
          $variation_post->save();
        }
      }

      // Clear cache after the last product is imported
      if ( $idx === count( $this->dr_products ) - 1 ) {
        delete_transient( 'dr_products' );
      }

      if ( $this->type === 'AJAX' ) {
        wp_send_json_success( $product );
      } else {
        return true;
      }
    }
  }

  private function basic_product_query_params() {
    $required_attrs = [
      'product.id',
      'product.sku',
      'product.baseProduct',
      'product.displayableProduct',
      'product.variations',
      'product.variationAttributes',
      'product.variations.product.customAttributes'
    ];
    return array( 'expand' => implode( ',', $required_attrs ) );
  }

  private function filter_out_share_product() {
    $key = array_search( '8350200', array_column( $this->dr_products, 'id' ) ); // Remove "Backup Disc"
    if ( $key !== false ) {
      unset( $this->dr_products[$key] );
    }
  }

}
