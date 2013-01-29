<?
  $pass = $_PARAMS['pa'];
  $remember = $_PARAMS['remember'];
  
  if( strlen($pass)<4 || $this->USER['type']!='sm' ) return false;
  
  $token = make_token(90);
  
  $data = array(
    'login_hash' => login_hash( $this->USER['email'], $pass ),
    'token' => $token,
  );
  
  $this->DB->update_assoc(DB_TABLE_users, $data, $this->USER['id']);
  
  $this->USER['token'] = $token;
  $this->save_session();
  
  if( $remember=='on' ) {
    setcookie('sm_token', $token, time()+REMEMBER_ME_SESSION_MAXLIFE, '/');
  }
  
  return true;
?>