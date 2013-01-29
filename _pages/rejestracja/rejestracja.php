<?php
if( $this->isLogged() ) {
	header ("Location: /");
	die();
}

$tab_ar = array( 'main', 'thx' );
$tab = 'main';

if( isset( $_GET['tab'] ) && in_array( $_GET['tab'], $tab_ar ) ){
	$tab = $_GET['tab'];
}

include( ROOT. '/_pages/rejestracja/tabs/'.$tab.'.php' );

$this->SMARTY->assign('tab', $tab );

