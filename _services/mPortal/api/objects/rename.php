<?php

list( $classSrc, $classDst ) = $_PARAMS;

$classSrc = addslashes( trim( $classSrc ) );
$classDst = addslashes( trim( $classDst ) );

if( $classSrc == $classDst ){
	return 'Klasy jednakowe!';
}

$srcExists = $this->DB->selectValue( "SELECT results_class FROM api_datasets WHERE results_class='{$classSrc}'" );

if( !$srcExists || $classSrc == '' ){
	return 'Klasa zrodlowa nie istnieje';
}

$dstExists = $this->DB->selectValue( "SELECT results_class FROM api_datasets WHERE results_class='{$classDst}'" );

if( $dstExists || $classDst == '' ){
	return 'Klasa docelowa istnieje, badz jest pusta';
}

/*
$this->DB->q( "UPDATE `api_datasets` SET `results_class`='{$classDst}' WHERE `results_class`='{$classSrc}'" );

$this->DB->q( "UPDATE `api_docs_object_layers` SET `class`='{$classDst}' WHERE `class`='{$classSrc}'" );

$this->DB->q( "UPDATE `api_docs_object_methods` SET `class`='{$classDst}' WHERE `class`='{$classSrc}'" );

$this->DB->q( "UPDATE `api_objects` SET `name`='{$classDst}' WHERE `name`='{$classSrc}'" );

$this->DB->q( "UPDATE `api_objects_tabs` SET `object`='{$classDst}' WHERE `object`='{$classSrc}'" );


*/