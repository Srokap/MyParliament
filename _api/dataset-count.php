<?
  require_once('engine.php');
  

  $params = $_REQUEST;
  if( $_PARAMS )
    $params = array_merge( $_REQUEST, $_PARAMS );



  $result = epapi_build_count_query( $params );
  $query = $result['query'];
  $count = (int) $_SERVER['M']->DB->selectValue( $query );
  
  
  
  return array(
    'base_alias' => $params['name'],
    'count' => $count,
  );