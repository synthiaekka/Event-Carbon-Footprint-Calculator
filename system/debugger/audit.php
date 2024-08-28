<?php

// invalid app mode
// if app mode not defined
if(!defined('MODE')) {
    showErrorMessage(
        'App Mode Not Defined',
        'App mode needs to be defined, either "prod" or "dev"'. 
        '<ul> <li> Mvcat app runs on two mode either "prod" or "dev". </li>'. 
        '<li> Copy either <b>define("MODE", "prod");</b> or <b>define("MODE", "dev");</b> and paste it inside <b>"config/config.php"</b>.</li>'.
        '<li> <b>prod</b> mode is used for production and <b>dev</b> mode is used while development </li>'.
        '<li> Development mode gives proper error messages while prod mode just gives a rough idea </li>'.
        '</ul>'
    );
}
// if invalid app mode 
if(MODE != 'dev' && MODE != 'prod') {
    showInvalidAppModeError();
}


// invalid db credentials 
// db host not defined
if(!defined('HOST')) {
    if(MODE == 'dev') {
        showConfigNotDefinedError('HOST');
    } else showServerError();
}
// db username not defined
if(!defined('USER')) {
    if(MODE == 'dev') {
        showConfigNotDefinedError('USER');
    } else showServerError();
}
// db name not defined
if(!defined('DATABASE')) {
    if(MODE == 'dev') {
        showConfigNotDefinedError('DATABASE');
    } else showServerError();
}
// db password
if(!defined('PASSWORD')) {
    if(MODE == 'dev') {
        showConfigNotDefinedError('PASSWORD');
    } else showServerError();
}