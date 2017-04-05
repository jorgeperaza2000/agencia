<?php
/**
 * @Author: jorge
 * @Date:   2017-04-04 21:12:37
 * @Last Modified by:   jorge
 * @Last Modified time: 2017-04-05 00:34:10
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

	public function __destruct() {

		$this->render();

	}

}