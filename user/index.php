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
				<strong>Listado</strong>
			</li>
		</ol>

		<h2>
			<div class="col-sm-6"><?=$names?></div>
			<div class="col-sm-6 text-right"><a href="routes.php?c=<?=$_GET["c"]?>&a=create" class="btn btn-primary" type="button">Agregar <?=$name?></a></div>
		</h2>

		<table id="tblListado" class="table table-bordered datatable">
	        <thead>
	            <tr class="text-center">
	                <th>ID</th>
	                <th>Nombre</th>
	                <th>Apellido</th>
	                <th>Login</th>
	                <th>Tipo</th>
	                <th>Estatus</th>
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
				tableContainer = $("#tblListado");
				
				tableContainer.dataTable({
					language: {
			            url: 'assets/Spanish.json'
			        },
			        ajax: {
			            url: 'routes.php?c=<?=$_GET["c"]?>&a=controller&f=index',
			            dataSrc: 'users',
			            error: function($xhr) {},
			            complete: function(h){}
			        },
			        columns: [
			            {
			              "data": "id", // can be null or undefined
			              "defaultContent": ""
			            },            
			            {
			              "data": "name", // can be null or undefined
			              "defaultContent": ""
			            },
			            {
			              "data": "lastName", // can be null or undefined
			              "defaultContent": ""
			            },
			            {
			              "data": "login", // can be null or undefined
			              "defaultContent": ""
			            },
			            {
			              "data": "userType", // can be null or undefined
			              "defaultContent": "",
			              "render": function( data, type, row, full, meta) {
			              	if ( data == 1) {
								return "Admin";
							} else if ( data == 2) {
								return "Master";
							} else if ( data == 3) {
								return "Adquiriente";
							} else if ( data == 4) {
								return "Comercio";
							}
			              }
			            },
			            {
			              "data": "status", // can be null or undefined
			              "defaultContent": "",
			              "render": function ( data, type, row, full, meta ) {
			                if ( data == 1 ) {
			                    return '<span class="label label-success">Activo</span>';
			                } else if ( data == 2 ) {
			                	return '<span class="label label-danger">Inactivo</span>';
			                } else if ( data == 3 ) {
			                	return '<span class="label label-warning">Suspendido</span>';
			                } else if ( data == 4 ) {
			                	return '<span class="label label-danger">Bloqueado</span>';
			                }
			              }
			            },
			            {
			              "data": "id", // can be null or undefined
			              "defaultContent": "",
			              "render": function ( data, type, row, full, meta ) {
			                return '<a href="routes.php?c=<?=$_GET["c"]?>&a=view&id='+data+'">Ver</a>';                
			              }
			            },
			            {
			              "data": "id", // can be null or undefined
			              "defaultContent": "",
			              "render": function ( data, type, full, meta ) {
			                return '<a href="routes.php?c=<?=$_GET["c"]?>&a=edit&id='+data+'">Editar</a>';                 
			              }
			            }
			            
			        ]
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