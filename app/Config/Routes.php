<?php

namespace Config;

use App\Controllers\District;

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
// route since we don't have to scan directories.'/'
$routes->get('/', 'Home::index');
//  $routes->resource('login');


// students
$routes->get("Student/listAll","Student::index");
$routes->delete("Student/delete/:num","Student::delete/$1");
$routes->post('Student/create','Student::create');
$routes->get('Student/(:num)','Student::show/$1');
$routes->patch('Student/(:num)','Student::update/$1');

//Mentors
$routes->get("mentor/listAll","Mentor::index");
$routes->post('Mentor/create','Mentor::create');
$routes->patch('Mentor/(:num)','Mentor::update/$1');
$routes->delete("Mentor/delete/:num","Mentor::delete/$1");
$routes->get('Mentor/(:num)','Mentor::show/$1');

//AdminProfile
$routes->get("admin/listAll","AdminProfile::index");
$routes->post('admin/create','AdminProfile::create');
$routes->patch('admin/(:num)','AdminProfile::update/$1');
$routes->delete("admin/delete/:num","AdminProfile::delete/$1");
$routes->get('admin/(:num)','AdminProfile::show/$1');

// Role
$routes->get("role/listAll","Role::index");

// Counselling category
$routes->get("category/listAll","CounsellingCategory::index");
$routes->post('category/create','CounsellingCategory::create');
$routes->patch('category/(:num)','CounsellingCategory::update/$1');
$routes->delete("category/delete/:num","CounsellingCategory::delete/$1");
$routes->get('category/(:num)','CounsellingCategory::show/$1');

// classes
$routes->get("class/listAll","StudentClass::index");

// streams
$routes->get("stream/listAll","Stream::index");

// login 
$routes->post("login", "Login::login");



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