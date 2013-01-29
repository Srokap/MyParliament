<?php

$auth_token = '';
$username = '';
$username_err = 'ok';
$pass = '';
$pass_err = 'ok';

// jesli zostal przeslany formularz
if( isset( $_POST['save_username'] ) ){
	$act_tab = 'username';
	
	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){

		header ("Location: /konto");
		die();

	} 
	// sprawdzanie poprawnoscie username
	if( isset( $_POST['username'] ) && $_POST['username'] != '' ){
		$_POST['username'] = trim( $_POST['username'] );
		if( preg_match('/^[a-zA-Z0-9_]{3,32}$/', $_POST['username'] ) ){
			$is_user = $this->DB->selectValue("SELECT id FROM m_users WHERE is_deleted='0' AND username='".$_POST['username']."'" );
			if( $is_user ){
				$username_err = 'exists';	
			}			
		} else {
			$username_err = 'invalid';
		}
		$username = htmlentities( $_POST['username'] );
		
	} else {
		$username_err = 'required';
	}
	

	// sprawdzanie hasla
	if(  !isset( $_POST['pass'] ) || $_POST['pass'] == '' ){
		$pass_err = 'required';
	} else {
		$login_hash = login_hash( $this->USER['email'], $_POST['pass'] );
		
		$user_id = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_users." WHERE is_deleted='0' AND login_hash='$login_hash'");
		
		if( !$user_id || $this->USER['id'] != $user_id ){
			$pass_err = 'invalid';
		} 
	}
	

	if( $username_err === 'ok' && $pass_err === 'ok' ){
		$this->USER['username'] = $username;
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET username='$username' WHERE id=".$this->USER['id'] );
		$_SESSION['mPortal']['msg'] = $act_tab;
		header ("Location: /konto");
		die();				
	}
}

$this->SMARTY->assign( 'username', $username );
$this->SMARTY->assign( 'username_err', $username_err );
$this->SMARTY->assign( 'username_pass_err', $pass_err );

