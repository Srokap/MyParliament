<?
  list( $old_id, $new_id ) = $_PARAMS;
  if( empty($old_id) || empty($new_id) ) return 0;
  
  $exist = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_pages." WHERE id='$new_id'");
  if( $exist ) return;
  
  $this->DB->q("UPDATE ".DB_TABLE_pages." SET id='$new_id' WHERE id='$old_id'");
  $this->DB->q("UPDATE ".DB_TABLE_pages_access." SET page='$new_id' WHERE page='$old_id'");
  $this->DB->q("UPDATE ".DB_TABLE_pages_components." SET page='$new_id' WHERE page='$old_id'");
  $this->DB->q("UPDATE ".DB_TABLE_pages_libs." SET page='$new_id' WHERE page='$old_id'");
  $this->DB->q("UPDATE ".DB_TABLE_services." SET page='$new_id' WHERE page='$old_id'");
  $this->DB->q("UPDATE ".DB_TABLE_services_access." SET page='$new_id' WHERE page='$old_id'");
  
  rename( ROOT.'/_pages/'.$old_id, ROOT.'/_pages/'.$new_id );
  foreach( array('.php', '.tpl', '.js', '.css', '-inline.js', '-inline.css') as $ext ){
  	@rename( ROOT.'/_pages/'.$new_id.'/'.filename($old_id).$ext, ROOT.'/_pages/'.$new_id.'/'.filename($new_id).$ext );
  }
?>