<?
  function sf_object($params){
	  $_modes = array('tabs');
	  $mode = in_array( $params['mode'] , $_modes ) ?  $params['mode'] : $_modes[0];
	  

	  switch( $mode ) {
		  
		  case 'tabs': {
		    
		    $smarty = new Smarty();
			  $folder = ROOT.'/_components/object/smarty/';
			  $smarty->template_dir = $folder;
				$smarty->compile_dir  = $folder.'_templates_c/';
				$smarty->config_dir   = $folder.'_configs/';
				$smarty->cache_dir    = $folder.'_cache/';
			  $smarty->register_modifier('data_slowna', 'sm_data_slowna');
		    
	      return $smarty->fetch( 'object.tpl' );
		    
			  break;
		  }
		  
	  }
  }
?>