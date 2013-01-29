<?
  if( $this->USER['type']=='fb' ) {
    $user_id = (int) $this->USER['id'];
    $user_fbid = (int) $this->USER['fb_id'];
    if( $user_id && $user_fbid ) {
    
      var_export( $this->USER );
    
    }
  }
?>