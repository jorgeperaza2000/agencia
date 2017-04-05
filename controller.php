<?php
require 'core/autoloader.php';
use socketHttp\socketHttp;
use validate\validate;

if ( is_callable($_GET["f"] ) ) {
	$_GET["f"]();
}

function index() {

	$client = new socketHttp();
	echo $client->socketGet('terminal/bymerchant/' . $_GET["merchantGuid"]);

}

function create() {

	$validate = [
					$_POST["affiliationId"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$rule = array();

		$body = json_encode($rule);
		$client = new socketHttp();
		$response = json_decode( $client->socketPost('terminal/'. $_POST["affiliationId"], $body), true );
		
		if ( $response["type"] == "terminal" ) {
		
			$_SESSION["message"] = "success";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $response["id"]);

		} else {

			$_SESSION["message"] = "error";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message");

		}

	} else {

		$_SESSION["message"] = "incomplete";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}
    
}

function activar() {
	
	$rule = array();

	$body = json_encode($rule);
	
	$client = new socketHttp();
	$response = json_decode( $client->socketPost('terminal/enable/'. $_GET["terminalGuid"], $body), true );

	if ( $response["type"] == "SUCCESS" ) {
		
		$_SESSION["message"] = "success";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	} else {

		$_SESSION["message"] = "error";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}

}

function desactivar() {
	
	$rule = array();

	$body = json_encode($rule);
	
	$client = new socketHttp();
	$response = json_decode( $client->socketPost('terminal/disable/'. $_GET["terminalGuid"], $body), true );

	if ( $response["type"] == "SUCCESS" ) {
		
		$_SESSION["message"] = "success";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	} else {

		$_SESSION["message"] = "error";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message");

	}

}


function getParametersByTerminal() {

	$client = new socketHttp();
	echo $client->socketGet('terminal/' . $_GET["id"] . '/parameter');

}

function getAffiliationsByMerchant() {

	$client = new socketHttp();
	$datos = json_decode( $client->socketGet('affiliation/'.$_POST["id"]) , true);
	
	foreach ($datos["affiliation"] as $key => $value) {
		$dato[$value["paymentChannelId"]] = $value["paymentChannelName"]; 
	}
	echo json_encode($dato);
	
}

function getAcquirerByAffiliation() {

	$client = new socketHttp();
	$datos = json_decode( $client->socketGet('acquirer/merchant/'.$_POST["merchantGuid"].'/'.$_POST["affiliationId"]) , true);

	foreach ($datos["acquirer"] as $key => $value) {
		$dato[$value["id"]] = $value["displayName"]; 
	}
	echo json_encode($dato);

}

function addTerminalParameter() {

	$validate = [
					$_POST["acquirerId"],
					$_POST['valueParameter'],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

		$bank = array(
	        	'type' => 'terminalParameter',
	        	'acquirerId' => $_POST["acquirerId"],
	            'value' => $_POST['valueParameter'],
	            );
		$body = json_encode($bank);

		$client = new socketHttp();
		$response = json_decode( $client->socketPost('terminal/' . $_POST["terminalId"] . '/' . $_POST["affiliationId"] . '/parameter/add', $body), true );

		if ( $response["type"] == "terminalParametersList" ) {
			echo json_encode("SUCCESS");
		}

	} else {

		echo json_encode("INCOMPLETE");

	}
	
}

function getDeviceToAssign() {

	$client = new socketHttp();
	$devices = json_decode($client->socketGet('device/toAssign?available=true'), true);
	foreach ($devices["deviceToAssign"] as $key => $value) {
		$dato[$value["deviceId"] . "-" . $value["deviceSerial"]] = $value["deviceName"] . " - " . $value["deviceTypeName"] . " - " . $value["deviceSerial"];
	}
	echo json_encode($dato);
		
	
}

function deleteAssignedDevice() {

	$client = new socketHttp();
	$response = $client->socketDelete('device/assigned/' . $_GET["assignedDeviceId"]);	
	header('Location:' . getenv('HTTP_REFERER'));

}