<?php
session_start();
if ( isset( $_GET["c"] ) ) {

	if ( is_dir( $_GET["c"] ) ) {

		$dir = $_GET["c"] . "/";

	}

}

if ( isset( $_GET["a"] ) ) {

	if ( ( $_GET["a"] == "create" ) || ( $_GET["a"] == "edit" ) ) {

		$action = "form";

	} else {

		$action = $_GET["a"];

	}

}

if ( isset( $_GET["f"] ) ) {

	$function = $_GET["f"];

}

if ( $action == "controller" ) {
	
	require ($dir . $action . '.php');

} else if ( $action == "form" ) {

	require_once 'core/autoloader.php';
	require 'header.php';
	require ($dir . $action . '.php');

} else { 

	require_once 'core/autoloader.php';
	require 'header.php';
	require ($dir . $action . '.php');

}


?>