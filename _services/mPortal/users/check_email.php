<?
  $email = $_PARAMS;
  return array(
    'email' => $email,
    'check' => $this->DB->selectCountBoolean("SELECT COUNT(*) FROM ".DB_TABLE_users." WHERE email='$email'"),
  );
?>