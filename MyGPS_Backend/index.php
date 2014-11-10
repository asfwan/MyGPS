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
	 	Q_("insert into gps_table (title,value) values('LatLng','".$lat.",".$lng."')");
	 	echo "Inserted Lat: $lat and Lng: $lng .... OK";
	});


require_once('lib_Slim/post_Slim.php');
