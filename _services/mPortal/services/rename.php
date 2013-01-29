<?php

list( $src, $dst ) = $_PARAMS;
if( empty( $src ) || empty( $dst ) ){
	return 0;	
} 

$exist = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_services." WHERE id='$src'");
if( !$exist ){
	return;
}

$exist = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_services." WHERE id='$dst'");
if( $exist ){
	return;
}
  
$this->DB->q("UPDATE ".DB_TABLE_services." SET id='$dst' WHERE id='$src'");
$this->DB->q("UPDATE ".DB_TABLE_services_access." SET service='$dst' WHERE service='$src'");

$fileSrc = ROOT.'/_services/'.$src.'.php';
$fileDst = ROOT.'/_services/'.$dst.'.php';

rename( $fileSrc, $fileDst );

/*
if( !file_exists( $fileDst ) ) {
    force_file_put_contents( $fileDst, file_get_contents( $fileSrc ) );
}

unlink( $fileSrc );
*/