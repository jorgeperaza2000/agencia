<?php

class Functions {

	public function getDataList( $a, $id = null ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		if ( !empty( $id ) ) {

			$datas = $db->query("SELECT DATE_FORMAT(fecha, '%d-%m-%Y') fecha, abono, id FROM abonos WHERE id = " . $id)->fetchAll();

		} else {

			$datas = $db->query("SELECT DATE_FORMAT(fecha, '%d-%m-%Y') fecha, abono, id FROM abonos")->fetchAll();

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

	public function saveData( $a ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		$obj = json_decode( file_get_contents('php://input') );  
        $objArr = (array)$obj;
		$datas = $db->insert($a, ["fecha" => $obj->fecha, "abono" => $obj->abono]);	

		$result["data"] = $datas;
		
		if ( !empty( $result["data"] ) ) {
			
			$result["response"] = "ok";

		} else {
			
			$result["response"] = "no-data";

		}

		$resultJson = json_encode($result, JSON_PRETTY_PRINT);

		echo $resultJson;

	}

	public function updateData( $a, $id = null  ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		$obj = json_decode( file_get_contents('php://input') );  
        $objArr = (array)$obj;
		$datas = $db->update($a, ["fecha" => $obj->fecha, "abono" => $obj->abono], ["id" => $id]);	

		$datas = $db->error();
		$result["data"] = $datas;
		
		if ( $result["data"][0] == 0 ) {
			
			$result["response"] = "ok";

		} else {
			
			$result["response"] = "no-data";

		}

		$resultJson = json_encode($result, JSON_PRETTY_PRINT);

		echo $resultJson;

	}

	public function deleteData( $a, $id = null  ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		$datas = $db->delete($a, ["id" => $id]);	

		$datas = $db->error();
		$result["data"] = $datas;
		
		if ( $result["data"][0] == 0 ) {
			
			$result["response"] = "ok";

		} else {
			
			$result["response"] = "no-data";

		}

		$resultJson = json_encode($result, JSON_PRETTY_PRINT);

		echo $resultJson;

	}
}