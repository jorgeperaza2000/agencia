		<?php
		use socketHttp\socketHttp;
		$client = new socketHttp();
		
		if ( isset( $_GET["id"] ) ) {
			$datos = json_decode( $client->socketGet('deudas/'. $_GET["id"] ), true );

			if ( $datos["response"] == "ok" ) {
				
		    }
		}


		$response = json_decode( $client->socketGet('clientes'), true );

		foreach ($response["data"] as $key => $value) {
			$clientes[$key]["id"] = $value["id"];
			$clientes[$key]["nombre"] = $value["nombre"] . " | " . nf($value["saldo"]);
		}
		
		$siteMap = ( $_GET["a"] == "create" ) ? "Crear" : "Modificar";
		$name = "Cuenta por cobrar";
		$names = "Cuentas por cobrar";
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
		if ( ( $_GET["a"] == "create" ) || (isset( $datos["response"] ) && $datos["response"] == "ok" ) ) {
		?>
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-primary" data-collapsed="0">
				
					<div class="panel-body">

						<div class="row">
							<form name="frm<?=ucfirst($_GET["c"])?>" method="post" action="routes.php?c=<?=$_GET["c"]?>&a=controller&f=<?=$_GET["a"]?><?=(isset($_GET["id"]))?"&id=".$_GET["id"]:""?>">
								<div class="col-sm-6">
									<label for="merchantGuid">Seleccione el cliente</label>
									<select id="idCliente" name="idCliente" class="form-control">
										<option value="">Seleccione</option>
										<?php
										foreach ($clientes as $key => $value) {
										?>
											<option <?=(isset($datos["data"]["idCliente"]) && ($datos["data"]["idCliente"]==$value["id"]))?"selected":""?> value="<?=$value["id"]?>"><?=$value["nombre"]?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="col-sm-6">
									<label for="fecha">Fecha</label>
									<input required type="text" id="fecha" value="<?=(isset($datos["data"]["fecha"]))?date("d-m-Y", strtotime($datos["data"]["fecha"])):date("d-m-Y");?>" name="fecha" class="form-control" placeholder="Fecha">
								</div>
								
								<div class="clear"></div>
								<br />

								<div class="col-sm-6">
									<label for="monto">Monto</label>
									<input required type="text" id="monto" value="<?=(isset($datos["data"]["monto"]))?$datos["data"]["monto"]:"";?>" name="monto" class="form-control" placeholder="Monto">
									<p><i class="fa fa-info-circle"></i> Positivo Deuda / Negativo Pago</p>
								</div>
								<div class="col-sm-6">
									<label for="descripcion">Descripción</label>
									<input type="text" id="descripcion" value="<?=(isset($datos["data"]["descripcion"]))?$datos["data"]["descripcion"]:"";?>" name="descripcion" class="form-control" placeholder="Loteria, Parley, Café, otros">
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