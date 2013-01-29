<?
  if( $this->USER['type']=='fb' ) {
    $user_id = (int) $this->USER['id'];
    $user_fbid = (int) $this->USER['fb_id'];
    if( $user_id && $user_fbid ) {
    
      
      $this->DB->q("INSERT INTO m_users_deleted SELECT *, NOW(), NULL FROM m_users WHERE id='$user_id'");
      $this->DB->q("DELETE FROM m_users WHERE id='$user_id'");
      $this->logout();
      
    
    }
  }
?>