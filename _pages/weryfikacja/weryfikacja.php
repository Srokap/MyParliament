<?php

$msg = 'error';

if( isset( $_GET['key'] ) && $_GET['key'] != '' ){
	$user_id = $this->DB->selectValue( "SELECT id FROM ".DB_TABLE_users." WHERE is_deleted='0' AND email_pass='".addslashes( $_GET['key'])."'");
	
	if( $user_id ){
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='3' WHERE id=".$user_id );
		$msg = 'ok';
	}
}

$this->SMARTY->assign( 'msg', $msg );