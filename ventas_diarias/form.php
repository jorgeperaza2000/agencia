		<?php
		use socketHttp\socketHttp;
		$client = new socketHttp();

		if ( isset( $_GET["id"] ) ) {
			
			$datos = json_decode( $client->socketGet('ventas_diarias/'. $_GET["id"] ), true );

			if ( $datos["response"] == "ok" ) {
				
		    }
		}		

		$siteMap = ( $_GET["a"] == "create" ) ? "Crear" : "Modificar";
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
				<strong><?=$siteMap?></strong>
			</li>
		</ol>

		<h2><?=$siteMap?> <?=$name?></h2>

		<br />
		<?php
		if ( $_GET["a"] == "create" ) {
			$programas = json_decode( $client->socketGet('programas'), true );
		?>
			<div class="row">
				<div class="col-md-12">
					
					<div class="panel panel-primary" data-collapsed="0">
					
						<div class="panel-body">

							<div class="row">
								<form name="frm<?=ucfirst($_GET["c"])?>" method="post" action="routes.php?c=<?=$_GET["c"]?>&a=controller&f=<?=$_GET["a"]?><?=(isset($_GET["id"]))?"&id=".$_GET["id"]:""?>">
									<div class="col-md-6">
										<label for="fecha">Fecha</label>
										<input required type="text" id="fecha" value="<?=(isset($datos["data"]["fecha"]))?date("d-m-Y", strtotime($datos["data"]["fecha"])):date("d-m-Y");?>" name="fecha" class="form-control" placeholder="Fecha">
									</div>
									<div class="clear"></div>
									<br />
									<?php
									foreach ($programas["data"] as $key => $value) {
									?>
									<h2><?=$value["nombre"]?> <?=$value["porcentaje"]?>%</h2>
									<br>
									<div class="col-md-6">
										<label for="venta<?=$value["id"]?>">Venta</label>
										<input required type="hidden" id="porcentaje<?=$value["id"]?>" value="<?=$value["porcentaje"]?>" name="porcentaje<?=$value["id"]?>">
										<input required type="text" id="venta<?=$value["id"]?>" value="<?=(isset($datos["data"]["venta"]))?$datos["data"]["venta"]:"";?>" name="venta<?=$value["id"]?>" class="form-control" placeholder="Venta">
									</div>
									<div class="col-md-6">
										<label for="premios<?=$value["id"]?>">Premios</label>
										<input required type="text" id="premios<?=$value["id"]?>" value="<?=(isset($datos["data"]["premios"]))?$datos["data"]["premios"]:"";?>" name="premios<?=$value["id"]?>" class="form-control" placeholder="Premios">
									</div>
									<div class="clear"></div>
									<br />
									<?php
									}
									?>
							
									<div class="col-md-12 text-right">
										<input type="submit" name="btnSave" id="btnSave" class="btn btn-primary" value="Guardar">
									</div>
								</form>
							</div>
							
						</div>
					
					</div>
				
				</div>
			</div>
		<?php
		} else if ( ( $_GET["a"] == "edit" ) && ( isset( $_GET["id"] ) ) ) {
			$programa = json_decode( $client->socketGet('programas/' . $datos["data"]["idPrograma"]), true );
		?>
			<div class="row">
				<div class="col-md-12">
					
					<div class="panel panel-primary" data-collapsed="0">
					
						<div class="panel-body">

							<div class="row">
								<form name="frm<?=ucfirst($_GET["c"])?>" method="post" action="routes.php?c=<?=$_GET["c"]?>&a=controller&f=<?=$_GET["a"]?><?=(isset($_GET["id"]))?"&id=".$_GET["id"]:""?>">
									<div class="col-md-6">
										<label for="fecha">Fecha</label>
										<input required type="text" id="fecha" value="<?=(isset($datos["data"]["fecha"]))?date("d-m-Y", strtotime($datos["data"]["fecha"])):date("d-m-Y");?>" name="fecha" class="form-control" placeholder="Fecha">
									</div>
									<div class="clear"></div>
									<br />
									
									<h2><?=$programa["data"]["nombre"]?> <?=$programa["data"]["porcentaje"]?>%</h2>
									<br>
									<div class="col-md-6">
										<label for="porcentaje">Porcentaje</label>
										<input required type="text" id="porcentaje" value="<?=$datos["data"]["porcentaje_actual"]?>" name="porcentaje" class="form-control" placeholder="Porcentaje">
									</div>
									<div class="clear"></div>
									<br />
									
									<div class="col-md-6">
										<label for="venta">Venta</label>
										<input required type="text" id="venta" value="<?=(isset($datos["data"]["venta"]))?$datos["data"]["venta"]:"";?>" name="venta" class="form-control" placeholder="Venta">
									</div>
									<div class="col-md-6">
										<label for="premios">Premios</label>
										<input required type="text" id="premios" value="<?=(isset($datos["data"]["premios"]))?$datos["data"]["premios"]:"";?>" name="premios" class="form-control" placeholder="Premios">
									</div>
									<div class="clear"></div>
									<br />
																
									<div class="col-md-12 text-right">
										<input type="submit" name="btnSave" id="btnSave" class="btn btn-primary" value="Guardar">
									</div>
								</form>
							</div>
							
						</div>
					
					</div>
				
				</div>
			</div>
		<?php
		}
		?>

		<?php
		require 'footer.php';
		?>