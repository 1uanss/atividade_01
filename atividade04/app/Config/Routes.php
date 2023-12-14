<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/user/(:num)', 'Home::screenUpdateUser/$1');





// Rotas POST
$routes->post('/send', 'Home::insertUser');

$routes->add('/delete/(:num)', 'Home::deleteUser/$1');

$routes->add('/atualizar/', 'Home::updateUser');
