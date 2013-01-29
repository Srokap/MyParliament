<?
  require_once('engine.php');
  

  $params = $_REQUEST;
  if( $_PARAMS )
    $params = array_merge( $_REQUEST, $_PARAMS );

  
  $q = $params['q'];
  $qs = is_array( $params['qs'] ) ? $params['qs'] : array();
  $d = $params['d'];
  $order = isset( $params['order'] ) ? $params['order'] : '';
  $offset = (int) $params['of'];
  
  
  /*
  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
	  
	  echo "\n\n";
	  var_export( $order );
	  
	}
  */
  
  
  // if(get_magic_quotes_gpc() == 1)
    // $q = stripslashes( $q );

  
  $__start = microtime_float();
  
  require_once(  '/home/www/epanstwo/_lib/Solr/Service.php' );
  if( !$_SERVER['SOLR_OBJECTS'] || ( $_SERVER['SOLR_OBJECTS'] && !$_SERVER['SOLR_OBJECTS']->ping() ) ) {
    $_SERVER['SOLR_OBJECTS'] = new Apache_Solr_Service('localhost', 8983, '/solr/objects/');
  }

  
  
  
  $items_found_rows = 0;
  
  // $q = addslashes($q);
  $q = str_replace(array('!', '&', '|', ':', '^', '[', ']', '{', '}', '~', '\\'), ' ', $q);
  $solrq = '*';
  $hlq = $q;
  
  if( $q ) {
	  
	  $solrq = $q;	  
	  
  } elseif( !empty($qs) ) {
	  
	  $hlq = '(' . implode(' OR ', $qs) . ')';
    $hlq = str_replace(array('!', '&', '|', ':', '^', '[', ']', '{', '}', '~', '\\'), ' ', $hlq);
	  
  }
  
    
  
  
  
  
  
  // echo $solrq;
  
  $query_params = array(
    'fl' => 'id, dataset, object_id, score',
    'facet' => 'true',
    'facet.field' => 'dataset',
    'sort' => $order,
    'hl' => 'true',
    'hl.q' => str_replace('"', '', $hlq),
    'hl.useFastVectorHighlighter' => 'true',
    'hl.fl' => 'hl_text',
    'hl.snippets' => 1,
    'hl.fragsize' => 200,
  );
  
  
  if( !empty($qs) )
    $query_params['fq'] = $hlq;
    

      
  
  if( $d ) {
    
    $d = str_replace(array('!', '&', '|', ':', '^', '[', ']', '{', '}', '~', '\\'), ' ', $d);
    $query_params['fq'] = 'dataset:' . $d;
    
  }
    
  
  
  
  
  
  
  
	
	
	
     
  
  $transport = $_SERVER['SOLR_OBJECTS']->search($solrq, $offset, 20, $query_params);
  if( $transport && $transport->response ) {
	  
	  
	  
	  
	  $items_found_rows = $transport->response->numFound;
	  $docs = $transport->response->docs;
    $hls = get_object_vars( $transport->highlighting );
	  
	  
	  
	  
	  
	  $_SERVER['M']->DB->q("INSERT INTO m_search_log (q, c) VALUES ('" . $q . "', '$items_found_rows')");
	  $_datasets_data = $_SERVER['M']->DB->selectPairs("SELECT base_alias, results_class, name FROM api_datasets");
    
    $tabs = array();
    if( $transport->facet_counts->facet_fields->dataset ) {
	    foreach( $transport->facet_counts->facet_fields->dataset as $dataset => $count ) {
		    
		    if( $count )
			    $tabs[] = array(
			      'dataset' => $dataset,
			      'name' => $_datasets_data[ $dataset ][1],
			      'count' => $count,
			    );
		    
	    }
    }
    


	  
	  
	  

	  $items = array();

	  $_start = microtime_float();
	  foreach( $docs as $doc ) {
	    
	    $id = $doc->getField('id');	    
	    $dataset = $doc->getField('dataset');
	    $object_id = $doc->getField('object_id');
	    $class = $_datasets_data[ $dataset['value'] ][0];
	    
	    
	    if( $dataset && $object_id && $class ) {
		    
		    $file = '/home/www/s/_api/data/' . $dataset['value'] . '/' .  $object_id['value'] .'.json';
		    $hl = $hls[ $id['value'] ]->hl_text;
		    if( !empty($hl) )
		      foreach( $hl as &$h )
		        $h = '...' . trim( strip_tags( $h, '<em>' ) ) . '...';
		    
		    
		    $items[] = array(
		      'id' => $id['value'],
		      'class' => $class,
		      'dataset' => $dataset['value'],
		      'object_id' => $object_id,
		      'data' => @file_get_contents( $file ),
		      'hl' => $hl,
		    );
		    
		    
	    }
	    
	    
	    
	    
	  }
	  
	  


	  
	  
  }
  

  $_stop = microtime_float();
  
  
  
  

  
  
  
  
  
  $performance['opening_files'] = $_stop - $_start;
  $performance['total'] = $_stop - $__start;
  
  return array(
    'items' => $items,
    'items_found_rows' => $items_found_rows,
    'tabs' => $tabs,
    'limit' => 20,
    'order' => $result['order'],
    'performance' => $performance,
  );