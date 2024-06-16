<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');
