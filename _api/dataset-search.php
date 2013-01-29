<?
  require_once('engine.php');
  

  $params = $_REQUEST;
  if( $_PARAMS )
    $params = array_merge( $_REQUEST, $_PARAMS );




	  
  if( $params['name']=='legislacja_projekty_ustaw' ) {
	  
	  $_id = (int) $params['_ID'];
		  $_typ_id = (int) $_SERVER['M']->DB->selectValue("SELECT typ_id FROM s_projekty WHERE id='$_id'");
		  if( $_typ_id==2 )
		    $params['name'] = 'legislacja_projekty_uchwal';
	  
  }
  
  

  $result = epapi_build_query( $params );
  
  
  
  
	
	
	
			  
  /*
  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
	  
	  echo( "\n\n\n".$result['query'] );
	  
  }
  */			  
			  
			  

  $dataset = $result['dataset'];
  $browse_mode = $dataset['browse_mode'];
  // echo "\n".$result['query']."\n";
  
  
  
  /*
  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
	  
	  echo( "\n\n\n".$result['query'] );
	  
  }
  */
  

  $performance = array();
  
  $_start = microtime_float();
  
  /*
  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
	  
	  echo "\n\n";
	  var_export( $result );
	  die();
	  
	}
	*/
  
  
  $items = $_SERVER['M']->DB->selectAssocs( $result['query'] );
  $_stop = microtime_float();
  $performance['data_query'] = $_stop - $_start;
  $__start = $_start;
  
  
  $items_found_rows = $_SERVER['M']->DB->found_rows();
  
  /*
  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
	  
	  echo "\n\n";
	  var_export( $items );
	  
  }
  */
  
  
  if( $dataset['browse_mode']=='DBF' ) {

    $_start = microtime_float();
    
    foreach( $items as &$item )
      $item = @file_get_contents( '/home/www/s/_api/data/'.$dataset['base_alias'].'/'. $item[ $dataset['base_alias'].'.id' ] .'.json' );  
    
    $_stop = microtime_float();
    $performance['opening_files'] = $_stop - $_start;
    
  }
  
  
  $performance['total'] = $_stop - $__start;
  
  /*
  if( $_SERVER['REMOTE_ADDR']=='80.72.34.251' ) {
	  
	  echo( "\n\n\n".$result['query'] );
	  
  }
  */
  
  
  return array(
    // 'query' =>  $result['query'],
    'items_class' => $dataset['results_class'],
    'items' => $items,
    'items_found_rows' => $items_found_rows,
    'limit' => $result['limit'],
    'order' => $result['order'],
    'performance' => $performance,
    'mode' => $dataset['browse_mode'],
  );