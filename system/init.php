<?php

// set csrf token, if not already set
if(!isset($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = CSRF;


// include_once will be called automatically whenever new class is being created
spl_autoload_register (function ($className) {

    if (file_exists("../system/classes/" . $className . ".php")) {
        include "../system/classes/" . $className . ".php";
    } 
    else if (file_exists("../system/helpers/" . $className . ".php")) {
        include "../system/helpers/" . $className . ".php";
    }
    
});
