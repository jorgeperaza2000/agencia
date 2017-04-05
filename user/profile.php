		<?php
		use socketHttp\socketHttp;

		$datos = $db->get("users", "*", ["id" => $_SESSION["user"]["id"]]);

		$siteMap = "Perfil del usuario";
		?>
		<ol class="breadcrumb bc-3" >
			<li>
				<a href="dashboard.php">Dashboard</a>
			</li>
			<li class="active">
				<strong><?=$siteMap?></strong>
			</li>
		</ol>

		<h2><?=$siteMap?> <?=strtoupper($datos["login"])?></h2>

		<br />
		<?php
		if ( isset( $datos ) ) {
		?>
		<div class="row">
			<div class="col-md-12">
				<form id="frm<?=ucfirst($_GET['c'])?>" name="frm<?=ucfirst($_GET['c'])?>" method="post" action="routes.php?c=<?=$_GET["c"]?>&a=controller&f=editProfile&id=<?=$_SESSION["user"]["id"]?>">
					<div class="panel panel-primary" data-collapsed="0">
						
						<div class="panel-heading">
							<div class="panel-title"> <strong>Información del usuario</strong> </div>
						</div>

						<div class="panel-body">

							<div class="row">
								<div class="col-md-6">
									<label for="name">Nombre</label>
									<input required type="text" id="name" value="<?=(isset($datos["name"]))?$datos["name"]:"";?>" name="name" class="form-control" placeholder="Nombre">
								</div>
								
								<div class="col-md-6">
									<label for="lastName">Apellido</label>
									<input type="text" id="lastName" value="<?=(isset($datos["lastName"]))?$datos["lastName"]:"";?>" name="lastName" class="form-control" placeholder="Apellido">
								</div>
								<div class="clear"></div>
								<br />

								<div class="col-md-6">
									<label for="phone">Teléfono</label>
									<input type="text" id="phone" value="<?=(isset($datos["phone"]))?$datos["phone"]:"";?>" name="phone" class="form-control" placeholder="04141234567">
								</div>
								
								<div class="col-md-6">
									<label for="email">Email</label>
									<input required type="text" id="email" value="<?=(isset($datos["email"]))?$datos["email"]:"";?>" name="email" class="form-control" placeholder="eduardoperez@example.com">
								</div>
							</div>
						</div>

						<div class="panel-heading">
							<div class="panel-title"> <strong>Seguridad</strong> </div>
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<label for="expirationPasswordPeriod">Período de Vencimieno de Contraseña</label>
									<select required name="expirationPasswordPeriod" id="expirationPasswordPeriod" class="form-control">
										<option value="">Seleccione</option>
										<option <?=(isset($datos["expirationPasswordPeriod"]) && $datos["expirationPasswordPeriod"]=="30")?"selected='selected'":""?> value="30">30 Días</option>
										<option <?=(isset($datos["expirationPasswordPeriod"]) && $datos["expirationPasswordPeriod"]=="60")?"selected='selected'":""?> value="60">60 Días</option>
										<option <?=(isset($datos["expirationPasswordPeriod"]) && $datos["expirationPasswordPeriod"]=="90")?"selected='selected'":""?> value="90">90 Días</option>
										<option <?=(isset($datos["expirationPasswordPeriod"]) && $datos["expirationPasswordPeriod"]=="180")?"selected='selected'":""?> value="180">180 Días</option>
									</select>
								</div>
								<div class="clear"></div>
								<br />
								
								<div class="col-md-6">
									<label for="password">Contraseña</label>
									<input type="password" id="password" value="" name="password" class="form-control" placeholder="Deje en blanco para mantener contraseña actual">
								</div>
								<div class="col-md-6">
									<label for="password2">Repita Contraseña</label>
									<input type="password" id="password2" value="" name="password2" class="form-control" placeholder="Deje en blanco para mantener contraseña actual">
								</div>

							</div>
						</div>

						<div class="panel-heading">
							<div class="panel-title"> <strong>Datos Adicionales</strong> </div>
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<strong>Tipo de usuario:</strong> <?=getUserType($_SESSION["user"]["userType"])?>
								</div>
								<div class="clear"></div>
								<br />

								<?php
								$client = new socketHttp();
								
								if ( $datos["userType"] == "3" ) {
									
									$banks = json_decode( $client->socketGet('bank/'.$_SESSION["user"]["associateId"]), true );
									$bank = $banks["name"];
								?>
								
									<div class="col-md-6">
										<strong>Banco asociado:</strong> <?=$bank?>
									</div>

								<?php
								} else if ( ( isset( $datos["userType"] ) ) && ( $datos["userType"]=="4" ) ) {
									
									$merchant = json_decode( $client->socketGet('merchant/'.$_SESSION["user"]["associateId"]), true );
									
								?>
									<div class="col-md-6">
										<strong>Comercio asociado:</strong> <?=$merchant["merchantGuid"] . " - " . $merchant["fantasyName"]?>
									</div>
								<?php
								}
								?>
								
								<div class="clear"></div>
								<br />
								
								<div class="col-md-12 text-right">
									<input type="submit" name="btnSave" id="btnSave" class="btn btn-primary" value="Guardar">
								</div>
								
							</div>
							
						</div>
					</form>
				</div>
			
			</div>
		</div>
		<?php
		}
		?>
		
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#merchantGuid').select2();
			$('#bankId').select2();
		});
		</script>
		<?php
		require 'footer.php';
		?>
		

		