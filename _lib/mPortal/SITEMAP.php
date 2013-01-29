<?
  require_once( $_SERVER['DOCUMENT_ROOT'].'/_lib/mPortal/PATTERN.php' );
  class SITEMAP extends PATTERN {
    
    function render(){							  
		  
		  // header("Content-Type: application/xml; charset=UTF-8"); 
      
      
      // echo ROOT.'/_sitemaps/'.$this->ID.'.php';
      // die();
      $items = array();
      
      
      if( $this->ID=='general' ) {
	      
	      $items[] = array(
		      'loc' => $SITE_ADDRESS.'/start',
		      'changefreq' => 'daily',
		    );
		    $items[] = array(
		      'loc' => $SITE_ADDRESS.'/bank_danych_lokalnych',
		      'changefreq' => 'daily',
		    );
		    $items[] = array(
		      'loc' => $SITE_ADDRESS.'/dane',
		      'changefreq' => 'daily',
		    );
		    $items[] = array(
		      'loc' => $SITE_ADDRESS.'/api',
		      'changefreq' => 'daily',
		    );
	      
      } else {
        
        $offset = (int) $_REQUEST['_OFFSET'];

        
	      $dataset = new ep_Dataset( $this->ID );
	      $dataset->respect_limit = false;
	      
			  $ditems = $dataset->find_all(10000, $offset, false);


			  
			  foreach( $ditems as $ditem ) {
			    
			    $items[] = array(
			      'loc' => $SITE_ADDRESS.'/'.$dataset->name.'/'.$ditem['id'],
			      'changefreq' => 'never',
			    );	        
			  }
		  
		  }
		    
		  $this->ITEMS = $items;
      
      
      // @include( ROOT.'/_sitemaps/'.$this->ID.'.php' );
			
			$folder = ROOT.'/_sitemaps/';					
			$this->SMARTY->template_dir = $folder;
			$this->SMARTY->compile_dir  = $folder.'_templates_c/';
			$this->SMARTY->config_dir   = $folder.'_configs/';
			$this->SMARTY->cache_dir    = $folder.'_cache/';
			
			$this->SMARTY->assign('M', array(
			  'ITEMS' => $this->ITEMS,
			));
			
			
			
			$output = $this->SMARTY->fetch( ROOT.'/_lib/mPortal/resources/sitemap.tpl' );			 
		  // if( $_REQUEST['MINIFY_OUTPUT']!=='0' ) { $output = minify_html($output); }
		  echo $output;
		
		}
      
  }
?>