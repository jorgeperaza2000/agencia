		<?php
		require 'header.php';
		$name = $this->controller;
		?>
		<ol class="breadcrumb bc-3" >
			<li>
				<a href="dashboard.php">Dashboard</a>
			</li>
			<li>
				<a href="../<?=$this->c?>/index"><?=$name?></a>
			</li>
			<li class="active">
				<strong>Listado</strong>
			</li>
		</ol>

		<h2>
			<div class="col-sm-6"><?=$name?></div>
			<div class="col-sm-6 text-right"><a href="../<?=$this->c?>/create" class="btn btn-primary" type="button">Agregar <?=$name?></a></div>
		</h2>

		<table id="tblListado" class="table table-bordered datatable">
	        <thead>
	            <tr class="text-center">
	                <th>ID</th>
	                <th>Nombre</th>
	                <th>Saldo</th>
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
			            url: '../<?=$this->c?>/listDataTable',
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
			              "data": "nombre", // can be null or undefined
			              "defaultContent": ""
			            },
			            {
			              "data": "saldo", // can be null or undefined
			              "defaultContent": ""
			            },
			            {
			              "data": "id", // can be null or undefined
			              "defaultContent": "",
			              "render": function ( data, type, full, meta ) {
			                return '<a href="../<?=$this->c?>/edit/'+data+'">Editar</a>';                 
			              }
			            },
			            {
			              "data": "id", // can be null or undefined
			              "defaultContent": "",
			              "render": function ( data, type, full, meta ) {
			                return '<a href="../<?=$this->c?>/delete/'+data+'">Eliminar</a>';                 
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
		