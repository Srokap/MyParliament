<?php
if( !$this->isLogged() ) {
	header ("Location: /_login");
	die();
}

$act_tab = 'email';
$msg_email = false;
$msg_username = false;
$msg_password = false;

if( isset( $_SESSION['mPortal']['msg'] ) ){
	$act_tab = $_SESSION['mPortal']['msg'];
	${'msg_'.$_SESSION['mPortal']['msg']} = true;
	unset( $_SESSION['mPortal']['msg'] );
}


if( isset( $_POST['save_email']) ){
	include( ROOT. '/_pages/konto/tabs/email.php' );
}

if( isset( $_POST['save_username']) ){
	include( ROOT. '/_pages/konto/tabs/username.php' );
}

if( isset( $_POST['save_pass']) ){
	include( ROOT. '/_pages/konto/tabs/haslo.php' );
}

if( isset( $_POST['save_remove']) ){
	include( ROOT. '/_pages/konto/tabs/usun.php' );
}


$_SESSION['mPortal']['auth_token'] = $auth_token = md5( uniqid('mportal') );

$this->SMARTY->assign( 'auth_token', $auth_token );
//$this->SMARTY->assign( 'tab', $tab );
//$this->SMARTY->assign( 'menu_links', $menu_links );
$this->SMARTY->assign( 'act_tab', $act_tab );

$this->SMARTY->assign( 'msg_email', $msg_email );
$this->SMARTY->assign( 'msg_username', $msg_username );
$this->SMARTY->assign( 'msg_password', $msg_password );

