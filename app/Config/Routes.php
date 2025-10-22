<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/registrasi', 'RegistrasiController::registrasi');
$routes->post('/login', 'LoginController::login');

$routes->group('biodata', function ($routes) {
    $routes->post('/', 'BiodataController::create');           // tambah
    $routes->get('/', 'BiodataController::list');              // list
    $routes->get('(:segment)', 'BiodataController::detail/$1');// detail
    $routes->post('ubah/(:segment)', 'BiodataController::ubah/$1'); // ⬅ update pakai POST
    $routes->delete('(:segment)', 'BiodataController::hapus/$1');   // hapus
});
