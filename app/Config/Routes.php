<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Layout::index');
$routes->get('layout/index', 'layout::index');

//Barang
$routes->get('/barang/index', 'barang::index');
$routes->post('/barang/index', 'barang::index');
$routes->post('/barang/formTambah', 'barang::formTambah');
$routes->post('/barang/simpandata', 'barang::simpandata');
$routes->get('/barang/hapus/(:any)', 'barang::index');
$routes->post('/barang/hapus', 'barang::hapus');
$routes->post('/barang/formedit', 'barang::formedit');
$routes->post('/barang/updatedata/', 'barang::updatedata');

//Pelanggan
$routes->get('/pelanggan/index', 'pelanggan::index');
$routes->post('/pelanggan/index', 'pelanggan::index');
$routes->post('/pelanggan/formTambah', 'pelanggan::formTambah');
$routes->post('/pelanggan/simpandata', 'pelanggan::simpandata');
$routes->get('/pelanggan/hapus/(:any)', 'pelanggan::index');
$routes->post('/pelanggan/hapus', 'pelanggan::hapus');
$routes->post('/pelanggan/formedit', 'pelanggan::formedit');
$routes->post('/pelanggan/updatedata/', 'pelanggan::updatedata');

//Pemasok
$routes->get('/pemasok/index', 'pemasok::index');
$routes->post('/pemasok/index', 'pemasok::index');
$routes->post('/pemasok/formTambah', 'pemasok::formTambah');
$routes->post('/pemasok/simpandata', 'pemasok::simpandata');
$routes->get('/pemasok/hapus/(:any)', 'pemasok::index');
$routes->post('/pemasok/hapus', 'pemasok::hapus');
$routes->post('/pemasok/formedit', 'pemasok::formedit');
$routes->post('/pemasok/updatedata/', 'pemasok::updatedata');

//Barang Masuk
$routes->get('/barangmasuk/index', 'barangmasuk::index');
$routes->post('/barangmasuk/index', 'barangmasuk::index');
$routes->get('/barangmasuk/add', 'barangmasuk::add');
$routes->post('/barangmasuk/selesaitransaksi', 'barangmasuk::selesaitransaksi');
$routes->post('/barangmasuk/datapemasok', 'barangmasuk::datapemasok');
$routes->post('/barangmasuk/dataDetail', 'barangmasuk::dataDetail');
$routes->post('/barangmasuk/databarang', 'barangmasuk::databarang');
$routes->post('/barangmasuk/simpanTemp', 'barangmasuk::simpanTemp');
$routes->get('/barangmasuk/hapusItem/(:any)', 'barangmasuk::index');
$routes->post('/barangmasuk/hapusItem', 'barangmasuk::hapusItem');

//Barang Keluar
$routes->get('/barangkeluar/index', 'barangkeluar::index');
$routes->post('/barangkeluar/index', 'barangkeluar::index');
$routes->get('/barangkeluar/add', 'barangkeluar::add');
$routes->post('/barangkeluar/selesaitransaksi', 'barangkeluar::selesaitransaksi');
$routes->post('/barangkeluar/datapelanggan', 'barangkeluar::datapelanggan');
$routes->post('/barangkeluar/dataDetail', 'barangkeluar::dataDetail');
$routes->post('/barangkeluar/databarang', 'barangkeluar::databarang');
$routes->post('/barangkeluar/simpanTemp', 'barangkeluar::simpanTemp');
$routes->get('/barangkeluar/hapusItem/(:any)', 'barangkeluar::index');
$routes->post('/barangkeluar/hapusItem', 'barangkeluar::hapusItem');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
