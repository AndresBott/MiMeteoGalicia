<?php
/*
 * This is the Front Controllers entry point, the server shoul only make this path public
 *
 */

if(!defined("PUBLICPATH")){
    define("PUBLICPATH",  dirname(__FILE__) );
}

if(!defined("ROOTPATH")){
    define("ROOTPATH", dirname(dirname(__FILE__) ) );
}



include(ROOTPATH."/init.php");


