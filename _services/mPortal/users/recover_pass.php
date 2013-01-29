<?
  $email = $_PARAMS; 
  $USER = $this->DB->selectAssoc("SELECT id, name, email FROM ".DB_TABLE_users." WHERE type='sm' AND email='$email' LIMIT 1");
  if( empty($USER) ) return false;  
  
  
  $pass = create_password(10);
  $hash = login_hash( $USER['email'], $pass );
  
  require_once(ROOT.'/_lib/smarty/Smarty.class.php');
  $smarty_folder = ROOT.'/_patterns/_SMARTY/';
  $SMARTY = new Smarty();
  $SMARTY->template_dir = $smarty_folder;
	$SMARTY->compile_dir  = $smarty_folder.'_templates_c/';
	$SMARTY->config_dir   = $smarty_folder.'_configs/';
	$SMARTY->cache_dir    = $smarty_folder.'_cache/';
	$SMARTY->assign('USER', $USER);
	$SMARTY->assign('pass', $pass);
  
  // minify_html
  $html = ( $SMARTY->fetch( ROOT.'/_lib/mPortal/resources/recover_pass.tpl' ) );
  

  
  
  
  
  
  
  
  
  
  require( ROOT."/_lib/PHPMailer_old/class.phpmailer.php" );

	$mail = new phpmailer;	
	$mail->IsSMTP();
	$mail->From = "";
	$mail->FromName = "OchParliament";
	$mail->Host = "";
	$mail->AddAddress( $USER['email'], $USER['name'] );
	$mail->WordWrap = 50;
	
	$mail->IsHTML(true);
	$mail->Subject = "Nowe hasło do portalu OchParliament";
	$mail->Body = $html;
	
	$mail->Send();
	
  $this->DB->q( "UPDATE ".DB_TABLE_users." SET login_hash='$hash' WHERE id=".$USER['id'] );  

  return false;
?>