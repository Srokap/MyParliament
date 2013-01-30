<?php

$table = isset( $_PARAMS['table'] ) ? addslashes( $_PARAMS['table'] ) : null;
$alias = isset( $_PARAMS['alias'] ) ? addslashes( $_PARAMS['alias'] ) : null;
$results_class = isset( $_PARAMS['results_class'] ) ? addslashes( $_PARAMS['results_class'] ) : null;

$return_array = array(
		'fields' => null,
		'alias' => 1,
		'results_class' => 1,
);

if( $alias && !$this->DB->selectValue( "SELECT alias FROM api_aliases WHERE alias='$alias'" ) ){
	$return_array['alias'] = 0;
}
if( $results_class && !$this->DB->selectValue( "SELECT results_class FROM api_datasets WHERE results_class='$results_class'" ) ){
	$return_array['results_class'] = 0;
}

if( $return_array['alias'] == 0 && $return_array['results_class'] == 0 && $table ){
	$fields = $this->DB->selectAssocs( "DESC " . $table );
	foreach( $fields as &$f ){
		$f = $f['Field'];
	}
	$return_array['fields'] = $fields;
}
return $return_array;