<?php
/**
 * Tematres Suggest
 *
 * @copyright Copyright 2025 Diego Ferreyra
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Tematres Suggest plugin.
 *
 * @package Omeka\Plugins\T3Suggest
 */
class T3SuggestPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'uninstall',
        'initialize',
        'define_acl',
    );

    protected $_filters = array(
        'admin_navigation_main',
    );

    /**
     * Install the plugin.
     */
    public function hookInstall()
    {
        $sql = "
        CREATE TABLE `{$this->_db->T3Suggest}` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `element_id` int(10) unsigned NOT NULL,
            `suggest_endpoint` tinytext COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `element_id` (`element_id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
        $this->_db->query($sql);
    }

    /**
     * Uninstall the plugin.
     */
    public function hookUninstall()
    {
        $sql = "DROP TABLE IF EXISTS `{$this->_db->T3Suggest}`";
        $this->_db->query($sql);
    }

    /**
     * Initialize the plugin.
     */
    public function hookInitialize()
    {
        // Register the SelectFilter controller plugin.
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new T3Suggest_Controller_Plugin_Autosuggest);

        // Add translation.
        add_translation_source(dirname(__FILE__) . '/languages');
    }

    /**
     * Define the plugin's access control list.
     */
    public function hookDefineAcl($args)
    {
        $acl = $args['acl'];
        $acl->addResource('T3Suggest_Index');
        $acl->allow(null, 'T3Suggest_Index', 'suggest-endpoint-proxy');
    }

    /**
     * Add the LC Suggest page to the admin navigation.
     */
    public function filterAdminNavigationMain($nav)
    {
        $nav[] = array(
            'label' => __('T3 Suggest'),
            'uri' => url('t3-suggest'),
            'resource' => 'T3Suggest_Index',
            'privilege' => 'index',
        );
        return $nav;
    }
}
