<?php

$config = array('siteName'=> 'Agencia');


//Creamos el JSON
$json_string = json_encode($config);
$file = 'config.json';
file_put_contents($file, $json_string);

?>