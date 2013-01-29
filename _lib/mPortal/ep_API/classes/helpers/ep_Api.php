<?
class ep_Api {

	private $_version = '0.1';
	private $_protocol = 'http';
	private $_hostname = '46.105.101.132:8081';
	private $_api_server = '/api';
	private $_secret = 'alskndoasndabnsd';
	private $_key = 'somekey';
	private $http_code = '';

	private $_context = array(
			'http' => array(
					'method'=> 'GET',
					'user_agent' => 'EPAPI PHP Official Client v0.1',
					'timeout' => 60,
			)
	);

	/**
	 * @return ep_Api
	 */
	static public function init(){
		return new ep_Api();
	}
	
	public function call( $api, $params ){
		$api = trim( $api );
		if( !$api ){
			return false;
		}

		try {			
			$params[ 'sign' ] = $this->generate_sig( $params );
			$params[ 'key' ] = $this->_key;
			
			//echo "\n";
			$request_url = $this->_protocol . '://' . $this->_hostname . $this->_api_server . '/' . $api;
			echo $request_url.'?'.http_build_query( $params )."\n";

			//print_r( $params );
			$data = '';			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $request_url );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1 );
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
			$data = curl_exec( $ch );
			$this->http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			return json_decode( $data, true );
		} catch( Exception $e ) {

		}
	}
	
	/**
	 * @param array $params
	 * @return string
	 */
	private function generate_sig( $params ){	
		$str = json_encode( $params );
		$str .= $this->_secret;
	
		return md5( $str );		 
	}
}