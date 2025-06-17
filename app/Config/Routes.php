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
    // Rutas de autenticación (protegidas) para el gestion de extras
    ///gestion de extras
    $routes->get('extrasmanagement', 'ExtrasController::index');
    //bank
    $routes->get('extrasmanagement/bank', 'BankController::index');
    $routes->post('extrasmanagement/bank/add', 'BankController::create');
    $routes->post('extrasmanagement/bank/update/(:num)', 'BankController::update/$1');
    $routes->get('extrasmanagement/bank/delete/(:num)', 'BankController::delete/$1');
    //banker
    $routes->get('extrasmanagement/banker', 'BankerController::index');
    $routes->post('extrasmanagement/banker/add', 'BankerController::create');
    $routes->post('extrasmanagement/banker/update/(:num)', 'BankerController::update/$1');
    $routes->get('extrasmanagement/banker/delete/(:num)', 'BankerController::delete/$1');
    //company
    $routes->get('extrasmanagement/company', 'CompanyController::index');
    $routes->post('extrasmanagement/company/add', 'CompanyController::create');
    $routes->post('extrasmanagement/company/update/(:num)', 'CompanyController::update/$1');
    $routes->get('extrasmanagement/company/delete/(:num)', 'CompanyController::delete/$1');
    // request statuses
    $routes->get('extrasmanagement/request-statuses', 'RequestStatusesController::index');
    $routes->post('extrasmanagement/request-statuses/add', 'RequestStatusesController::create');
    $routes->post('extrasmanagement/request-statuses/update/(:num)', 'RequestStatusesController::update/$1');
    $routes->get('extrasmanagement/request-statuses/delete/(:num)', 'RequestStatusesController::delete/$1');
    // request types
     // request statuses
     $routes->get('extrasmanagement/request-types', 'RequestTypesController::index');
     $routes->post('extrasmanagement/request-types/add', 'RequestTypesController::create');
     $routes->post('extrasmanagement/request-types/update/(:num)', 'RequestTypesController::update/$1');
     $routes->get('extrasmanagement/request-types/delete/(:num)', 'RequestTypesController::delete/$1');
    // Rutas de autenticación (protegidas) para el aside
    ///setting
    $routes->get('setting', 'ConfigurationController::index');
    $routes->post('setting/save_security_settings', 'ConfigurationController::saveSecuritySettings');
    $routes->post('setting/save_smtp', 'ConfigurationController::saveSMTPConfig');
    ///profile
    $routes->get('profile', 'ProfileController::index');
    // Rutas de autenticación (protegidas) para el modulo de sistema
    //pqrsmanagement
    $routes->get('pqrsmanagement', 'PqrsManagementController::index');
    $routes->post('pqrsmanagement/filter', 'PqrsManagementController::filterRequests');
    $routes->get('pqrsmanagement/cancel-request/(:num)', 'PqrsManagementController::cancelrequest/$1');
    $routes->post('pqrsmanagement/getDetails', 'PqrsManagementController::detailsRequest');
    $routes->post('pqrsmanagement/resolved-request', 'PqrsManagementController::solveRequest');

    ///transactions
    $routes->get('transactions', 'TransactionsController::index');
    $routes->post('transactions/search', 'TransactionsController::search');
    $routes->post('transactions/pay', 'TransactionsController::pay');
// Rutas de autenticación (protegidas) para el modulo de seguridad
    ///clientmanagemen
    $routes->get('clientmanagement', 'ClientsManagementController::index'); // Listar usuarios
    $routes->get('clientmanagement/show/(:num)', 'ClientsManagementController::show/$1'); // Obtener un usuario específico
    $routes->post('clientmanagement/add', 'ClientsManagementController::addUser'); // Crear usuario
    $routes->post('clientmanagement/update/(:num)', 'ClientsManagementController::updateUser/$1'); // Actualizar usuario
    $routes->post('clientmanagement/getClient/(:num)', 'ClientsManagementController::getUserById/$1'); // Actualizar usuario
    $routes->get('clientmanagement/delete/(:num)', 'ClientsManagementController::deleteUser/$1'); // Eliminar usuario
    $routes->post('clientmanagement/recalculateCompoundInterest', 'ClientsManagementController::recalculateCompoundInterest');

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

    // Rutas de autenticación (protegidas) para pqrs client
    $routes->get('pqrs-sent', 'PqrsSentController::index');
    $routes->post('pqrs-sent/save', 'PqrsSentController::save'); // Guardar PQRS
    $routes->get('historytransactions/detail/(:num)', 'HistoryTransactionsController::renderViewHistoryTransaction/$1');

    //PQRS VIEW
    $routes->get('pqrs-sent/view', 'PqrsSentController::view'); // Ver detalles de una PQRS
});