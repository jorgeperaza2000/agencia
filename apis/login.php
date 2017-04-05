<?php

$identificadorValido = ["manu13" => "Marquiel", "manuelin" => "Jorge", "dragon" => "Josangel"];

$identificadorEnviado = $_GET['txtIdentificador'];

$resultados = array();
$resultados["hora"] = date("F j, Y, g:i a"); 
$resultados["generador"] = "Enviado desde codefull.com.ve" ;

if ( array_key_exists( $identificadorEnviado, $identificadorValido ) ) {

	$resultados["mensaje"] = "Identificacion Correcta";
	$resultados["usuario"] = $identificadorValido[$identificadorEnviado];
	$resultados["validacion"] = "ok";

} else {

	$resultados["mensaje"] = "Identificacion incorrecta";
	$resultados["validacion"] = "error";

}

$resultadosJson = json_encode($resultados);

echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
?>