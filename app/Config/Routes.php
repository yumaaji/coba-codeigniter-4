<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');

$routes->get('/komik', 'Komik::index');
$routes->get('/komik/create', 'Komik::create');
$routes->post('/komik/store', 'Komik::store');
$routes->get('/komik/(:segment)', 'Komik::detail/$1');
