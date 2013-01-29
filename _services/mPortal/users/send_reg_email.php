<?
  $user_id = (int) $this->USER['id'];  
  if( !$user_id ) return false;
  
  $email_token = make_numeric_token(10);
  $this->DB->q( "UPDATE ".DB_TABLE_users." SET email_pass='$email_token', email_verified='1' WHERE id=".$user_id );  
  $USER = array_merge( $this->USER, $this->DB->selectAssoc("SELECT email_pass FROM ".DB_TABLE_users." WHERE id=".$user_id) );
  
  
  
  
  require_once(ROOT.'/_lib/smarty/Smarty.class.php');
  $smarty_folder = ROOT.'/_patterns/_SMARTY/';
  $SMARTY = new Smarty();
  $SMARTY->template_dir = $smarty_folder;
	$SMARTY->compile_dir  = $smarty_folder.'_templates_c/';
	$SMARTY->config_dir   = $smarty_folder.'_configs/';
	$SMARTY->cache_dir    = $smarty_folder.'_cache/';
	$SMARTY->assign('USER', $USER);
  
  // minify_html
  $html = ( $SMARTY->fetch( ROOT.'/_lib/mPortal/resources/email_verification.tpl' ) );
  
    
  
  
  
  
  
  
  
  
  
  require( ROOT."/_lib/PHPMailer_old/class.phpmailer.php" );

	$mail = new phpmailer;
	
	$mail->IsSMTP();
	$mail->From = "";
	$mail->FromName = "OchParliament";
	$mail->Host = "";
	$mail->AddAddress( $USER['email'], $USER['name'] );
	$mail->WordWrap = 50;
	
	$mail->IsHTML(true);
	$mail->Subject = "Rejestracja na portalu OchParliament";
	$mail->Body = $html;
	
	$mail->Send();
	
  $this->DB->q( "UPDATE ".DB_TABLE_users." SET email_verified='2' WHERE id=".$user_id );  
  $this->USER['email_verified'] = '2';
  $this->save_session();
  
  return true;
?>