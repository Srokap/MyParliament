<?php

if( isset( $id[1] ) ){
	switch ($id[1]) {
	    
	    case 'dataset':
	    	if( $content == 'null' ){
		    	$content == '';
		    }
	        if( isset( $id[2] ) ){
		    	$this->DB->q( "UPDATE api_datasets SET opis='{$content}' WHERE base_alias = '{$id[2]}'");    
	        }
	        break;

	}
}