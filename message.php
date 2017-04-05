<?php
session_start();
require_once 'core/autoloader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>vPortal</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.css">
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">-->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body  page-fade" data-url="">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	
	<div class="main-content">
				
		<div class="row">
		
			<!-- Profile Info and Notifications -->
			<div class="col-md-6 col-sm-8 clearfix">
		
				<ul class="user-info pull-left pull-none-xsm">
		
					<!-- Profile Info -->
					<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="assets/images/profile-picture.png" alt="" class="img-circle" width="36" />
							<?=$_SESSION["user"]["name"]." ".$_SESSION["user"]["lastName"]?> - <?=getUserType($_SESSION["user"]["userType"])?>
						</a>
		
					</li>
		
				</ul>
				
			</div>
		
		
			<!-- Raw Links -->
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
				<ul class="list-inline links-list pull-right">
		
					<!-- Language Selector -->
					<li class="dropdown language-selector">
		
						Idioma: &nbsp;
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
							<img src="assets/images/flag-es.png" />
						</a>
		
						<ul class="dropdown-menu pull-right">
							<li class="active">
								<a href="#">
									<img src="assets/images/flag-uk.png" />
									<span>English</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="assets/images/flag-es.png" />
									<span>Español</span>
								</a>
							</li>
						</ul>
		
					</li>
		
					<li class="sep"></li>
		
					<li>
						<a href="index.php">
							Cerrar Sesión <i class="entypo-logout right"></i>
						</a>
					</li>
				</ul>
		
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-md-12 text-left">Última conexión: 22-02-2017 04:12:45 am</div>
		</div>
		<hr />		
		
		<?php
		$name = "Cambio de contraseña";
		$names = "Cambio de contraseña";
		?>
		
		<h2><?=$name?></h2>

		<br />
		
		<?php
		if ( isset( $_SESSION["message"] ) ) {

			if ( $_SESSION["message"] == "success" ) {
			?>
				<div class="row mt50">
					<div class="col-md-12">
						<div class="alert alert-success text-center">
							<i class="fa fa fa-check-square-o fa-3x"></i> <strong>Bien hecho!</strong>
							Operación realizada con éxito.
						</div>
					</div>
				</div>
				<div class="row mt20">
					<div class="col-md-12">
						<div class="alert alert-minimal text-center">
							Los cambios tomarán efecto con el próximo inicio de sesión.
						</div>
					</div>
				</div>
				<div class="row mb40">
					<div class="col-md-12 text-center"><a href="index.php" class="btn btn-primary">Iniciar sesión nuevamente</a></div>
				</div>
			<?php
			} else if ( $_SESSION["message"] == "error" ) {
			?>
				<div class="row mt50">
					<div class="col-md-12">
						<div class="alert alert-danger text-center">
							<strong>Upss!</strong>
							Ocurrio un error, por favor intente nuevamente.
						</div>
					</div>
				</div>
				<div class="row mb100">
					<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
				</div>
			<?php
			} else if ( $_SESSION["message"] == "incomplete" ) {
			?>
				<div class="row mt50">
					<div class="col-md-12">
						<div class="alert alert-info text-center">
							<strong>Algo faltó!</strong>
							Complete todos los datos obligatorios.
						</div>
					</div>
				</div>
				<div class="row mb100">
					<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
				</div>
			<?php
			} else if ( $_SESSION["message"] == "errorPassword" ) {
			?>
				<div class="row mt50">
					<div class="col-md-12">
						<div class="alert alert-info text-center">
							<strong>La contraseña no cumple con nuestras políticas de seguridad.</strong>
							<ul>
								<li>Al menos 1 (un) Letra</li>
								<li>Al menos 1 (un) Número</li>
								<li>Al menos 1 (un) Caracter Especial ( ! @ # * $ % . )</li>
								<li>Entre 8 y 16 caracteres de logitud</li>
								<li>No debe contener 3 o mas caracteres iguales consecutivos</li>
								<li>No debe ser igual a las últimas 5 (cinco) contraseñas utilizadas </li>
								<li>No debe información personal (Nombre, Apellido, Número de Teléfono)</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row mb100">
					<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
				</div>
			<?php
			} else if ( $_SESSION["message"] == "noMatch" ) {
			?>
				<div class="row mt50">
					<div class="col-md-12">
						<div class="alert alert-danger text-center">
							<strong>Las contraseñas no coinciden, por favor intente nuevamente.</strong>
						</div>
					</div>
				</div>
				<div class="row mb100">
					<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
				</div>
			<?php
			} else if ( $_SESSION["message"] == "errorQuestions" ) {
			?>
				<div class="row mt50">
					<div class="col-md-12">
						<div class="alert alert-danger text-center">
							<strong>Las preguntas de seguridad y respuestas no pueden ser iguales.</strong>
						</div>
					</div>
				</div>
				<div class="row mb100">
					<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
				</div>
			<?php
			}
		}
		?>
		
		<br />
		
		<?php
		require 'footer.php';
		?>