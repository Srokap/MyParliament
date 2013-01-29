<?

  function _dataset_browser_sort_fields_function($a, $b){
    $a = (int) $a['filter_ord'];
    $b = (int) $b['filter_ord'];
    
    if( $a==$b )
      return 0;
    elseif( $a<$b )
      return 1;
    else
      return -1;
  }

  function _dataset_browser_http_build_query( $params ){
	  
	  
	  if( !empty($params) )
	    
	    $parts = array();
	    foreach( $params as $key => $value ) {
		    
		    if( is_array($value) ) {
			    
			    foreach( $value as $v )
			      $parts[] = $key.'[]=' . htmlspecialchars( $v ); 
			      
			    
		    } else {
			    
			    $parts[] = $key.'=' . htmlspecialchars( $value ); 
			    
		    }
		    
	    }
	  
	  return implode('&', $parts);
  }


  function sf_dataset_browser($params, &$master_smarty){
	  
	  
	  $_mode = $_REQUEST['_MODE'] ? $_REQUEST['_MODE'] : 'browse';
	  if( $params['_mode'] )
	    $_mode = $params['_mode'];
	  
	  if( $params['_template'] )
	    $_template = $params['_template'];
	  
	  
	  $dataset = $params['dataset'];
	  $mode = $params['mode'] ? $params['mode'] : 'full';
	  $prefix = $params['prefix'];
	  $title = $params['title'];
	  $limit = $params['limit'];
	  
	  
	  
	  $request = array();
	  if( !empty($params['request']) )
	    foreach( $params['request'] as $key=>$value )
	      if( !$prefix || ( $prefix && startsWith($key, $prefix) ) )
	        $request[ substr($key, strlen($prefix)) ] = $value;
	  
	  
	  
	  $base_url = $_SERVER['REQUEST_URI'];
       
      

      
      
   
   
    // SMARTY INIT
	    
	  $smarty = new Smarty();
	  $folder = ROOT.'/_components/dataset_browser/smarty/';
    $smarty->template_dir = $folder;
		$smarty->compile_dir  = $folder.'_templates_c/';
		$smarty->config_dir   = $folder.'_configs/';
		$smarty->cache_dir    = $folder.'_cache/';
    $smarty->register_modifier('data_slowna', 'sm_data_slowna');
    $smarty->register_modifier('dopelniacz', 'sm_dopelniacz');
		$smarty->register_modifier('dopelniaczb', 'sm_dopelniaczb');
    $smarty->register_modifier('wiek', 'sm_wiek');
    $smarty->register_modifier('kalendarzyk', 'sm_kalendarzyk');
    $smarty->register_modifier('dzien_slowny', 'sm_dzien_slowny');
    $smarty->register_modifier('czas_hm', 'sm_czas_hm');
    $smarty->register_modifier('czas_dlugosc', 'sm_czas_dlugosc');
    
    
    $smarty->register_function('s_glosowanie', 'sf_s_glosowanie');
	  
    if( is_array($params['svars']) ){
    	foreach( $params['svars'] as $sk => $sv ){
	    	$smarty->assign( $sk, $sv );
	    }
    }
    
    if( $params['add_sort_fields'] )
      $smarty->assign( 'add_sort_fields', $params['add_sort_fields'] );
    if( $params['add_sort_fields_label'] )
      $smarty->assign( 'add_sort_fields_label', $params['add_sort_fields_label'] );
	  
	  
	  
	  
	  if( $_mode=='browse' ) {
	    
	    
	    
	    
	    
	    
	    
	    
	    /*
		  $o = array();
		  $_o = array();
		  for( $i=0; $i<count($request['o']); $i++ ) {
			  $_o[] = $request['o'][$i];
			  if( $i % 2 == 1 ) {
			    $o[] = $_o;
				  $_o = array();
			  }
		  }
		  $request['o'] = $o;
		  */
	
	
		  
		  $_p = (int) $request['p'];
		  if( !$_p ) $_p = 1;
		  
		  
		  
		  $offset = $dataset->data['limit_default'] * ($_p-1);
		  $dataset->order_by($request['o'][0], $request['o'][1])->keyword($request['k'][0]);
		  
		  $wheres = array();
		  $wcount = floor( count( $request['w'] ) / 3 );
		  for( $i=0; $i<$wcount; $i++ )
		    $wheres[] = array(
		      $request['w'][ 3*$i ],
		      $request['w'][ 3*$i+1 ],
		      $request['w'][ 3*$i+2 ],
		    );
		  
		  for( $i=0; $i<count($wheres); $i++ )
		    $dataset->where( $wheres[$i][0], $wheres[$i][1], $wheres[$i][2] );		  
		  

		  
		  $items = $dataset->find_all( $limit, $offset );

	    
	    
	    
	    
		  
		  
		  
		  
		  
		  // FILTERS
		  $filters = array();
		  for( $i=0; $i<count($dataset->fields); $i++ )
		    if( $dataset->fields[$i]['filter_id'] ) {
		      $filter = $dataset->fields[$i];
		      
		      for( $j=0; $j<count($wheres); $j++ ) {
		        if( $filter['field']==$wheres[$j][0] )
		          $filter = array_merge($filter, array(
		            'selected' => true,
			          'selected_operator' => $wheres[$j][1],
			          'selected_value' => $wheres[$j][2],
		          ));
		      }
		      
		      $filters[] = $filter;
		    }
		  
		  
		  if( $_SERVER['M']->isAdmin() ) {
			  
			  uasort( $filters , '_dataset_browser_sort_fields_function');
			  $filters = array_values( $filters );
			  
		  }
		  
		  
		  
		  
		  
		  
		  
		  
		  // PAGINATION
		  
		  $_pages_range = 5;
		  $total_count = (int) $dataset->items_found_rows;
		  
		  // echo "total_count = $total_count<br/>";
		  // echo "limit = ".$dataset->limit."<br/>";
		  
		  $pages_count = $dataset->limit ? ( ceil($total_count / $dataset->limit) ) : 0;
		  // echo "pages_count = $pages_count<br/>";
		  
		  $_p = max( 1, min( $_p, $pages_count ) );
		  
		  
		  
		  
		  $lis = array();
		  
		  
		  
		  
		  
		  
		  
		  
		  if( $_p>2 ) {
			  
		    $li_html = '<li class="first"><a href="?';
		    $li_html .= _dataset_browser_http_build_query(array(
		      $prefix.'w' => $request['w'],
		      $prefix.'o' => $request['o'],
		      $prefix.'k' => $request['k'],
		      $prefix.'p' => 1,
		    ));
		    $li_html .= '"><img src="/g/p.gif" /></a></li>';
		    $lis[] = $li_html;
		  
		  }
		  
		  if( $_p>1 ) {  
		    $li_html = '<li class="prev"><a href="?';
		    $li_html .= _dataset_browser_http_build_query(array(
		      $prefix.'w' => $request['w'],
		      $prefix.'o' => $request['o'],
		      $prefix.'k' => $request['k'],
		      $prefix.'p' => $_p-1,
		    ));
		    $li_html .= '"><img src="/g/p.gif" /></a></li>';
		    $lis[] = $li_html;
			  
		  }
		  
		  
		  
		  $i_start = $_p - $_pages_range;
		  $i_stop = $_p + $_pages_range;
		  
		  // echo "i_start = $i_start<br/>";
		  // echo "i_stop = $i_stop<br/>";
		  
		  $upper_overflow = $i_stop - $pages_count;
		  if( $upper_overflow>0 ) {
		    $i_stop -= $upper_overflow;
		    $i_start -= $upper_overflow;
		  }
		  
		  $lower_overflow = 1 - $i_start;
		  if( $lower_overflow>0 ) {
		    $i_stop += $lower_overflow;
		    $i_start += $lower_overflow;
		  }
		  
		  $i_start = max(1, $i_start);
		  $i_stop = min($pages_count, $i_stop);
		  
		  
		  
		  for( $p=$i_start; $p<=$i_stop; $p++ ) {
		    
		    	    
		    $li_html = '<li ';
		    if( $p==$_p )
		      $li_html .= 'class="s" ';
		    $li_html .= '><a href="?';
		    $li_html .= _dataset_browser_http_build_query(array(
		      $prefix.'w' => $request['w'],
		      $prefix.'o' => $request['o'],
		      $prefix.'k' => $request['k'],
		      $prefix.'p' => $p,
		    ));
		    $li_html .= '">'.$p.'</a></li>';
		    	    
		    $lis[] = $li_html;
		    
		  }
		  
		  if( $_p<$pages_count ) {
			  
		    $li_html = '<li class="next"><a href="?';
		    $li_html .= _dataset_browser_http_build_query(array(
		      $prefix.'w' => $request['w'],
		      $prefix.'o' => $request['o'],
		      $prefix.'p' => $_p+1,
		    ));
		    $li_html .= '"><img src="/g/p.gif" /></a></li>';
		    $lis[] = $li_html;
			  
		  }
		  
		  if( $_p<$pages_count-1 ) {
			  
		    $li_html = '<li class="last"><a href="?';
		    $li_html .= _dataset_browser_http_build_query(array(
		      $prefix.'w' => $request['w'],
		      $prefix.'o' => $request['o'],
		      $prefix.'k' => $request['k'],
		      $prefix.'p' => $pages_count,
		    ));
		    $li_html .= '"><img src="/g/p.gif" /></a></li>';
		    $lis[] = $li_html;
			  
		  }
	
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  $range = array(
		    $dataset->offset+1,
		    min($dataset->offset+$dataset->limit+1, $total_count),
		  );
		  
		  if( count($lis)===1 )
		    $lis = array();
		  	  
		  $str = '<ul class="s_browser_pagination_ul">'.implode('', $lis).'</ul>';
		  
		  $pagination = array(
		    'total_count' => $total_count,
		    'pages' => $pages,
		    'str' => $str
		  );
		  
		  
		  $smarty->assign('pagination', $pagination);
		  
		  
		  
		  
		  
		  $lis = array();
		  for( $i=0; $i<count($request['k']); $i++ ) {
		    if( $request['k'][$i] ) {
		    
			    $k = $request['k'];
			    unset( $k[$i] );
			    
			    $href = _dataset_browser_http_build_query(array(
			      $prefix.'w' => $request['w'],
			      $prefix.'o' => $request['o'],
			      $prefix.'k' => $k,
			    ));
			    
			    $lis[] = '<li><a title="'.$request['k'][$i].'" href="?'.$href.'"><i></i><span>'._truncate($request['k'][$i],  50, '...', true, true).'</span></a></li>';
		    
		    }
		  }
		  
		  
		  $k_str = '<ul>'.implode('', $lis).'</ul>';
	
		  
		  
		  
		  
		  
		  
		  
		  $nav_str = '';
		  if($total_count) {
		    $z = ($total_count>99 && $total_count<200) ? 'ze' : 'z';
		    $nav_str = '<b>'.$range[0].'</b> - <b>'.$range[1].'</b> '.$z.' <b>'.number_format($total_count, 0, '.', ' ').'</b>';
		  } 
		  
		  
		  $smarty->assign('items', $items);	  
		  $smarty->assign('pagination', $pagination);	  
		  $smarty->assign('nav_str', $nav_str);	  
		  $smarty->assign('k_str', $k_str);	  
		  $smarty->assign('w', $request['w']);	  
		  $smarty->assign('o', $request['o']);	  
		  $smarty->assign('k', $request['k']);  
		  $smarty->assign('filters', $filters);	  
		  
		  
		  
		 
		  		  
		  
		  
		  
		  $filters_div_html = $smarty->fetch( 'dataset_browser_filters_div.tpl' );
		  $smarty->assign('filters_div_html', $filters_div_html);	 
	    
	    
	    
	  
	  
	  
	  } elseif( $_mode=='mini' ) {
	  
	  
	  	$limit = $limit ? $limit : 100;
	  	
		  $items = $dataset->find_all( $limit, 0 );		  
		  $smarty->assign('items', $items);	  
		  $mode = 'mini';
		  
	  
	  
	  } elseif( $_mode=='api' ) {
		  
		  $aliases = array();
		  $children = array();
		  $fields = array();
		  
			foreach( $dataset->fields as $v ) {
				
				$parts = explode('.', $v['field']);
				$parts_count = count($parts);
				if( $parts_count<2 )
				  break;
				
				$alias = $parts[ $parts_count-2 ];
				$key = $parts[ $parts_count-1 ];
				
				if( $alias==$dataset->name ) {
					$v['key'] = $key;
					$fields[] = $v;
				} else
					$children[ $alias ][ $alias.'.'.$key ] =  $v ;
				
			}
	    
	    // var_export( $fields );
		  $smarty->assign('object_fields', $fields);	 
		  
		  
	  }

 
    $list_item_path = $folder;
    $list_item_path .= ( $_mode=='mini' ) ? 'list_item_mini.tpl' : 'list_item.tpl';
	    
	  
	  
	  $M = array(
	    'ROOT' => ROOT,
	    'isAdmin' => $_SERVER['M']->isAdmin(),
	  );
  
	  $smarty->assign('ROOT', ROOT);
	  $smarty->assign('M', $M);	  
	  $smarty->assign('include_path', $folder.'list_item_classes/');
	  $smarty->assign('include_path_mini', $folder.'list_item_classes_mini/');
	  $smarty->assign('list_item_path', $list_item_path);
	  $smarty->assign('dataset', $dataset);
	  $smarty->assign('title', $title);  
	  $smarty->assign('mode', $_mode);  
	  $smarty->assign('template', $_template);
	  
	   
	  return $smarty->fetch( 'dataset_browser_'.$mode.'.tpl' );
  	  
  }
?>
