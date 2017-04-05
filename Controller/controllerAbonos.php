<?php
/**
 * @Author: jorge
 * @Date:   2017-04-04 21:12:37
 * @Last Modified by:   jorge
 * @Last Modified time: 2017-04-05 00:32:33
 */

use ControllerApp\ControllerApp;

class Abonos extends ControllerApp {

	public $data;

	public function __construct() {

		parent::__construct();

		$this->data = [];

	}

	public function index() {

		

	}

	public function listDataTable() {

		$this->setRender(false);

		echo $this->socketGet("abonos");

	}

	public function __destruct() {

		$this->render();

	}

}