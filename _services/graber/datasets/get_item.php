<?
  $i = 0;
  $limit = 1;
  
  while( $i<$limit && $id = 1 ) {
	  
	  $i++;
	  
	  $item = $this->DB->selectAssoc("SELECT id, unique_id FROM mps WHERE status='0' ORDER BY id ASC LIMIT 1");
	  $params = $this->S('graber/mps/get_item', $item);
	  
	  var_export( $item );
	  
	  $this->DB->update_assoc('mps', $params, $item['id']);
	  
  }
?>