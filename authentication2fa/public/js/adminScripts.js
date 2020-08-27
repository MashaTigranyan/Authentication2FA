init = () => {
    jQuery('#mt-auth-2fa-option').change(function() {
        let val = '';
        if (this.checked) {
            val = jQuery(this).val();
        }

        let data = {
            action: 'mtauth_autosave',
            nonce: MT_AUTH_JS_PARAMS.nonce,
            value: val
        };

        jQuery.post(MT_AUTH_JS_PARAMS.ajaxUrl, data, function(response) {

        });
    });
};


jQuery(document).ready(function() {
    init();
});
