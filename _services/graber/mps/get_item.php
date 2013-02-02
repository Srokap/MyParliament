<?
  $item = $_PARAMS;
  $id = $item['id'];
  
  if( !$item || empty($item) || !$id )
    return false;
  




  require_once( ROOT.'/_lib/simple_html_dom.php' );  
  $url = 'http://www.mkogy.hu/internet/plsql/ogy_kpv.kepv_adat?p_azon='.$item['unique_id'];    
  $html = file_get_contents( $url );
  
  
  
  $html = iconv( 'ISO-8859-2', 'UTF-8', $html );
  $html = str_get_html( $html );
  $params = array();



  $mp_name = false;
  
  if( $html ) {
	  
	  
	  foreach( $html->find('h1') as $element ) {
		  $mp_name = $element->innertext;
		  break;
	  }
	  
	  
	  
	  $tables = array();
	  $i = 0;
	  foreach( $html->find('table') as $table_obj ) {
	    if( $i>2 ) {
	      
	      $table = array();
	      $columns = array();
	      
		    $trs = array();
		    $tri = 0;
		    foreach( $table_obj->find('tr') as $tr ) {
			    
			    $tag_names = array();
			    $tag_names_distinct = array();
			    $elements = array();
			    foreach( $tr->childNodes() as $el ) {
				    $tag_names[] = $el->tag;
				    if( !in_array($el->tag, $tag_names_distinct) )
				      $tag_names_distinct[] = $el->tag;
				    $elements[] = $el;
				  }
				  
				  
				  
				    
			    if( count($tag_names)===1 ) {
				    
				    
				    if( $tag_names[0]=='th' )
				      $table['title'] = trim( strip_tags( $el->innertext ) );
				    elseif( $tag_names[0]=='td' ) {
				      $table['subtitle'] = trim( strip_tags( $el->innertext ) );
				      continue;
				    }
				      
				    
			    } else {
				    
				    if( $tag_names_distinct[0]=='th' )
				    foreach( $elements as $el ) {
				      $columns[] = strip_tags( $el->innertext );
				    }
				    
				    
			    }
			    
				  
				  $row = array();
				  if( $tag_names_distinct==array('td') ) {
					  for( $j=0; $j<count($elements); $j++ )
					    $row[] = $elements[$j]->innertext;
					  
				  }
				  
				  if( !empty($row) )
				    $table['data'][] = $row;
				  
				  
				  
				  

			    $tri++;
		    }
		    
		    $table['columns'] = $columns;
		    $tables[] = $table;
	    
		  }
		  $i++;
	  }
	  
    
    
    
       
    
    if( $mp_name ) {
	    
	    
	    $params = array_merge($params, array(
	      'name' => addslashes( $mp_name ),
	      'status' => '3',
	      // 'tables_count' => count($tables),
	    ));
	    
	    
	    
	    // TABLES DUMP
	    
	    
	    for( $t=0; $t<count($tables); $t++ ) {
		    
		    $table_sid = md5( trim( strip_tags( $tables[$t]['title'] ) ) );		    
		    $table_params = array(
		      'sid' => $table_sid,
		      'mp_id' => $id,
		      'title' => trim( strip_tags( $tables[$t]['title'] ) ),
		      'columns_count' => count( $tables[$t]['columns'] ),
		      'rows_count' => count( $tables[$t]['data'] ),
		      'columns_str' => implode(';', $tables[$t]['columns']),
		    );
		    
		    
		    /*
		    $table_id = (int) $this->DB->selectValue("SELECT id FROM mps_tables WHERE sid='$table_sid'");
		    if( $table_id )
		      $this->DB->update_assoc('mps_tables', $table_params, $table_id);
		    else {
			    $this->DB->insert_assoc('mps_tables', $table_params);
			    $table_id = $this->DB->insert_id;
		    }
		    
		    
		    
		    $this->DB->q("UPDATE mps_tables_data SET deleted='1' WHERE table_id='$table_id'");
		    for( $ti=0; $ti<count($tables[$t]['data']); $ti++ ) {
			    for( $tj=0; $tj<count($tables[$t]['data'][$ti]); $tj++ ) {
				    
				    $this->DB->insert_update_assoc('mps_tables_data', array(
				      'table_id' => $table_id,
				      'row_i' => $ti,
				      'column_i' => $tj,
				      'text' => trim( addslashes( strip_tags( $tables[$t]['data'][$ti][$tj] ) ) ),
				      'html' => trim( addslashes( $tables[$t]['data'][$ti][$tj] ) ),
				      'deleted' => '0',
				    ));
				    
			    }
		    }
		    */
		    
		    
	    }
	    
	    
	    
    } else $params['status'] = '5';	  
  } else $params['status'] = '4';
  
  
  $file = ROOT.'/resources/w/mps/a/src/'.$id.'.jpg';
  @unlink( $file );
  copy( 'http://www.parlament.hu/kepv/kepek/'.$item['unique_id'].'.jpg', $file );
  
  
  
  return $params;
  
?>