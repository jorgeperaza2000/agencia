<?php
/**
 * @Author: jorge
 * @Date:   2017-04-04 21:12:37
 * @Last Modified by:   Jorge Peraza
 * @Last Modified time: 2017-04-05 01:10:55
 */

use ControllerApp\ControllerApp;

class Clientes extends ControllerApp {

	public $data;

	public function __construct() {

		parent::__construct();

		$this->data = [];

	}

	public function index() {

		

	}

	public function listDataTable() {

		$this->setRender(false);

		echo $this->socketGet("clientes");

	}

	public function delete( $id ) {

		$this->setRender(false);

		$response = json_decode( $this->socketDelete("clientes/" . $id ), true );

	}

	public function __destruct() {

		$this->render();

	}

}