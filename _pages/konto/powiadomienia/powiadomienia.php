<?php
if( !$this->isLogged() ) {
	header ("Location: /_login");
	die();
}

$act_tab = 'ustawienia_email';
$msg_email = false;
$msg_username = false;
$msg_password = false;

if( isset( $_SESSION['mPortal']['msg'] ) ){
	$act_tab = $_SESSION['mPortal']['msg'];
	${'msg_'.$_SESSION['mPortal']['msg']} = true;
	unset( $_SESSION['mPortal']['msg'] );
}


$news_email_freq = $this->DB->selectValue( "SELECT news_email_freq FROM ".DB_TABLE_users." WHERE id=".$this->USER['id'] );

if( isset( $_POST['save_ustawienia_email']) ){
	include( ROOT. '/_pages/konto/powiadomienia/tabs/ustawienia_email.php' );
}


$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );

$this->SMARTY->assign( 'auth_token', $auth_token );
$this->SMARTY->assign( 'tab', $tab );
$this->SMARTY->assign( 'menu_links', $menu_links );
$this->SMARTY->assign( 'act_tab', $act_tab );
$this->SMARTY->assign( 'news_email_freq', $news_email_freq );

$this->SMARTY->assign( 'msg_ustawienia_email', $msg_ustawienia_email );


