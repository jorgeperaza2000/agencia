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
		$name = "Preguntas de seguridad";
		$names = "Preguntas de seguridad";
		?>
		
		<h2>Creación de <?=$name?></h2>

		<br />
		
		<div class="row">
			<div class="col-md-12">
				<form id="frmChangePassword" name="frmChangePassword" method="post" action="routes.php?c=user&a=controller&f=createQuestionAnswerSecurity">
					<div class="panel panel-primary" data-collapsed="0">
						
						<div class="panel-heading">
							<div class="panel-title"> <strong>Por su seguridad, deberá definir 3 (tres) preguntas y respuestas de seguridad.</strong> </div>
						</div>

						<div class="panel-body">

							<div class="row">
								<div class="col-md-6">
									<label for="question1">Pregunta #1</label>
									<input required type="text" id="question1" name="question1" class="form-control" placeholder="Pregunta de seguridad">
								</div>
								<div class="col-md-6">
									<label for="answer1">Respuesta #1</label>
									<input required type="text" id="answer1" name="answer1" class="form-control" placeholder="Su respuesta">
								</div>
							</div>							
							<div class="row">
								<div class="col-md-6">
									<label for="question2">Pregunta #2</label>
									<input required type="text" id="question2" name="question2" class="form-control" placeholder="Pregunta de seguridad">
								</div>
								<div class="col-md-6">
									<label for="answer1">Respuesta #2</label>
									<input required type="text" id="answer2" name="answer2" class="form-control" placeholder="Su respuesta">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="question3">Pregunta #3</label>
									<input required type="text" id="question3" name="question3" class="form-control" placeholder="Pregunta de seguridad">
								</div>
								<div class="col-md-6">
									<label for="answer3">Respuesta #3</label>
									<input required type="text" id="answer3" name="answer3" class="form-control" placeholder="Su respuesta">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mt20 text-center">
									<input type="submit" name="btnSave" id="btnSave" class="btn btn-primary" value="Establecer Pregunta de Seguridad">
								</div>
							</div>
								
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<br />
		
		<?php
		require 'footer.php';
		?>