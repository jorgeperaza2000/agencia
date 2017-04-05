<?php

class Functions {

	public function getDataList( $a, $id = null ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		if ( !empty( $id ) ) {
			
			$datas = $db->select($a,
								  ["[>]programas" => ["idPrograma" => "id"]], 
								  [
								  	"ventas_diarias.id",
								  	"ventas_diarias.idPrograma",
								  	"ventas_diarias.venta",
								  	"ventas_diarias.premios",
								  	"ventas_diarias.porcentaje_actual",
								  	"ventas_diarias.comision",
								  	"ventas_diarias.banca",
								  	"ventas_diarias.fecha",
								  	"programas.nombre",
								  ], 
								  ["OR" => ["ventas_diarias.id" => $id, "fecha" => $id]]
								);

		} else {

			$datas = $db->select($a, "*");

		}

		if ( isset( $datas[1] ) ) {
			$result["data"] = $datas;	
		} else {
			if ( isset( $datas[1] ) ) {
				$result["data"][] = $datas[0];
			} else {
				$result["data"] = $datas;
			}
		}
		
		
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

		$objArr = json_decode( file_get_contents('php://input') );  
        
        foreach ($objArr as $obj) {
			
			$datas = $db->insert($a, [
										"idPrograma" => $obj->idPrograma, 
										"venta" => $obj->venta, 
										"premios" => $obj->premios, 
										"porcentaje_actual" => $obj->porcentaje, 
										"fecha" => date("Y-m-d", strtotime($obj->fecha))
									 ]);

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

	public function updateData( $a, $id = null  ) {

		require '../core/db.php';

		$result = array();

		extract($_GET);

		$obj = json_decode( file_get_contents('php://input') );  
        $objArr = (array)$obj;
		$datas = $db->update($a, [
									"venta" => $obj->venta, 
									"premios" => $obj->premios, 
									"porcentaje_actual" => $obj->porcentaje, 
									"fecha" => date("Y-m-d", strtotime($obj->fecha))], 
								[
								"id" => $id
								]);	

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