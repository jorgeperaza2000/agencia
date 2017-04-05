<?php
/**
 * @Author: jorge
 * @Date:   2017-04-04 22:10:49
 * @Last Modified by:   Jorge Peraza
 * @Last Modified time: 2017-04-05 01:02:45
 */
namespace socketHttp;

class socketHttp {

	private $_production;
	private $_urlBase;

	public function __construct() {
		
		$this->_production = false;

		if ( $this->_production == true ) {
		
			$this->_urlBase = "http://p.codefull.com.ve/agencia/apis/";
		
		} else {
		
			$this->_urlBase = "http://localhost/agencia/apis/";	
		
		}

	}
	
	public function socketGet( $url = null ){


		$url = $this->_urlBase . $url;
		$client = new \GuzzleHttp\Client();
		$request = $client->request('GET', $url, [
		    'headers' => [
		        'Accept'     => 'application/json',

		    ]
		]);
		return $request->getBody();	

	}

	public function socketPost( $url = null, $body = null ){

		$url = $this->_urlBase . $url;
		$client = new \GuzzleHttp\Client();
		$request = $client->request('POST', $url, [
												    'headers' => [
															        'Accept'     => 'application/json',
															        'Content-Type' => 'application/json',
															  	],
													'body' => $body
												  ]
								  );
		return $request->getBody();	

	}

	public function socketPut( $url = null, $body = null ){

		$url = $this->_urlBase . $url;
		$client = new \GuzzleHttp\Client();
		$request = $client->request('PUT', $url, [
												    'headers' => [
															        'Accept'     => 'application/json',
															        'Content-Type' => 'application/json',
															  	],
													'body' => $body
												  ]
								  );
		return $request->getBody();	

	}

	public function socketDelete( $url = null, $body = null ){

		$url = $this->_urlBase . $url;
		$client = new \GuzzleHttp\Client();
		$request = $client->request('DELETE', $url, [
												    'headers' => [
															        'Accept'     => 'application/json',
															        'Content-Type' => 'application/json',
															  	],
													'body' => $body
												  ]
								  );
		return $request->getBody();	

	}
	
	

}