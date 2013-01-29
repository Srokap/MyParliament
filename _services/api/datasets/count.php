<?php

$base_alias = $_PARAMS;
echo "\n" . $base_alias;
$dataset = new ep_Dataset( $base_alias );

if( $dataset->name=='kluby_sejmowe' )
  $dataset->init_where('id', '!=', '7');

$count = $dataset->count();

$this->DB->update_assoc( 'api_datasets', array( 'count' => $count ), array( 'base_alias' => $base_alias ) );