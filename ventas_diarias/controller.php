<?php
require 'core/autoloader.php';
use socketHttp\socketHttp;
use validate\validate;

if ( is_callable($_GET["f"] ) ) {
	$_GET["f"]();
}

function index() {

	$client = new socketHttp();
	$fecha = date("Y-m-d", strtotime($_GET["fecha"]));
	echo $client->socketGet('ventas_diarias/' . $fecha);

}

function create() {

	$client = new socketHttp();
	
	$programas = json_decode( $client->socketGet('programas'), true );
	foreach ($programas["data"] as $key => $value) {
		$arrayPost[] = [
						'idPrograma' => $value["id"],
						'fecha' => $_POST["fecha"],
						'porcentaje' => $_POST["porcentaje".$value["id"]],
						'venta' => $_POST["venta".$value["id"]],
						'premios' => $_POST["premios".$value["id"]],
					];
	}
	$body = $arrayPost;
	$body = json_encode($body);
	
	$response = json_decode( $client->socketPost('ventas_diarias', $body), true );
	
	if ( $response["response"] == "ok" ) {
	
		$_SESSION["message"] = "success";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $response["data"]);

	} else {

		$_SESSION["message"] = "error";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}

}

function edit() {

	$validate = [
					$_POST["venta"],
					$_POST["porcentaje"],
					$_POST["fecha"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$body = array(
					'fecha' => $_POST["fecha"],
					'porcentaje' => $_POST["porcentaje"],
					'venta' => $_POST["venta"],
					'premios' => $_POST["premios"],
	            );
		$body = json_encode($body);

		$client = new socketHttp();
		$response = json_decode( $client->socketPut('ventas_diarias/'.$_GET["id"], $body), true );
		
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
	$response = json_decode( $client->socketDelete('ventas_diarias/'.$_GET["id"]), true );
		
	if ( $response["response"] == "ok" ) {
	
		$_SESSION["message"] = "success";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"] );

	} else {

		$_SESSION["message"] = "error";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}

}