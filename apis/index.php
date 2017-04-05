<?php
require_once $_GET["a"] . ".php";
$api = new API();
$api->apiFunctions();

class API {

	public function apiFunctions(){

	    //header('Content-Type: application/JSON');

	    $method = $_SERVER['REQUEST_METHOD'];
	    $a = $_GET["a"];
		$id = isset($_GET["id"])?$_GET["id"]:null;
		$func = new Functions();

	    switch ( $method ) {
		    case 'GET'://consulta

		    	$func->getDataList( $a, $id );
		        break;   

		    case 'POST'://inserta

		        $func->saveData( $a );
		        break;     

		    case 'PUT'://actualiza
		        
		        $func->updateData( $a, $id );
		        break;      
		    case 'DELETE'://elimina
		        $func->deleteData( $a, $id );
		        break;
		        break;
		    default://metodo NO soportado
		        echo 'METODO NO SOPORTADO';
		        break;
	    }
	}


	
}
?>