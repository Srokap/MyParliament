<?
  if( empty($_PARAMS) ) return false;
  $_PARAMS['name'] = trim( $_PARAMS['name'] );
  
  $token = make_token(90);
  
  $data = array('type' => 'sm');
  $data['email'] = trim( $_PARAMS['email'] );
  $data['login_hash'] = login_hash( $_PARAMS['email'], $_PARAMS['pass'] );
  $data['bd_date'] = $_PARAMS['bd_date'];
  $data['gender'] = $_PARAMS['gender'];
  $data['postal_code'] = trim( $_PARAMS['postal_code'] );
  $data['name'] = $_PARAMS['name'] ? $_PARAMS['name'] : $data['email'];
  $data['token'] = $token;
  $data['registration_time'] = 'NOW()';
  $data['remember_me'] = $_PARAMS['remember'];
  $data['reg_ip'] = $_SERVER['REMOTE_ADDR'];
  
  $this->DB->insert_ignore_assoc( DB_TABLE_users, $data );
  
  $result = (boolean) $this->DB->affected_rows;
  
  
  if( $result ) {
    
    $this->USER = $data;
    $this->USER['id'] = $this->DB->insert_id;
    $this->USER['token'] = $token;
    
    $this->save_session();
    $this->S('mPortal/users/send_reg_email');
    
    if( $data['remember_me']=='1' )
      setcookie('sm_token', $token, time()+REMEMBER_ME_SESSION_MAXLIFE, '/');
  }

  return $result;
?>