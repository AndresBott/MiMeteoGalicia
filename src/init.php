<?php
// load the needed classes
include_once (ROOTPATH."/class/f.class.php");
include(ROOTPATH . "/core/config.class.php");
include(ROOTPATH . "/core/requestRouter.class.php");
include(ROOTPATH . "/core/database.class.php");
include(ROOTPATH . "/core/controller.class.php");
include(ROOTPATH . "/core/authentication.class.php");

// setup some variables
if(!defined("MODELSPATH")){
    define("MODELSPATH",  ROOTPATH."/model");
}

if(!defined("VIEWSPATH")){
    define("VIEWSPATH",  ROOTPATH."/view");
}

if(!defined("CONTROLLERSPATH")){
    define("CONTROLLERSPATH",  ROOTPATH."/controller");
}


if(!defined("PUBLICURL")){
    define("PUBLICURL", f::getBaseURL() );
}

// load the instance files
include (ROOTPATH."/data/config.php");


// trun on error reporting on devel enviroment
if($siteConfig->getParam("env") == "devel"){
    error_reporting(E_ALL);
    define("ENV","devel");
}else{
    define("ENV","prod");
}


// init the database connection
$db = new database($dbConfig);

// the authentication module should be initialized depending on a config and not as standard
$auth = new authentication();

// navigation module handles the front controller url routing
$navigation = new navigation($siteConfig);

// stat the url routing between requested url and the corresponding defined controller
$navigation->run();


