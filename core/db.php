<?php
include 'medoo.php';
$production = false;
if ( $production ) {

	$db = new medoo([
	// required
		'database_type' => 'mysql',
		'database_name' => 'u140592665_cfweb',
		'server' => 'mysql.hostinger.es',
		'username' => 'u140592665_cfweb',
		'password' => 'SikagYSKP5tj',
		'charset' => 'utf8',
		'port' => 3306,
		'option' => [ PDO::ATTR_CASE => PDO::CASE_NATURAL]
	]);
	
} else {
	$db = new medoo([
	// required
		'database_type' => 'mysql',
		'database_name' => 'agencia',
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
		//'database_name' => 'webfz',
		//'server' => 'localhost',
		//'username' => 'webmzurita',
		//'password' => 'FSXrh&C?0PGh',
		'charset' => 'utf8',
		'port' => 3306,
		'option' => [ PDO::ATTR_CASE => PDO::CASE_NATURAL]
	]);
}
?>