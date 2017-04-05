<?php

class Functions {

	public function getDataList( $a, $id = null ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		if ( !empty( $id ) ) {
			
			$datas = $db->query("SELECT DATE_FORMAT(MAX(fecha), '%d-%m-%Y') fecha, SUM(venta) banca, SUM(abono) abono, SUM(comision) comision, SUM(venta) - SUM(abono) total FROM saldo WHERE fecha <= '" . $id . "'")->fetchAll();

			$datas2 = $db->query("SELECT DATE_FORMAT(fecha, '%d-%m-%Y') fecha_formateada, fecha, SUM(venta) banca, SUM(abono) abono, SUM(comision) comision, SUM(venta) - SUM(abono) total FROM saldo WHERE fecha <= '" . $id . "' GROUP BY fecha ORDER BY fecha DESC")->fetchAll();

		}

		$result["data"] = $datas;
		$result["data2"] = $datas2;
		
		if ( !empty( $result["data"] ) ) {
			
			$result["response"] = "ok";

		} else {
			
			$result["response"] = "no-data";

		}

		
		$resultJson = json_encode($result, JSON_PRETTY_PRINT);

		echo $resultJson;

	}

}