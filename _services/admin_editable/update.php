<?php
//print_r( $_PARAMS );
//die();
$id = $_PARAMS['id'];
$content = $_PARAMS['content'];

$id = explode('/', $id );

if( isset( $id[0] ) ){
	switch ($id[0]) {
	    case 'api_docs':
	    	return include ROOT. '/_services/admin_editable/inc/api_docs.inc.php';
	    	break;
	    case 'dane':
	    	return include ROOT. '/_services/admin_editable/inc/dane.inc.php';
	    	break;
	}
}