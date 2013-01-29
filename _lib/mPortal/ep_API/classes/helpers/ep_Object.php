<?php
abstract class ep_Object extends ep_Api {
	 
	public $id;
	public $data;
	private $loaded;
		 
	public function __construct( $data, $complex = true ){
		//echo get_class( $this ) . " create\n";
		//var_dump( $data );
		$id = false;
	  
		if( is_array( $data ) ) {
			$id = $data['id'];
			//unset( $data['id'] );
		} elseif( $data ) {
			$id = $data;
			//$id = (int) $data;
			unset( $data );
		}
	  
		if( !$id ){
			return false;
		}
		
		$this->id = $id;

		if( isset( $data ) ) {
			$this->loaded = $this->parse_data( $data );
		} else {
			if( $complex ){
				$this->load();
			} else {
				$this->loaded = true;
			}
		}
	}
	
	function load(){
		$this->load_from_db();
	} 
	 
	function load_from_db(){
		$data = $this->call( get_class($this) . '/info', array( 'id' => $this->id ) );

		if( $data ) {
			$this->parse_data( $data );
		} else {
			$this->loaded = false;	
		}
	}
	 
	function parse_data( $data ){
	
		$children = array();
		foreach( $data as $k => $v ){
			$o = strstr($k, '.');
			if( $o ){
				$o = str_replace( $o, '', $k);				
				$children[ $o ][ substr( strstr($k, '.'),1) ] =  $v ;
			} else {
				$this->data[ $k ] = $v;
			}	
		}
		
		//var_dump( $children );
		foreach( $children as $k => $v ){
			$method = 'set_ep_' . $k;
			//echo get_class( $this ) . " " .$method . "\n";
			if( method_exists( $this, $method ) ){
				call_user_func_array(array($this, $method), array($v));
			}
		}
		
		
		return true;
	}
	 
	function isloaded(){
		return (Boolean) $this->loaded;
	}
	 
}