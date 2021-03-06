<?php
/**
 * @Author: jorge
 * @Date:   2017-04-04 21:12:37
 * @Last Modified by:   Jorge Peraza
 * @Last Modified time: 2017-04-05 22:18:14
 */

namespace ControllerApp;

use socketHttp\socketHttp;

class ControllerApp extends socketHttp{

	public $controller;
	public $c;
	public $action;
	public $parameter;
	public $render;
	private $_basePath;

	public function __construct() {

		parent::__construct();

		$this->controller = isset($_GET["controller"])?ucfirst($_GET["controller"]):"";
		$this->c = isset($_GET["controller"])?$_GET["controller"]:"";
		$this->action = isset($_GET["action"])?$_GET["action"]:"";
		$this->parameter = isset($_GET["parameter"])?$_GET["parameter"]:"";
		$this->render = true;
		$this->_basePath = "http://localhost/agencia/";

	}

	public function setRender( $render = true ) {

		$this->render = $render;

	}

	public function render() {

		if ( $this->render ) {

			if ( is_file("View/" . $this->controller . "/" . $this->action . ".php") ) {

				require_once "View/" . $this->controller . "/" . $this->action . ".php";

			} else {

				echo "La vista <b>" . $this->action . ".php</b> no existe!";

			}

		}

	}

	public function redirect( $path = null ) {

		if ( empty( $path ) ) {
			
			header("location: " . $this->_basePath . $this->c . "/index" );

		} else {

			header("location: " . $this->_basePath . $path );

		}

	}	

}