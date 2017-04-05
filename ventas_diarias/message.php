		<?php
		$name = "Venta diaria";
		$names = "Ventas diarias";
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
					<div class="col-md-12 text-center"><a href="routes.php?c=<?=$_GET["c"]?>&a=index" class="btn btn-primary">Volver al listado</a></div>
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
					<div class="col-md-12 text-center"><a href="routes.php?c=<?=$_GET["c"]?>&a=index" class="btn btn-primary">Volver al listado</a></div>
				</div>
			<?php
			}
		}
		?>
		
		

		<?php
		require 'footer.php';
		?>
		
