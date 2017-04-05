		<?php
		$name = "Cuenta por cobrar";
		$names = "Cuentas por cobrar";
		use socketHttp\socketHttp;

		$client = new socketHttp();
		$response = json_decode( $client->socketGet('clientes'), true );

		foreach ($response["data"] as $key => $value) {
			$clientes[$key]["id"] = $value["id"];
			$clientes[$key]["nombre"] = $value["nombre"] . " | " . nf($value["saldo"]);
		}

		?>
		<ol class="breadcrumb bc-3" >
			<li>
				<a href="dashboard.php">Dashboard</a>
			</li>
			<li>
				<a href="routes.php?c=<?=$_GET["c"]?>&a=index"><?=$names?></a>
			</li>
			<li class="active">
				<strong>Listado</strong>
			</li>
		</ol>

		<h2>
			<div class="col-sm-6"><?=$names?></div>
			<div class="col-sm-6 text-right"><a href="routes.php?c=<?=$_GET["c"]?>&a=create" class="btn btn-primary" type="button">Agregar <?=$name?></a></div>
		</h2>

		<br>

		<div class="row">
			<div class="col-sm-6">
			<label for="merchantGuid">Seleccione el cliente</label>
				<select id="idCliente" name="idCliente" class="form-control">
					<option value="">Seleccione</option>
					<?php
					foreach ($clientes as $key => $value) {
					?>
						<option value="<?=$value["id"]?>"><?=$value["nombre"]?></option>
					<?php
					}
					?>
				</select>
			</div>	
		</div>

		<table id="tblListado" hidden class="table table-bordered datatable">
	        <thead>
	            <tr class="text-center">
	                <th>ID</th>
	                <th>Cliente</th>
	                <th>Fecha</th>
	                <th>Monto</th>
	                <th>Descripción</th>
	                <th></th>
	                <th></th>
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

				$("#idCliente").on("change", function(){
					if ( $("#idCliente option:selected").val() == "" ) {
						
						$("#tblListado").hide();

					} else {
						
						if ( $("#tblListado").is(":visible") ) {

							$("#tblListado").dataTable()._fnAjaxUpdate();
						
						} else {
						
							$("#tblListado").show();	
						
						}

						tableContainer = $("#tblListado");
						
						tableContainer.dataTable({
							language: {
					            url: 'assets/Spanish.json'
					        },
					        destroy: true,
					        ajax: {
					            url: 'routes.php?c=<?=$_GET["c"]?>&a=controller&f=index&idCliente='+$("#idCliente option:selected").val(),
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
					            },
					            {
					              "data": "descripcion", // can be null or undefined
					              "defaultContent": ""
					            },
					            {
					              "data": "id", // can be null or undefined
					              "defaultContent": "",
					              "render": function ( data, type, full, meta ) {
					                return '<a href="routes.php?c=<?=$_GET["c"]?>&a=edit&id='+data+'">Editar</a>';                 
					              }
					            },
					            {
					              "data": "id", // can be null or undefined
					              "defaultContent": "",
					              "render": function ( data, type, full, meta ) {
					                return '<a href="routes.php?c=<?=$_GET["c"]?>&a=controller&f=delete&id='+data+'">Eliminar</a>';                 
					              }
					            }					            
					        ]
						});
					}
				});
			});
		</script>
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