		<?php
		$name = "Usuario";
		$names = "Usuarios";
		?>
		<ol class="breadcrumb bc-3" >
			<li>
				<a href="dashboard.php">Dashboard</a>
			</li>
			<li>
				<a href="routes.php?c=<?=$_GET["c"]?>&a=index"><?=$names?></a>
			</li>
			<li class="active">
				<strong>Mensaje del sistema</strong>
			</li>
		</ol>
		<?php
		if ( isset( $_SESSION["message"] ) ) {

			if ( $_SESSION["message"] == "success" ) {
				if ( !empty( $_GET["profile"] ) ) {
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
				} else {
				?>
					<div class="row mt50">
						<div class="col-md-12">
							<div class="alert alert-success text-center">
								<i class="fa fa fa-check-square-o fa-3x"></i> <strong>Bien hecho!</strong>
								Operación realizada con éxito.
							</div>
						</div>
					</div>
					<div class="row mb100">
						<div class="col-md-12 text-center"><a href="routes.php?c=<?=$_GET["c"]?>&a=index" class="btn btn-default">Volver al listado</a></div>
					</div>
			<?php
				}
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
				<?php
				if ( !empty( $_GET["profile"] ) ) {
				?>
					<div class="row mb100">
						<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
					</div>
				<?php
				} else {
				?>
					<div class="row mb100">
						<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
					</div>
				<?php	
				}
				?>
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
				<?php
				if ( !empty( $_GET["profile"] ) ) {
				?>
					<div class="row mb100">
						<div class="col-md-12 text-center"><a href="routes.php?c=<?=$_GET["c"]?>&a=profile" class="btn btn-primary">Volver</a></div>
					</div>
				<?php
				} else {
				?>
					<div class="row mb100">
						<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
					</div>
				<?php	
				}
				?>
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
				<?php
				if ( !empty( $_GET["profile"] ) ) {
				?>
					<div class="row mb100">
						<div class="col-md-12 text-center"><a href="routes.php?c=<?=$_GET["c"]?>&a=profile" class="btn btn-primary">Volver</a></div>
					</div>
				<?php
				} else {
					/*routes.php?c=<?=$_GET["c"]?>&a=index*/
				?>
					<div class="row mb100">
						<div class="col-md-12 text-center"><a href="javascript:history.back();" class="btn btn-primary">Volver</a></div>
					</div>
				<?php	
				}
				?>
			<?php
			}
		}
		?>
		
		

		<?php
		require 'footer.php';
		?>
		
