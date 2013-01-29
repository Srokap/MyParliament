<?
	$lang = include( ROOT.'/_lang/pl.php' );
	if( !is_array( $lang ) ){
		$lang = array();
	}
	
	if( $this->LANG == 'pl' ){
		return $lang;
	}
	
	$other_lang = array();
	
	if( $this->LANG == 'en' ){
		$other_lang = include( $_SERVER['DOCUMENT_ROOT'].'/_lang/en.php' );
	}
	
	if( is_array( $other_lang ) ){
		$lang = array_merge( $lang, $other_lang );
	}
	
	return $lang;
	