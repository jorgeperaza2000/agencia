		<?php
		use socketHttp\socketHttp;
			
		if ( isset( $_GET["id"] ) ) {
			$client = new socketHttp();
			$datos = json_decode( $client->socketGet('abonos/'. $_GET["id"] ), true );
			$datos["data"] = $datos["data"][0];
			if ( $datos["response"] == "ok" ) {
				
		    }
		}
		
		$siteMap = ( $_GET["a"] == "create" ) ? "Crear" : "Modificar";
		$name = "Abono";
		$names = "Abonos";
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
								<div class="col-md-6">
									<label for="fecha">Fecha</label>
									<input required type="text" id="fecha" value="<?=(isset($datos["data"]["fecha"]))?$datos["data"]["fecha"]:"";?>" name="fecha" class="form-control" placeholder="Fecha">
								</div>
								<div class="col-md-6">
									<label for="abono">Abono</label>
									<input required type="text" id="abono" value="<?=(isset($datos["data"]["abono"]))?$datos["data"]["abono"]:"";?>" name="abono" class="form-control" placeholder="Abono">
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