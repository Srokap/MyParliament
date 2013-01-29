<?php

$auth_token = '';
$newpass = '';
$newpass_err = 'ok';
$pass = '';
$pass_err = 'ok';

if( isset( $_POST['save_pass'] ) ){
	$act_tab = 'password';
	
	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){
		header ("Location: /konto");
		die();
	} 
	

	if( !isset( $_POST['pass'] ) || $_POST['pass'] == '' ){
		$pass_err = 'required';
	} else {
		$login_hash = login_hash( $this->USER['email'], $_POST['pass'] );
		
		$user_id = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_users." WHERE is_deleted='0' AND login_hash='$login_hash'");
		
		if( !$user_id || $this->USER['id'] != $user_id ){
			$pass_err = 'invalid';
		}
	} 
		
	if( isset( $_POST['newpass'] ) && $_POST['newpass'] != '' ){
		if( strlen( $_POST['newpass'] ) < 6 ) {
			$newpass_err = 'invalid';
			$newpass = '';
		} else {
			$newpass = $_POST['newpass'];
		}
	} else {
		$newpass_err = 'required';
	}
	

	if( $newpass_err === 'ok' && $pass_err === 'ok' ){
		$login_hash = login_hash( $this->USER['email'], $newpass );
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET login_hash='$login_hash' WHERE id=".$this->USER['id'] );
		$_SESSION['mPortal']['msg'] = $act_tab;
		header ("Location: /konto");
		die();
	}
}


$this->SMARTY->assign( 'auth_token', $auth_token );
$this->SMARTY->assign( 'newpassword_err', $newpass_err );
$this->SMARTY->assign( 'password_err', $pass_err );

