<?
  if( !function_exists('_api_process_joins') ) {
	  function _api_process_joins( $alias, $joins, $table=false ){
		  
		  $result = array();
		  
		  // echo "\n_api_process_joins - alias: $alias";
		  
		  for( $i=0; $i<count($joins); $i++ ) {
		    
		    if( $joins[$i][0]==$alias ) {
		      
		   
		      
		      
		 			      
		      $_joins = $joins;
		      array_splice( $_joins , $i, 1 );
		      			      
		      
		      /*
		      if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
  
				    echo "\nDELETE  ";
					  var_export( $_aliases );
					  
				  }
		      */
		      
		      

		      // $_ai = array_search($joins[$i][0], $_aliases);
		      // if( $_ai )
		      // array_splice( $_aliases, $_ai );
		      
		      
		      
		      /*
		      if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
  
				    echo "\n\nADDING JOIN 1 ";
					  var_export( $joins[$i] );
					  
				  }
				  */
				  
		      
		      
		      if( $joins[$i][5]!=$table ) {
		        $result[] = array( $joins[$i][1], $joins[$i][2] );
		        $result = array_merge( $result, _api_process_joins( $joins[$i][1], array_values($_joins), $table ) );
		      }
		      
		    } elseif( $joins[$i][1]==$alias ) {
			    
			    				    
			    
			    $_joins = $joins;
		      array_splice( $_joins , $i, 1 );
		      			      
		      
		      /*
		      if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
  
				    echo "\nDELETE  ";
					  var_export( $_aliases );
					  
				  }
		      */
		      
		      /*
		      if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
  
				    echo "\n\nADDING JOIN 2 ";
					  var_export( $joins[$i] );
					  
				  }
		      */
		      
		      if( $joins[$i][4]!=$table ) {
			      $result[] = array( $joins[$i][0], $joins[$i][3] );
			      $result = array_merge( $result, _api_process_joins( $joins[$i][0], array_values($_joins), $table ) );
		      }
			    
		    }
		  }
		  
		  return $result;
		   
	  }
  }



  ////////////////////////////////////////////////////////////////////////////////
  // epapi_build_query

  function epapi_build_query($params){
	  	  
	  	  
	  
	  $_allowed_orders = array('ASC', 'DESC');
  
	  $base_alias = addslashes( $params['name'] );
	  $wheres = is_array( $params['w'] ) ? $params['w'] : array();
	  $layers = is_array( $params['ls'] ) ? $params['ls'] : array();
	  $keywords = is_array( $params['k'] ) ? $params['k'] : array();
	  $orders = is_array( $params['o'] ) ? $params['o'] : array();
	  

	  
	  
	  
	  $js = is_array( $params['j'] ) ? $params['j'] : array();
	  
	  $respect_limit = isset($params['rl']) ? $params['rl'] : true;
	  
	  
	  // Pobieramy dane żądanego datasetu
	  
	  
	  
	  
	  $_PARAMS = $base_alias;
	  $data = include('dataset-info.php');
	  
	  $dataset = $data['dataset'];
	  $fields = $data['fields'];
	
	  if( !$dataset )
	    return false;
	
	
	  
	
	  $limit = ( is_numeric( $params['l'] ) && $params['l']>0 ) ? $params['l'] : $dataset['limit_default'];
	
	  if( $limit<=0 || ($respect_limit && $limit>$dataset['limit_max']) )
	    $limit = $dataset['limit_max'];
	  
	  
	  $offset = (int) $params['of'];
	  
	  
	  
	  
	
	
	  if( empty($orders) ) {
	    if( $dataset['sort_field'] && $dataset['sort_direct'] )
	      $orders[] = array( $dataset['sort_field'], $dataset['sort_direct'] );
	    else
	      $orders[] = array( $fields[0][0], 'DESC' );
	  }
	
	
	
	
	
	
	  // Tworzymy zapytanie SELECT do bazy
	  
	  $query = 'SELECT SQL_CALC_FOUND_ROWS ';
	  
	  // Zaczynamy od części bezpośrednio po SELECT (pola, których żądamy). Dla każdego datasetu istnieje indywidualna lista pól, o które należy pytać. Są przechowywane w tabeli 'api_datasets_fields'
	
	  
	  if( $dataset['browse_mode']=='DBF' ) {
	  		  
		  $keys = array("`{$dataset['table']}`.`id` AS '{$dataset['base_alias']}.id'");

	  } else {
	  
	  	  
		  $q = "SELECT CONCAT('`', api_aliases.`table`, '`.`', api_fields.`key`, '` AS \'', api_datasets_fields.`alias`, '.', api_datasets_fields.`field`, '\'') FROM api_datasets_fields JOIN api_aliases ON api_datasets_fields.`alias`=api_aliases.`alias` JOIN api_fields ON (api_datasets_fields.`field`=api_fields.`field` AND api_datasets_fields.`alias`=api_fields.`alias`) WHERE api_datasets_fields.base_alias='$base_alias' AND api_datasets_fields.mode='normal'";
		  $keys = $_SERVER['M']->DB->selectValues($q);
	  
	  }
	  
	  
	  
		  
	  foreach( $layers as $layer ) {
		  
		  $ld = $_SERVER['M']->DB->selectValues("SELECT CONCAT('`', api_aliases.`table`, '`.`', api_fields.`key`, '` AS \'layer.".$layer.".', api_fields.`field`, '\'') FROM api_aliases JOIN api_fields ON api_fields.`alias`=api_aliases.`alias` WHERE api_aliases.`alias`='$layer' AND api_fields.`export`='1'");
		  if( $ld )
		    $keys = array_merge($keys, $ld);
		  
	  }
	  
	  
	  
	  
	  
	  if( empty($keys) )
	    return false;
	  
	  
	  if( $respect_limit )
	    $query .= implode(', ', $keys).' FROM `'.$dataset['table'].'` ';
	  else
	    $query .= '`'.$data['dataset']['table'].'`.`'.$data['dataset']['id_key'].'` FROM `'.$dataset['table'].'` ';
	  
	    
	  
	  
	  
	  
	  
	  
	  
	  
	  // Teraz pobieramy tabele, po których ma odbyć się wyszukiwanie (ewentualne JOINY). W poprzednim zapytaniu pobieraliśmy listę pól. Każde pole ma przypisany `alias`. Tabela 'api_aliases_connections' zawiera informacje o sposobie łączenia się ze sobą aliasów.
	  
	  
	  $_aliases = $_SERVER['M']->DB->selectValues("SELECT DISTINCT(alias) FROM api_datasets_fields WHERE base_alias='$base_alias' AND `alias`!='' AND `mode`='normal'");
	  $_aliases = array_merge( $_aliases, $js );
	  
	  
	  
	  

	  
	  
	  

			
	  $js = $_aliases;
	  for( $i=0; $i<count($js); $i++ ) {
	    
	    $q = "SELECT map FROM api_joins_map WHERE (alias_a='$base_alias' AND alias_b='".addslashes($js[$i])."') OR (alias_b='$base_alias' AND alias_a='".addslashes($js[$i])."') LIMIT 1";
	    $_aliases = array_merge($_aliases, explode(',', $_SERVER['M']->DB->selectValue($q)));
		
		}
		
		
		
		
		
	
		for( $i=0; $i<count($wheres); $i++ ) {
		  
		  $parts = explode('.', $wheres[$i][0]);
		  $parts_count = count($parts);
		  if( $parts_count<2 )
		    break;
		  
		  $balias = $parts[$parts_count-2];
		  
		  if( $params['name']=='legislacja_projekty_uchwal' && $balias=='legislacja_projekty_ustaw' )
		    $balias = 'legislacja_projekty_uchwal';
		  
		  $_aliases[] = $balias;
		  $q = "SELECT map FROM api_joins_map WHERE (alias_a='$base_alias' AND alias_b='$balias') OR (alias_b='$base_alias' AND alias_a='$balias') LIMIT 1";
		  // echo "\n".$q;
		  
		  
		  
		  $_aliases = array_merge($_aliases, explode(',', $_SERVER['M']->DB->selectValue($q)));
		  
	  }
	  
	 		
		
		
	  
		  
	  
	  $_aliases = array_values( array_filter( array_unique( $_aliases ) ) );
	  

	  




  
		  
	  $_aliases_str_a = "api_aliases_connections.`alias_a`='".implode("' OR api_aliases_connections.`alias_a`='", $_aliases)."'";
	  $_aliases_str_b = "api_aliases_connections.`alias_b`='".implode("' OR api_aliases_connections.`alias_b`='", $_aliases)."'";
	  
	  
	  $q = "SELECT a.`alias`, b.`alias`, CONCAT('JOIN `', b.`table`, '` ON `', a.`table`, '`.`', api_aliases_connections.alias_a_key, '` = `', b.`table`, '`.`', api_aliases_connections.alias_b_key, '`'), CONCAT('JOIN `', a.`table`, '` ON `', b.`table`, '`.`', api_aliases_connections.alias_b_key, '` = `', a.`table`, '`.`', api_aliases_connections.alias_a_key, '`'), a.table, b.table FROM api_aliases_connections JOIN api_aliases as a ON api_aliases_connections.alias_a=a.`alias` JOIN api_aliases as b ON api_aliases_connections.alias_b=b.`alias` WHERE ($_aliases_str_a) AND ($_aliases_str_b)";
	  // echo "\n\n$q\n\n";
	  

	  
	  $joins = $_SERVER['M']->DB->selectRows($q);
    
    
    
    
	  
	  $_joins = array();
	  $_alias = $base_alias;
	  
	  $run = true;

	  
	  $_joins = _api_process_joins( $base_alias, $joins, $dataset['table'] );
	  
	  $joins = array();
	  $_used_aliases = array( $base_alias );
	  foreach( $_joins as $j ) {
		  
		  if( !in_array($j[0], $_used_aliases) ) {
		    $joins[] = $j[1];
		    $_used_aliases[] = $j[0];
		  }
		  
	  }
	  
	  
	  
	  
	  
	  
	  
	  /*
	  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
		  
			  echo "\n\n\n\n\n";
			  var_export( $dataset['table'] );
			  echo "\n\n";
			  var_export( $joins );
						  
	  }
	  */
	  
	  
	  
	  	
		  
	  if( $joins )
	    $query .= implode(' ', $joins).' ';
	
	
	
	
	
	  
	  
	  

	  
	  
	  // dodajemy obsługę WHERE
	  
	  // var_export( $wheres );
	  
	  $_wheres = array();
	  
	  

	  
	  $fixed = $_SERVER['M']->DB->selectAssocs("SELECT `alias`, field, fixed_value FROM api_fields WHERE (`alias`='".implode("' OR `alias`='", $_aliases)."') AND fixed_value!=''");
	  for( $i=0; $i<count($fixed); $i++ )
	    $wheres[] = array(
	      $fixed[$i]['alias'].'.'.$fixed[$i]['field'],
	      '=',
	      $fixed[$i]['fixed_value'],
	    );
	  
	  
	  
	  
	  for( $i=0; $i<count($wheres); $i++ ) {
		  
		  $parts = explode('.', $wheres[$i][0]);
		  $parts_count = count($parts);
		  if( $parts_count<2 )
		    break;
		  
		  $balias = $parts[$parts_count-2];
		  $field = $parts[$parts_count-1];
		  
		  
		  $sql_key = $_SERVER['M']->DB->selectValue("SELECT CONCAT('`', api_aliases.`table`, '`.`', api_fields.`key`, '`') FROM api_aliases JOIN api_fields ON api_aliases.alias=api_fields.alias WHERE api_aliases.alias='$balias' AND api_fields.alias='$balias' AND api_fields.`field`='$field' LIMIT 1");
		  
		  /*
		  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
		  
			  echo "\n\n\n\n\n";
			  var_export( $balias.'.'.$field );
			  echo "\n";
			  var_export( $sql_key );
			  
		  }
		  */
		  
		  
		  if( $sql_key )
		    $_wheres[] = array(
		      'sql_key' => $sql_key,
		      'operator' => $wheres[$i][1],
		      'value' => $wheres[$i][2],
		    );
		  
		 
		  
	  }
	  
	  
	
	
	  
	  
	  
	  $wheres = array();
	
	  for( $i=0; $i<count($_wheres); $i++ ) {
		  
		  $sql_key = $_wheres[$i]['sql_key'];
		  $operator = strtoupper( $_wheres[$i]['operator'] );
		  
		  if( !is_array( $_wheres[$i]['value'] ) )
		    $value = addslashes( $_wheres[$i]['value'] );
		  
		  if( $value!='NOW()' )
		    $value = "'".$value."'";
		  
		  switch( $operator ) {
			  
			  case '=': {
				  
				  $wheres[] = $sql_key.'='.$value;
				  break;
				  
			  }
			  
			  case 'IN': {
				  
				  $varray = $_wheres[$i]['value'];
				  $_p = array();
				  if( is_array($varray) && !empty($varray) )
				    foreach( $varray as $v )
				      $_p[] = $sql_key.'='.addslashes( $v );
				    
				  $wheres[] = '('.implode( ' OR ' , $_p).')';
				  
				  break;
				  
			  }
			  
			  case 'BETWEEN': {
				  
				  $wheres[] = $sql_key . '>=' . $_wheres[$i]['value'][0] . ' AND ' . $sql_key . '<=' . $_wheres[$i]['value'][1];
				  break;
				  
				  break;
				  
			  }
			  
			  case 'LIKE': {
				  
				  $wheres[] = $sql_key.' LIKE '.$value;
				  break;
				  
			  }
			  
			  case '!=': {
				  
				  $wheres[] = $sql_key.'!='.$value;
				  break;
				  
			  }
			  
			  case '>': {
				  
				  $wheres[] = $sql_key.'>'.$value;
				  break;
				  
			  }
			  
			  case '<': {
				  
				  $wheres[] = $sql_key.'<'.$value;
				  break;
				  
			  }
			  
			  case '>=': {
				  
				  $wheres[] = $sql_key.'>='.$value;
				  break;
				  
			  }
			  
			  case '<=': {
				  
				  $wheres[] = $sql_key.'<='.$value;
				  break;
				  
			  }
			  
			  case 'IN_LAST_MONTHS': {
				  
				  $wheres[] = "TIMESTAMPDIFF(MONTH, $sql_key, NOW())<".$value;			  
				  break;
				  
			  }
			  
		  }
	  }
	  
	  
	  
	  
	  // var_export( $keywords );
	  if( $dataset['fts_columns'] && !empty($keywords) )
		  for( $i=0; $i<count($keywords); $i++ )
		    if( $keywords[$i] ) {
	        
	        switch( $dataset['fts_mode'] ) {
		        
		        case 'FULLTEXT': {
			        $wheres[] = "MATCH (".$dataset['fts_columns'].") AGAINST ('".addslashes( $keywords[$i] )."')";
			        break;
		        }
		        
		        case 'FULLTEXT-BOOLEAN': {
			        $wheres[] = "MATCH (".$dataset['fts_columns'].") AGAINST ('".addslashes( $keywords[$i] )."' IN BOOLEAN MODE)";
			        break;
		        }
		        
		        case 'EQUALITY': {
			        $wheres[] = "`".$dataset['fts_columns']."`='".addslashes( $keywords[$i] )."'";
			        break;
		        }
		        
	        }
	        
	        
	      
	      }
	  
	  
	  // var_export( $wheres );
	
	  if( !empty($wheres) )
	    $query .= 'WHERE ('.implode(') AND (', $wheres).') ';
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  // dodajemy obsługę ORDER BY
	  
	  
	  // if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
		  // echo "\n\n\n\n\n\n";
		  // var_export( $orders );
	  // }
	  
	  $_orders = array();
	  for( $i=0; $i<count($orders); $i++ ) {
		  	  
		  $parts = explode('.', $orders[$i][0]);
		  $parts_count = count($parts);
		  if( $parts_count<2 )
		    break;
		  
		  $balias = $parts[$parts_count-2];
		  $field = $parts[$parts_count-1];
		  
		  
		  if( $field=='RAND' ) {
			  
			  $_orders = array('RAND()');
			  
		  } else {
		  
			  $sql_key = $_SERVER['M']->DB->selectValue("SELECT CONCAT('`', api_aliases.`table`, '`.`', api_fields.`key`, '`') FROM api_aliases JOIN api_fields ON api_aliases.alias=api_fields.alias WHERE api_aliases.alias='$balias' AND api_fields.`field`='$field' LIMIT 1");
			  
			  // if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
				  // echo "\n\n\n\n\n\n";
				  // var_export( $orders );
			  // }
			  
			  $direction = in_array($orders[$i][1], $_allowed_orders) ? $orders[$i][1] : $_allowed_orders[0];
			  
			  if( $sql_key )
			    $_orders[] = $sql_key.' '.$direction;
		  
		  }
		 
		  
	  }
	  
	 
	  
	  
	  
	  
	  if( !empty($data['dataset']['table']) )
	    $query .= 'GROUP BY `'.$data['dataset']['table'].'`.`'.$data['dataset']['id_key'].'` ';
	  
	  
	  
	  if( !empty($_orders) )
	    $query .= 'ORDER BY '.implode(', ', $_orders).' ';
	    
	    
	  /* 
	  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
		  echo "\n\n";
		  echo( $query );
	  }
	  */
	  
	  
	  
	  
	  
	  $offset = max( $offset, 0 );
	  $query .= 'LIMIT '.$offset.','.$limit;
	  
	  
	  $return = array(
	    'dataset' => $dataset,
	    'query' => $query,
	    'limit' => $limit,
	    'order' => $orders[0],
	  );
	  return $return;
	  
	  
	  
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  ////////////////////////////////////////////////////////////////////////////////
  // epapi_build_count_query
  
  function epapi_build_count_query($params){
	  	  
	  
  
	  $base_alias = addslashes( $params['name'] );
	  $wheres = is_array( $params['w'] ) ? $params['w'] : array();
	  $keywords = is_array( $params['k'] ) ? $params['k'] : array();
	  $js = is_array( $params['j'] ) ? $params['j'] : array();
	  
	  
	  
	  // Pobieramy dane żądanego datasetu
	  
	  $_PARAMS = $base_alias;
	  $data = include('dataset-info.php');
	  
	  $dataset = $data['dataset'];
	  $fields = $data['fields'];
	
	  if( !$dataset )
	    return false;
	
	
	
	  	
	
	  // Tworzymy zapytanie SELECT do bazy
	  
	  $query = 'SELECT COUNT(*) FROM `'.$dataset['table'].'` ';

	  
	  
	    
	  
	  
	  
	  
	  
	  
	  
	  
	  // Teraz pobieramy tabele, po których ma odbyć się wyszukiwanie (ewentualne JOINY). W poprzednim zapytaniu pobieraliśmy listę pól. Każde pole ma przypisany `alias`. Tabela 'api_aliases_connections' zawiera informacje o sposobie łączenia się ze sobą aliasów.
	  
	  
	  $_aliases = $_SERVER['M']->DB->selectValues("SELECT DISTINCT(alias) FROM api_datasets_fields WHERE base_alias='$base_alias' AND `alias`!=''");
	  $_aliases = array_merge( $_aliases, $js );
	  
	  for( $i=0; $i<count($js); $i++ )
	    $_aliases = array_merge($_aliases, explode(',', $_SERVER['M']->DB->selectValue("SELECT map FROM api_joins_map WHERE (alias_a='$base_alias' AND alias_b='".addslashes($js[$i])."') OR (alias_b='$base_alias' AND alias_a='".addslashes($js[$i])."') LIMIT 1")));
		    
	
	  // var_export( $wheres );
		for( $i=0; $i<count($wheres); $i++ ) {
		  
		  $parts = explode('.', $wheres[$i][0]);
		  $parts_count = count($parts);
		  if( $parts_count<2 )
		    break;
		  
		  $balias = $parts[$parts_count-2];
		  
		  $_aliases[] = $balias;
		  $_aliases = array_merge($_aliases, explode(',', $_SERVER['M']->DB->selectValue("SELECT map FROM api_joins_map WHERE (alias_a='$base_alias' AND alias_b='$balias') OR (alias_b='$base_alias' AND alias_a='$balias') LIMIT 1")));
		  
	  }
		  
	  
	  $_aliases = array_values( array_filter( array_unique( $_aliases ) ) );
	  
	  
	    /*
	    if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
		  
			  echo "\n\n\n\n\n";
			  var_export( $_aliases );
						  
		  }	
		  */
	  
	  $_aliases_str_a = "api_aliases_connections.`alias_a`='".implode("' OR api_aliases_connections.`alias_a`='", $_aliases)."'";
	  $_aliases_str_b = "api_aliases_connections.`alias_b`='".implode("' OR api_aliases_connections.`alias_b`='", $_aliases)."'";
	  
	  
	  $q = "SELECT a.`alias`, b.`alias`, CONCAT('JOIN `', b.`table`, '` ON `', a.`table`, '`.`', api_aliases_connections.alias_a_key, '` = `', b.`table`, '`.`', api_aliases_connections.alias_b_key, '`'), CONCAT('JOIN `', a.`table`, '` ON `', b.`table`, '`.`', api_aliases_connections.alias_b_key, '` = `', a.`table`, '`.`', api_aliases_connections.alias_a_key, '`'), a.table, b.table FROM api_aliases_connections JOIN api_aliases as a ON api_aliases_connections.alias_a=a.`alias` JOIN api_aliases as b ON api_aliases_connections.alias_b=b.`alias` WHERE ($_aliases_str_a) AND ($_aliases_str_b)";
	  // echo "\n\n$q\n\n";
	  
	  
	  $joins = $_SERVER['M']->DB->selectRows($q);
	  
	  
	



	  
	  
	  $_joins = array();
	  $_alias = $base_alias;
	  
	  $run = true;
	
	  
	  $_joins = _api_process_joins( $base_alias, $joins, $dataset['table'] );
	  
	  $joins = array();
	  $_used_aliases = array( $base_alias );
	  foreach( $_joins as $j ) {
		  
		  if( !in_array($j[0], $_used_aliases) ) {
		    $joins[] = $j[1];
		    $_used_aliases[] = $j[0];
		  }
		  
	  }

	  
	  if( $joins )
	    $query .= implode(' ', $joins).' ';	
	
	
	
	  
	  
	  
	  
	  // dodajemy obsługę WHERE
	  
	  // var_export( $wheres );
	  
	  $_wheres = array();
	  
	  $fixed = $_SERVER['M']->DB->selectAssocs("SELECT `alias`, field, fixed_value FROM api_fields WHERE (`alias`='".implode("' OR `alias`='", $_aliases)."') AND fixed_value!=''");
	  for( $i=0; $i<count($fixed); $i++ )
	    $wheres[] = array(
	      $fixed[$i]['alias'].'.'.$fixed[$i]['field'],
	      '=',
	      $fixed[$i]['fixed_value'],
	    );
	  
	  for( $i=0; $i<count($wheres); $i++ ) {
		  
		  $parts = explode('.', $wheres[$i][0]);
		  $parts_count = count($parts);
		  if( $parts_count<2 )
		    break;
		  
		  $balias = $parts[$parts_count-2];
		  $field = $parts[$parts_count-1];
		  
		  
		  $sql_key = $_SERVER['M']->DB->selectValue("SELECT CONCAT('`', api_aliases.`table`, '`.`', api_fields.`key`, '`') FROM api_aliases JOIN api_fields ON api_aliases.alias=api_fields.alias WHERE  api_aliases.alias='$balias' AND api_fields.alias='$balias' AND api_fields.`field`='$field' LIMIT 1");
		  
		  
		  if( $sql_key )
		    $_wheres[] = array(
		      'sql_key' => $sql_key,
		      'operator' => $wheres[$i][1],
		      'value' => $wheres[$i][2],
		    );
		  
		 
		  
	  }
	  
	  
	
	  
	  
	  
	  $wheres = array();
	
	  for( $i=0; $i<count($_wheres); $i++ ) {
		  
		  $sql_key = $_wheres[$i]['sql_key'];
		  $operator = strtoupper( $_wheres[$i]['operator'] );
		  $value = addslashes( $_wheres[$i]['value'] );
		  
		  if( $value!='NOW()' )
		    $value = "'".$value."'";
		  
		  switch( $operator ) {
			  
			  case '=': {
				  
				  $wheres[] = $sql_key.'='.$value;
				  break;
				  
			  }
			  
			  case 'IN': {
				  
				  $varray = $_wheres[$i]['value'];
				  $_p = array();
				  if( is_array($varray) && !empty($varray) )
				    foreach( $varray as $v )
				      $_p[] = $sql_key.'='.addslashes( $v );
				    
				  $wheres[] = '('.implode( ' OR ' , $_p).')';
				  
				  break;
				  
			  }
			  
			  case 'LIKE': {
				  
				  $wheres[] = $sql_key.' LIKE '.$value;
				  break;
				  
			  }
			  
			  case 'BETWEEN': {
				  
				  $wheres[] = $sql_key . '>=' . $_wheres[$i]['value'][0] . ' AND ' . $sql_key . '<=' . $_wheres[$i]['value'][1];
				  break;
				  
				  break;
				  
			  }
			  
			  case '!=': {
				  
				  $wheres[] = $sql_key.'!='.$value;
				  break;
				  
			  }
			  
			  case '>': {
				  
				  $wheres[] = $sql_key.'>'.$value;
				  break;
				  
			  }
			  
			  case '<': {
				  
				  $wheres[] = $sql_key.'<'.$value;
				  break;
				  
			  }
			  
			  case '>=': {
				  
				  $wheres[] = $sql_key.'>='.$value;
				  break;
				  
			  }
			  
			  case '<=': {
				  
				  $wheres[] = $sql_key.'<='.$value;
				  break;
				  
			  }
			  
			  case 'IN_LAST_MONTHS': {
				  
				  $wheres[] = "TIMESTAMPDIFF(MONTH, $sql_key, NOW())<".$value;			  
				  break;
				  
			  }
			  
		  }
	  }
	  
	  
	  
	  
	  // var_export( $keywords );
	  if( $dataset['fts_columns'] && !empty($keywords) )
		  for( $i=0; $i<count($keywords); $i++ )
		    if( $keywords[$i] )
	        $wheres[] = "MATCH (".$dataset['fts_columns'].") AGAINST ('".addslashes( $keywords[$i] )."')";
	  
	  
	  // var_export( $wheres );
	
	  if( !empty($wheres) )
	    $query .= 'WHERE ('.implode(') AND (', $wheres).') ';
	  
	  
	  	  
	  /*
	  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
		  
			  echo "\n\n\n\n\n";
			  var_export( $query );
						  
		  }
	  */
	  
	 	  
	 
	  
	  $return = array(
	    'dataset' => $dataset,
	    'query' => $query,
	  );
	  return $return;
	  
	  
	  
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  ////////////////////////////////////////////////////////////////////////////////
  // epapi_dataset_filter
  
  function epapi_dataset_filter( $dataset, $params, $field ){
	    
	  $base_alias = $dataset->data['base_alias'];
	  $wheres = is_array( $params['w'] ) ? $params['w'] : array();
	  $keywords = is_array( $params['k'] ) ? $params['k'] : array();
	  
	  
	  $js = is_array( $params['j'] ) ? $params['j'] : array();

	  // $js[] = $field
	  
	  if( !$dataset )
	    return false;
	  
	  
	  $filter_params = false;
	  for( $i=0; $i<count($dataset->fields); $i++ ) {		  
		  if( $dataset->fields[$i]['field']==$field ) {
			  $filter_params = $dataset->fields[$i]['filter_params'];
			  break;
		  }
		}		
		if( $filter_params )
		  $filter_params = json_decode( $filter_params, true );
		    
		if( !$filter_params )
		  return false;
	  
	  $js[] = $filter_params['dataset'];
	  
	  
	  
	  
	  $query = "SELECT ".$filter_params['group_key_id']." as 'id', ".$filter_params['group_key_name']." as 'label', COUNT(*) as 'count' FROM `".$dataset->data['table'].'` ';
	  
	  
	  
	  // Teraz pobieramy tabele, po których ma odbyć się wyszukiwanie (ewentualne JOINY). W poprzednim zapytaniu pobieraliśmy listę pól. Każde pole ma przypisany `alias`. Tabela 'api_aliases_connections' zawiera informacje o sposobie łączenia się ze sobą aliasów.
	  
	  
	  $_aliases = $_SERVER['M']->DB->selectValues("SELECT DISTINCT(alias) FROM api_datasets_fields WHERE base_alias='$base_alias' AND `alias`!=''");
	  $_aliases = array_merge( $_aliases, $js );
	
	  for( $i=0; $i<count($js); $i++ )
	    $_aliases = array_merge($_aliases, explode(',', $_SERVER['M']->DB->selectValue("SELECT map FROM api_joins_map WHERE (alias_a='$base_alias' AND alias_b='".addslashes($js[$i])."') OR (alias_b='$base_alias' AND alias_a='".addslashes($js[$i])."') LIMIT 1")));
	    
		    
	
	  $_wheres;
		for( $i=0; $i<count($wheres); $i++ ) {
		  
		  $parts = explode('.', $wheres[$i][0]);
		  $parts_count = count($parts);
		  if( $parts_count<2 )
		    break;
		  
		  $balias = $parts[$parts_count-2];
		  $bfield = $parts[$parts_count-1];
		  
		  if( $balias.'.'.$bfield != $field ) {
		  
			  $_aliases[] = $balias;
			  $_aliases = array_merge($_aliases, explode(',', $_SERVER['M']->DB->selectValue("SELECT map FROM api_joins_map WHERE (alias_a='$base_alias' AND alias_b='$balias') OR (alias_b='$base_alias' AND alias_a='$balias') LIMIT 1")));
        $_wheres[] = $wheres[$i];
        
		  }
	  }
	  $wheres = $_wheres;
	 
	  
	  $_aliases = array_values( array_filter( array_unique( $_aliases ) ) );
	  
	
	  
	  $_aliases_str_a = "api_aliases_connections.`alias_a`='".implode("' OR api_aliases_connections.`alias_a`='", $_aliases)."'";
	  $_aliases_str_b = "api_aliases_connections.`alias_b`='".implode("' OR api_aliases_connections.`alias_b`='", $_aliases)."'";
	  
	  
	  $q = "SELECT a.`alias`, b.`alias`, CONCAT('JOIN `', b.`table`, '` ON `', a.`table`, '`.`', api_aliases_connections.alias_a_key, '` = `', b.`table`, '`.`', api_aliases_connections.alias_b_key, '`'), CONCAT('JOIN `', a.`table`, '` ON `', b.`table`, '`.`', api_aliases_connections.alias_b_key, '` = `', a.`table`, '`.`', api_aliases_connections.alias_a_key, '`'), a.table, b.table FROM api_aliases_connections JOIN api_aliases as a ON api_aliases_connections.alias_a=a.`alias` JOIN api_aliases as b ON api_aliases_connections.alias_b=b.`alias` WHERE ($_aliases_str_a) AND ($_aliases_str_b)";
	  // echo "\n\n$q\n\n";
	  $joins = $_SERVER['M']->DB->selectRows($q);
	  
	  
	  
	  $_joins = array();
	  $_alias = $base_alias;
	  
	  $run = true;
	  
	  
	  
	  
	  $_joins = _api_process_joins( $base_alias, $joins, $dataset->data['table'] );
	  
	  $joins = array();
	  $_used_aliases = array( $base_alias );
	  foreach( $_joins as $j ) {
		  
		  if( !in_array($j[0], $_used_aliases) ) {
		    $joins[] = $j[1];
		    $_used_aliases[] = $j[0];
		  }
		  
	  }
	  
	  if( $joins )
	    $query .= implode(' ', $joins).' ';
	

	  
	  
	  // dodajemy obsługę WHERE
	  	  
	  $_wheres = array();
	  
	  $fixed = $_SERVER['M']->DB->selectAssocs("SELECT `alias`, field, fixed_value FROM api_fields WHERE (`alias`='".implode("' OR `alias`='", $_aliases)."') AND fixed_value!=''");
	  for( $i=0; $i<count($fixed); $i++ )
	    $wheres[] = array(
	      $fixed[$i]['alias'].'.'.$fixed[$i]['field'],
	      '=',
	      $fixed[$i]['fixed_value'],
	    );
	  
	  
	  
	  
	  
	  
	  for( $i=0; $i<count($wheres); $i++ ) {
		  
		  $parts = explode('.', $wheres[$i][0]);
		  $parts_count = count($parts);
		  if( $parts_count<2 )
		    break;
		  
		  $balias = $parts[$parts_count-2];
		  $field = $parts[$parts_count-1];
		  
		  
		  $sql_key = $_SERVER['M']->DB->selectValue("SELECT CONCAT('`', api_aliases.`table`, '`.`', api_fields.`key`, '`') FROM api_aliases JOIN api_fields ON api_aliases.alias=api_fields.alias WHERE  api_aliases.alias='$balias' AND api_fields.alias='$balias' AND api_fields.`field`='$field' LIMIT 1");
		  
		  
		  if( $sql_key )
		    $_wheres[] = array(
		      'sql_key' => $sql_key,
		      'operator' => $wheres[$i][1],
		      'value' => $wheres[$i][2],
		    );
		  
		 
		  
	  }
	  
	  
	
	
	  
	  
	  
	  $wheres = array();
	
	  for( $i=0; $i<count($_wheres); $i++ ) {
		  
		  $sql_key = $_wheres[$i]['sql_key'];
		  
		  $operator = strtoupper( $_wheres[$i]['operator'] );
		  $value = addslashes( $_wheres[$i]['value'] );
		  
		  if( $value!='NOW()' )
		    $value = "'".$value."'";
		  
		  switch( $operator ) {
			  
			  case '=': {
				  
				  $wheres[] = $sql_key.'='.$value;
				  break;
				  
			  }
			  
			  case 'LIKE': {
				  
				  $wheres[] = $sql_key.' LIKE '.$value;
				  break;
				  
			  }
			  
			  case '!=': {
				  
				  $wheres[] = $sql_key.'!='.$value;
				  break;
				  
			  }
			  
			  case '>': {
				  
				  $wheres[] = $sql_key.'>'.$value;
				  break;
				  
			  }
			  
			  case '<': {
				  
				  $wheres[] = $sql_key.'<'.$value;
				  break;
				  
			  }
			  
			  case '>=': {
				  
				  $wheres[] = $sql_key.'>='.$value;
				  break;
				  
			  }
			  
			  case '<=': {
				  
				  $wheres[] = $sql_key.'<='.$value;
				  break;
				  
			  }
			  
			  case 'IN_LAST_MONTHS': {
				  
				  $wheres[] = "TIMESTAMPDIFF(MONTH, $sql_key, NOW())<".$value;			  
				  break;
				  
			  }
			  
		  }
	  }
	  
	  
	  if( $dataset->data['fts_columns'] && !empty($keywords) )
		  for( $i=0; $i<count($keywords); $i++ )
		    if( $keywords[$i] )
	        $wheres[] = "MATCH (".$dataset->data['fts_columns'].") AGAINST ('".addslashes( $keywords[$i] )."')";
	  
	  
	  // var_export( $wheres );
	
	  if( !empty($wheres) )
	    $query .= 'WHERE ('.implode(') AND (', $wheres).') ';
	  
	  
	  
	  
	  
	  
	  $query .= "GROUP BY ".$filter_params['group_key_id']." ORDER BY COUNT(*) DESC";
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  /*
	  if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' ) {
	    echo $query;
	    die();
	  }
	  */
	  
	  // echo $query;
	  
		  
	  
	  return $_SERVER['M']->DB->selectRows( $query );

	  
	  
	  
  }