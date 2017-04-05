<?php
/**
 * @Author: jorge
 * @Date:   2017-04-04 21:12:37
 * @Last Modified by:   jorge
 * @Last Modified time: 2017-04-05 00:19:11
 */
namespace Routes;

class Routes {

	public $controller;
	public $c;
	public $action;
	public $parameter;

	public function __construct() {

		$this->controller = isset($_GET["controller"])?ucfirst($_GET["controller"]):"";
		$this->c = isset($_GET["controller"])?$_GET["controller"]:"";
		$this->action = isset($_GET["action"])?$_GET["action"]:"";
		$this->parameter = isset($_GET["parameter"])?$_GET["parameter"]:"";

	}

	public function makeRoute() {

		if ( !empty( $this->controller ) ) {

			if ( is_file("Controller/controller" . $this->controller . ".php" ) ) {

				require_once "vendor/autoload.php";
				require_once "Controller/helpers/socketHttp.php";
				require_once "Controller/controllerApp.php";
				require_once "Controller/controller" . $this->controller . ".php";

				$obj = new $this->controller();
				
				if ( !empty( $this->action ) ) {

					if ( method_exists( $this->controller, $this->action ) ) {

						$method = $this->action;
					
						$obj->$method();
						
					} else {

						echo "El metodo <b>" . $this->action . "</b> no existe!";

					}

				}

				
				

			} else { 

				echo "El controlador <b>controller" . ucfirst($this->controller) . ".php</b> no existe!";

			}

		}

	}

}

$routes = new \Routes\Routes;
$routes->makeRoute();


?>