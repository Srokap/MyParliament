<?php
$next = isset( $_REQUEST['next'] ) ? trim( $_REQUEST['next'] ) : '';
if( !$next && isset( $_SESSION['_REFERRER'] ) ){
	$next = $_SESSION['_REFERRER'];
}

if( $next == SITE_ROOT ){
	$next = '';
}


if( strlen( $next ) && $next{0} == '/' ){
	$next = substr( $next, 1 );
}

if( $next == 'logout' || SITE_ROOT){
	$next = '';
}

$fb = $M->USER['type']=='fb';

if( $fb ){
	$fb_logout_url = $M->FB->getLogoutUrl(array(
			'next' => SITE_ADDRESS . $next,
	));
}

$M->logout();

if( $fb ) {
	header( 'Location: ' . $fb_logout_url);
	die();	 
} else {
	header( 'Location: ' . SITE_ADDRESS . '/' . $next);
	die();
}