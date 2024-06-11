<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/news', 'News::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/news/(:any)', 'News::viewNews/$1');

$routes->get('/login', 'Auth::index_login');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::index_register');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');

$routes->setAutoRoute(false);

$routes->group('admin', function($routes){
    $routes->get('news', 'NewsAdmin::index');
    $routes->get('news/(:segment)/preview', 'NewsAdmin::preview/$1');
    $routes->add('news/new', 'NewsAdmin::create');
    $routes->add('news/(:segment)/edit', 'NewsAdmin::edit/$1');
    $routes->get('news/(:segment)/delete', 'NewsAdmin::delete/$1');
});