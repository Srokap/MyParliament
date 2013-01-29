<?
 class ep_Api {
	
		private $_version = '0.1';
		private $_protocol = 'http';
		private $_hostname = 'epanstwo.net';
		private $_api_server = '/api';
		private $_secret = 'WILDCARD';
		private $_key = 'WILDCARD';
		private $http_code = '';
	  
	
		/**
		 * @return ep_Api
		 */
		static public function init(){
			return new ep_Api();
		}
		
		public function call( $api, $params ){
		  return $_SERVER['M']->ep_api_call($api, $params);
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
?>