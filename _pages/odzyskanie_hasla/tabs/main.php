<?php

if( $this->isLogged() ) {
	header ("Location: /");
	die();
}

$auth_token = '';
$username = '';
$username_err = 'ok';
$email = false;

// jesli zostal przeslany formularz
if( isset( $_POST['save'] ) ){

	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){

		header ("Location: /odzyskanie_hasla");
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
	
	

	if( $username_err === 'ok' ){

		if( $email === false ){
			$data = $this->DB->selectAssoc( "SELECT email, username, id FROM " . DB_TABLE_users . " WHERE is_deleted='0' AND username='" . addslashes( $username ) . "'" );
		} else {
			$data = $this->DB->selectAssoc( "SELECT email, username, id FROM " . DB_TABLE_users . " WHERE is_deleted='0' AND email='" . addslashes( $username ) . "'" );
		}
		
		if( $data ){
			do{
				$pass_recover = md5( uniqid('pass_recover') );
			}while( $this->DB->selectValue( "SELECT id FROM ".DB_TABLE_users." WHERE pass_recover='{$pass_recover}'") );	
			$this->DB->q( "UPDATE ".DB_TABLE_users." SET pass_recover='{$pass_recover}', pass_recover_ts=NOW() WHERE id=".$data['id'] );

			
			require_once(ROOT.'/_lib/smarty/Smarty.class.php');
			$smarty_folder = ROOT.'/_patterns/_SMARTY/';
			
			$SMARTY = new Smarty();
			$SMARTY->template_dir = $smarty_folder;
			$SMARTY->compile_dir  = $smarty_folder.'_templates_c/';
			$SMARTY->config_dir   = $smarty_folder.'_configs/';
			$SMARTY->cache_dir    = $smarty_folder.'_cache/';
			
			$SMARTY->assign('username', $data['username'] );
			$SMARTY->assign('pass_recover', $pass_recover );
			
			$html = ( $SMARTY->fetch( ROOT.'/_lib/mPortal/resources/s_odzyskanie_hasla.tpl' ) );

			require( ROOT."/_lib/PHPMailer_5.2.1/class.phpmailer.php" );
						
			$mail             = new PHPMailer();
			$mail->IsSMTP(); 
			$mail->SMTPDebug  = 0;
			$mail->CharSet = "UTF-8";
			
            $mail->SMTPAuth   = MAILER_REG_SMTPAUTH;
            $mail->Host       = MAILER_REG_HOST;
            $mail->Port       = MAILER_REG_PORT;
            $mail->Username   = MAILER_REG_USERNAME;
            $mail->Password   = MAILER_REG_PASSWORD;
            
            $mail->SetFrom( MAILER_REG_FROM, MAILER_REG_FROM_TITLE );
            $mail->AddReplyTo( MAILER_REG_REPLY,  MAILER_REG_REPLY_TITLE );
            $mail->Subject    = "OchParliament - odzyskiwanie hasła";
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->MsgHTML($html);

            $mail->AddAddress($data['email'] , $data['username'] );

			if( !$mail->Send() ) {
				
			} else {
				header ("Location: /odzyskanie_hasla?tab=send");
				die();
			}
		} else {
			$username_err = 'invalid';
		}
	}
}
$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );	


$this->SMARTY->assign( 'auth_token', $auth_token );
$this->SMARTY->assign( 'username', $username );
$this->SMARTY->assign( 'username_err', $username_err );

