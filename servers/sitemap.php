<?
  require_once( $_SERVER['DOCUMENT_ROOT'].'/_lib/mPortal/SITEMAP.php' );
  

  if( !$_GET['_SITEMAP_ID'] ) {
	  
	  header("HTTP/1.1 301 Moved Permanently");
	  header("Location: http://sejmometr.pl/sitemap");
	  exit;
	  
  }
    
  
  
  $M = new SITEMAP( array('ID'=>$_GET['_SITEMAP_ID']) );
  $redirection = $M->DB->selectValue("SELECT new_alias FROM api_redirections WHERE old_alias='".addslashes( $_GET['_SITEMAP_ID'] )."'");
  
  
  if( $redirection ) {
	  
	  header("HTTP/1.1 301 Moved Permanently");
	  $url = "http://sejmometr.pl/sitemap/".$redirection;
	  
	  if( $_GET['_OFFSET'] )
		  $url .= '-'.$_GET['_OFFSET'];
		
		header("Location: $url");
		exit();
	  
  }



  $DB = &$M->DB;
  
  
  $M->render();
?>