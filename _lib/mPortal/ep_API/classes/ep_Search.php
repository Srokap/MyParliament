<?
  class ep_Search extends ep_Api {
	
	  public $q;
	  public $qs;
	  public $order;
	  public $items;
	  public $tabs;
	  public $limit;
	  public $items_found_rows;
	  public $dataset;
	  public $performance;
	  
	  public function set_q( $q ) {
		  
		  $this->q = trim( $q );
		  return $this;
		  
	  }
	  
	  public function set_qs( $qs ) {
		  
		  $this->qs = is_array( $qs ) ? $qs : array();
		  return $this;
		  
	  }
	  
	  public function set_dataset( $dataset ) {
		  
		  $this->dataset = trim( $dataset );
		  return $this;
		  
	  }
	  
	  public function set_order( $order ){
		  $this->order = $order;
	  }
	  
	  public function find_all($limit, $offset){
		  
		  $this->limit = 20;
		  if( $offset )
			  $this->offset = $offset;
		  
		  $params = array(
		    'q' => $this->q,
		    'qs' => $this->qs,
		    'l' => $this->limit,
				'of' => $this->offset,
		    'order' => $this->order,
		  );
		  
		  if( $this->dataset )
		    $params['d'] = $this->dataset;
		  
		  $data = $this->call( 'search', $params );
		  
		  
		  /*
		  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
	  
			  echo "\n\n";
			  var_export( $data );
			  die();
			  
			}
			*/
		  
		  $this->items = array();
		  $this->tabs = $data['tabs'];
		  $this->limit = $data['limit'];
		  $this->items_found_rows = $data['items_found_rows'];
		  $this->performance = $data['performance'];
		  
		  foreach( $data['items'] as $i ) {
			  
			  $class = $i['class'];
			  $object_id = $i['object_id'];
			  $o = new $class( $object_id, false );
			  $o->data = json_decode( $i['data'], true );
			  $o->layers['hl'] = $i['hl'];
			  
			  $this->items[] = $o;
			  
		  }
		  		  		  
		  return $this->items;
		  
	  }
	
	}
?>