<?
  $v = $_PARAMS;
  if( strlen($v)!=10 ) return false;

  $this->DB->q( "UPDATE ".DB_TABLE_users." SET	email_verified='3' WHERE id='".$this->USER['id']."' AND email_pass='$v'" );
  $this->USER['email_verified'] = '3';
  $this->save_session();
  
  return true;
?>