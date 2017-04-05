<?php

class Functions {

	public function getDataList( $a, $id = null ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		if ( !empty( $id ) ) {

			$datas = $db->get($a, "*", ["id" => $id]);	

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

	public function saveData( $a ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		$obj = json_decode( file_get_contents('php://input') );  
        $objArr = (array)$obj;
		$datas = $db->insert($a, ["idCliente" => $obj->idCliente, "descripcion" => $obj->descripcion, "fecha" => $obj->fecha, "monto" => $obj->monto]);	

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
		$datas = $db->update($a,["idCliente" => $obj->idCliente, "descripcion" => $obj->descripcion, "fecha" => $obj->fecha, "monto" => $obj->monto], ["id" => $id]);	

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