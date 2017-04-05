		<?php
		use socketHttp\socketHttp;

		if ( isset( $_GET["id"] ) ) {
			
			$datos = $db->get("users", "*", ["id" => $_GET["id"]]);

		}
		
		$siteMap = ( $_GET["a"] == "create" ) ? "Crear" : "Modificar";
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
				<strong><?=$siteMap?></strong>
			</li>
		</ol>

		<h2><?=$siteMap?> <?=$name?></h2>

		<br />
		<?php
		if ( ( $_GET["a"] == "create" ) || (isset( $datos ) ) ) {
		?>
		<div class="row">
			<div class="col-md-12">
				<form autocomplete="off" id="frm<?=ucfirst($_GET['c'])?>" name="frm<?=ucfirst($_GET['c'])?>" method="post" action="routes.php?c=<?=$_GET["c"]?>&a=controller&f=<?=$_GET["a"]?><?=(isset($_GET["id"]))?"&id=".$_GET["id"]:""?>">
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
									<label for="login">Usuario del Sistema</label>
									<input required type="text" id="login" value="<?=(isset($datos["login"]))?$datos["login"]:"";?>" name="login" class="form-control" placeholder="Usuario del Sistema">
								</div>
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
								
								<?php
								if ( $_GET["a"] != "create" ) {
								?>
									<div class="col-md-6">
									<input type="text" style="display:none">
										<label for="password">Contraseña</label>
										<input type="password" id="password" autocomplete="false" value="" name="password" class="form-control" placeholder="Deje en blanco para mantener contraseña actual">
									</div>
									<div class="col-md-6">
										<label for="password2">Repita Contraseña</label>
										<input type="password" id="password2" autocomplete="off" value="" name="password2" class="form-control" placeholder="Deje en blanco para mantener contraseña actual">
									</div>
									<div class="clear"></div>
									<br />
									<div class="col-md-6">
										<label for="status">Estatus</label>
										<select required name="status" id="status" class="form-control">
											<option value="">Seleccione</option>
											<option <?=(isset($datos["status"]) && $datos["status"]=="1")?"selected='selected'":""?> value="1">Activo</option>
											<option <?=(isset($datos["status"]) && $datos["status"]=="2")?"selected='selected'":""?> value="2">Inactivo</option>
											<option <?=(isset($datos["status"]) && $datos["status"]=="3")?"selected='selected'":""?> value="3">Suspendido</option>
											<option <?=(isset($datos["status"]) && $datos["status"]=="4")?"selected='selected'":""?> value="4">Bloqueado</option>
										</select>
									</div>
									<?php
									if ( $_GET["a"] == "create" ) {

										$forceChangePassword = "checked='checked'";

									} else {
										$forceChangePassword = "";
										if (isset($datos["changePasswordNextLogin"]) && ($datos["changePasswordNextLogin"]=="1")) {
											$forceChangePassword = "checked='checked'";									
										}
									}
									?>
									<div class="form-group">
										<label class="col-md-6" for="changePasswordNextLogin">Forzar cambio de contraseña en próximo inicio de sesión</label>
										<div class="make-switch" data-on-label="Si" data-off-label="No" data-text-label="<i class='entypo-user'></i>">
											<input type="checkbox" name="changePasswordNextLogin" <?=$forceChangePassword?> id="changePasswordNextLogin" value="1" class="form-control">
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</div>

						<div class="panel-heading">
							<div class="panel-title"> <strong>Configuración del usuario</strong> </div>
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<label for="userType">Tipo de usuario</label>
									<select required name="userType" id="userType" class="form-control">
										<option value="">Seleccione</option>
										<option <?=(isset($datos["userType"]) && $datos["userType"]=="1")?"selected='selected'":""?> value="1">Administrador</option>
										<option <?=(isset($datos["userType"]) && $datos["userType"]=="2")?"selected='selected'":""?> value="2">Master</option>
										<option <?=(isset($datos["userType"]) && $datos["userType"]=="3")?"selected='selected'":""?> value="3">Adquiriente</option>
										<option <?=(isset($datos["userType"]) && $datos["userType"]=="4")?"selected='selected'":""?> value="4">Comercio</option>
									</select>
								</div>
								<div class="clear"></div>
								<br />

								<?php
								$client = new socketHttp();
								$banks = json_decode( $client->socketGet('bank'), true );
								$bank = $banks["bank"];

								$response = json_decode( $client->socketGet('merchant'), true );
								foreach ($response["merchant"] as $key => $value) {
									//if ( $value["multi"] == false ) {
										$merchant[$key]["merchantGuid"] = $value["merchantGuid"];
										$merchant[$key]["fantasyName"] = $value["fantasyName"];
										$merchant[$key]["type"] = $value["multi"];
									//}
								}								

								if ( ( isset( $datos["userType"] ) ) && ( $datos["userType"]=="3" ) ) {
									
									$bankDisabled = "";
									$merchantDisabled = "disabled";

								} else if ( ( isset( $datos["userType"] ) ) && ( $datos["userType"]=="4" ) ) {
									
									$bankDisabled = "disabled";
									$merchantDisabled = "";

								} else {
									
									$bankDisabled = "disabled";
									$merchantDisabled = "disabled";

								}
								?>
								<div class="col-md-6">
									<label for="bankId">Seleccione el banco</label>
									<select required name="bankId" <?=$bankDisabled?> id="bankId" class="form-control">
										<option value="">Seleccione</option>
										<?php
										foreach ($bank as $key => $value) {
										?>
											<option <?=(isset($datos["associateId"]) && ((string)$datos["associateId"] == (string)$value["id"]))?"selected":""?> value="<?=$value["id"]?>"><?=$value["name"]?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="merchantGuid">Seleccione el comercio</label>
									<select required name="merchantGuid" <?=$merchantDisabled?> id="merchantGuid" class="form-control">
										<option value="">Seleccione</option>
										<?php
										foreach ($merchant as $key => $value) {
										?>
											<option  <?=(isset($datos["associateId"]) && ((string)$datos["associateId"] === (string)$value["merchantGuid"]))?"selected":""?> value="<?=$value["merchantGuid"]?>"><?=($value["type"] == false)?"(Merchant) ":"(Multimerchant) "?><?=$value["fantasyName"]?></option>
										<?php
										}
										?>
									</select>
								</div>
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
		

		