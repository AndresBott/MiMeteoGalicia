<?php
/*
 * This is the Front Controllers entry point, the server shoul only make this path public
 *
 */

if(!defined("PUBLICPATH")){
    define("PUBLICPATH",  dirname(__FILE__) );
}

if(!defined("ROOTPATH")){
    define("ROOTPATH", dirname(__FILE__)  );
}

include_once (ROOTPATH."/class/f.class.php");

if(!defined("PUBLICURL")){

$s =  f::getBaseURL()."/public/";
    define("PUBLICURL", $s );
}

include(ROOTPATH."/init.php");


