require([
    'jquery',
    'mage/mage'
], function ($) {
    var dataForm = $('.g-frm_helpdesk--send').first();
    if (dataForm.length) {
        dataForm.mage('validation', {});
    }
});