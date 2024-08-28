<?php

class Route {

    private $handlers = array();
    private $routeNotFound;
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function get (string $path, $handler, string $middleware = '') {
        return $this->addHandler(self::METHOD_GET, $path, $handler, $middleware);
        
    }

    public function post (string $path, $handler, string $middleware = '') {
        return $this->addHandler(self::METHOD_POST, $path, $handler, $middleware);
    }

    public function run ():void {
        // this function checks the request uri and runs the appropriate handler

        // sanitize the url from unwanted character
        // this will help us prevent from XSS attacks
        $uniform_resource_locator = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        
        // break the url into its different components
        $requestUri = parse_url($uniform_resource_locator);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

         // if the user wants to pass one variable in the uri
         $uri = explode('/', $requestPath);
         $uriParam = array_pop($uri);
         unset($uri[0]);
         array_values($uri);
         array_push($uri, "{id}");
         $uriStr = "";
         foreach ($uri as $current) {
            $uriStr .= "/$current";
         } 
         $uriCallbackParam = ['id' => $uriParam];


        // check if we have handler for the requested uri
        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                $callback = $handler['handler'];

                // check if custom controller is used
                if(is_array($callback)) {
                    // check if the controller file and the method exists

                    $callback_controller_name = $callback[0];
                    $callback_method_name = $callback[1];
                    
                    // show error message if controller file does not exists and stop further execution
                    if(!file_exists("../app/controllers/$callback_controller_name.php")) {
                        showControllerNotFoundError($callback_controller_name);
                    }

                    // create an instance of the called controller
                    include "../app/controllers/$callback_controller_name.php";
                    $callback_controller = new $callback_controller_name;

                    // show error message if method does not exists and stop further execution
                    if(!method_exists($callback_controller, $callback_method_name)) {
                        showMethodNotFoundError($callback_controller_name, $callback_method_name);
                    }

                    // here, the callback is set to seperate controller method, so no need of passing a controller instance as parameter
                    $callbackParam = [array_merge($_GET, $_POST)];
                    $callback = [new $callback_controller, $callback_method_name];


                    // check if middleware exists
                    $middleware = $handler['middleware'];
                }

                else {
                    // here the callback is within the routes.php file, so pass a controller instance as parameter
                    $callbackParam = [$controller, array_merge($_GET, $_POST)];
                }
            }

           
            // use of variable in the url path
            // else if ($handler['path'] === $uriStr && $method === $handler['method']) {
            //     $callback = $handler['handler'];

            //     // check if custom controller is used
            //     if(is_array($callback)) {
            //         // check if the controller file and the method exists

            //         $callback_controller_name = $callback[0];
            //         $callback_method_name = $callback[1];
                    
            //         // show error message if controller file does not exists
            //         if(!file_exists("../app/controllers/$callback_controller_name.php")) {
            //             showControllerNotFoundError($callback_controller_name);
            //         }

            //         // create an instance of the called controller
            //         include "../app/controllers/$callback_controller_name.php";
            //         $callback_controller = new $callback_controller_name;

            //         // show error message if method does not exists
            //         if(!method_exists($callback_controller, $callback_method_name)) {
            //             showMethodNotFoundError($callback_controller_name, $callback_method_name);
            //         }

            //         // here, the callback is set to seperate controller method, so no need of passing a controller instance as parameter
            //         $callbackParam = [array_merge($_GET, $_POST, $uriCallbackParam)];
            //     }

            //     else {
            //         // here the callback is within the routes.php file, so pass a controller instance as parameter
            //         $callbackParam = [$controller, array_merge($_GET, $_POST, $uriCallbackParam)];
            //     }
            // }
        }

        if (!isset($callback)) {
            header ("HTTP/1.0 404 Not Found");

            // if user has defined custom route not found error handler, then call it
            if (!empty($this->routeNotFound)) {
                $callback = $this->routeNotFound;
                $callbackParam = [$controller];
            } else { // other wise call the default route not found error handler
                showRouteNotFoundError($requestPath);
            }
        }

        

        $controller = new Controller;

        // check if middleware exists
        if (isset($middleware)  &&  $middleware !== '' ) {

            // continue further only if middleware allows
            // show error message if middleware file does not exists and stop further execution
            if(!file_exists("../app/middlewares/$middleware.php")) {
                showMiddlewareNotFoundError($middleware);
            }

            // include the middleware file
            include("../app/middlewares/$middleware.php");
            
            // check if middleware allows further execution
            $middleware = new $middleware;

            if (!$middleware->run()) {
                // if middleware returns false, then run middleware->failed and stop execution
                $middleware->failed();
                die();
            }
        }

        

        

        call_user_func_array($callback, $callbackParam);
        
    }

    // function to add new handler 
    private function addHandler (string $method, string $path, $handler, string $middleware) {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
            'middleware' => $middleware,
        ];
        return $this;
    }

    // function to add route not found handler
    public function routeNotFound ($handler):void {
        $this->routeNotFound = $handler;
    }
}