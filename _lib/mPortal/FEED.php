<?
  require_once( $_SERVER['DOCUMENT_ROOT'].'/_lib/mPortal/PATTERN.php' );
  class FEED extends PATTERN {
    
    function FEED($params) {
			
			$this->PATTERN( $params );
			$folder = ROOT.'/_feeds/';
			
	    $this->SMARTY->template_dir = $folder;
			$this->SMARTY->compile_dir  = $folder.'_templates_c/';
			$this->SMARTY->config_dir   = $folder.'_configs/';
			$this->SMARTY->cache_dir    = $folder.'_cache/';
	    
    }
    
    function render_feed(){					
		  
		  $folder = ROOT.'/_feeds/';
		  
		  /*
		  if( !file_exists( $folder.$this->ID.'.php' ) ) {
		    		  
			  if( $this->DB->selectCountBoolean("SELECT COUNT(*) FROM poslowie WHERE id='".$this->ID."'") ) {
		      $this->ID = 'posel';
		    } elseif( $this->DB->selectCountBoolean("SELECT COUNT(*) FROM ludzie WHERE id='".$this->ID."'") ) {
		      $this->ID = 'mowca';
		    }
		    		  
		  }
		  */
		  
		  include( $folder.$this->ID.'.php' );
		  
		  
		  
		  header("Content-Type: application/xml; charset=UTF-8"); 
      include( ROOT.'/_feeds/'.$this->ID.'.php' );			
			$this->SMARTY->assign('M', array(
			  'TITLE' => $this->TITLE,
			  'DESCRIPTION' => $this->DESCRIPTION,
			  'ITEMS' => $this->ITEMS,
			  'LINK' => $this->LINK,
			));
			
			
			$output = $this->SMARTY->fetch( ROOT.'/_lib/mPortal/resources/feed.tpl' );			 
		  // if( $_REQUEST['MINIFY_OUTPUT']!=='0' ) { $output = minify_html($output); }
		  echo $output;
		
		}
      
  }
?>