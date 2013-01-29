<?php

$auth_token = '';
$username = '';
$username_err = 'ok';
$email = '';
$email_err = 'ok';
$pass = '';
$pass_err = 'ok';

// jesli zostal przeslany formularz
if( isset( $_POST['save'] ) ){

	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) ){

		header ("Location: /rejestracja");
		die();

	} elseif( $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){

		$auth_token = md5( uniqid('mportal') );
		$_SESSION['mPortal']['auth_token'] = $auth_token;	
		header ("Location: /rejestracja");
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
	if( $username_err === 'ok' && $email_err === 'ok' && $pass_err === 'ok' ){
		$email_pass = '';
		do{
			$email_pass = md5( uniqid('email_pass') );

		}while( $this->DB->selectValue( "SELECT id FROM ".DB_TABLE_users." WHERE email_pass='{$email_pass}'") );

		$login_hash = login_hash( $email, $pass );
		
		$this->DB->insert_ignore_assoc( DB_TABLE_users, array( 
		 													'username' => addslashes( $username ),
		 													'login_hash' => $login_hash,
		 													'email' => addslashes( $email ),
		 													'email_pass' => $email_pass,
		 													'registration_time' => 'NOW()',
		));
		
		$user_id = $this->DB->insert_id;
		
		if( $user_id ){
			$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='1' WHERE id=".$user_id );
			
			require_once(ROOT.'/_lib/smarty/Smarty.class.php');
			$smarty_folder = ROOT.'/_patterns/_SMARTY/';
			
			$SMARTY = new Smarty();
			$SMARTY->template_dir = $smarty_folder;
			$SMARTY->compile_dir  = $smarty_folder.'_templates_c/';
			$SMARTY->config_dir   = $smarty_folder.'_configs/';
			$SMARTY->cache_dir    = $smarty_folder.'_cache/';
			
			$SMARTY->assign('username', $username );
			$SMARTY->assign('email_pass', $email_pass );
			
			$html = ( $SMARTY->fetch( ROOT.'/_lib/mPortal/resources/s_email_verification.tpl' ) );

			require( ROOT."/_lib/PHPMailer_5.2.1/class.phpmailer.php" );
						
			$mail = new PHPMailer();
			$mail->IsSMTP();  
			$mail->SMTPDebug = 0;
			$mail->CharSet = "UTF-8";
			
            $mail->SMTPAuth   = MAILER_REG_SMTPAUTH;
            $mail->Host       = MAILER_REG_HOST;
            $mail->Port       = MAILER_REG_PORT;
            $mail->Username   = MAILER_REG_USERNAME;
            $mail->Password   = MAILER_REG_PASSWORD;
            
            $mail->SetFrom( MAILER_REG_FROM, MAILER_REG_FROM_TITLE );
            $mail->AddReplyTo( MAILER_REG_REPLY,  MAILER_REG_REPLY_TITLE );
			
            $mail->Subject    = "Rejestracja na portalu OchParliament";
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->MsgHTML($html);

            $mail->AddAddress($email, $username);

			if( !$mail->Send() ) {
				$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='4' WHERE id=".$user_id );
			} else {
				$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='2' WHERE id=".$user_id );
				header ("Location: /rejestracja?tab=thx");
				die();
			}
		}		
	}
	
	$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );
} else {	
	$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );	
}

$this->SMARTY->assign( 'auth_token', $auth_token );
$this->SMARTY->assign( 'username', $username );
$this->SMARTY->assign( 'username_err', $username_err );
$this->SMARTY->assign( 'email', $email );
$this->SMARTY->assign( 'email_err', $email_err );
$this->SMARTY->assign( 'pass_err', $pass_err );

