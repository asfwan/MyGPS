<?php
	
require_once('lib_Slim/pre_Slim.php');
	
//GET VAR

$app->get('/', 
	function () {
	 	echo "ARE YOU LOST?";
	});
	
$app->get('/gps/desc', 
	function () {
	 	echo getJSONFromQuery("select * from gps_table order by id desc");
	});
	
$app->get('/gps', 
	function () {
	 	echo getJSONFromQuery("select * from gps_table order by id desc");
	});

$app->get('/gps/asc', 
	function () {
	 	echo getJSONFromQuery("select * from gps_table order by id asc");
	});
	
$app->get('/gps/mod/:lat/:lng', 
	function ($lat,$lng) {
	 	//if(
	 		Q_("insert into gps_table (key,value) values('LatLng','$lat:$lng')");
	 	//) 
	 	echo "OK";
	});


require_once('lib_Slim/post_Slim.php');
