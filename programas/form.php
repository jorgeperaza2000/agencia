		<?php
		use socketHttp\socketHttp;
			
		if ( isset( $_GET["id"] ) ) {
			$client = new socketHttp();
			$datos = json_decode( $client->socketGet('programas/'. $_GET["id"] ), true );

			if ( $datos["response"] == "ok" ) {
				
		    }
		}
		
		$siteMap = ( $_GET["a"] == "create" ) ? "Crear" : "Modificar";
		$name = "Programa";
		$names = "Programas";
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
									<label for="name">Nombre</label>
									<input required type="text" id="name" value="<?=(isset($datos["data"]["nombre"]))?$datos["data"]["nombre"]:"";?>" name="name" class="form-control" placeholder="Nombre">
								</div>
								<div class="col-md-6">
									<label for="porcentaje">Porcentaje</label>
									<input required type="text" id="porcentaje" value="<?=(isset($datos["data"]["porcentaje"]))?$datos["data"]["porcentaje"]:"";?>" name="porcentaje" class="form-control" placeholder="Porcentaje">
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