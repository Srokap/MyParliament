<?php
// LIMIT QUERING API
$MAX_REQUEST = 3000;

$allowed_requests = array(
	'dataset-search',
	'dataset-count',
	'dataset-filter',
	'load-layer',
	'search',
);

$_API_REQUEST = $_REQUEST['_API_REQUEST'];
unset( $_REQUEST['_API_REQUEST'] );
if( !in_array( $_API_REQUEST, $allowed_requests ) ){
	die( "Error no.425" );
} 

$key = addslashes( $_REQUEST['key'] );
unset( $_REQUEST['key'] );

$sign_from_request = $_REQUEST['sign'];
unset( $_REQUEST['sign'] );

if( !$sign_from_request || !$key ){
	header( 'HTTP/1.1 401 Unauthorized' );
	die();		
}

require_once( $_SERVER['DOCUMENT_ROOT'].'/_constructors/REQUEST.php' );

// RETRIEVING DATA FROM DB USING API KEY STRING
$record = $_SERVER['M']->DB->selectAssoc( "SELECT id, api_secret, api_count, api_total_count FROM m_users WHERE api_key ='$key'" );

if( !$record ){
	header( 'HTTP/1.1 401 Unauthorized' );
	die();		
}

$id                = $record['id']; 
$_secret           = $record['api_secret']; 
$api_count         = $record['api_count'];
$api_total_count   = $record['api_total_count'];
unset( $record );
 
if( $api_count >= $MAX_REQUEST ){
	header( 'HTTP/1.1 402 Limit exceed' );
	die();		
}

// CHECKING SIGN FROM REQUEST
array_walk_recursive( $_REQUEST, function( &$v ){ settype($v, 'string'); } );
$sign = md5( json_encode(  $_REQUEST ) . $_secret );
if( $sign != $sign_from_request ){
	die( "Error no.356" );
} 

// INCREMENTING COUNTER API
$_SERVER['M']->DB->q( "UPDATE m_users SET api_count=api_count+1, api_total_count=api_total_count+1 WHERE id={$id}" );



// SENDING REQUEST TO API
header('Content-type: application/json');
echo( json_encode($M->ep_api_call($_API_REQUEST, $_REQUEST ? $_REQUEST : null)) );

