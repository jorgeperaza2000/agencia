		<?php
			
		if ( isset( $_GET["id"] ) ) {
			
			$datos = $db->get("users", "*", ["id" => $_GET["id"]]);

		}

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
				<strong>Información</strong>
			</li>
		</ol>

		<h2>
			<div class="col-sm-6">Información del <?=$name?></div>
		</h2>
		<br />
		<br />

		<div class="row">
			<div class="col-md-12">
				<!-- API Functions -->
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td width="30%">
								<h4>Nombre</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["name"]))?$datos["name"]:"";?>	
							</td>
						</tr>
		
		
						<tr>
							<td>
								<h4>Apellido</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["lastName"]))?$datos["lastName"]:"";?>
							</td>
						</tr>
		
		
						<tr>
							<td>
								<h4>Login</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["login"]))?$datos["login"]:"";?>
							</td>
						</tr>

						<tr>
							<td>
								<h4>Tipo de Usuario</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["userType"]))?getUserType($datos["userType"]):"";?>
							</td>
						</tr>

						<tr>
							<td>
								<h4>Estatus</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["status"]))?getUserStatus($datos["status"]):"";?>
							</td>
						</tr>
					</tbody>
				</table>
		
			</div>
		</div>
	
		<div class="row">
			<div class="col-md-12 text-right"><a href="routes.php?c=<?=$_GET["c"]?>&a=index" class="btn btn-primary" type="button">Volver al listado</a></div>
		</div>
		
		<?php
		require 'footer.php';
		?>
		

		<!-- Imported styles on this page -->
		<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
		<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
		<link rel="stylesheet" href="assets/js/select2/select2.css">

		<!-- Imported scripts on this page -->
		<script src="assets/js/dataTables.bootstrap.js"></script>
		<script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
		<script src="assets/js/datatables/lodash.min.js"></script>
		<script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>
		<script src="assets/js/select2/select2.min.js"></script>
		<script src="assets/js/neon-chat.js"></script>