<?php

//Step 1: Require the Slim Framework
require 'lib_Slim/Slim/Slim.php';

Slim\Slim::registerAutoloader();

//Step 2: Instantiate a Slim application
$app = new \Slim\Slim();

// ASF's backend library
$db_name = "malaysi7_fyp2_lukman";
$path_to_essentials = "back-end.php.v2/";
require($path_to_essentials."essentials.php");


$res = $app->response();
$res->header('Access-Control-Allow-Origin', '*');
$res->header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");

?>