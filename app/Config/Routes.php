<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Admin');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->match(['get', 'post'], 'admin/edit', 'Pages::create');
$routes->match(['get', 'post'], 'admin/auth', 'Admin::auth');
$routes->match(['get', 'post'], 'admin/logo_update', 'Admin::logo_update');
$routes->add('pages/contact', 'Pages::contact');
$routes->add('pages/(:segment)', 'Pages::view/$1');
$routes->add('admin/global_details', 'Admin::global_details');
$routes->add('admin/logo/(:any)', 'Admin::logo/$1');
$routes->add('admin/logo', 'Admin::logo');
$routes->add('admin/edit/(:segment)', 'Admin::edit/$1');
$routes->add('admin/logout', 'Admin::logout');
$routes->add('admin', 'Admin::index');
$routes->add('pages/(:any)', function($segment)
{
    if (file_exists(APPPATH.'views/'.$segment.'.php'))
    {
        echo view($segment);
    }
    else
    {
        throw new CodeIgniter\PageNotFoundException($segment);
    }
});
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
