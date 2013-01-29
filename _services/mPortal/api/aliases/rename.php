<?
list( $aliasSrc, $aliasDst ) = $_PARAMS;
echo $aliasSrc . ' ' . $aliasSrc;
die();
$aliasSrc = addslashes( trim( $aliasSrc ) );
$aliasDst = addslashes( trim( $aliasDst ) );

if( $aliasSrc == $aliasDst ){
	return 'Aliasy jednakowe!';
}

$srcExists = $this->DB->selectValue( "SELECT alias FROM api_aliases WHERE alias='{$aliasSrc}'" );

if( !$srcExists || $aliasSrc == '' ){
	return 'Alias zrodlowy nie istnieje';
}

$dstExists = $this->DB->selectValue( "SELECT alias FROM api_aliases WHERE alias='{$aliasDst}'" );

if( $dstExists || $aliasDst == '' ){
	return 'Alias docelowy istnieje, badz jest pusty';
}

/*
$this->DB->q( "UPDATE `api_aliases` SET `alias`='{$aliasDst}' WHERE `alias`='{$aliasSrc}'" );

$this->DB->q( "UPDATE `api_aliases_connections` SET `alias_a`='{$aliasDst}' WHERE `alias_a`='{$aliasSrc}'" );
$this->DB->q( "UPDATE `api_aliases_connections` SET `alias_b`='{$aliasDst}' WHERE `alias_b`='{$aliasSrc}'" );


$this->DB->q( "UPDATE `api_datasets` SET `base_alias`='{$aliasDst}' WHERE `base_alias`='{$aliasSrc}'" );

$api_datasets_sort_fields = $this->DB->selectValues( "SELECT sort_field FROM `api_datasets` WHERE sort_field LIKE '{$aliasSrc}.%'" );
foreach( $api_datasets_sort_fields as $api_datasets_sort_fieldSRC ){
	$api_datasets_sort_fieldDST = str_replace( "{$aliasSrc}.", "{$aliasDst}.", $api_datasets_sort_fieldSRC );
	$this->DB->q( "UPDATE `api_datasets` SET `sort_field`='{$api_datasets_sort_fieldDST}' WHERE `sort_field`='{$api_datasets_sort_fieldSRC}'" );
}

$filter_params_fields = $this->DB->selectValues( "SELECT filter_params FROM `api_datasets_fields` WHERE filter_params RLIKE '^{\"dataset\": *\"{$aliasSrc}\",'" );
foreach( $filter_params_fields as $filter_params_fieldSRC ){
	$filter_params_fieldDST = preg_replace( "/^{\"dataset\": *\"{$aliasSrc}\",/", "{\"dataset\": \"{$aliasDst}\",", $filter_params_fieldSRC );
	$this->DB->q( "UPDATE `api_datasets` SET `filter_params`='". addslashes( $filter_params_fieldDST ) ."' WHERE `filter_params`='{$filter_params_fieldSRC}'" );
}


$this->DB->q( "UPDATE `api_datasets_fields` SET `base_alias`='{$aliasDst}' WHERE `base_alias`='{$aliasSrc}'" );
$this->DB->q( "UPDATE `api_datasets_fields` SET `alias`='{$aliasDst}' WHERE `alias`='{$aliasSrc}'" );


//UPDATE `api_docs_object_layers` SET `class`=[value-1],`layer`=[value-2],`opis`=[value-3] WHERE 1
//UPDATE `api_docs_object_methods` SET `class`=[value-1],`method`=[value-2],`opis`=[value-3] WHERE 1

$this->DB->q( "UPDATE `api_fields` SET `alias`='{$aliasDst}' WHERE `alias`='{$aliasSrc}'" );

//UPDATE `api_joins_map` SET `alias_a`=[value-1],`alias_b`=[value-2],`map`=[value-3] WHERE 1

$this->DB->q( "UPDATE `api_objects` SET `base_alias`='{$aliasDst}' WHERE `base_alias`='{$aliasSrc}'" );

$api_objects_aliases = $this->DB->selectValues( "SELECT aliases FROM `api_objects` WHERE aliases REGEXP '^{$aliasSrc}(,|$)'" );
foreach( $api_objects_aliases as $aliasesSRC ){
	$aliasesDST = preg_replace( "/^{$aliasSrc}(,|$)/", "{$aliasDst}$1", $aliasesSRC );
	$this->DB->q( "UPDATE `api_objects` SET `aliases`='{$aliasesDST}' WHERE `aliases`='{$aliasesSRC}'" );
}


$this->DB->q( "UPDATE `objects` SET `dataset`='{$aliasDst}' WHERE `dataset`='{$aliasSrc}'" );
*/