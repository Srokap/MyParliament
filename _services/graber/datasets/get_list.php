<?
  $datasets = array(
    array(
      'id' => 'mps',
      'table' => 'mps',
    ),
  );
  
  foreach( $datasets as $dataset ) {
	  
	  $unique_ids = $this->S('graber/' . $dataset['id'] . '/get_list');
	  
	  var_export( $unique_ids );
	  
	  foreach( $unique_ids as $unique_id )
	    $this->DB->insert_update_assoc($dataset['table'], array(
	      'unique_id' => addslashes( $unique_id ),
	      'status' => '0',
	      'status_ts' => 'NOW()',
	    ));
	  
	  
	  
  }
  
?>