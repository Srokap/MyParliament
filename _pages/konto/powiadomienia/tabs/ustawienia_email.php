<?php
$auth_token = '';
//$news_email_freq = '';
$news_email_freq_err = 'ok';

if( isset( $_POST['save_ustawienia_email'] ) ){
	$act_tab = 'ustawienia_email';
	
	if( !isset( $_SESSION['mPortal']['auth_token'] ) || !isset( $_POST['auth_token'] ) || $_SESSION['mPortal']['auth_token'] != $_POST['auth_token'] ){
		header ("Location: /konto/powiadomienia");
		die();
	} 
	
	if( isset( $_POST['news_email_freq'] ) && $_POST['news_email_freq'] != '' && ctype_digit( $_POST['news_email_freq'] ) ){
		$news_email_freq_tmp = (int) $_POST['news_email_freq'];
		if( $news_email_freq_tmp >= 0 && $news_email_freq_tmp <= 3 ){
			$news_email_freq = $news_email_freq_tmp;
		} else {
			$news_email_freq_err = 'invalid';
		}
				
	} else {
		$news_email_freq_err = 'required';
	}
	

	if( $news_email_freq_err === 'ok' ){
		$this->DB->q( "UPDATE ".DB_TABLE_users." SET news_email_freq='$news_email_freq' WHERE id=".$this->USER['id'] );
		$_SESSION['mPortal']['msg'] = $act_tab;
		header ("Location: /konto/powiadomienia");
		die();				
	}
	
}

$this->SMARTY->assign( 'news_email_freq', $news_email_freq );
$this->SMARTY->assign( 'news_email_freq_err',$news_email_freq_err );

