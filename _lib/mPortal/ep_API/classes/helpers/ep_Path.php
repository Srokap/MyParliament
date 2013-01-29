<?php
class ep_Path{
	/**
	 * @var boolean
	 */
	private $mode = true;
	
	/**
	 * @var array ep_Points
	 */
	private $points = array();
	
	/**
	 * @param boolean $mode
	 * @return ep_Path
	 */
	static public function init( $mode = true){
		return new ep_Path( $mode );
	}

	/**
	 * @param boolean $mode
	 */
	public function __construct( $mode = true ){
		$this->set_mode( $mode );
	}
	
	/**
	 * @param ep_Point $point
	 * @return ep_Path
	 */
	public function add_point( ep_Point $point ){
		array_push( $this->points, $point );
		return $this;
	}
	
	/**
	 * @param array $points
	 * @return ep_Path
	 */
	public function set_points( $points ){
		$this->points = $points;
		return $this;
	}
	
	/**
	 * @return multitype: array ep_Point
	 */
	public function get_points(){
		return $this->points;
	}
	
	/**
	 * @param boolean $mode
	 * @return ep_Path
	 */
	public function set_mode( $mode ){
		$this->mode = (bool) $mode;
		return $this;
	}
	
	/**
	 * @return boolean
	 */
	public function get_mode(){
		return $this->mode;
	}
	
	/**
	 * Used to generate objects from ouer service
	 * @param array $val
	 * @return boolean|ep_Path
	 */
	public function set_raw_data( $val ){
		if( isset( $val['m'] ) ){
			$this->set_mode( $val['m'] );
		}
		if( isset( $val['p'] ) && is_array( $val['p'] ) ){
			foreach( $val['p'] as $p ){
				if( count($p) == 2 ){
					$this->add_point( new ep_Point( $p[0], $p[1] ) );
				}
			}
		} else {
			return false;
		}
		return $this;
	}
}