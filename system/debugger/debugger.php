<?php

// function to get the site url
function getBaseUrl () {
    // Program to display URL of current page.
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
    else $link = "http";

    // Here append the common URL characters.
    $link .= "://";

    // Append the host(domain name, ip) to the URL.
    $link .= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL
    $link .= explode('/', $_SERVER['REQUEST_URI'])[0];

    // return the link
    return $link;
}

// base function for showing errors
function showErrorMessage ($header, $message = '') {
    require_once "../system/error/error.php";
    die();
}

// function to show server error
function showServerError () {
    showErrorMessage(
        'Internal Server Error',
        'This could be some error in server code <ul>'.
        '<li> Please wait till the problem gets solved. </li>'. 
        '<li> If you are the owner of the site, run the app in "dev" mode to see the causes of the error.</li>'. 
        '</ul>' 
    );
}

// error to show invalid app mode
function showInvalidAppModeError () {
    showErrorMessage(
        'Invalid App Mode',
        'Mvcat app only has two modes- "dev" and "prod"'.
        '<li> Invalid app mode <b>"'.MODE.'"</b> in <b>"config/config.php"</b>. </li>'. 
        '<li> Make sure the app mode is either "dev" or "prod" (case sensitive).</li>'. 
        '</ul>' 
    );
}

// function to show dbms connection error
function showDBConnectionError ($error) {
    // show debug if app running in dev mode
    if(MODE == 'dev') {
        showErrorMessage(
            'Could Not Connect To Database',
            'PDO Connection could not be made to the database <ul>'.
            '<li> Please check if the DBMS is running properly. </li>'. 
            '<li> Make sure you have entered correct database credentials inside <b>"config/config.php"</b> file. </li>'. 
            '<li> Make sure you are using a mysql database (mvcat only supports mysql currently).</li>'.
            '<li>'. $error .'</li>'.
            '</ul>'
        );
    } else showServerError();
}


// url errors 
// function to show controller not found error
function showRouteNotFoundError ($route) {
    showErrorMessage(
        'Route Not Found',
        'Route <b>"' . $route . '"</b> not found. <ul>'.
        '<li> Make sure your have defined the route for <b>"' . $route . '.php"</b> inside <b>"app/routes/routes.php"</b> file. </li>'.
        '<li> Also make sure the callback is a function, if you are using a seperate controller, make sure the controller and the callback method exists. </li>' . 
        '<li> Make sure you have entered the correct url </li>'. 
        '</ul>'
    );
}

// function to show method not found
function showMethodNotFoundError ($controller, $method) {
    if (MODE === 'dev') {
        showErrorMessage(
            'Method Not Found',
            'Method <b>"' . $method . '"</b> not found. <ul>'.
            '<li> Make sure your have defined method <b>' . $method . '</b> inside <b>"app/controllers/'.$controller.'.php"</b> file. </li>'.
            '<li> Make sure you have entered the correct url </li>'. 
            '</ul>'
        );
    } else showServerError();
    
}

// function to show controller not found
function showControllerNotFoundError ($controller) {
    if (MODE === 'dev') {
        showErrorMessage(
            'Controller Not Found',
            'Controller <b>"' . $controller . '"</b> not found. <ul>'.
            '<li> Make sure your have a <b>' . $controller . '.php</b> inside <b>app/controllers/</b> file. </li>'.
            '<li> Make sure you have entered the correct url </li>'. 
            '</ul>'
        );
    } else showServerError();
}

// function to show middleware not found
function showMiddlewareNotFoundError ($controller) {
    if (MODE === 'dev') {
        showErrorMessage(
            'Middleware Not Found',
            'Middleware <b>"' . $controller . '"</b> not found. <ul>'.
            '<li> Make sure your have a <b>' . $controller . '.php</b> inside <b>app/middleware/</b> file. </li>'.
            '<li> Or remove the middleware in the routes file </li>'. 
            '</ul>'
        );
    } else showServerError();
}





// error messages for easy debugging
// function to show view not found error
function showViewNotFoundError ($viewName, $debugInfo = 'no info found') {
    if(MODE == 'dev') {
        showErrorMessage(
            'View Not Found',
            'View <b>"' . $viewName . '"</b> not found. <ul>'.
            '<li> Invalid View called in:  <b>' . $debugInfo . '</b></li>'.
            '<li> Make make sure you have a file named <b>"' . $viewName . '.php"</b> inside <b>"app/views/"</b> directory. </li>'. 
            '<li> Make sure you have written the correct file name </li>'. 
            '</ul>'
        );
    } else showServerError();
}
  
// function to show model not found error
function showModelNotFoundError ($modelName, $debugInfo = 'no info found') {
    if (MODE == 'dev') {
        showErrorMessage(
            'Model Not Found',
            'Model <b>"' . $modelName . '"</b> not found. <ul>'.
            '<li> Invalid Model called in:  <b>' . $debugInfo . '</b></li>'.
            '<li> Make make sure you have a file named <b>"' . $modelName . '.php"</b> inside <b>"app/models/"</b> directory. </li>'. 
            '<li> Make sure you have written the correct file name </li>'. 
            '</ul>'
        );
    } else showServerError();    
}

// show this error when a used model has not specified its table name
function showTableNameNotSetError ($modelName, $debugInfo = 'no info found') {
    if (MODE == 'dev') {
        showErrorMessage(
            'Table Name Not Set',
            'Table name is required to be set in models <ul>'.
            '<li> Table name is not set in <b>"'. $debugInfo . '"</b> </li>'.
            '<li> Name of the table is not set in the model <b>"'.$modelName.'"</b>. </li>'.
            '</ul>'
        );
    } else showServerError();
}

// show this error when a used model has not specified its primary key
function showPrimaryNotSetError ($modelName, $debugInfo = 'no info found') {
    if (MODE == 'dev') {
        showErrorMessage(
            'Primary Key Not Set',
            'Primary Key is required to be set in models <ul>'.
            '<li> Primary Key is not set in <b>"'. $debugInfo . '"</b> </li>'.
            '<li> Primary Key is not set in the model <b>"'.$modelName.'"</b>. </li>'.
            '</ul>'
        );
    } else showServerError();
}


// function to show var/constant not defined error
function showConfigNotDefinedError ($var, $extraMsg = '') {
    if (MODE == 'dev') {

        $msg = 'Required constant not defined <ul>'. 
               '<li> The value of  '.$var.' is not defined. </li>'. 
               '<li>Please copy <b>define("'.$var.'", "_the_correct_value_")</b> and paste it inside <b>"config/config.php"</b></li>';

        if(!empty($extraMsg)) $msg .= '<li>'.extraMsg.'</li>';

        $msg .= '</ul>';

        showErrorMessage($var.' Not Defined', $msg);
    } else showServerError();
}

// function to show csrf token validation error
function showCsrfTokenValidationError () {
    showErrorMessage(
        'CSRF Validation Error',
        'CSRF validation is required for every request <ul>'.
        '<li> Use Mvcat template, write <b>{{csrf_token}}</b> inside your form. </li>'.
        '<li> Note: Mvcat template is case sensitive. </li>'.
        '<li> This is done to prevent Cross-site Request Forgery. </li>'.
        '</ul>'
    );
}

// function to show variable not defined error
function showVariableNotDefinedError ($key, $debugInfo, $lineNumber) {
    showErrorMessage(
        'Undefined Variable',
        'Undefined variable in view <ul>'.
        '<li> Undefined variable <b>"'.$key.'"</b> in view <b>"'.$debugInfo.'"</b>. </li>'.
        '<li> Make sure you have defined the varibel <b>"'.$key.'"</b> before you call the view. </li>'.
        "<li> Undefined variable in Line:<b>$lineNumber</b> </li>".
        '</ul>'
    );
}
