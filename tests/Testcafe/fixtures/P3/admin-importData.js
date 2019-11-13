import { Selector } from 'testcafe';
import { ClientFunction, t } from 'testcafe';
import config from '../../config';
import user from '../../utils/admin-login';
import AdminPage from '../../page-models/admin/admin-page-model';
import MinicartPage from '../../page-models/public/minicart-page-model';
import DataUtils from '../../utils/dataUtils';

const adminPage = new AdminPage();
const minicartPage = new MinicartPage();
const getLocation = ClientFunction(() => document.location.href.toString());

fixture `===== DRGC P3 Automation Test - Admin: Import Data =====`
  .beforeEach(async t => {
    console.log('>> Logging in into admin panel...');
    await t
      .useRole(user)
      .expect(adminPage.drLink.exists).ok()
      .maximizeWindow();
    console.log('>> Login to admin panel successfully!');
  });

test('Move DR Products to Trash', async t => {
  console.log('Test Case: Move DR Products to Trash');
  console.log('>> Enter product import page and move all products into trash');
  await t
    .hover(adminPage.drLink)
    .click(adminPage.drProductsLink)
    .expect(adminPage.productsImportBtn.exists).ok()
    .click(adminPage.selectAll);

  await adminPage.bulkActions.with({visibilityCheck:true});

  await t
    .click(adminPage.bulkActions)
    .click(adminPage.moveToTrash)
    .click(adminPage.applyBtn);
  await t.expect(adminPage.returnMsg.textContent).contains('posts moved to the Trash');

  console.log('>> Empty Trash');
  await t
    .click(adminPage.trashLink)
    .click(adminPage.emptyTrashBtn);
  await t.expect(adminPage.returnMsg.textContent).contains('posts permanently deleted');
});

const prodName = new DataUtils().getTestingPhysicalProduct().productName;
const permaLink = new DataUtils().getTestingPhysicalProduct().permalink;

test('Import DR Products', async t => {
  console.log('Test Case: Import DR products');
  await t
    .setTestSpeed(0.7)
    .hover(adminPage.drLink)
    .click(adminPage.drProductsLink);

  console.log('>> Start to import products');
  await t
    .expect(adminPage.productsImportBtn.exists).ok()
    .click(adminPage.productsImportBtn);

  const sel1 = adminPage.importProgress.with({visibilityCheck:true}).nth(0);
  await t.expect(sel1.exists).ok({timeout:20000});
  const sel2 = adminPage.importProgress;
  await t
    .expect(sel2.with({visibilityCheck: true}).exists).notOk({timeout:600000})
    .expect(getLocation()).contains('&import-complete=1')
    .click(adminPage.drProductsLink);
  console.log(' >>', await adminPage.displayNum.textContent + ' have been successfully imported!');

  //view product & add product to cart
  console.log('>> View product and add it into cart');
  await t
    .hover(adminPage.drLink)
    .click(adminPage.drProductsLink)
    .typeText(adminPage.searchProductsInput, prodName)
    .click(adminPage.searchProductsBtn);

  const retItems = await adminPage.displayNum.textContent;
  await t
    .expect(retItems).eql("1 item")
    .hover(adminPage.productTable)
    .click(adminPage.viewTable)
    .expect(getLocation()).contains(permaLink)
    .click(adminPage.addToCartBtn);

  console.log('>> Directs to cart page');
  await minicartPage.clickViewCartBtn();
});
