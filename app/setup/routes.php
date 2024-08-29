<?php

$routes = new Route;

/**
 * the above initializes the Route class
 * 
 * routes can be created below
 * parameters to be passed -> (string: path, function: callback || array: [controller, method])
 */

/**
 * if you want to use controller methods here, accept it as a parameter in the callback function
 * example:
 * 
 * $routes->get('/', function ($controller) {
 *      $controller->view('home');
 * });
 * 
 */

/**
 * ------------------------------- CREATE YOUR ROUTES BELOW -------------------------------
 */


// routes for public pages
$routes->get('/', ['view', 'home'], '');
$routes->get('/Register', ['view', 'signup'], '');
$routes->get('/signin', ['view', 'signin'], '');




// post routes for public form actions
$routes->post('/signup', ['publicForm', 'signup']);
$routes->post('/signin', ['publicForm', 'signin']);














 
// create your own custom route not found handler
/**
 * uncomment the below code to create your own custom 'route not found' handler
 * Parameteres to be passed --> function that will run whenever uri route is invalid
 */

// $routes->routeNotFound(function () {
//     echo "route not found";
// });

// this will run the router
$routes->run();