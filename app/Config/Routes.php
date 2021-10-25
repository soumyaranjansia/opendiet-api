<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Return all food entries
$routes->get('food', 'Food::index');

// Return food entry by ID number
$routes->get('food/id/(:segment)', 'Food::show/$1');

// Return food entries by name
$routes->get('food/name', 'Food::getFoodEntriesByName');

// Return food entries by brand
$routes->get('food/brand', 'Food::getFoodEntriesByBrand');

// Create food entry
$routes->post('food', 'Food::create');

// Update food entry
$routes->patch('food', 'Food::update');

// Delete food entry
$routes->delete('food', 'Food::delete');



// Return all brand entries
$routes->get('brand', 'Brand::index');

// Return brand entry by ID number
$routes->get('brand/id/(:segment)', 'Brand::show/$1');

// Return brand entreis by name
$routes->get('brand/name', 'Brand::getBrandEntriesByName');

// Create brand entry
$routes->post('brand', 'Brand::create');

// Update brand entry
$routes->patch('brand', 'Brand::update');

// Delete brand entry
$routes->delete('brand', 'Brand::delete');




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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
