<?
  // var_export( $_REQUEST );

  require_once('engine.php');
  if( $_PARAMS )
    $params = array_merge( $_REQUEST, $_PARAMS );
    
  $base_alias = $_PARAMS['name'];


  $filters_data = $this->DB->selectAssocs("SELECT CONCAT(api_datasets_fields.alias, '.', api_datasets_fields.field) as 'field', api_datasets_fields.tytul, api_datasets_fields.can_order, api_datasets_fields.filter_id FROM api_datasets_fields WHERE api_datasets_fields.base_alias='".$base_alias."' AND api_datasets_fields.filter_id!=0 ORDER BY api_datasets_fields.field='id' DESC, api_datasets_fields.field ASC");
  
  
  $filters = array();


	for( $i=0; $i<count($filters_data); $i++ ) {		
		$filter = $filters_data[$i];
		$filter_type_id = (int) $filter['filter_id'];
		
		switch( $filter_type_id ) {
			
			case 1: {
				
				$filters[] = epapi_dataset_filter($filter, $params);
				break;
			}
			
		}
	}
	
	


  return array(
    'filters' => $filters,
  );
?>