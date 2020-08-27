<?php
namespace mtauth;

class MtAuthPopupExtension
{
    public static function getAdminScripts () {
        $jsFiles = array();
        $localizeData = array();

        $jsFiles[] = array('folderUrl'=> MT_AUTH_PLUGIN_JS_URL, 'filename' => 'adminScripts.js');

        $localizeData[] = array(
            'handle' => 'adminScripts.js',
            'name' => 'MT_AUTH_JS_PARAMS',
            'data' => array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce(MT_AUTH_AJAX_NONCE),
            )
        );

        $scriptData = array(
            'jsFiles' => $jsFiles,
            'localizeData' => $localizeData
        );

        return $scriptData;
    }

    public static function getAdminStyles () {
        $cssFiles[] = array('folderUrl'=> MT_AUTH_PLUGIN_CSS_URL, 'filename' => 'adminStyles.css');

        return $cssFiles;
    }

    public static function getFrontendScripts () {
        $jsFiles = array();
        $localizeData = array();

        $jsFiles[] = array('folderUrl'=> MT_AUTH_PLUGIN_JS_URL, 'filename' => 'bootstrap.bundle.min.js', 'dep' => array('jquery'));
        $jsFiles[] = array('folderUrl'=> MT_AUTH_PLUGIN_JS_URL, 'filename' => 'frontendScripts.js');

        $localizeData[] = array(
            'handle' => 'frontendScripts.js',
            'name' => 'MT_AUTH_JS_PARAMS',
            'data' => array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce(MT_AUTH_AJAX_NONCE),
                'translations' => array(
                    'login' => __('Login', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'registration' => __('SignUp', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'username' => __('Enter username', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'password' => __('Enter password', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'email' => __('Enter email', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'rememberme' => __('Remember me', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'forgotPassword' => __('Forgot Password', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'resetPassword' => __('Reset Password', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'newPassword' => __('New Password', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'confirm' => __('Confirm', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                    'twoFaCode' => __('Confirmation Code', MT_AUTH_PLUGIN_TEXT_DOMAIN),
                )
            )
        );

        $scriptData = array(
            'jsFiles' => $jsFiles,
            'localizeData' => $localizeData
        );

        return $scriptData;
    }

    public static function getFrontendStyles () {
        $cssFiles[] = array('folderUrl'=> MT_AUTH_PLUGIN_CSS_URL, 'filename' => 'bootstrap.min.css');
        $cssFiles[] = array('folderUrl'=> MT_AUTH_PLUGIN_CSS_URL, 'filename' => 'frontendStyles.css');

        return $cssFiles;
    }

    public static function registerScript($fileData, $type = 'js') {
        $registerFunctionName = 'wp_register_script';
        $enqueueFunctionName = 'wp_enqueue_script';

        $fileName = $fileData['filename'];
        $dirUrl = $fileData['folderUrl'];
        $dep = (!empty($fileData['dep'])) ? $fileData['dep'] : '';
        $ver = (!empty($fileData['ver'])) ? $fileData['ver'] : '';
        $inFooter = (!empty($fileData['inFooter'])) ? $fileData['inFooter'] : '';

        if ($type == 'css') {
            $registerFunctionName = 'wp_register_style';
            $enqueueFunctionName = 'wp_enqueue_style';
        }
        $registerFunctionName($fileName, $dirUrl.''.$fileName, $dep, $ver, $inFooter);
        $enqueueFunctionName($fileName);
    }

    public static function localizeScript($file) {
        $handle = $file['handle'];
        $name = $file['name'];
        $data = $file['data'];

        wp_localize_script($handle, $name, $data);
    }
}