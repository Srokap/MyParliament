<?
	$lang = array();
	
	$file_name = ROOT.'_pages/'.$this->ID.'/_lang/pl.php';
	
	if( file_exists( $file_name ) ){
		$lang = include( $file_name );
	}
	
	if( $this->LANG == 'pl' ){
		return $lang;
	}
		
	$file_name = ROOT.'_pages/'.$this->ID.'/_lang/'.$this->LANG .'.php';

	if( file_exists( $file_name ) ){
		$lang = array_merge( $lang, include( $file_name ) );
	}
	
	return $lang;