<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);


//expenses
$routes->get("/expenses", "ExpenseController::list");

//expenses/methods
$routes->post("/expenses/create", "ExpenseController::create");
$routes->get("/expenses/list", "ExpenseController::list");
$routes->delete('expenses/delete/(:num)', 'ExpenseController::delete/$1');
$routes->put("/expenses/update/(:num)", "ExpenseController::update/$1");


$routes->get('/', 'Home::index');
