<?php
echo '<pre>';
$base_aliases = $this->DB->selectValues( "SELECT base_alias FROM `api_datasets`" );

$skip = array( 
	'kody_pocztowe' 
);

foreach( $base_aliases as $base_alias ){
	if( !in_array($base_alias, $skip) ){
		$this->S('api/datasets/count', $base_alias);
	}
}