<?php
/*
 * Configure your database conections
 * At the moment only sqlite is avaliable
 */
$dbConfig = new config([
    "dbType"=>"sqlite",
    "dbUrl"=>ROOTPATH."/data/mimeteogalicia.sqlite3",
]);

/*
 * other config for the site
 * you can add mor if needed
 */
$siteConfig = new config([
    "lang"=>"EN",
    "env"=>"devel", // productin or devel environment
    "defaultIndex"=>"Front"
]);


