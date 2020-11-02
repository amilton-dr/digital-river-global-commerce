/* global drgc_params, iFrameResize */
/* eslint-disable no-alert, no-console */
import DRCommerceApi from './commerce-api';
import CheckoutUtils from './checkout-utils';

const PdpModule = (($) => {
    const localizedText = drgc_params.translations;

    const bindVariationPrice = (pricing, $target) => {
        if (!pricing.listPrice || !pricing.salePriceWithQuantity) return;
        if (pricing.listPrice.value > pricing.salePriceWithQuantity.value) {
            $target.data('old-price', pricing.formattedListPrice);
            $target.data('price', pricing.formattedSalePriceWithQuantity);
        } else {
            $target.data('price', pricing.formattedSalePriceWithQuantity);
        }
    };

    const bindVariationInventoryStatus = (purchasable, $target) => {
        $target.data('purchasable', purchasable);
    };

    const selectVariation = ($target) => {
        if ($target.is('input[type=radio]')) $target.prop('checked', true).trigger('click');
        else $target.prop('selected', true).trigger('change');
    };

    const displayRealTimePricing = (pricing, option, $target) => {
        if (!pricing.listPrice || !pricing.salePriceWithQuantity) {
            $target.text(''); // no pricing data
            return;
        }
        if (pricing.listPrice.value > pricing.salePriceWithQuantity.value) {
            $target.html(`
                <${option.listPriceDiv} class="${option.listPriceClass()}">${pricing.formattedListPrice}</${option.listPriceDiv}>
                <${option.salePriceDiv} class="${option.salePriceClass()}">${pricing.formattedSalePriceWithQuantity}</${option.salePriceDiv}>
            `);
        } else {
            $target.html(`
                <${option.priceDiv} class="${option.priceClass()}">${pricing.formattedSalePriceWithQuantity}</${option.priceDiv}>
            `);
        }
    };

    const displayRealTimeBuyBtn = (purchasable, isRedirectBuyBtn, $target) => {
        const isOutOfStock = purchasable === 'false';

        $target
            .prop('disabled', isOutOfStock)
            .text(isOutOfStock ? localizedText.out_of_stock :
                isRedirectBuyBtn ? localizedText.buy_now : localizedText.add_to_cart)
            .addClass(isRedirectBuyBtn ? 'dr-redirect-buy-btn' : '');
    };

    const updateProductItem = ($target, product) => {
        const $loadingIcon = $target.find('.dr-loading');
        const $productInfo = $target.find('.dr-pd-info');
        const $title = $target.find('.dr-pd-item-title');
        const $thumbnail = $target.find('.dr-pd-item-thumbnail > img');
        const thumbnail = product.thumbnailImage || '';

        $title.text(product.displayName);
        $thumbnail.attr('src', thumbnail).attr('alt', product.displayName);
        $loadingIcon.hide();
        $productInfo.show();
    };

    return {
        bindVariationPrice,
        bindVariationInventoryStatus,
        selectVariation,
        displayRealTimePricing,
        displayRealTimeBuyBtn,
        updateProductItem
    };
})(jQuery);

jQuery(document).ready(($) => {
    const localizedText = drgc_params.translations;
    let lineItems = [];

    function toggleMiniCartDisplay() {
        const $miniCartDisplay = $('.dr-minicart-display');
        if ($miniCartDisplay.is(':visible')) {
            $miniCartDisplay.fadeOut(200);
        } else {
            $miniCartDisplay.fadeIn(200);
        }
    }

    function openMiniCartDisplay() {
        const $miniCartDisplay = $('.dr-minicart-display');
        if (! $miniCartDisplay.is(':visible')) {
            $miniCartDisplay.fadeIn(200);
        }
    }

    function displayMiniCart(cart) {
        const $display = $('.dr-minicart-display');
        const $body = $('<div class="dr-minicart-body"></div>');
        const $footer = $('<div class="dr-minicart-footer"></div>');

        lineItems = (cart.lineItems && cart.lineItems.lineItem) ? cart.lineItems.lineItem : [];

        $('.dr-minicart-count').text(cart.totalItemsInCart);
        $('.dr-minicart-header').siblings().remove();
        if ($('section.dr-login-sections__section.logged-in').length && cart.totalItemsInCart == 0) {
            $('section.dr-login-sections__section.logged-in > div').hide();
        }

        if (!lineItems.length) {
            const emptyMsg = `<p class="dr-minicart-empty-msg">${localizedText.empty_cart_msg}</p>`;
            $body.append(emptyMsg);
            $display.append($body);
        } else {
            const params = (new URL(window.location)).searchParams;
            const locale = params.get('locale') || drgc_params.drLocale;
            const isTaxInclusive = locale !== 'en_US';
            const forceExclTax = drgc_params.forceExclTax === 'true';
            const taxSuffixLabel = isTaxInclusive ?
                forceExclTax ? ' ' + localizedText.excl_vat_label : ' ' + localizedText.incl_vat_label :
                '';
            let miniCartLineItems = '<ul class="dr-minicart-list">';
            const miniCartSubtotal = `<p class="dr-minicart-subtotal"><label>${localizedText.subtotal_label + taxSuffixLabel}</label><span>${cart.pricing.formattedSubtotal}</span></p>`;
            const miniCartViewCartBtn = `<a class="dr-btn" id="dr-minicart-view-cart-btn" href="${drgc_params.cartUrl}">${localizedText.view_cart_label}</a>`;

            lineItems.forEach((li) => {
                const productId = li.product.uri.replace(`${DRCommerceApi.apiBaseUrl}/me/products/`, '');
                const listPrice = Number(li.pricing.listPriceWithQuantity.value);
                const salePrice = Number(li.pricing.salePriceWithQuantity.value);
                const formattedSalePrice = li.pricing.formattedSalePriceWithQuantity;
                const formattedListPrice = li.pricing.formattedListPriceWithQuantity;
                let priceContent = '';

                if (listPrice > salePrice) {
                    priceContent = `<del class="dr-strike-price">${formattedListPrice}</del><span class="dr-sale-price">${formattedSalePrice}</span>`;
                } else {
                    priceContent = formattedSalePrice;
                }

                const miniCartLineItem = `
                <li class="dr-minicart-item clearfix">
                    <div class="dr-minicart-item-thumbnail">
                        <img src="${li.product.thumbnailImage}" alt="${li.product.displayName}" />
                    </div>
                    <div class="dr-minicart-item-info" data-product-id="${productId}">
                        <span class="dr-minicart-item-title">${li.product.displayName}</span>
                        <span class="dr-minicart-item-qty">${localizedText.qty_label}.${li.quantity}</span>
                        <p class="dr-pd-price dr-minicart-item-price">${priceContent}</p>
                    </div>
                    <a href="#" class="dr-minicart-item-remove-btn" aria-label="Remove" data-line-item-id="${li.id}">${localizedText.remove_label}</a>
                </li>`;
                miniCartLineItems += miniCartLineItem;
            });
            miniCartLineItems += '</ul>';
            $body.append(miniCartLineItems, miniCartSubtotal);
            $footer.append(miniCartViewCartBtn);
            $display.append($body, $footer);
        }
    }

    (function() {
        if ( $('#dr-minicart'.length)) {
            displayMiniCart(drgc_params.cart.cart);
        }
    }());

    $('.dr-minicart-toggle, .dr-minicart-close-btn').click((e) => {
        e.preventDefault();
        toggleMiniCartDisplay();
    });

    $('body').on('click', '.dr-buy-btn', (e) => {
        e.preventDefault();
        const $this = $(e.target);

        if ($this.hasClass('dr-redirect-buy-btn')) {
            const pdLink = $this.closest('.dr-pd-item, .c-product-card').find('a').attr('href');
            window.location.href = pdLink;
        } else {
            const productID = $this.attr('data-product-id') ? $this.attr('data-product-id').toString() : '';
            const existingProducts = lineItems.map((li) => {
                const { uri } = li.product;
                const id = uri.replace(`${DRCommerceApi.apiBaseUrl}/me/products/`, '');
                return {
                    id,
                    quantity: li.quantity
                };
            });
            let quantity = 1;

            // PD page
            if ($('#dr-pd-offers').length) {
                quantity = parseInt($('#dr-pd-qty').val(), 10);
            }

            existingProducts.forEach((pd) => {
                if (pd.id === productID) {
                    quantity += pd.quantity;
                }
            });

            const queryObj = {
                productId: productID,
                quantity,
                testOrder: drgc_params.testOrder,
                expand: 'all'
            };
            DRCommerceApi.updateCart(queryObj)
                .then(res => {
                  displayMiniCart(res.cart);
                  openMiniCartDisplay();
                })
                .catch(jqXHR => CheckoutUtils.apiErrorHandler(jqXHR));
        }
    });

    $('.dr-minicart-display').on('click', '.dr-minicart-item-remove-btn', (e) => {
        e.preventDefault();
        const lineItemID = $(e.target).data('line-item-id');

        $('.dr-minicart-display').addClass('dr-loading');
        DRCommerceApi.removeLineItem(lineItemID)
            .then(() => DRCommerceApi.getCart())
            .then((res) => {
                $('.dr-minicart-display').removeClass('dr-loading');
                displayMiniCart(res.cart);
            })
            .catch(jqXHR => CheckoutUtils.apiErrorHandler(jqXHR));
    });

    $('span.dr-pd-qty-plus, span.dr-pd-qty-minus').on('click', (e) => {
        // Get current quantity values
        const $qty = $('#dr-pd-qty');
        const val = parseInt($qty.val(), 10);
        const max = parseInt($qty.attr('max'), 10);
        const min = parseInt($qty.attr('min'), 10);
        const step = parseInt($qty.attr('step'), 10);
        if (val) {
            // Change the value if plus or minus
            if ($(e.currentTarget).is('.dr-pd-qty-plus')) {
                if (max && (max <= val)) {
                    $qty.val(max);
                } else {
                    $qty.val(val + step);
                }
            } else if ($(e.currentTarget).is('.dr-pd-qty-minus')) {
                if (min && (min >= val)) {
                    $qty.val(min);
                } else if (val > 1) {
                    $qty.val(val - step);
                }
            }
        } else {
            $qty.val('1');
        }
    });

    $('.dr_prod-variations select').on('change', function(e) {
        e.preventDefault();

        const $selectedOption = $(this).children('option:selected');
        const varId = $(this).val();
        const price = $selectedOption.data('price');
        const listPriceValue = $selectedOption.data('old-price');
        const purchasable = $selectedOption.data('purchasable');
        const $prodPrice = $('.single-dr_product .dr-pd-content .dr-pd-price');
        const $buyBtn = $('.dr-buy-btn');
        let prodPriceHtml = '';

        $buyBtn.attr('data-product-id', varId);
        if (listPriceValue) prodPriceHtml = '<del class="dr-strike-price">' + listPriceValue + '</del>';
        prodPriceHtml += '<strong class="dr-sale-price">' + price + '</strong>';
        $prodPrice.html(prodPriceHtml);

        PdpModule.displayRealTimeBuyBtn(purchasable, false, $buyBtn);

        $('.dr-pd-img').attr('src', $selectedOption.data('thumbnail-url'));
    });

    $('input[type=radio][name=variation]').on('click', (e) => {
        const purchasable = $(e.target).data('purchasable');
        const $buyBtn = $('form.product-detail .dr-buy-btn');
        PdpModule.displayRealTimeBuyBtn(purchasable, false, $buyBtn);
    });

    $( "iframe[name^='controller-']" ).css('display', 'none');

    // Real-time pricing & inventory status option (for DR child/non-DR child themes)
    let pdDisplayOption = {};
    let isPdCard = false;
    if ($('#digital-river-child-css').length) { // DR child theme
        pdDisplayOption = {
            $card: $('.c-product-card'),
            $variationOption: $('input[type=radio][name=variation]'),
            $singlePDBuyBtn: $('form.product-detail .dr-buy-btn'),
            priceDivSelector: () => { return isPdCard ? '.c-product-card__bottom__price' : '.product-pricing'; },
            listPriceDiv: 'span',
            listPriceClass: () => { return isPdCard ? 'old-price' : 'product-price-old'; },
            salePriceDiv: 'span',
            salePriceClass: () => { return isPdCard ? 'new-price' : 'product-price'; },
            priceDiv: 'span',
            priceClass: () => { return isPdCard ? 'price' : 'product-price'; }
        };
    } else { // non-DR child theme
        pdDisplayOption = {
            $card: $('.dr-pd-item'),
            $variationOption: $('select[name=dr-variation] option'),
            $singlePDBuyBtn: $('form#dr-pd-form .dr-buy-btn'),
            priceDivSelector: () => { return isPdCard ? '.dr-pd-item-price' : '.dr-pd-price'; },
            listPriceDiv: 'del',
            listPriceClass: () => { return 'dr-strike-price'; },
            salePriceDiv: 'strong',
            salePriceClass: () => { return 'dr-sale-price'; },
            priceDiv: 'strong',
            priceClass: () => { return 'dr-sale-price'; }
        };
    }

    // Real-time pricing & inventory status for single PD page (including variation/base products)
    if ($('.single-dr_product').length && !$('.dr-prod-variations select').length) { 
        isPdCard = false;
        $(pdDisplayOption.priceDivSelector()).text(localizedText.loading_msg);
        pdDisplayOption.$singlePDBuyBtn.text(localizedText.loading_msg).prop('disabled', true);

        if (pdDisplayOption.$variationOption && pdDisplayOption.$variationOption.length) { // variation product
            pdDisplayOption.$variationOption.each((idx, elem) => {
                const $option = $(elem);
                const productID = $option.val();

                if (!productID) return;
                DRCommerceApi.getProduct(productID, { expand: 'inventoryStatus' }).then((res) => {
                    const purchasable = res.product.inventoryStatus.productIsInStock;

                    isPdCard = false; // to avoid being overwritten by concurrency
                    PdpModule.bindVariationPrice(res.product.pricing, $option);
                    PdpModule.bindVariationInventoryStatus(purchasable, $option);

                    if (idx === 0) PdpModule.selectVariation($option);
                });
            });
        } else { // base product
            const productID = pdDisplayOption.$singlePDBuyBtn.data('product-id');
            const $priceDiv = $(pdDisplayOption.priceDivSelector()).text(localizedText.loading_msg);

            if (!productID) return;
            DRCommerceApi.getProduct(productID, { expand: 'inventoryStatus' }).then((res) => {
                const purchasable = res.product.inventoryStatus.productIsInStock;

                isPdCard = false; // to avoid being overwritten by concurrency
                PdpModule.displayRealTimePricing(res.product.pricing, pdDisplayOption, $priceDiv);
                PdpModule.displayRealTimeBuyBtn(purchasable, false, pdDisplayOption.$singlePDBuyBtn);
            });
        }
    }

    // Real-time pricing & inventory status for PD card (category page & recommended products)
    if (pdDisplayOption.$card && pdDisplayOption.$card.length) {
        isPdCard = true;
        pdDisplayOption.$card.each((idx, elem) => {
            const $currentElem = $(elem);
            const $priceDiv = $currentElem.find(pdDisplayOption.priceDivSelector()).text(localizedText.loading_msg);
            const $buyBtn = $currentElem.find('.dr-buy-btn').text(localizedText.loading_msg).prop('disabled', true);
            const productID = $buyBtn.data('product-id');
            const parentId = $buyBtn.data('parent-id');

            if (!productID) return;

            if (parentId) {
                DRCommerceApi.getProduct(parentId, {fields: 'variations', expand: 'all'}).then((res) => {
                    const variations = res.product.variations.product;
                    const isInStock = variations.some(elem => elem.inventoryStatus.availableQuantity > 0);
                    const currentProduct = variations[0];

                    isPdCard = true; // to avoid being overwritten by concurrency
                    PdpModule.displayRealTimePricing(currentProduct.pricing, pdDisplayOption, $priceDiv);
                    PdpModule.displayRealTimeBuyBtn(isInStock.toString(), true, $buyBtn);
                    PdpModule.updateProductItem($currentElem, currentProduct);
                });
            } else {
                DRCommerceApi.getProduct(productID, { expand: 'inventoryStatus' }).then((res) => {
                    const currentProduct = res.product;
                    const purchasable = currentProduct.inventoryStatus.productIsInStock;

                    isPdCard = true; // to avoid being overwritten by concurrency
                    PdpModule.displayRealTimePricing(currentProduct.pricing, pdDisplayOption, $priceDiv);
                    PdpModule.displayRealTimeBuyBtn(purchasable, false, $buyBtn);
                    PdpModule.updateProductItem($currentElem, currentProduct);
                });
            }
        });
    }

    const $varSelects = $('.dr-prod-variations select');
    const varSelectCount = $varSelects.length;
    const $priceDiv = $(pdDisplayOption.priceDivSelector());
    const $buyBtn = $('.dr-buy-btn');

    if (varSelectCount) {
        $varSelects.children('option:first').prop('selected', true);
        $varSelects.first().prop('disabled', false);
        $buyBtn.prop('disabled', true);
    }

    $('.dr-prod-variations select').on('change', (e) => {
        e.preventDefault();
        $priceDiv.text('');
        $buyBtn.prop('disabled', true);

        const selectedVal = $(e.target).val();
        const index = $(e.target).data('index');
        const selectedValues = [];
        const allSelectedVal = {};
        const filterObj = Object.assign({}, drgcVarAttrs);
        let i = index;
        let j = 0;

        while (i < varSelectCount) {
            const $next = $varSelects.eq(i + 1);

            if ($next.length) {
                $next.prop('disabled', true).children('option:first').prop('selected', true);
            }

            while (j < index) {
                selectedValues[j] = $varSelects.eq(j).val();
                j++;
            }

            selectedValues[index] = selectedVal;

            selectedValues.forEach((element, i) => {
                const attr = $varSelects.eq(i).data('var-attribute');
                const deleteItems = Object.keys(filterObj).filter(key => filterObj[key][attr] !== element);

                deleteItems.forEach((key) => {
                    delete filterObj[key];
                });    
            });

            i++;
        }

        if ((index < varSelectCount - 1) && selectedVal) {
            const $nextSelect = $varSelects.eq(index + 1);
            const nextAttr = $nextSelect.data('var-attribute');
            const options = [...new Set(Object.keys(filterObj).map(key => filterObj[key][nextAttr]))];

            $nextSelect.children('option:not(:first-child)').remove();

            $.each(options, (key, value) => {
                $nextSelect.append($('<option></option>').attr('value', value).text(value));
            });

            $nextSelect.prop('disabled', false);
        }

        $varSelects.children('option:selected').each((index, element) => {
            allSelectedVal[$(element).parent().data('var-attribute')] = $(element).val();
        });

        const productId = Object.keys(drgcVarAttrs).find(key => JSON.stringify(drgcVarAttrs[key]) === JSON.stringify(allSelectedVal));

        if (productId) {
            $priceDiv.text(localizedText.loading_msg);
            DRCommerceApi.getProduct(productId, {expand: 'inventoryStatus'})
                .then((res) => {
                    const currentProduct = res.product;
                    const purchasable = currentProduct.inventoryStatus.productIsInStock;

                    PdpModule.displayRealTimePricing(currentProduct.pricing, pdDisplayOption, $priceDiv);
                    PdpModule.displayRealTimeBuyBtn(purchasable, false, $buyBtn);
                });

            $buyBtn.attr('data-product-id', productId).prop('disabled', false);
        }
    });
});

export default PdpModule;
