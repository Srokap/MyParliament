<?php
if( isset( $id[2] ) ){
	switch ($id[2]) {
		
		case 'add':
			$ret_arr = array();
			foreach( $content as $k => $v ){
				$v = array_map( 'trim', $v );
				$v = array_map( 'addslashes', $v );
				$value = $this->DB->selectValue( "SELECT `class` FROM api_docs_object_layers WHERE `class` = '{$id[3]}' AND layer='{$v[0]}'" );
				
				if( $v[1] == 'null' ){
		    		$v[1] == '';
		    	}
		    
				if( $v[0] != '' && !$value ){
					$this->DB->q( "INSERT INTO `api_docs_object_layers`(`class`, `layer`, `opis`) VALUES ( '{$id[3]}', '{$v[0]}', '{$v[1]}')" );
					$ret_arr[$k][0] = true;
					$ret_arr[$k][1] = 'class="_admin_editable" _admin_editable_id="api_docs/object_layer/update/'.$id[3].'/'.$v[0].'"' ;
				} else {
					$ret_arr[$k][0] = false;
					$ret_arr[$k][1] = true;
				}
			}
			return $ret_arr;
			break;
		
		case 'update':
			if( isset( $id[3] ) && isset( $id[4] ) ){
		    	$this->DB->q( "UPDATE api_docs_object_layers SET opis='{$content}' WHERE `class` = '{$id[3]}' AND `layer` = '{$id[4]}' ");    
	        }
	        return 'OK';
			break;
	}
}