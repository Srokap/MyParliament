<?php
$auth_token = '';
$email = '';
$email_err = 'ok';
$pass = '';
$pass_err = 'ok';

// jesli zostal przeslany formularz
if( isset( $_POST['save_email'] ) ){
	$act_tab = 'email';
	
	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){
		header ("Location: /konto");
		die();
	} 
	
	// sprawdzanie poprawnoci email
	if( isset( $_POST['email'] ) && $_POST['email'] != '' ){
		$_POST['email'] = trim( $_POST['email'] );
		if( preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $_POST['email'] ) ){
			$is_email = $this->DB->selectValue("SELECT id FROM m_users WHERE is_deleted='0' AND email='".$_POST['email']."'" );
			if( $is_email ){
				$email_err = 'exists';	
			}			
		} else {
			$email_err = 'invalid';
		}
		$email = htmlentities( $_POST['email'] );
		
	} else {
		$email_err = 'required';
	}
	
	// sprawdzanie hasla
	if(  !isset( $_POST['pass'] ) || $_POST['pass'] == '' ){
		$pass_err = 'required';
	} else {
		$login_hash = login_hash( $this->USER['email'], $_POST['pass'] );
		
		$user_id = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_users." WHERE is_deleted='0' AND login_hash='$login_hash'");
		
		if( !$user_id || $this->USER['id'] != $user_id ){
			$pass_err = 'invalid';
		} else {
			$pass = htmlentities( $_POST['pass'] );
		}
	}
	

	if( $email_err === 'ok' && $pass_err === 'ok' ){
		$this->USER['email'] = $email;
		$login_hash = login_hash( $this->USER['email'], $pass );
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET login_hash='$login_hash', email='".( addslashes($email) )."' WHERE id=".$this->USER['id'] );
		$_SESSION['mPortal']['msg'] = $act_tab;
		header ("Location: /konto");
		die();				
	}
}

$this->SMARTY->assign( 'email', $email );
$this->SMARTY->assign( 'email_err', $email_err );
$this->SMARTY->assign( 'email_pass_err', $pass_err );

