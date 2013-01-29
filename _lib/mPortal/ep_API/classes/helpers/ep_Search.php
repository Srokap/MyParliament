<?php
abstract class ep_Search extends ep_Api {
	protected $_init_wheres = array();
	protected $_runtime_wheres = array();
	protected $_result = array();
	protected $_order = null;
	protected $_direction = null;
	protected $_limit = null;
	protected $_offset = null;

	public function where( $key, $operator, $value ){
		$this->add_runtime_wheres( array( $this->singular .'.'. $key, $operator, $value ) );
		return $this;		
	}
	
	public function find_all( $limit = null, $offset = null ){
		$this->_limit = $limit;
		$this->_offset = $offset;		
		$this->_result = $this->call( get_class($this).'/search', $this->get_params() );
		$this->clear();
		return $this->return_objects();
	}
	
	public function find_one(){
		return $this->find_all( 1,0 );		
	}

	public function find(){
		return $this->find_one();
	}
	
	public function order( $column, $direction = 'asc' ){
		$this->_order = $column;
		$this->_direction = $direction;
	}
		
	public function get_params(){
		return array(
			'l'  => $this->_limit,
			'o' => $this->_offset,
			'w' => array_merge( $this->_init_wheres, $this->_runtime_wheres ),
			'rt'  => $this->_order,
			'rd'  => $this->_direction,
		);
	}
	
	protected function return_objects(){
		$ret_arr = array();
		$object_name = 'ep_' . ucfirst( $this->singular );
		if( $this->_result ){
			foreach( $this->_result as $r ){
				$ret_arr[] = new $object_name( $r, false );
			}
			return $ret_arr;
		} else {
			return array();	
		}
	}
	
	
	protected function clear(){
		$this->_runtime_wheres = array();
		$this->_order = array();
	}
	
	public function get_runtime_wheres(){
		return $this->_runtime_wheres;
	}

	public function set_runtime_wheres( $val ){
		$this->_runtime_wheres = $val;
		return $this;
	}

	public function add_runtime_wheres( $val ){
		$this->_runtime_wheres[] = $val;
		return $this;
	}


	public function get_init_wheres(){
		return $this->_init_wheres;
	}

	public function set_init_wheres( $val ){
		$this->_init_wheres = $val;
		return $this;
	}

	public function add_init_wheres( $val ){
		$this->_init_wheres[] = $val;
		return $this;
	}

	/**
	 * @param ep_Search $obj
	 */
	public function append_init_wheres_from_obj( $obj ){
		$wheres = array_merge( $obj->get_init_wheres(), $obj->get_runtime_wheres() );
		foreach( $wheres as $w ){
			if( isset( $w[0] ) ){
				$w[0] = $this->singular . '.' .$w[0];
			}
			$this->add_init_wheres( $w );
		}
		$obj->clear();
	}
}