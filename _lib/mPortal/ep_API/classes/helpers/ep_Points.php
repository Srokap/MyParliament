<?php
class ep_Point{

	/**
	 * @var float
	 */
	private $x = 0.0;

	/**
	 * @var float
	 */
	private $y = 0.0;

	/**
	 * @param float $x
	 * @param float $y
	 * @return ep_Point
	 */
	static public function init( $x, $y){
		return new ep_Point( $x, $y );
	}
	
	/**
	 * @param float $x
	 * @param float $y
	 */
	public function __construct( $x, $y){
		$this->set_x( $x );
		$this->set_y( $y );
	}
	
	/**
	 * @return float
	 */
	public function get_x(){
		return $this->x;
	}

	/**
	 * @return float
	 */
	public function get_y(){
		return $this->y;
	}
	
	/**
	 * @param float $x
	 * @return ep_Point
	 */
	private function set_x( $x ){
		$this->x = (float) $x;
		return $this;
	}
	
	/**
	 * @param float $y
	 * @return ep_Point
	 */
	private function set_y( $y ){
		$this->y = (float) $y;
		return $this;
	}
}