<?php
/**
 * Tematres Suggest
 *
 * @copyright Copyright 2025 Diego Ferreyra
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * The Tematres Suggest controller plugin.
 *
 * @package Omeka\Plugins\T3Suggest
 */
class T3Suggest_Controller_Plugin_Autosuggest extends Zend_Controller_Plugin_Abstract
{
    /**
     * Add autosuggest only during defined routes.
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $db = get_db();

        // Set NULL modules to default. Some routes do not have a default
        // module, which resolves to NULL.
        $module = $request->getModuleName();
        if (is_null($module)) {
            $module = 'default';
        }
        $controller = $request->getControllerName();
        $action = $request->getActionName();

        // Include all routes (route + controller + actions) that render an
        // element form, including actions requested via AJAX.
        $routes = array(
            array('module' => 'default',
                  'controller' => 'items',
                  'actions' => array('add', 'edit', 'element-form', 'change-type'))
        );

        // Allow plugins to add routes that contain form inputs rendered by
        // Omeka_View_Helper_ElementForm::_displayFormInput().
        $routes = apply_filters('t3_suggest_routes', $routes);

        // Iterate the defined routes.
        foreach ($routes as $route) {

            // Set the autosuggest if the current action matches a defined route.
            if ($route['module'] === $module && $route['controller'] === $controller
                && in_array($action, $route['actions'])) {

                // Iterate the elements that are assigned to a suggest endpoint.
                $t3Suggests = $db->getTable('T3Suggest')->findAll();
                foreach ($t3Suggests as $t3Suggest) {

                    $element = $db->getTable('Element')->find($t3Suggest->element_id);
                    $elementSet = $db->getTable('ElementSet')->find($element->element_set_id);

                    // Add the autosuggest JavaScript to the JS queue.
                    $view = Zend_Registry::get('view');
                    $view->headScript()->captureStart();
?>
    // Add autosuggest to <?php echo $elementSet->name . ':' . $element->name; ?>. Used by the Tematres Suggest plugin.
    jQuery(document).bind('omeka:elementformload', function(event) {
        jQuery('#element-<?php echo $element->id; ?> textarea').autocomplete({
            minLength: 2,
            source: <?php echo json_encode($view->url('t3-suggest/index/suggest-endpoint-proxy/element-id/' . $element->id)); ?>
        });
    });
<?php
                    $view->headScript()->captureEnd();
                }

                // Once the JavaScript is applied there is no need to continue
                // looping the defined routes.
                break;
            }
        }
    }
}
