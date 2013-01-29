<?
  // echo sm_wiek( $data );
  // die();


  
  
  $dataset = new ep_Dataset( $this->DATASET_BASE_ALIAS );
	$dataset->get_info();
    
  if( $dataset->name=='sejm_kluby' )
    $dataset->init_where('id', '!=', '7');
  elseif( $dataset->name=='sejm_posiedzenia' )
    $dataset->init_where('zapowiedz', '=', '0');
  elseif( $dataset->name=='poslowie_wspolpracownicy' )
    $dataset->init_where('nazwa', '!=', '');
  elseif( $dataset->name=='ustawy' )
    $dataset->init_where('prawo.status_id', '=', '1');
  
  $this->TITLE = $dataset->data['name'];
  $this->SMARTY->assign('dataset', $dataset);
?>