<?php
require_once( '../_lib/mPortal/config.php' );
require_once( ROOT.'/_constructors/REQUEST.php' );
 
$_SERVICE = isset( $_REQUEST['_SERVICE'] ) ? $_REQUEST['_SERVICE'] : null;
$_PARAMS = isset( $_REQUEST['_PARAMS'] ) ? $_REQUEST['_PARAMS'] : null;
$M->ID = isset( $_REQUEST['_PID'] ) ? $_REQUEST['_PID'] : null;

if( empty( $_SERVICE ) ) {
	die();
}

echo( json_encode( $M->S( $_SERVICE, $_PARAMS ? json_decode( $_PARAMS, true) : null ) ) );
