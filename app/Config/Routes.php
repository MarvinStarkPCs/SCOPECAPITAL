<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//rutas por vista
// Rutas de autenticación (no protegidas)
$routes->get('/', 'IndexController::index');
$routes->get('login', 'AuthController::index');
$routes->post('authenticate', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

// Rutas protegidas (requieren autenticación)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('usermanagement', 'ExtrasController::index');
    $routes->get('extrasmanagement', 'ExtrasController::index');
    $routes->get('pqrsmanagement', 'PqrsController::index');
    $routes->get('transactions', 'Ctransactions::index');
    $routes->get('dashboard', 'HomeController::index');
});


