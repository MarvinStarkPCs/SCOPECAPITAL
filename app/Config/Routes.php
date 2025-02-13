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
    $routes->get('extrasmanagement', 'ExtrasController::index');
    $routes->get('pqrsmanagement', 'PqrsController::index');
    $routes->get('transactions', 'Ctransactions::index');
    $routes->get('dashboard', 'HomeController::index');

    // Rutas de autenticación (protegidas) para el modulo de seguridad
    ///usermanagemen
    $routes->get('usermanagement', 'UserManagementController::index'); // Listar usuarios
    $routes->get('usermanagement/show/(:num)', 'UserManagementController::show/$1'); // Obtener un usuario específico
    $routes->post('usermanagement/add', 'UserManagementController::addUser'); // Crear usuario
    $routes->post('usermanagement/update/(:num)', 'UserManagementController::updateUser/$1'); // Actualizar usuario
    $routes->post('usermanagement/delete/(:num)', 'UserManagementController::deleteUser/$1'); // Eliminar usuario
    
});


