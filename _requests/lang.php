<?
  $pages = $M->DB->selectValues("SELECT id FROM m_pages");
  $txt_array = array();
  
  foreach( $pages as $page ) {
       
    $file = ROOT.'/_pages/'.$page.'/_lang/en.php';
    if( file_exists($file) ) {
      
      $txt_array[] = '<h2>'.$page.'</h2>';
      $txt_array[] = file_get_contents( $file );
    
    }
  }
  
  echo nl2br( implode('<br/>', $txt_array) );
?>