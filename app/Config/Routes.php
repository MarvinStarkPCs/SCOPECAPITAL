<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//rutas por vista

//authentication
$routes->get('/', 'Cindex::index');

$routes->get('/login', 'Clogin::index');
$routes->post('clogin/authenticate', 'Clogin::authenticate');
$routes->post('cambiar-contrasena/actualizar', 'CambioContrasena::actualizar');
$routes->get('clogin/logout', 'Clogin::logout');


$routes->get('pqrs', 'Cpqrs::index');
$routes->get('transactions', 'Ctransactions::index');


//dashboard
$routes->get('dashboard', 'chome::index');

//inventario
$routes->get('pqrs', 'Cinventario::index');
$routes->post('inventario/open', 'Cinventario::insertinventario');
$routes->get('inventario/inventario-excel', 'Cinventario::descargarInventarioExcel');
$routes->post('/inventario/dardebaja/(:num)', 'Cinventario::dardebaja/$1');
$routes->post('/inventario/actualizar/(:num)', 'Cinventario::actualizar/$1');


//Prestamos
$routes->get('prestamos', 'PrestamosArticuloController::index');
$routes->post('prestamos/save', 'PrestamosArticuloController::asignar');
$routes->post('prestamos/obtener-estado-ubicacion', 'PrestamosArticuloController::obtenerEstadoUbicacion');

//Asignar Articulo
$routes->get('asignar-articulo', 'AsignarArticuloController::index');
$routes->post('asignar-articulo/buscarPorSerial', 'AjaxAsignarArticuloController::obtenerInventarioPorSerial');
$routes->post('asignar-articulo/buscarPorUbicacion', 'AjaxAsignarArticuloController::obtenerInventarioPorUbicacion');
$routes->post('asignar-articulo/buscarPorEstados', 'AjaxAsignarArticuloController::getInventarioxEstados');
$routes->post('asignar-articulo/asignar', 'AsignarArticuloController::actualizarUbicacion');



//seguridad
///Gestion de usuarios
$routes->get('/gestion-usuarios', 'Cgestionusuarios::index');
$routes->get('/gestion-usuarios/deleteusuario/(:num)', 'Cgestionusuarios::deleteusuario/$1');
$routes->post('/gestion-usuarios/addusuarios/', 'Cgestionusuarios::addusuario');
$routes->post('/gestion-usuarios/editusuario/(:num)', 'Cgestionusuarios::updateusuario/$1');

///Cambier contraseña
$routes->get('cambiar-contrasena', 'CambioContrasena::index');

//Gestion de extras
$routes->get('gestion-extras', 'Cgestionextra::index');
///articulos
$routes->get('/articulos', 'ArticuloController::index');
$routes->post('/articulos/add', 'ArticuloController::store');
$routes->post('/articulos/update/(:num)', 'ArticuloController::update/$1');
$routes->get('/articulos/delete/(:num)', 'ArticuloController::delete/$1');
$routes->get('/articulos/articulos-excel', 'ArticuloController::ArticuloExcel');
///categorias.
$routes->get('/categorias', 'CategoriaController::index');
$routes->post('/categorias/add', 'CategoriaController::store');
$routes->post('/categorias/update/(:num)', 'CategoriaController::update/$1');
$routes->get('/categorias/delete/(:num)', 'CategoriaController::delete/$1');
///estados.
$routes->get('/estados', 'EstadosController::index');
$routes->post('/estados/create', 'EstadosController::store');
$routes->post('/estados/update/(:num)', 'EstadosController::update/$1');
$routes->get('/estados/delete/(:num)', 'EstadosController::delete/$1');
///sedes
$routes->get('/sedes', 'SedesController::index');

///Ubicacion
$routes->get('/ubicaciones', 'UbicacionesController::index');
$routes->post('/ubicaciones/store', 'UbicacionesController::store');
$routes->post('/ubicaciones/update/(:num)', 'UbicacionesController::update/$1');
$routes->get('/ubicaciones/delete/(:num)', 'UbicacionesController::delete/$1');
$routes->get('/ubicaciones/ubicaciones-excel', 'UbicacionesController::ubicacioneExcel');
///procedencias
$routes->get('/procedencias', 'ProcedenciasController::index');
$routes->post('/procedencias/add', 'ProcedenciasController::store');
$routes->post('/procedencias/update/(:num)', 'ProcedenciasController::update/$1');
$routes->get('/procedencias/delete/(:num)', 'ProcedenciasController::delete/$1');
$routes->get('/procedencias/procedencias-excel', 'ProcedenciasController::procedenciasExcel');

//historial
///Histroial asignaciones
$routes->get('/asignaciones', 'AsignacionesController::index');

//historial inventario
$routes->get('/inventarios-anteriores', 'HistorialInventarioController::index');
$routes->get('/inventarios-anteriores/inventario-excel', 'HistorialInventarioController::descargarInventarioExcel');

//historial dados de baja
$routes->get('/dados-de-baja', 'DadosdebajaController::index');
$routes->get('/dados-de-baja/inventario-excel', 'DadosdebajaController::descargarInventarioExcel');
