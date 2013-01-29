<?
  $dataset = addslashes( $_PARAMS['dataset'] );
  $object_id = (int) $_PARAMS['object_id'];
  
  if( !$dataset || !$object_id )
    return false;
    
  $id = $this->DB->selectValue("SELECT id FROM objects WHERE dataset='$dataset' AND object_id='$object_id' LIMIT 1");
  
  
  
  if( $id )
  
    $this->DB->update_assoc('objects', array(
      'a' => '1',
      'a_ts' => 'NOW()',
    ), $id);
    
  else {
  
    $this->DB->insert_ignore_assoc('objects', array(
      'dataset' => $dataset,
      'object_id' => $object_id,
      'a' => '1',
      'a_ts' => 'NOW()',
    ));
    $id = $this->DB->insert_id;
    
  }
  
  return $id;
?>