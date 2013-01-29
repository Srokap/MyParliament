<?php

$auth_token = '';
$username = '';
$username_err = 'ok';
$email = false;
$pass = '';
$pass_err = 'ok';
$incorrect = false;
$remember = true;

// jesli zostal przeslany formularz
if( isset( $_POST['save'] ) ){


	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){
		header ("Location: ".SITE_ROOT."zaloguj");
		die();
	} 
	
	// sprawdzanie poprawnoscie username
	if( isset( $_POST['username'] ) && $_POST['username'] != '' ){
		$_POST['username'] = trim( $_POST['username'] );
		if( preg_match('/^[a-zA-Z0-9_]{6,32}$/', $_POST['username'] ) ){
			$email = false;
		} elseif( preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $_POST['username'] ) ) {
			$email = true;
		}

		$username = htmlentities( $_POST['username'] );		
	} else {
		$username_err = 'required';
	}
	
	// sprawdzanie hasla
	if( !isset( $_POST['pass'] ) || $_POST['pass'] == '' ){
		$pass_err = 'required';
	} else {
		$pass = $_POST['pass'];	
	} 
		
	if( isset( $_POST['remember'] ) ){
		$remember = true;
	} else {
		$remember = false;
	}
	
	// register
	if( $username_err === 'ok' && $pass_err === 'ok' ){

		if( $email === false ){
			$email = $this->DB->selectValue( "SELECT email FROM " . DB_TABLE_users . " WHERE is_deleted='0' AND  username='" . addslashes( $username ) . "'" );
		} else {
			$email = $username;
		}

		$login_hash = login_hash( $email, $pass );
		
		$USER = $this->DB->selectAssoc("SELECT id, name, first_name, last_name, link, username, gender, email, email_verified, type, is_active FROM ".DB_TABLE_users." WHERE is_deleted='0' AND login_hash='$login_hash'");
		
		if( !empty( $USER ) && $USER['email_verified'] == '3' && $USER['is_active'] == '1'){	
			
			$this->USER = $USER;
			if( $remember ) {
				$token = make_token(90);
				$this->DB->q("UPDATE ".DB_TABLE_users." SET token='$token' WHERE id=".$this->USER['id']);
				$this->USER['token'] = $token;
				$this->save_session();
				setcookie('sm_token', $token, time()+REMEMBER_ME_SESSION_MAXLIFE, '/');
			}		 
			if( isset( $_SESSION['mPortal']['auth_next'] ) && $_SESSION['mPortal']['auth_next'] ){
				header ("Location: " . SITE_ROOT. $_SESSION['mPortal']['auth_next'] );
				unset( $_SESSION['mPortal']['auth_next'] );
			} else {
				header ("Location: " . SITE_ROOT);
			}
			die();
		} elseif( !empty( $USER ) && $USER['email_verified'] == '2' ){
			header ("Location: ".SITE_ROOT."zaloguj?tab=not_verified");
			die();
		} elseif( !empty( $USER ) && $USER['email_verified'] == '4' ){
			$_SESSION['mPortal']['send_email_to'] = $USER['id'];
			header ("Location: ".SITE_ROOT."zaloguj?tab=not_send");
			die();			
		} elseif( !empty( $USER ) && $USER['is_active'] == '0' ){
			header ("Location: ".SITE_ROOT."zaloguj?tab=inactive");
			die();
		}
		$incorrect = true;
	}
	
	$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );
} else {	
	$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );
	$_SESSION['mPortal']['auth_next'] = isset( $_GET['next'] ) ? strip_tags( $_GET['next'] ) : false;
	$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	if( $referer && strpos( SITE_ADDRESS, $referer ) == 0 ){
		$referer = str_replace( SITE_ADDRESS, '', $referer );
		if( !$_SESSION['mPortal']['auth_next'] ){
			$_SESSION['mPortal']['auth_next'] = strip_tags( $referer );
		}
	}
}

$this->SMARTY->assign( 'auth_token', $auth_token );
$this->SMARTY->assign( 'username', $username );
$this->SMARTY->assign( 'username_err', $username_err );
$this->SMARTY->assign( 'remember', $remember );
$this->SMARTY->assign( 'pass_err', $pass_err );
$this->SMARTY->assign( 'incorrect', $incorrect );
