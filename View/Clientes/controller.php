<?php
require 'core/autoloader.php';
use socketHttp\socketHttp;
use validate\validate;

if ( is_callable($_GET["f"] ) ) {
	$_GET["f"]();
}

function index() {

	$client = new socketHttp();
	echo $client->socketGet('abonos');

}

function create() {

	$validate = [
					$_POST["fecha"],
					$_POST["abono"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$body = array(
	        	'fecha' => date("Y-m-d", strtotime($_POST["fecha"])),
	            'abono' => $_POST["abono"],
	            );
		$body = json_encode($body);

		$client = new socketHttp();
		$response = json_decode( $client->socketPost('abonos', $body), true );
		
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
					$_POST["fecha"],
	            	$_POST["abono"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$body = array(
	            'fecha' => date("Y-m-d", strtotime($_POST["fecha"])),
	            'abono' => $_POST["abono"],
	            );
		$body = json_encode($body);


		$client = new socketHttp();
		$response = json_decode( $client->socketPut('abonos/'.$_GET["id"], $body), true );
		
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

function delete() {

	$client = new socketHttp();
	$response = json_decode( $client->socketDelete('abonos/'.$_GET["id"]), true );
		
	if ( $response["response"] == "ok" ) {
	
		$_SESSION["message"] = "success";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"] );

	} else {

		$_SESSION["message"] = "error";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}

}