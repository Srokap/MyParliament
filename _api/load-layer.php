<?
  $object = trim( $_PARAMS['object'] );
  $id = (int) $_PARAMS['id'];
  $layer = trim( $_PARAMS['layer'] );
  $params = $_PARAMS['params'];
  
  
  if( !function_exists('bdl_url_id') ) {
	  function bdl_url_id( $temp_p_wym ){
	    $output = array();
	    
	    $insert = false;
	    for( $i=5; $i>1; $i-- ) {
	      if( $temp_p_wym[$i] ) $insert = true;
	      if( $insert ) $output[] = $temp_p_wym[$i];
	    }
	    $output = array_reverse( $output );
	    
	    return implode(',', $output);
	  }
  }
  
  
  
  if( !$id ) return false;
  
  switch( $object ) {
	  
	  
  }
  
  return array(
    'object' => $object,
    'id' => $id,
    'layer' => $layer,
    'data' => $data,
  );