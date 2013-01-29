<?php
require_once( $_SERVER['DOCUMENT_ROOT'].'/_constructors/REQUEST.php' );
 
$_SERVICE = $_REQUEST['_SERVICE'];
$_PARAMS = $_REQUEST['_PARAMS'];

if( empty($_SERVICE) ) {
	die();
}
echo( json_encode($M->S($_SERVICE, $_PARAMS ? params_decode($_PARAMS) : null)) );