<?php

list( $old_id, $new_id ) = $_PARAMS;
if( empty( $old_id ) || empty( $new_id ) ){
	return 0;
}

$this->S( 'mPortal/pages/delete', $new_id );
$this->S( 'mPortal/pages/rename', array( $old_id, $new_id ) );