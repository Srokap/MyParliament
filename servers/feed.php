<?
  require_once( $_SERVER['DOCUMENT_ROOT'].'/_lib/mPortal/FEED.php' );
    
  $M = new FEED( array('ID'=>$_GET['_FEED']) );
  $DB = &$M->DB;
       
  $_SERVER['M'] = &$M;
  $M->render_feed();
?>