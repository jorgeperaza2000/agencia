<?php
require 'core/autoloader.php';
use socketHttp\socketHttp;
use validate\validate;

if ( is_callable($_GET["f"] ) ) {
	$_GET["f"]();
}

function index() {

	$client = new socketHttp();
	echo $client->socketGet('programas');

}

function create() {

	$validate = [
					$_POST["name"],
					$_POST["porcentaje"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$body = array(
	        	'nombre' => $_POST["name"],
	            'porcentaje' => $_POST["porcentaje"],
	            );
		$body = json_encode($body);

		$client = new socketHttp();
		$response = json_decode( $client->socketPost('programas', $body), true );
		
		if ( $response["response"] == "ok" ) {
		
			$_SESSION["message"] = "success";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $response["data"]);

		} else {

			$_SESSION["message"] = "error";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message");

		}

	} else {

		$_SESSION["message"] = "incomplete";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}
    
}

function edit() {

	$validate = [
					$_POST["name"],
					$_POST["porcentaje"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$body = array(
	            'nombre' => $_POST["name"],
	            'porcentaje' => $_POST["porcentaje"],
	            );
		$body = json_encode($body);

		$client = new socketHttp();
		$response = json_decode( $client->socketPut('programas/'.$_GET["id"], $body), true );
		
		if ( $response["response"] == "ok" ) {
		
			$_SESSION["message"] = "success";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"] );

		} else {

			$_SESSION["message"] = "error";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message");

		}

	} else {

		$_SESSION["message"] = "incomplete";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}
    
}