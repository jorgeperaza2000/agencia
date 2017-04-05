<?php

class Functions {

	public function getDataList( $a, $id = null ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		if ( !empty( $id ) ) {

			$datas = $db->select("deudas", 
								["[>]clientes" => ["idCliente" => "id"]], 
								["deudas.id", "deudas.idCliente", "deudas.fecha", "deudas.monto", "deudas.descripcion", "clientes.nombre"], 
								["idCliente" => $id]
								);	

		} else {

			$datas = $db->select($a, "*");

		}

		$result["data"] = $datas;
		
		if ( !empty( $result["data"] ) ) {
			
			$result["response"] = "ok";

		} else {
			
			$result["response"] = "no-data";

		}

		$resultJson = json_encode($result, JSON_PRETTY_PRINT);

		echo $resultJson;

	}

	
}