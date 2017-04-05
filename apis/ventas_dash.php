<?php

class Functions {

	public function getDataList( $a, $id = null ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		$datas = $db->query("SELECT SUM(venta) venta FROM ventas_diarias WHERE fecha = CURDATE() - 1")->fetchAll();

		$result["data"] = $datas[0];
		
		if ( !empty( $result["data"] ) ) {
			
			$result["response"] = "ok";

		} else {
			
			$result["response"] = "no-data";

		}

		$resultJson = json_encode($result, JSON_PRETTY_PRINT);

		echo $resultJson;

	}

}