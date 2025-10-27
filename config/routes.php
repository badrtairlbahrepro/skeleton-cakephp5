<?php
declare(strict_types=1);

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that helps you organize your code.
 *
 * @link https://book.cakephp.org/5/en/routing.html
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/**
 * This code runs before each request.
 * Set here the default locale, logging, etc.
 */

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder): void {
    /**
     * Here, we are connecting '/' (index) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, templates/Pages/home.php)
     * This is basically the same as:
     * - Route with GET    http://www.example.com/ -> Pages::display('home')
     */
    $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Logs Viewer Routes (Telescope-like interface) - Plugin LogViewer
     */
    $builder->scope('/logs', function (RouteBuilder $routes) {
        $routes->connect('/', ['plugin' => 'LogViewer', 'controller' => 'Logs', 'action' => 'index']);
        $routes->connect('/export/*', ['plugin' => 'LogViewer', 'controller' => 'Logs', 'action' => 'export']);
        $routes->connect('/view/*', ['plugin' => 'LogViewer', 'controller' => 'Logs', 'action' => 'view']);
        $routes->connect('/clear/*', ['plugin' => 'LogViewer', 'controller' => 'Logs', 'action' => 'clear']);
        $routes->connect('/download/*', ['plugin' => 'LogViewer', 'controller' => 'Logs', 'action' => 'download']);
    });

    /**
     * Components Library Routes
     */
$builder->connect('/components', ['controller' => 'Components', 'action' => 'index']);
$builder->connect('/components/:group', ['controller' => 'Components', 'action' => 'view']);

/**
 * FormBuilder Routes - Plugin AdminLteForm
 */
$builder->scope('/form-builder', function (RouteBuilder $routes) {
    $routes->connect('/', ['plugin' => 'AdminLteForm', 'controller' => 'FormBuilder', 'action' => 'index']);
    $routes->connect('/contact', ['plugin' => 'AdminLteForm', 'controller' => 'FormBuilder', 'action' => 'contact']);
    $routes->connect('/register', ['plugin' => 'AdminLteForm', 'controller' => 'FormBuilder', 'action' => 'register']);
    $routes->connect('/profile', ['plugin' => 'AdminLteForm', 'controller' => 'FormBuilder', 'action' => 'profile']);
    $routes->connect('/search', ['plugin' => 'AdminLteForm', 'controller' => 'FormBuilder', 'action' => 'search']);
    $routes->connect('/multiple', ['plugin' => 'AdminLteForm', 'controller' => 'FormBuilder', 'action' => 'multiple']);
    $routes->connect('/switches', ['plugin' => 'AdminLteForm', 'controller' => 'FormBuilder', 'action' => 'switches']);
});

    /**
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for creating catch-all routes
     * for controller and plugin routing. It should always be the last route
     * method call in a scope.
     *
     * Otherwise, it may not work as expected when you want a fallback
     * route for a specific controller.
     *
     * For e.g.
     *    $builder->fallbacks(DashedRoute::class);
     */
    $builder->fallbacks();
});

/**
 * If you need a different set of middleware or state in a group of
 * routes, append `/admin` in the path and create a new scope.
 *
 * @link https://book.cakephp.org/5/en/routing.html#routing-scopes
 *
 * ````
 * $routes->scope('/admin', function (RouteBuilder $builder): void {
 *     // Here, $builder only applies to URLs that start with /admin
 *     $builder->fallbacks(DashedRoute::class);
 * });
 * ````
 */
