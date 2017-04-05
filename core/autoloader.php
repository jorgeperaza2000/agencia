<?php
require_once 'vendor/autoload.php';
require_once "socketHttp.php";
require_once "validate.php";
require_once 'db.php';
require_once 'email.php';


function pr($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function getConfig($field = null){
	
	$config = file_get_contents("config.json");
	$config = json_decode($config, true);
	if ( isset($field) ) {
		return $config[$field];
	} else {
		return $config;
	}
}

function nf( $number ) {
	return number_format($number, 2, ",", ".");
}
