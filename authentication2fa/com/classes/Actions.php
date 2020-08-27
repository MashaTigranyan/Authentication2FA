<?php
namespace mtauth;

class Actions
{
    public function __construct() {
        $this->init();
    }

    public function init() {
        add_action('wp_enqueue_scripts', array($this, 'loadFrontendStyles'));
        add_action('wp_enqueue_scripts', array($this, 'loadFrontendScripts'));
        add_action('admin_enqueue_scripts', array($this, 'loadAdminScripts'));
        add_action('admin_enqueue_scripts', array($this, 'loadAdminStyles'));

        add_action('show_user_profile', array($this, 'addTwoFaOption'));
        add_action('edit_user_profile', array($this, 'addTwoFaOption'));

        add_action('personal_options_update', array($this, 'updateTwoFaOption'));
        add_action('edit_user_profile_update', array($this, 'updateTwoFaOption'));

        new Ajax();
    }

    /* load frontend styles and scripts*/
    public function loadFrontendStyles() {
        $cssFiles = MtAuthPopupExtension::getFrontendStyles();
        if (empty($cssFiles)) {
            return;
        }
        foreach ($cssFiles as $file) {
            MtAuthPopupExtension::registerScript($file, 'css');
        }
    }

    public function loadFrontendScripts() {
        $scriptData = MtAuthPopupExtension::getFrontendScripts();

        $jsFiles = $scriptData['jsFiles'];
        if (!empty($jsFiles)) {
            foreach ( $jsFiles as $file) {
                MtAuthPopupExtension::registerScript($file);
            }
        }

        $localizeData = $scriptData['localizeData'];
        if (!empty($localizeData)) {
            foreach ( $localizeData as $file) {
                MtAuthPopupExtension::localizeScript($file);
            }
        }
    }

    /* load admin styles and scripts*/
    public function loadAdminScripts() {
        global $pagenow;

        if ($pagenow != 'profile.php') {
            return '';
        }
        $scriptData = MtAuthPopupExtension::getAdminScripts();

        $jsFiles = $scriptData['jsFiles'];
        if (!empty($jsFiles)) {
            foreach ( $jsFiles as $file) {
                MtAuthPopupExtension::registerScript($file);
            }
        }

        $localizeData = $scriptData['localizeData'];
        if (!empty($localizeData)) {
            foreach ( $localizeData as $file) {
                MtAuthPopupExtension::localizeScript($file);
            }
        }
    }

    public function loadAdminStyles() {
        global $pagenow;

        if ($pagenow != 'profile.php') {
            return '';
        }
        $cssFiles = MtAuthPopupExtension::getAdminStyles();
        foreach ($cssFiles as $file) {
            MtAuthPopupExtension::registerScript($file, 'css');
        }
    }

    public function addTwoFaOption($user) {
        require_once MT_AUTH_PLUGIN_PUBLIC_PATH.'AuthenticationOptions.php';
    }

    public function updateTwoFaOption($userId) {
        if (isset($_POST[MT_AUTH_PLUGIN_2FA_OPTION])) {
            update_user_meta($userId, MT_AUTH_PLUGIN_2FA_OPTION, $_POST[MT_AUTH_PLUGIN_2FA_OPTION]);
        }
    }
}
