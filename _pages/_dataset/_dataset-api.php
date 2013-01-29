<?php

$dataset = new ep_Dataset( $this->DATASET_BASE_ALIAS );
$dataset->get_info();

$request = $_REQUEST;

$limit = is_numeric($request['pp']) ? $request['pp'] : $dataset->data['limit_default'];

$_p = (int) $request['p'];
if( !$_p ){
	$_p = 1;
}

$offset = $dataset->data['limit_default'] * ($_p-1);

$dataset->order_by($request['o'][0], $request['o'][1])->keyword($request['k'][0]);

$wheres = array();
$wcount = floor( count( $request['w'] ) / 3 );
for( $i=0; $i<$wcount; $i++ )
$wheres[] = array(
	$request['w'][ 3*$i ],
	$request['w'][ 3*$i+1 ],
	$request['w'][ 3*$i+2 ],
);

for( $i=0; $i<count($wheres); $i++ ){
	$dataset->where( $wheres[$i][0], $wheres[$i][1], $wheres[$i][2] );		  
}


$objects = $dataset->find_all( $limit, $offset );
return array( $dataset, $objects );
