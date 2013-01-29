<?php
require_once( ROOT .'/_lib/mPortal/REQUEST.php' );

$M = new REQUEST();
$_SERVER['DB'] = &$M->DB;
