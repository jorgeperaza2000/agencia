<?php
session_start();
require_once 'core/autoloader.php';
require 'header.php';

use socketHttp\socketHttp;

$client = new socketHttp();
$cuentas_cobrar = json_decode( $client->socketGet('clientes_dash'), true );
$dataprefix1 = "";
if ( $cuentas_cobrar["data"] < 0 ) {
	$dataprefix1 = "-";
	$cuentas_cobrar["data"] = $cuentas_cobrar["data"] * (-1);
}

$ventas = json_decode( $client->socketGet('ventas_dash'), true );
$dataprefix2 = "";
if ( $ventas["data"]["venta"] < 0 ) {
	$dataprefix2 = "-";
	$ventas["data"]["venta"] = $ventas["data"]["venta"] * (-1);
}

$cuentas = json_decode( $client->socketGet('cuentas_dash'), true );
$dataprefix3 = "";
if ( $cuentas["data"]["total"] < 0 ) {
	$dataprefix3 = "-";
	$cuentas["data"]["total"] = $cuentas["data"]["total"] * (-1);
}

$abonos = json_decode( $client->socketGet('abonos_dash'), true );
$dataprefix4 = "";
if ( $abonos["data"]["abono"] < 0 ) {
	$dataprefix4 = "-";
	$abonos["data"]["abono"] = $abonos["data"]["abono"] * (-1);
}
?>

<div class="row">
	<div class="col-sm-3 col-xs-6">

		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end="<?=$cuentas_cobrar["data"]?>" data-prefix="<?=$dataprefix1?>" data-duration="1000" data-delay="0">0</div>

			<h3>Cuentas por Cobrar</h3>
			<!--<h3 class="dashboard"><a href="#">Ver detalles</a></h3>-->
		</div>

	</div>

	<div class="col-sm-3 col-xs-6">

		<div class="tile-stats tile-cyan">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="<?=$ventas["data"]["venta"]?>" data-prefix="<?=$dataprefix2?>" data-duration="1000" data-delay="1000">0</div>

			<h3>Venta Día Anterior</h3>
			<!--<h3 class="dashboard"><a href="#">Ver detalles</a></h3>-->
		</div>

	</div>

	<div class="col-sm-3 col-xs-6">

		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="<?=$cuentas["data"]["total"]?>" data-prefix="<?=$dataprefix3?>" data-duration="1000" data-delay="2000">0</div>

			<h3>Mis Cuentas</h3>
			<!--<h3 class="dashboard"><a href="#">Ver detalles</a></h3>-->
		</div>

	</div>

	<div class="col-sm-3 col-xs-6">

		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-mail"></i></div>
			<div class="num" data-start="0" data-end="<?=$abonos["data"]["abono"]?>" data-prefix="<?=$dataprefix4?>" data-duration="1000" data-delay="3000">0</div>

			<h3>Ultimo Abono</h3>
			<!--<h3 class="dashboard"><a href="#">Ver detalles</a></h3>-->
		</div>

	</div>

</div>

<br />

<?php

require 'footer.php';
		