<?php

if( isset( $id[1] ) ){
	switch ($id[1]) {
	    
	    case 'object_field':
	    	if( $content == 'null' ){
		    	$content == '';
		    }
	        if( isset( $id[2] ) && isset( $id[3] ) ){
		    	$this->DB->q( "UPDATE api_datasets_fields SET opis='{$content}' WHERE base_alias = '{$id[2]}' AND alias = '{$id[2]}' AND field = '{$id[3]}' ");    
	        }
	        break;
	    
	    case 'object_method':
	    	return include ROOT. '/_services/admin_editable/inc/object_method.inc.php';
	        break;

	    case 'object_layer':
	    	return include ROOT. '/_services/admin_editable/inc/object_layer.inc.php';
	        break;
	}
}