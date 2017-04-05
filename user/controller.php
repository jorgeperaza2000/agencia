<?php
require 'core/autoloader.php';
include 'vendor/PHPMailer/class.phpmailer.php';
use socketHttp\socketHttp;
use validate\validate;

if ( is_callable($_GET["f"] ) ) {
	$_GET["f"]($db);
}


function login($db) {

	$validate = [
					$_POST["username"],
					$_POST["password"],
				];
	$validation = new validate();
	if ( $validation->validatePost( $validate ) ) {

				
		$user = $db->get("usuarios", "*", ["AND" => ["login" => $_POST["username"], "clave" => $_POST["password"], "estatus" => "Activo"]]);
		
		if ( count( $user ) > 1 ) {

			$_SESSION["user"] = $user;

			
			$login_status = 'success';

			$resp['redirect_url'] = 'dashboard.php';

		} else {
			
			$login_status = 'error';

		}


	} else {

		$login_status = 'error';

	}

	$resp['login_status'] = $login_status;

	echo json_encode($resp);

}

function index($db) {

	$user = $db->select("users", "*");


	$datos = new \stdClass();
	$datos->users = $user;
	
	echo json_encode($datos);
	

}

function create($db) {

	$validate = [
					$_POST["name"],
					//$_POST["lastName"],
					//$_POST['phone'],
					$_POST['email'],

					$_POST['login'],
					$_POST['expirationPasswordPeriod'],
					//$_POST['status'],
					//$_POST['changePasswordNextLogin'],

					$_POST['userType'],
					//$_POST['bankId'],
					//$_POST['merchantGuid'],
				];
	$validation = new validate();

	if ( $validation->validatePost( $validate ) ) {
		
		if ( !empty( $_POST['bankId'] ) ) {
			$associateId = $_POST['bankId'];
		} else if ( !empty( $_POST['merchantGuid'] ) ) {
			$associateId = $_POST['merchantGuid'];
		} else {
			$associateId = "";
		}

		$fecha = date( "Y-m-d" );
		$expirationPasswordDate = date( "Y-m-d", strtotime ( '+' . $_POST["expirationPasswordPeriod"] . ' day' , strtotime ( $fecha ) ) );
		$password = generatePassword();
		$datos = $db->insert("users", 
							[
							'"name"' => $_POST["name"],
							'"lastName"' => $_POST["lastName"],
							'"phone"' => $_POST["phone"],
							'"email"' => $_POST["email"],
							'"login"' => $_POST["login"],
							'#"generationPasswordDate"' => "NOW()",
							'"expirationPasswordPeriod"' => $_POST["expirationPasswordPeriod"],
							'"expirationPasswordDate"' => $expirationPasswordDate,
							'"password"' => $password,
							'"status"' => '1',
							'"changePasswordNextLogin"' => '1',
							'"userType"' => $_POST["userType"],
							'"associateId"' => $associateId,
							'"failedAttemptsLogin"' => 0,
							]);

		if ( $datos ) {

			$to = [strtolower($_POST["email"]) => ucwords($_POST["name"])];
			$asunto = utf8_decode( "Creación de usuario");
			$cuerpo = "Hola " . ucwords($_POST["name"]) . " " . ucwords($_POST["lastName"]) . ", se ha creado tu cuenta en Vportal con éxito.<br><br>";
			$cuerpo .= "Tiene 24 horas para iniciar sesión, de lo contrario el usuario será bloqueado.<br><br>";

			$cuerpo .= "Nombre de usuario: " . strtolower($_POST["login"]) . "<br>";
			$cuerpo .= "Contraseña: " . $password . "<br>";
			$cuerpo = utf8_decode( $cuerpo );
			enviaEmail( $to, $asunto, $cuerpo);

			$_SESSION["message"] = "success";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $datos);

		} else {

			$_SESSION["message"] = "error";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $datos);

		}

	} else {

		$_SESSION["message"] = "incomplete";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $datos);

	}

}

function edit($db) {

	$validate = [
					$_POST["name"],
					//$_POST["lastName"],
					//$_POST['phone'],
					$_POST['email'],

					$_POST['login'],
					$_POST['expirationPasswordPeriod'],
					//$_POST['password'],
					//$_POST['password2'],
					$_POST['status'],
					$_POST['changePasswordNextLogin'],

					$_POST['userType'],
					//$_POST['bankId'],
					//$_POST['merchantGuid'],
				];
	$validation = new validate();

	if ( $validation->validatePost( $validate ) ) {
		
		if ( !empty( $_POST['bankId'] ) ) {
			$associateId = $_POST['bankId'];
		} else if ( !empty( $_POST['merchantGuid'] ) ) {
			$associateId = $_POST['merchantGuid'];
		} else {
			$associateId = "";
		}

		$fecha = date( "Y-m-d" );
		$expirationPasswordDate = date( "Y-m-d", strtotime ( '+' . $_POST["expirationPasswordPeriod"] . ' day' , strtotime ( $fecha ) ) );


		if ( !empty( $_POST["password"] ) ) {

			if ( validaPassword( $db, $_POST["password"], $_GET["id"] ) ) {

				$datos = $db->update("users", 
									[
									"name" => $_POST["name"],
									"lastName" => $_POST["lastName"],
									"phone" => $_POST["phone"],
									"email" => $_POST["email"],
									"login" => $_POST["login"],
									"password" => $_POST["password"],
									"expirationPasswordPeriod" => $_POST["expirationPasswordPeriod"],
									"expirationPasswordDate" => $expirationPasswordDate,
									"status" => $_POST["status"],
									"changePasswordNextLogin" => ($_POST["changePasswordNextLogin"]==1)?'1':'0',
									"userType" => $_POST["userType"],
									"associateId" => $associateId,
									"failedAttemptsLogin" => 0,
									],
									[
									"id" => $_GET["id"]
									]);

				$datos = $db->insert("lastpassworduser", ['"idUser"' => $_GET["id"], '"password"' => $_POST["password"], '"changePasswordDate"' => date("Y-m-d")]);

				$response = ( $datos === false )?false:true;

			} else {

				$response = false;
				$_SESSION["message"] = "errorPassword";
				header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);
				exit();

			}

		} else {

			$datos = $db->update("users", 
								[
								"name" => $_POST["name"],
								"lastName" => $_POST["lastName"],
								"phone" => $_POST["phone"],
								"email" => $_POST["email"],
								"login" => $_POST["login"],
								"expirationPasswordPeriod" => $_POST["expirationPasswordPeriod"],
								"expirationPasswordDate" => $expirationPasswordDate,
								"status" => $_POST["status"],
								"changePasswordNextLogin" => ($_POST["changePasswordNextLogin"]==1)?'1':'0',
								"userType" => $_POST["userType"],
								"associateId" => $associateId,
								"failedAttemptsLogin" => 0,
								],
								[
								"id" => $_GET["id"]
								]);
			$response = ( $datos === false )?false:true;

		}

		if ( isset( $_GET["id"] ) ) {
			
			
			if ( $response ) {

				$_SESSION["message"] = "success";
				header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);

			} else {

				$_SESSION["message"] = "error";
				header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);

			}

		} else {

			$_SESSION["message"] = "error";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);

		}

	} else {

		$_SESSION["message"] = "incomplete";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);

	}

}


function editProfile($db) {

	$validate = [
					$_POST["name"],
					$_POST['email'],
					$_POST['expirationPasswordPeriod'],
				];
	$validation = new validate();

	if ( $validation->validatePost( $validate ) ) {
		
		$fecha = date( "Y-m-d" );
		$expirationPasswordDate = date( "Y-m-d", strtotime ( '+' . $_POST["expirationPasswordPeriod"] . ' day' , strtotime ( $fecha ) ) );


		if ( !empty( $_POST["password"] ) ) {

			if ( validaPassword( $db, $_POST["password"], $_GET["id"] ) ) {

				$datos = $db->update("users", 
									[
									"name" => $_POST["name"],
									"lastName" => $_POST["lastName"],
									"phone" => $_POST["phone"],
									"email" => $_POST["email"],
									"password" => $_POST["password"],
									"expirationPasswordPeriod" => $_POST["expirationPasswordPeriod"],
									"expirationPasswordDate" => $expirationPasswordDate,
									"failedAttemptsLogin" => 0,
									],
									[
									"id" => $_GET["id"]
									]);

				$datos = $db->insert("lastpassworduser", ['"idUser"' => $_GET["id"], '"password"' => $_POST["password"], '"changePasswordDate"' => date("Y-m-d")]);

				$response = ( $datos === false )?false:true;

			} else {

				$response = false;
				$_SESSION["message"] = "errorPassword";
				header("location: routes.php?c=" . $_GET["c"] . "&a=message&profile=true&id=" . $_GET["id"]);
				exit();

			}

		} else {

			$datos = $db->update("users", 
								[
								"name" => $_POST["name"],
								"lastName" => $_POST["lastName"],
								"phone" => $_POST["phone"],
								"email" => $_POST["email"],
								"expirationPasswordPeriod" => $_POST["expirationPasswordPeriod"],
								"expirationPasswordDate" => $expirationPasswordDate,
								"failedAttemptsLogin" => 0,
								],
								[
								"id" => $_GET["id"]
								]);
			$response = ( $datos === false )?false:true;
		}

		if ( isset( $_GET["id"] ) ) {
			
			
			if ( $response ) {
				
				$_SESSION["message"] = "success";
				header("location: routes.php?c=" . $_GET["c"] . "&a=message&profile=true&id=" . $_GET["id"]);

			} else {
				
				$_SESSION["message"] = "error";
				header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);

			}

		} else {

			$_SESSION["message"] = "error";
			header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);

		}

	} else {

		$_SESSION["message"] = "incomplete";
		header("location: routes.php?c=" . $_GET["c"] . "&a=message&id=" . $_GET["id"]);

	}

}

function changePassword( $db ) {

	$validate = [
					$_POST['password'],
					$_POST['password2'],
				];
	$validation = new validate();

	if ( $validation->validatePost( $validate ) ) {
		
		if ( $_POST['password'] == $_POST['password2'] ) {

			if ( validaPassword( $db, $_POST["password"], $_SESSION["user"]["id"] ) ) {

				$user = $db->get("users", "*", ["id" => $_SESSION["user"]["id"]]);

				$fecha = date( "Y-m-d" );
				$expirationPasswordDate = date( "Y-m-d", strtotime ( '+' . $user["expirationPasswordPeriod"] . ' day' , strtotime ( $fecha ) ) );

				$datos = $db->update("users", 
									[
									"#generationPasswordDate" => "NOW()",
									"expirationPasswordDate" => $expirationPasswordDate,
									"password" => $_POST['password'],
									"changePasswordNextLogin" => 0,
									"failedAttemptsLogin" => 0,
									],
									["id" => $_SESSION["user"]["id"]]);

				$datos = $db->insert("lastpassworduser", ['"idUser"' => $_SESSION["user"]["id"], '"password"' => $_POST["password"], '"changePasswordDate"' => date("Y-m-d")]);

				$response = ( $datos === false )?false:true;

			} else {

				$response = false;
				$_SESSION["message"] = "errorPassword";
				header("location: message.php?id=" . $_SESSION["user"]["id"]);
				exit();

			}
			if ( $response ) {

				$_SESSION["message"] = "success";

				$questions = $db->count("securitycuestionuser", ["idUser" => $_SESSION["user"]["id"]]);

				if ( $questions > 0 ) {
					
					header("location: message.php?id=" . $_SESSION["user"]["id"]);

				} else {

					header("location: securityquestions.php");

				}

			} else {

				$_SESSION["message"] = "error";
				header("location: message.php?id=" . $_SESSION["user"]["id"]);

			}
		} else {

			$_SESSION["message"] = "noMatch";
			header("location: message.php?id=" . $_SESSION["user"]["id"]);

		}

	} else {

		$_SESSION["message"] = "incomplete";
		header("location: message.php?id=" . $_SESSION["user"]["id"]);

	}

}

function createQuestionAnswerSecurity( $db ) {

	$validate = [
					$_POST['question1'],
					$_POST['question2'],
					$_POST['question3'],
					$_POST['answer1'],
					$_POST['answer2'],
					$_POST['answer3'],
				];
	$validation = new validate();

	if ( $validation->validatePost( $validate ) ) {

		if ( 
			( $_POST['question1'] != $_POST['question2'] ) && ( $_POST['question1'] != $_POST['question3'] ) && ( $_POST['question2'] != $_POST['question3'] ) 
			&&
			( $_POST['answer1'] != $_POST['answer2'] ) && ( $_POST['answer1'] != $_POST['answer3'] ) && ( $_POST['answer2'] != $_POST['answer3'] ) 
		) {

			for ($i=1; $i <= 3; $i++) { 
				
				$datos = $db->insert("securitycuestionuser", 
									[
									'"idUser"' => $_SESSION["user"]["id"], 
									'"question"' => $_POST["question".$i], 
									'"answer"' => $_POST["answer".$i]
									]);

			}

			$response = ( $datos === false )?false:true;
		} else {

			$response = false;
			$_SESSION["message"] = "errorQuestions";
			header("location: message.php?id=" . $_SESSION["user"]["id"]);
			exit();

		}

		if ( $response ) {

			$_SESSION["message"] = "success";
			header("location: message.php?id=" . $_SESSION["user"]["id"]);

		} else {

			$_SESSION["message"] = "error";
			header("location: message.php?id=" . $_SESSION["user"]["id"]);

		}
		
	} else {

		$_SESSION["message"] = "incomplete";
		header("location: message.php?id=" . $_SESSION["user"]["id"]);

	}
}