<?
  // echo 'SERVICE SERVER'; die();
  require_once( $_SERVER['DOCUMENT_ROOT'].'/_constructors/REQUEST.php' );
  
  
    
  $_ACTION = $_REQUEST['_PAGE'];
  $_PARAMS = $_REQUEST;
  
  
  

  
  /*
  if( !file_exists( ROOT.'/_serivces/api/'.$_ACTION.'.php' ) ) {
  
		if( $M->DB->selectCountBoolean("SELECT COUNT(*) FROM poslowie WHERE id='$_ACTION'") ) {
		  $_ACTION = 'posel';
		  $_PARAMS['_ID'] = $_ACTION;
		} elseif( $M->DB->selectCountBoolean("SELECT COUNT(*) FROM ludzie WHERE id='$_ACTION'") ) {
		  $_ACTION = 'mowca';
		  $_PARAMS['_ID'] = $_ACTION;
		} elseif( $typ = $M->DB->selectValue("SELECT typ FROM druki_autorzy WHERE id='$_ACTION'") ) {
		  $_ACTION = $typ;
		  $_PARAMS['_ID'] = $_ACTION;
		}
	
	}
	*/
	    
  if( empty($_ACTION) ) die();
  
  
  
  
  $service = $_ACTION;
  if( !empty($_REQUEST['_TAB_ID']) ) $service .= '/'.$_REQUEST['_TAB_ID'];
  $_ID = (int) $_REQUEST['_ID'];
  

  
    
  
  $M->DB->insert_assoc('api_log', array(
    'action' => $service,
    'ip' => $_SERVER['REMOTE_ADDR'],
  ));
  $result = @include($_SERVER['DOCUMENT_ROOT'].'/_api_legacy/'.$service.'.php');
  
    
  

  
  echo( json_encode($result) ); die();
?>