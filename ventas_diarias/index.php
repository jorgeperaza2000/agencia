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
				<strong>Listado</strong>
			</li>
		</ol>

		<h2>
			<div class="col-sm-6"><?=$names?></div>
			<div class="col-sm-6 text-right"><a href="routes.php?c=<?=$_GET["c"]?>&a=create" class="btn btn-primary" type="button">Agregar <?=$name?></a></div>
		</h2>

		<div class="row">
			<div class="col-sm-3">
				<label for="merchantGuid">Seleccione la fecha</label>
				<input type="text" name="fecha" id="fecha" class="form-control" placeholder="Fecha">
				<input type="hidden" id="buscar" name="buscar" value="Buscar">
			</div>	
		</div>

		<table id="tblListado" hidden class="table table-bordered datatable">
	        <thead>
	            <tr class="text-center">
	                <th>ID</th>
	                <th>Fecha</th>
	                <th>Programa</th>
	                <th>Venta</th>
	                <th>Premios</th>
	                <th>Porcentaje</th>
	                <th>Comisión</th>
	                <th>Banca</th>
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
				$("#buscar").on("click", function(){
					if ( $("#fecha").val() == "" ) {
						
						$("#tblListado").hide();

					} else {
						
						if ( $("#tblListado").is(":visible") ) {

							$("#tblListado").dataTable()._fnAjaxUpdate();
						
						} else {
						
							$("#tblListado").show();	
						
						}

						tableContainer = $("#tblListado");
				
						tableContainer.dataTable({
							"paging":   false,
					        "info":     false,
					        "searching":     false,
					        "ordering": false,
					        language: {
					            url: 'assets/Spanish.json'
					        },
					        destroy: true,
					        ajax: {
					            url: 'routes.php?c=<?=$_GET["c"]?>&a=controller&f=index&fecha='+$("#fecha").val(),
					            dataSrc: 'data',
					            error: function($xhr) {},
					            complete: function(h){}
					        },
					        columns: [
					            {
					              "data": "id", // can be null or undefined
					              "defaultContent": ""
					            },            
					            {
					              "data": "fecha", // can be null or undefined
					              "defaultContent": ""
					            },
					            {
					              "data": "nombre", // can be null or undefined
					              "defaultContent": ""
					            },
					            {
					              "data": "venta", // can be null or undefined
					              "defaultContent": ""
					            },
					            {
					              "data": "premios", // can be null or undefined
					              "defaultContent": ""
					            },
					            {
					              "data": "porcentaje_actual", // can be null or undefined
					              "defaultContent": ""
					            },
					            {
					              "data": "comision", // can be null or undefined
					              "defaultContent": ""
					            },
					            {
					              "data": "banca", // can be null or undefined
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

