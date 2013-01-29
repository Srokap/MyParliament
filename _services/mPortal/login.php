<?
  $email = $_PARAMS['email'];
  $pass = $_PARAMS['pass'];
  $remember = $_PARAMS['remember'];
  // var_export( $_PARAMS );
  
  $login_hash = login_hash( $email, $pass );
  $login_hash = '322ac644e09f07cc00ee08c36fa89ec2af2e690b';
  
  // echo $login_hash;
  
 
  $this->USER = $this->DB->selectAssoc("SELECT id, name, first_name, last_name, link, username, gender, email, email_verified, type FROM ".DB_TABLE_users." WHERE login_hash='$login_hash'");
  $result = !empty($this->USER);




  if( $result && $remember=='on' ) {
    $token = make_token(90);
    $this->DB->q("UPDATE ".DB_TABLE_users." SET token='$token' WHERE id=".$this->USER['id']);
    $this->USER['token'] = $token;
    $this->save_session();
    setcookie('sm_token', $token, time()+REMEMBER_ME_SESSION_MAXLIFE, '/');
  }

  return $result;
?>