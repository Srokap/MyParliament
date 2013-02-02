<?
  $url = 'http://www.mkogy.hu/internet/plsql/ogy_kpv.kepv_lis?p_ckl=39';
  $html = file_get_contents($url);
  
  
  $output = array();
  
  
  if( preg_match_all('/\"ogy_kpv.kepv_adat\?p_azon=(.*?)\&p_ckl=([0-9]+)\"/i', $html, $matches) ) {
	  for( $i=0; $i<count($matches[0]); $i++ ) {
	  
	    $output[] = trim( $matches[1][$i] );
	  
	  }
  }
  
  
  return $output;
?>