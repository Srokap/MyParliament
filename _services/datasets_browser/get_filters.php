<?
  $base_alias = $_PARAMS['base_alias'];
  $params = $_PARAMS['params'];
  $fields = $_PARAMS['fields'];
  
  if( !$base_alias )
    return false;
    
  $request = array();
  if( !empty($params) )
    foreach( $params as $key => $value ) {
	    
	    if( endsWith($key, '[]') ) {
		    $key = substr($key, 0, strlen($key)-2);
		    $request[ $key ][] = $value;
	    } else $request[ $key ] = $value;
	    
    }
    
  
  
  
  
  require_once( '/home/www/epanstwo/_api/engine.php' );
  $filters = array();
  $dataset = new ep_Dataset( $base_alias );
  $dataset->get_info();
  
  
  
  for( $i=0; $i<count($fields); $i++ ) {
	  
	  $field = $fields[ $i ];
	  $filters[ $field ] = epapi_dataset_filter( $dataset, $request, $field );
	  
  }
  
  // var_export( $filters ); die();
  
  return array(
    'filters' => $filters,
  );
?>