<?php

if( !isset( $_SESSION['mPortal']['send_email_to'] ) ){
	header ("Location: /zaloguj");
	die();
}

$user_id = (int)$_SESSION['mPortal']['send_email_to'];

$USER = $this->DB->selectAssoc("SELECT id, name, first_name, last_name, link, username, gender, email, email_verified, type, is_active, email_pass FROM ".DB_TABLE_users." WHERE is_deleted='0' AND id={$user_id}");

if(!$USER){
	header ("Location: /zaloguj");
	die();	
}

$resend = isset( $_GET['resend'] ) ? (int)$_GET['resend'] : 0;



if( $resend == 1 ){
	if( !$USER['email_pass'] ){
		$email_pass = '';
		do{
			$email_pass = md5( uniqid('email_pass') );

		}while( $this->DB->selectValue( "SELECT id FROM ".DB_TABLE_users." WHERE email_pass='{$email_pass}'") );

		$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_pass='{$email_pass}' WHERE id=".$user_id );

		$USER['email_pass'] = $email_pass;
	}

	$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='1' WHERE id=".$user_id );
	
	require_once(ROOT.'/_lib/smarty/Smarty.class.php');
	$smarty_folder = ROOT.'/_patterns/_SMARTY/';
	
	$SMARTY = new Smarty();
	$SMARTY->template_dir = $smarty_folder;
	$SMARTY->compile_dir  = $smarty_folder.'_templates_c/';
	$SMARTY->config_dir   = $smarty_folder.'_configs/';
	$SMARTY->cache_dir    = $smarty_folder.'_cache/';
	
	$SMARTY->assign('username', $USER['username'] );
	$SMARTY->assign('email_pass', $USER['email_pass'] );
	
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
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
    $mail->MsgHTML($html);

    $mail->AddAddress( $USER['email'], $USER['username'] );

	if( !$mail->Send() ) {
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='4' WHERE id=".$user_id );
		header ("Location: zaloguj?tab=not_send&resend=3");
		die();
	} else {
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='2' WHERE id=".$user_id );
		header ("Location: zaloguj?tab=not_send&resend=2");
		die();
	}
}

if( $resend == 2 ){
	unset( $_SESSION['mPortal']['send_email_to'] );
}
$this->SMARTY->assign( 'resend', $resend );