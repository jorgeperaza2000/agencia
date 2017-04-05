		<?php
		use socketHttp\socketHttp;
			
		if ( isset( $_GET["id"] ) ) {
			$client = new socketHttp();
			$datos = json_decode( $client->socketGet('clientes/'. $_GET["id"] ), true );
			
			if ( $datos["response"] == "ok" ) {
				
		    }
		}
		
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
							<td>
								<h4>ID</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["data"]["id"]))?$datos["data"]["id"]:"";?>	
							</td>
						</tr>
						<tr>
							<td>
								<h4>Nombre</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["data"]["nombre"]))?$datos["data"]["nombre"]:"";?>	
							</td>
						</tr>
						<tr>
							<td>
								<h4>Saldo</h4>
							</td>
							<td class="middle-align">
								<?=(isset($datos["data"]["saldo"]))?$datos["data"]["saldo"]:"";?>
							</td>
						</tr>
					</tbody>
				</table>
		
			</div>
		</div>
		<h2>
			<div class="col-sm-6">Historial Cuentas por Conbrar</div>
		</h2>
		<br />
		<table id="tblListado" class="table table-bordered datatable">
	        <thead>
	            <tr class="text-center">
	                <th>ID</th>
	                <th>Cliente</th>
	                <th>Fecha</th>
	                <th>Monto</th>
	            </tr>
	        </thead>
	        <tbody>
	        </tbody>
	    </table>
		
		
		
		<script type="text/javascript">
		var responsiveHelper;
		var breakpointDefinition = {
		    tablet: 1024,
		    phone : 480
		};
		var tableContainer;
		
			jQuery(document).ready(function($)
			{

				tableContainer = $("#tblListado");
				
				tableContainer.dataTable({
					language: {
			            url: 'assets/Spanish.json'
			        },
			        destroy: true,
			        ajax: {
			            url: 'routes.php?c=deudas&a=controller&f=index&idCliente=<?=$_GET["id"]?>',
			            dataSrc: 'data',
			            error: function($xhr) {},
			            complete: function(h){}
			        },
			        order: [[ 0, "desc" ]],
			        columns: [
			            {
			              "data": "id", // can be null or undefined
			              "defaultContent": ""
			            },            
			            {
			              "data": "nombre", // can be null or undefined
			              "defaultContent": ""
			            },
			            {
			              "data": "fecha", // can be null or undefined
			              "defaultContent": ""
			            },
			            {
			              "data": "monto", // can be null or undefined
			              "defaultContent": ""
			            }			            
			        ]
				});
			});
		</script>

		<div class="row mb100">
			<div class="col-md-12 text-center"><a href="routes.php?c=<?=$_GET["c"]?>&a=index" class="btn btn-default">Volver al listado</a></div>
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