import AdminPage from '../../page-models/admin/admin-page-model';
import user from '../../utils/admin-login';
import config from '../../config';

fixture `===== DRGC P3 Automation Test - Admin: Config DRGC Settings =====`;


const adminPage = new AdminPage();

test('DR Site Settings - ', async t => {
  console.log('Test Case: Admin Page - DR Site Settings');
  console.log('>> Enter admin settings page');
  await t
    .useRole(user)
    .expect(adminPage.drLink.exists).ok()
    .maximizeWindow()
    .hover(adminPage.drLink)
    .click(adminPage.drSettingsLink)
    .expect(adminPage.saveBtn.visible).ok();

  console.log('>> Update site settings');
  await t
    .typeText(adminPage.siteID, config.drSettings['siteID'], { replace: true })
    .typeText(adminPage.apiKey, config.drSettings['apiKey'], { replace: true })
    .typeText(adminPage.apiSecret, config.drSettings['apiSecret'], { replace: true })
    .typeText(adminPage.domainInput, config.drSettings['domainInput'], { replace: true })
    .typeText(adminPage.pluginKey, config.drSettings['pluginKey'], { replace: true });

  if (!await adminPage.scheduledImport.checked) {
    console.log('  -> Enable schedule import');
    await t.click(adminPage.scheduledImport);
  }

  if (!await adminPage.testOrder.checked) {
    console.log('  -> Enable test order');
    await t.click(adminPage.testOrder);
  }

  await t.click(adminPage.saveBtn);
});
