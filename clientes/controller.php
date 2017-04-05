<?php
require 'core/autoloader.php';
use socketHttp\socketHttp;
use validate\validate;

if ( is_callable($_GET["f"] ) ) {
	$_GET["f"]();
}

function index() {

	$client = new socketHttp();
	echo $client->socketGet('clientes');

}

function create() {

	$validate = [
					$_POST["name"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$body = array(
	        	'nombre' => $_POST["name"],
	            'saldo' => 0,
	            );
		$body = json_encode($body);

		$client = new socketHttp();
		$response = json_decode( $client->socketPost('clientes', $body), true );
		
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
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$body = array(
	            'nombre' => $_POST["name"],
	            );
		$body = json_encode($body);

		$client = new socketHttp();
		$response = json_decode( $client->socketPut('clientes/'.$_GET["id"], $body), true );
		
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