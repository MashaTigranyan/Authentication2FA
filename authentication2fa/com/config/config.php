<?php

class MtAuthPluginConfig
{
    public static function addDefine($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    public static function init() {
        self::addDefine('MT_AUTH_PLUGIN_URL', plugins_url().'/'.MT_AUTH_PLUGIN_FOLDER_NAME.'/');
        self::addDefine('MT_AUTH_PLUGIN_PATH', WP_PLUGIN_DIR.'/'.MT_AUTH_PLUGIN_FOLDER_NAME.'/');

        self::addDefine('MT_AUTH_PLUGIN_COM_PATH', MT_AUTH_PLUGIN_PATH.'com/');
        self::addDefine('MT_AUTH_PLUGIN_CONFIG_PATH', MT_AUTH_PLUGIN_COM_PATH.'config/');
        self::addDefine('MT_AUTH_PLUGIN_CLASSES_PATH', MT_AUTH_PLUGIN_COM_PATH.'classes/');
        self::addDefine('MT_AUTH_PLUGIN_HELPERS_PATH', MT_AUTH_PLUGIN_COM_PATH.'helpers/');

        self::addDefine('MT_AUTH_PLUGIN_PUBLIC_PATH', MT_AUTH_PLUGIN_PATH.'public/');
        self::addDefine('MT_AUTH_PLUGIN_CSS_PATH', MT_AUTH_PLUGIN_PUBLIC_PATH.'css/');
        self::addDefine('MT_AUTH_PLUGIN_JS_PATH', MT_AUTH_PLUGIN_PUBLIC_PATH.'js/');

        self::addDefine('MT_AUTH_PLUGIN_CLASSES_URL', MT_AUTH_PLUGIN_URL.'com/classes/');
        self::addDefine('MT_AUTH_PLUGIN_PUBLIC_URL', MT_AUTH_PLUGIN_URL.'public/');
        self::addDefine('MT_AUTH_PLUGIN_CSS_URL', MT_AUTH_PLUGIN_PUBLIC_URL.'css/');
        self::addDefine('MT_AUTH_PLUGIN_JS_URL', MT_AUTH_PLUGIN_PUBLIC_URL.'js/');

        self::addDefine('MT_AUTH_PLUGIN_TEXT_DOMAIN', 'mt-auth');
        self::addDefine('MT_AUTH_AJAX_NONCE', 'mt-auth-ajax-nonce');
        
        self::addDefine('MT_AUTH_PLUGIN_TOKEN_TIMESTAMP', 'mt-auth-token-timestamp');
        self::addDefine('MT_AUTH_PLUGIN_TOKEN', 'mt-auth-token');
        self::addDefine('MT_AUTH_PLUGIN_LINK_KEY', 'mt-auth-link-key');
        /* options name */
        self::addDefine('MT_AUTH_PLUGIN_2FA_OPTION', 'mt-auth-2fa-option');
    }
}

MtAuthPluginConfig::init();
