<?
  // var_export( $_REQUEST );
  
  $convert = isset( $_REQUEST['convert'] ) ? $_REQUEST['convert'] : 1;
 

  $id = (int) $_REQUEST['_ID'];
  
  /*
  if( $convert )
	  $id = $this->DB->selectValue("SELECT epanstwo_id FROM s_dokumenty_helper WHERE id='$id'");
  */
  
  $file = '/home/www/epanstwo/docs/snippets/'.$id.'.html';
  if( file_exists($file) ) {
    
    $filesize = filesize( $file );
    if( $filesize < 3072000 ) {
    
      $result = file_get_contents( $file );
    
    } else {
      
      $handle = fopen($file, 'r');
      $content = fread( $handle, 3072000 );	      	
      fclose($handle);
      $result = $content;
      
    }
    
  }
  
  
  
  $this->SMARTY->assign('html', $result);