<?php
require 'core/autoloader.php';
use socketHttp\socketHttp;
use validate\validate;

if ( is_callable($_GET["f"] ) ) {
	$_GET["f"]();
}

function index() {

	$client = new socketHttp();
	$fecha = date("Y-m-d", strtotime($_GET["fecha"]));
	echo $client->socketGet('cuadre_cuentas/' . $fecha);

}

