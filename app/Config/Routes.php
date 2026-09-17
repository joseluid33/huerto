<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */$routes->get('/', 'Huerto::index');

$routes->post('huerto/crear', 'Huerto::crear');

$routes->post('huerto/registrarRiego/(:num)', 'Huerto::registrarRiego/$1');

$routes->post('huerto/cambiarEstado/(:num)', 'Huerto::cambiarEstado/$1');


$routes->get('huerto/eliminar/(:num)', 'Huerto::eliminar/$1');
$routes->get('/huerto', 'Huerto::index');
$routes->get('huerto/nuevo', 'Huerto::nuevo');
