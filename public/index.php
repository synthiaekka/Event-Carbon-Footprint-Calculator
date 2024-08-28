<?php declare(strict_types=1);

/**
 * 
 * ------------------ M V C A T----------------
 * --------------------------------------------
 * --> A light weight MVC Framework in PHP
 * --> version : 2.1 
 * --> author  : Ashish Toppo
 * --> contact : ashishtoppo8958@gmail.com
 * --> licence : MIT Licence ( Open Source ) 
 * 
 * 
 */


// start the session
session_start();

// load necessary helpers
include_once ("../system/debugger/debugger.php");
include_once ("../system/helpers/validator.php");
include_once ("../system/helpers/template.php");

// load database configurations
include_once ("../config/config.php");

// check if all necessary configuration information are available
include_once ("../system/debugger/audit.php");

// load all autoload files
include_once ("../system/init.php");

// start routing
include_once ("../app/setup/routes.php");
