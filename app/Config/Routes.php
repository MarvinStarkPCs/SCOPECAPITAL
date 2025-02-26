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
    $routes->get('dashboard', 'HomeController::index');
    // rutas de gestion de extras
    $routes->get('extrasmanagement', 'ExtrasController::index');
    //rutas de gestion de extras (bank)
    $routes->get('extrasmanagement/bank', 'ExtrasController::index');
    $routes->get('pqrsmanagement', 'PqrsController::index');
    // Rutas de autenticación (protegidas) para el aside
    ///setting
    $routes->get('setting', 'SettingController::index');
    $routes->post('setting/save_security_settings', 'SettingController::saveSecuritySettings');
    $routes->post('setting/save_smtp', 'SettingController::saveSMTPConfig');
    ///profile
    $routes->get('profile', 'ProfileController::index');
    // Rutas de autenticación (protegidas) para el modulo de sistema
    ///transactions
    $routes->get('transactions', 'TransactionsController::index');
    $routes->post('transactions/search', 'TransactionsController::search');
    $routes->post('transactions/recharge', 'TransactionsController::recharge');
    // Rutas de autenticación (protegidas) para el modulo de historial
    ///historytransactions
    $routes->get('historytransactions', 'HistoryTransactionsController::index');
    $routes->get('historytransactions/detail/(:num)', 'HistoryTransactionsController::renderViewHistoryTransaction/$1');
    $routes->post('historytransactions/search', 'TransactionsController::search');
    // Rutas de autenticación (protegidas) para el modulo de seguridad
    ///usermanagemen
    $routes->get('usermanagement', 'UserManagementController::index'); // Listar usuarios
    $routes->get('usermanagement/show/(:num)', 'UserManagementController::show/$1'); // Obtener un usuario específico
    $routes->post('usermanagement/add', 'UserManagementController::addUser'); // Crear usuario
    $routes->post('usermanagement/update/(:num)', 'UserManagementController::updateUser/$1'); // Actualizar usuario
    $routes->get('usermanagement/delete/(:num)', 'UserManagementController::deleteUser/$1'); // Eliminar usuario
    ///changepassword
    $routes->get('changepassword', 'ChangePasswordController::index');  // Cargar formulario
    $routes->post('changepassword/update', 'ChangePasswordController::updatePassword');  // Enviar formulario

});


$routes->group('client', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'HomeController::index');
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::updateProfile');
    ///changepassword
    $routes->get('changepassword', 'ChangePasswordController::index');  // Cargar formulario
    $routes->post('changepassword/update', 'ChangePasswordController::updatePassword');  // Enviar formulario
});