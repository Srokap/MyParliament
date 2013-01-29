<?php
$auth_token = '';
$username = '';
$username_err = 'ok';
$pass = '';
$pass_err = 'ok';

// jesli zostal przeslany formularz
if( isset( $_POST['save_remove'] ) ){
	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){
		header ("Location: /konto");
		die();
	} 
	

	// sprawdzanie hasla
	if(  !isset( $_POST['pass'] ) || $_POST['pass'] == '' ){
		$pass_err = 'required';
	} else {
		$login_hash = login_hash( $this->USER['email'], $_POST['pass'] );
		
		$user_id = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_users." WHERE login_hash='$login_hash'");
		
		if( !$user_id || $this->USER['id'] != $user_id ){
			$pass_err = 'invalid';
		} 
	}
	

	if( $pass_err === 'ok' ){
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET is_deleted='1', deleted_ts=NOW() WHERE id=".$this->USER['id'] );
		$this->logout();
		header ("Location: /logout");
		die();				
	}

	$act_tab = 'remove';
}

$this->SMARTY->assign( 'username', $username );
$this->SMARTY->assign( 'username_err', $username_err );
$this->SMARTY->assign( 'pass_err', $pass_err );

