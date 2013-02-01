<?php
$skip_tables = array( 'api_aliases','api_aliases_connections','api_builds','api_datasets','api_datasets_fields','api_docs_object_layers','api_docs_object_methods','api_fields','api_joins_map','api_log','api_objects','api_objects_tabs','api_redirections','m_alerts','m_alerts-users','m_alerts_results','m_components','m_components_defaults','m_drafts','m_files_stamps','m_menu','m_menu_groups','m_menus','m_meta','m_pages','m_pages_access','m_pages_compare','m_pages_components','m_pages_libs','m_search_log','m_services','m_services_access','m_services_compare','m_sql_errors','m_start_menu_groups','m_start_menu_items','m_system_processes','m_users','m_users_api','m_users_copy1','m_users_groups','m_vars');

$tables = $this->DB->selectValues( "SHOW TABLES;");
foreach( $tables as $k => $v ){
	if( in_array($v, $skip_tables)){
		unset($tables[$k]);
	}
}
$this->SMARTY->assign( 'tables', $tables );

$aliases = $this->DB->selectValues( "SELECT alias FROM api_aliases");
$this->SMARTY->assign( 'aliases', $aliases );

$tmp = $this->DB->selectAssocs( "SELECT alias, field FROM api_fields");
$fields = array();
foreach( $tmp as $k => $v ){
	if( !isset($fields[$v['alias']]) ){
		$fields[$v['alias']] = array( $v['field'] );
	} else {
		$fields[$v['alias']][] = $v['field'];
	}
}

$this->SMARTY->assign( 'fields', $fields );

if( isset( $_POST['save'] ) ){
	$table = addslashes( trim( $_POST['table'] ) );
	$col_names = $_POST['col_name'];
	$col_types = $_POST['col_type'];
	print_r( $_POST );
	
	$query_table = "CREATE TABLE `$table` (
			`id` INT(10) NULL,
			`unique_id` VARCHAR(255) NULL,
			`status` ENUM('0','1','2','3','4','5') NULL DEFAULT '0',
			`status_ts` TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00',
			`accept` ENUM('0','1') DEFAULT '0',";
	foreach( $col_names as $k => $col_name ){
		$query_table .= " `$col_name` "; 
		if( $col_types[$k] == 'text'){
			$query_table .= " TEXT ";
		} elseif( $col_types[$k] == 'varchar' ){
			$query_table .= " VARCHAR(".$_POST['col_length'][$k].") ";
		} elseif( $col_types[$k] == 'int' ){
			$query_table .= " INT(10) ";			
		}
		$query_table .= " NULL, \n"; 
	}
	
	$query_table .= "PRIMARY KEY (`id`),	UNIQUE INDEX `unique_id` (`unique_id`) ) COLLATE='utf8_general_ci'ENGINE=MyISAM;";
	$this->DB->q( $query_table );
	

	$nazwa = addslashes( trim( $_POST['nazwa'] ) );
	$alias = addslashes( trim( $_POST['alias'] ) );
	$results_class = addslashes( trim( $_POST['results_class'] ) );
	$sort_field = addslashes( trim( $_POST['sort_field'] ) );
	$order = addslashes( trim( $_POST['order'] ) );

	$fields = $_POST['fields'];
	$fields = array_map( 'trim', $fields );
	$fields = array_map( 'addslashes', $fields );

	$keys = $_POST['keys'];
	$keys = array_map( 'trim', $keys );
	$keys = array_map( 'addslashes', $keys );

	$c_alias = $_POST['c_alias'];
	$c_alias = array_map( 'trim', $c_alias );
	$c_alias = array_map( 'addslashes', $c_alias );

	$c_field = $_POST['c_field'];
	$c_field = array_map( 'trim', $c_field );
	$c_field = array_map( 'addslashes', $c_field );
	
	$this->DB->q( "INSERT INTO `api_aliases` (`alias`, `table`) VALUES ('$alias', '$table');" );
	foreach( $keys as $k => $v ){
		if( $fields[ $k ] ){
			$this->DB->q( "INSERT INTO `api_fields` (`alias`, `field`, `key`) VALUES ('$alias', '{$fields[$k]}', '$v');" );
		}
	}
	
	$this->DB->q( "INSERT INTO `api_datasets` (`name`, `results_class`, `base_alias`, `sort_field`, `sort_direct` ) VALUES ('$nazwa', '$results_class', '$alias', '$sort_field', '$order');" );
	
	foreach($c_alias as $k => $v ){
		if( $fields[ $k ] ){
			$this->DB->q( "INSERT INTO `api_datasets_fields` (`base_alias`, `alias`, `field`) VALUES ('$alias', '$v', '{$c_field[$k]}');" );
		}
	}
	
	$inc_files = ROOT. '/_lib/mPortal/ep_API/ep_API.php';
	$inc_content = file_get_contents( $inc_files );
	if( strpos($inc_content, "@include_once('classes/objects/".$results_class.".php');") === false ){
		$inc_content .= "\n@include_once('classes/objects/".$results_class.".php');";
		@file_put_contents( $inc_files, $inc_content );
	}
	if( !file_exists( ROOT. '/_lib/mPortal/ep_API/classes/objects/'.$results_class.'.php' ) ){
		$class_content = "<?php\nclass ".$results_class." extends ep_Object{\n\tpublic \$_aliases = array('".$alias."');\n\tpublic \$_field_init_lookup = '';\n}";
		file_put_contents(  ROOT. '/_lib/mPortal/ep_API/classes/objects/'.$results_class.'.php', $class_content );
	}
	
	if( !file_exists(ROOT. '/_components/dataset_browser/smarty/list_item_classes/'.$results_class.'.tpl' ) ){
		$list_content =
		'{assign var="data" value=$item->data}
		{assign var="href" value=$M.SITE_ROOT|cat:$item->_aliases.0|cat:"/"|cat:$data.id}
		<div class="'.$results_class.'">
		<div class="content_div">
		<p class="label">Label</p>
		<p class="tytul"><a href="{$href}">Tytul</a></p>
		</div>
		</div>';
		file_put_contents(ROOT. '/_components/dataset_browser/smarty/list_item_classes/'.$results_class.'.tpl', $list_content );
	}
	
	$this->S( 'mPortal/pages/create', '_objects/'.$results_class );
	$this->S( 'mPortal/services/new', 'graber/' . $alias . '/get_list' );
	$this->S( 'mPortal/services/new', 'graber/' . $alias . '/get_item' );
	
	if( !file_exists( ROOT. '/_pages/_objects/'.$results_class.'/'.$results_class.'.tpl' ) ){
		@file_put_contents( ROOT. '/_pages/_objects/'.$results_class.'/'.$results_class.'.tpl', "\n");
	}
}