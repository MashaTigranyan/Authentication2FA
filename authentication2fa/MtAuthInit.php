<?php
namespace mtauth;
require_once 'com/config/config.php';
use MtAuthPluginConfig;

class MtAuthInit
{
    private static $instance = null;
    private $actions;
    private $filters;

    private function __construct() {
        $this->init();
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init() {
        /*Included required data*/
        $this->includeData();
        $this->registerHooks();
        $this->actions();
        $this->filters();
    }

    private function includeData() {
        require_once(MT_AUTH_PLUGIN_CLASSES_PATH.'Ajax.php');
        require_once (MT_AUTH_PLUGIN_CLASSES_PATH.'Filters.php');
        require_once (MT_AUTH_PLUGIN_CLASSES_PATH.'Actions.php');
        require_once (MT_AUTH_PLUGIN_CLASSES_PATH.'MtAuthPopupExtension.php');
        require_once (MT_AUTH_PLUGIN_HELPERS_PATH.'Helper.php');
    }

    public function actions() {
        $this->actions = new Actions();
    }

    public function filters() {
        $this->filters = new Filters();
    }

    private function registerHooks() {
        register_activation_hook(MT_AUTH_PLUGIN_FILE_NAME, array($this, 'activate'));
        register_deactivation_hook(MT_AUTH_PLUGIN_FILE_NAME, array($this, 'deactivate'));
    }

    public function activate() {

    }

    public function deactivate() {

    }
}

MtAuthInit::getInstance();
