<?php
namespace validate;
//use GuzzleHttp\Psr7\Request;
class validate {

	public function validatePost( $fields ) {
		
		if ( is_array( $fields ) ) {

			foreach ($fields as $key => $value) {
				
				if ( empty( $value ) ) {

					return false;
					exit();

				}

				return true;

			}

		}

	}

}
