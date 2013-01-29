<?php
require_once( '../_lib/mPortal/config.php' );
require_once( ROOT.'/_constructors/REQUEST.php' );

$M = new REQUEST(array(
		'DONT_VERIFY_USER' => true
));
$DB = &$M->DB;

$free_access_requests = array(
		'build_engines', 
		'build_page', 
		'test', 
		'login', 
		'logout', 
		'sitemap', 
		'server', 
		);

if( !in_array($_REQUEST['_SERVICE'], $free_access_requests) ) $M->setAccess(2);
include( ROOT.'/_requests/'.$_REQUEST['_SERVICE'].'.php' );