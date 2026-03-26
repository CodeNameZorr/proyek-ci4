<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. AUTH ROUTES
$routes->get('/', 'Auth::index');
$routes->group('auth', function($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login_process', 'Auth::login_process');
    $routes->get('logout', 'Auth::logout');
});

// 2. DASHBOARD
$routes->get('dashboard', 'Dashboard::index');

// 3. BARANG (CRUD LENGKAP)
$routes->group('barang', function($routes) {
    $routes->get('/', 'Barang::index');              // Tampil
    $routes->post('tambah', 'Barang::tambah');       // Proses Tambah
    $routes->get('edit/(:num)', 'Barang::edit/$1');  // Form Edit
    $routes->post('update/(:num)', 'Barang::update/$1'); // Proses Update
    $routes->get('hapus/(:num)', 'Barang::hapus/$1'); // Hapus
});

// 4. TRANSAKSI
$routes->group('transaksi', function($routes) {
    $routes->get('/', 'Transaksi::index');
    $routes->post('proses', 'Transaksi::proses');
});

// AUTO ROUTE OFF (BIAR AMAN)
$routes->setAutoRoute(false);