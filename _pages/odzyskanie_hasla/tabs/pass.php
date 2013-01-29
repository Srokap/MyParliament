<?php
$auth_token = '';
$pass = '';
$pass_err = 'ok';
$user_id = null;

if( !isset( $_GET['key'] ) && $_GET['key'] != '' ){
	header ("Location: /odzyskanie_hasla");
	die();
}

$user_id = $this->DB->selectValue( "SELECT id FROM " . DB_TABLE_users . " WHERE is_deleted='0' AND pass_recover='" . addslashes( $_GET['key'] ) . "'" );
if( !$user_id ){
	header ("Location: /odzyskanie_hasla");
	die();
}

// jesli zostal przeslany formularz
if( isset( $_POST['save'] ) ){

	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){
		header ("Location: /rejestracja");
		die();
	}
	
	
	// sprawdzanie hasla
	if( isset( $_POST['pass'] ) && $_POST['pass'] != '' ){
		if( strlen( $_POST['pass'] ) < 6 ) {
			$pass_err = 'invalid';
			$pass = '';
		} else {
			$pass = $_POST['pass'];
		}
	} else {
		$pass_err = 'required';
	}
	
	// register
	if( $pass_err === 'ok' ){
		$email =  $this->DB->selectValue( "SELECT email FROM " . DB_TABLE_users . " WHERE is_deleted='0' AND pass_recover='" . addslashes( $_GET['key'] ) . "'" );

		$login_hash = login_hash( $email, $pass );
		
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET login_hash='".$login_hash."', pass_recover='' WHERE is_deleted='0' AND id=".$user_id );

		header ("Location: /odzyskanie_hasla?tab=thx");
		die();				
	}
}

$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );

$this->SMARTY->assign( 'auth_token', $auth_token );
$this->SMARTY->assign( 'pass_err', $pass_err );
