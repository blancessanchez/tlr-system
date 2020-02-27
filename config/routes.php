<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\InflectedRoute;


Router::defaultRouteClass(InflectedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'EmployeeInformation', 'action' => 'index', 'login']);
    $routes->connect('/home', ['controller' => 'EmployeeInformation', 'action' => 'home']);
    $routes->connect('/logout', ['controller' => 'EmployeeInformation', 'action' => 'logout']);
    $routes->connect('/logs', ['controller' => 'ActivityLogs', 'action' => 'index']);
    $routes->connect('/settings', ['controller' => 'Configurations', 'action' => 'edit']);

    /**
     * EmployeeInformation controller
     */
    $routes->scope('/employees', function($routes) {
        $routes->connect(
            '/list',
            [
                'controller' => 'EmployeeInformation',
                'action' => 'employeeList'
            ]
        );

        $routes->connect(
            '/add',
            [
                'controller' => 'EmployeeInformation',
                'action' => 'add'
            ]
        );

        $routes->connect(
            '/edit/:id',
            [
                'controller' => 'EmployeeInformation',
                'action' => 'edit'
            ],
            [
                'pass' => ['id'],
                'id' => '[0-9]+'
            ]
        );
    });

    /**
     * Leaves controller
     */
    $routes->scope('/leaves', function($routes) {
        $routes->connect(
            '/',
            [
                'controller' => 'Leaves',
                'action' => 'index'
            ]
        );

        $routes->connect(
            '/apply',
            [
                'controller' => 'Leaves',
                'action' => 'add'
            ]
        );

        $routes->connect(
            '/edit/:id',
            [
                'controller' => 'Leaves',
                'action' => 'edit'
            ],
            [
                'pass' => ['id'],
                'id' => '[0-9]+'
            ]
        );

        $routes->connect(
            '/view/:id',
            [
                'controller' => 'Leaves',
                'action' => 'view'
            ],
            [
                'pass' => ['id'],
                'id' => '[0-9]+'
            ]
        );

        $routes->connect(
            '/report',
            [
                'controller' => 'Leaves',
                'action' => 'generateReport'
            ]
        );

        $routes->connect(
            '/cancel/:id',
            [
                'controller' => 'Leaves',
                'action' => 'cancel'
            ],
            [
                'pass' => ['id'],
                'id' => '[0-9]+'
            ]
        );
    });

    /**
     * LeaveApplicationResponses controller
     */
    $routes->scope('/leave_response', function($routes) {
        $routes->connect(
            '/add',
            [
                'controller' => 'LeaveApplicationResponses',
                'action' => 'add'
            ]
        );
    });

    /**
     * Terms controller
     */
    $routes->scope('/terms', function($routes) {
        $routes->connect(
            '/add',
            [
                'controller' => 'Terms',
                'action' => 'add'
            ]
        );
    });

    $routes->fallbacks(InflectedRoute::class);
});
