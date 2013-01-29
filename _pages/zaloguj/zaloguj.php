<?php
if( $this->isLogged() ) {
	header ( "Location: " . SITE_ADDRESS );
	die();
}


$tab_ar = array( 'main', 'inactive', 'not_verified', 'not_send' );
$tab = 'main';

if( isset( $_GET['tab'] ) && in_array( $_GET['tab'], $tab_ar ) ){
	$tab = $_GET['tab'];
}

if( file_exists( ROOT. '/_pages/zaloguj/tabs/'.$tab.'.php' ) ){
	include( ROOT. '/_pages/zaloguj/tabs/'.$tab.'.php' );
}

$this->SMARTY->assign('tab', $tab );
