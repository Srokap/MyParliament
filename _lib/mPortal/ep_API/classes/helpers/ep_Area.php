<?php
class ep_Area extends ep_Api{
	/**
	 * @var multitype: array ep_Paths
	 */
	private $paths = array();
	
	/**
	 * @return ep_Area
	 */
	static public function init(){
		return new ep_Area();
	}

	/**
	 * @param ep_Path $path
	 * @return ep_Area
	 */
	public function add_path( ep_Path $path ){
		array_push( $this->paths, $path );
		return $this;
	}
	
	/**
	 * @param array ep_Path $paths
	 * @return ep_Area
	 */
	public function set_path( $paths ){
		$this->paths = $paths;
		return $this;
	}
	
	/**
	 * @return multitype: array ep_Paths
	 */
	public function get_paths(){
		return $this->paths;
	}
	
	/**
	 * Used to generate objects from ouer service
	 * @param array $val
	 */
	public function set_raw_data( $val ){
		if( is_array( $val ) ){
			foreach( $val as $v ){
				$this->add_path( ep_Path::init()->set_raw_data( $v ) );
			}
		}
		return $this;
	}	
} 