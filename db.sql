
-- Dumping structure for table ochparliament_local.api_aliases
CREATE TABLE IF NOT EXISTS `api_aliases` (
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `table` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_key` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'id',
  UNIQUE KEY `aliast` (`alias`,`table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_aliases: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_aliases` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_aliases` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_aliases_connections
CREATE TABLE IF NOT EXISTS `api_aliases_connections` (
  `alias_a` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias_b` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias_a_key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias_b_key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` enum('INNER','LEFT','RIGHT') COLLATE utf8_polish_ci NOT NULL DEFAULT 'INNER',
  UNIQUE KEY `alias_a` (`alias_a`,`alias_b`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_aliases_connections: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_aliases_connections` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_aliases_connections` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_builds
CREATE TABLE IF NOT EXISTS `api_builds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_builds: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_builds` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_builds` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_datasets
CREATE TABLE IF NOT EXISTS `api_datasets` (
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `results_class` varchar(255) CHARACTER SET utf8 NOT NULL,
  `base_alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `browse_mode` enum('DB','DBF') COLLATE utf8_polish_ci NOT NULL DEFAULT 'DB',
  `limit_max` int(10) unsigned NOT NULL DEFAULT '100',
  `limit_default` int(10) unsigned NOT NULL DEFAULT '20',
  `page_id` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `sort_field` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `sort_direct` varchar(4) COLLATE utf8_polish_ci NOT NULL,
  `fts_columns` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT 'Format: mysql_table.mysql_column,mysql_table.mysql_column',
  `fts_label` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fts_mode` enum('FULLTEXT','FULLTEXT-BOOLEAN','EQUALITY') COLLATE utf8_polish_ci NOT NULL DEFAULT 'FULLTEXT-BOOLEAN',
  `color_items` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '1',
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `public` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `zrodlo` text COLLATE utf8_polish_ci NOT NULL,
  `ord` int(11) NOT NULL DEFAULT '1000',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `stats_field` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `indexing` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `indexing_priority` smallint(6) NOT NULL,
  `enabled` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`base_alias`),
  FULLTEXT KEY `name` (`name`,`opis`),
  FULLTEXT KEY `name_2` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_datasets: 0 rows
/*!40000 ALTER TABLE `api_datasets` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_datasets` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_datasets_fields
CREATE TABLE IF NOT EXISTS `api_datasets_fields` (
  `base_alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tytul` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `can_order` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `filter_id` int(10) unsigned NOT NULL,
  `filter_params` text COLLATE utf8_polish_ci NOT NULL,
  `filter_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `filter_ord` mediumint(9) NOT NULL,
  `stats` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `parent_dataset` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `parent_field` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `mode` enum('normal','virtual') COLLATE utf8_polish_ci NOT NULL DEFAULT 'normal',
  `opis` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  UNIQUE KEY `dataset` (`base_alias`,`alias`,`field`),
  KEY `filter_id` (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_datasets_fields: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_datasets_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_datasets_fields` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_docs_object_layers
CREATE TABLE IF NOT EXISTS `api_docs_object_layers` (
  `class` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `layer` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  UNIQUE KEY `base_alias` (`class`,`layer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_docs_object_layers: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_docs_object_layers` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_docs_object_layers` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_docs_object_methods
CREATE TABLE IF NOT EXISTS `api_docs_object_methods` (
  `class` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `method` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  UNIQUE KEY `base_alias` (`class`,`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_docs_object_methods: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_docs_object_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_docs_object_methods` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_fields
CREATE TABLE IF NOT EXISTS `api_fields` (
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field` varchar(255) CHARACTER SET utf8 NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fixed_value` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `export` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  UNIQUE KEY `alias` (`alias`,`field`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_fields: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_fields` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_joins_map
CREATE TABLE IF NOT EXISTS `api_joins_map` (
  `alias_a` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias_b` varchar(255) CHARACTER SET utf8 NOT NULL,
  `map` varchar(2048) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `alias_a` (`alias_a`,`alias_b`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_joins_map: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_joins_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_joins_map` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_log
CREATE TABLE IF NOT EXISTS `api_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_log` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_objects
CREATE TABLE IF NOT EXISTS `api_objects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `new_name` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `enabled` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '1',
  `aliases` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `field_init_lookup` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `to_string` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `base_alias` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `singular` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `listing` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `search_output` longtext COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_objects: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_objects` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_objects_tabs
CREATE TABLE IF NOT EXISTS `api_objects_tabs` (
  `object` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tab_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tab_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ord` int(11) NOT NULL,
  `tab` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '1',
  `hidden` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `minimal` enum('0','1') COLLATE utf8_polish_ci NOT NULL,
  `count` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  UNIQUE KEY `object` (`object`,`tab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_objects_tabs: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_objects_tabs` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_objects_tabs` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.api_redirections
CREATE TABLE IF NOT EXISTS `api_redirections` (
  `old_alias` varchar(180) COLLATE utf8_polish_ci NOT NULL,
  `new_alias` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `enabled` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `search_output` longtext COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`old_alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.api_redirections: ~0 rows (approximately)
/*!40000 ALTER TABLE `api_redirections` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_redirections` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_alerts
CREATE TABLE IF NOT EXISTS `m_alerts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `q` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `q` (`q`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_alerts: 0 rows
/*!40000 ALTER TABLE `m_alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_alerts` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_alerts-users
CREATE TABLE IF NOT EXISTS `m_alerts-users` (
  `alert_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `alert_id` (`alert_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_alerts-users: 0 rows
/*!40000 ALTER TABLE `m_alerts-users` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_alerts-users` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_alerts_results
CREATE TABLE IF NOT EXISTS `m_alerts_results` (
  `alert_id` int(10) unsigned NOT NULL,
  `result_id` int(10) unsigned NOT NULL,
  `deleted` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `score` float unsigned NOT NULL DEFAULT '0',
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `alert_id` (`alert_id`,`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_alerts_results: 0 rows
/*!40000 ALTER TABLE `m_alerts_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_alerts_results` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_components
CREATE TABLE IF NOT EXISTS `m_components` (
  `id` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `js` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `css` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `smarty` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_components: 16 rows
/*!40000 ALTER TABLE `m_components` DISABLE KEYS */;
INSERT INTO `m_components` (`id`, `js`, `css`, `smarty`) VALUES
	('addthis', '1', '1', '1'),
	('czas_hm', '0', '0', '1'),
	('dataset_browser', '1', '1', '1'),
	('data_slowna', '0', '0', '1'),
	('dopelniacz', '0', '0', '1'),
	('dopelniaczb', '0', '0', '1'),
	('dstats_chart', '1', '1', '1'),
	('epdoc', '1', '1', '1'),
	('epdoc_img', '1', '1', '1'),
	('ep_doc', '1', '1', '0'),
	('getlink', '0', '0', '1'),
	('fblike', '0', '1', '1'),
	('object', '1', '1', '0'),
	('wiek', '0', '0', '1'),
	('plec', '0', '0', '1'),
	('kalendarzyk', '0', '1', '1');
/*!40000 ALTER TABLE `m_components` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_components_defaults
CREATE TABLE IF NOT EXISTS `m_components_defaults` (
  `id` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_components_defaults: 17 rows
/*!40000 ALTER TABLE `m_components_defaults` DISABLE KEYS */;
INSERT INTO `m_components_defaults` (`id`) VALUES
	('addthis'),
	('czas_hm'),
	('data_slowna'),
	('dataset_browser'),
	('dopelniacz'),
	('dopelniaczb'),
	('dstats_chart'),
	('ep_doc'),
	('epdoc'),
	('epdoc_img'),
	('fblike'),
	('getlink'),
	('kalendarzyk'),
	('object'),
	('plec'),
	('s_glosowanie'),
	('wiek');
/*!40000 ALTER TABLE `m_components_defaults` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_drafts
CREATE TABLE IF NOT EXISTS `m_drafts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `msg` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_drafts: 0 rows
/*!40000 ALTER TABLE `m_drafts` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_drafts` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_files_stamps
CREATE TABLE IF NOT EXISTS `m_files_stamps` (
  `file` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `ext` enum('js','css') COLLATE utf8_polish_ci NOT NULL,
  `stamp` char(13) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`file`,`ext`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_files_stamps: 4 rows
/*!40000 ALTER TABLE `m_files_stamps` DISABLE KEYS */;
INSERT INTO `m_files_stamps` (`file`, `ext`, `stamp`) VALUES
	('engine', 'css', '5108f61c765eb'),
	('engine', 'js', '5108f61c86e81'),
	('engine_admin', 'css', '50fe959e5b3ab'),
	('engine_admin', 'js', '50fe959e657d5');
/*!40000 ALTER TABLE `m_files_stamps` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_menu
CREATE TABLE IF NOT EXISTS `m_menu` (
  `id` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `label_pl` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `label_en` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `parent` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `group` int(10) unsigned NOT NULL,
  `ord` int(10) unsigned NOT NULL,
  `show` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_menu: 0 rows
/*!40000 ALTER TABLE `m_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_menu` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_menus
CREATE TABLE IF NOT EXISTS `m_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `href` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `text` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `parent` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `ord` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_menus: 0 rows
/*!40000 ALTER TABLE `m_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_menus` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_menu_groups
CREATE TABLE IF NOT EXISTS `m_menu_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `ord` int(10) unsigned NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `class` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_menu_groups: 0 rows
/*!40000 ALTER TABLE `m_menu_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_menu_groups` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_meta
CREATE TABLE IF NOT EXISTS `m_meta` (
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `content` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_meta: 0 rows
/*!40000 ALTER TABLE `m_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_meta` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_pages
CREATE TABLE IF NOT EXISTS `m_pages` (
  `id` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `layout` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `fullscreen` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `js_stamp` char(13) COLLATE utf8_polish_ci NOT NULL,
  `css_stamp` char(13) COLLATE utf8_polish_ci NOT NULL,
  `front_menu` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_pages: 14 rows
/*!40000 ALTER TABLE `m_pages` DISABLE KEYS */;
INSERT INTO `m_pages` (`id`, `title`, `layout`, `fullscreen`, `js_stamp`, `css_stamp`, `front_menu`) VALUES
	('404', 'Strona nie istnieje', 'front', '0', '', '', ''),
	('logout', 'Wylogowanie', '', '0', '', '', ''),
	('zaloguj', 'Logowanie', '', '0', '', '50fea248499f0', ''),
	('start', '', 'front', '0', '', '', 'start'),
	('konto', 'Moje konto', 'user', '0', '50fe9f7622845', '50fe9f7622ac6', ''),
	('rejestracja', 'Rejestracja', 'front', '0', '50feaa7bde8d2', '50feaa7bdead7', ''),
	('odzyskanie_hasla', '', '', '0', '', '50feab62e665f', ''),
	('admin', '', 'admin', '0', '', '', ''),
	('', '', '', '0', '', '', ''),
	('admin/wizard', '', 'admin', '0', '510927108a048', '510927108a8b8', ''),
	('_dataset', '', 'data', '0', '', '5108f3538d3b9', ''),
	('_objects/ep__Dataset', '', '', '0', '', '', '');
/*!40000 ALTER TABLE `m_pages` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_pages_access
CREATE TABLE IF NOT EXISTS `m_pages_access` (
  `page` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`page`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_pages_access: 0 rows
/*!40000 ALTER TABLE `m_pages_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pages_access` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_pages_compare
CREATE TABLE IF NOT EXISTS `m_pages_compare` (
  `id` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `layout` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `fullscreen` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `js_stamp` char(13) COLLATE utf8_polish_ci NOT NULL,
  `css_stamp` char(13) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_pages_compare: 0 rows
/*!40000 ALTER TABLE `m_pages_compare` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pages_compare` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_pages_components
CREATE TABLE IF NOT EXISTS `m_pages_components` (
  `page` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `component` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`page`,`component`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_pages_components: 0 rows
/*!40000 ALTER TABLE `m_pages_components` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pages_components` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_pages_libs
CREATE TABLE IF NOT EXISTS `m_pages_libs` (
  `page` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `lib` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`page`,`lib`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_pages_libs: 0 rows
/*!40000 ALTER TABLE `m_pages_libs` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pages_libs` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_search_log
CREATE TABLE IF NOT EXISTS `m_search_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `q` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `c` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_search_log: 0 rows
/*!40000 ALTER TABLE `m_search_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_search_log` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_services
CREATE TABLE IF NOT EXISTS `m_services` (
  `id` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `page` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `lastRun` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `counter` int(10) unsigned NOT NULL,
  `file_exists` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `filesize` int(10) unsigned NOT NULL,
  `md5` char(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `_id` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  KEY `id` (`id`),
  KEY `page` (`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_services: 12 rows
/*!40000 ALTER TABLE `m_services` DISABLE KEYS */;
INSERT INTO `m_services` (`id`, `page`, `lastRun`, `counter`, `file_exists`, `filesize`, `md5`, `_id`) VALUES
	('mPortal/pages/build', '', '0000-00-00 00:00:00', 0, '1', 0, '', ''),
	('mPortal/pages/build_engines', '', '0000-00-00 00:00:00', 0, '1', 0, '', ''),
	('mPortal/pages/create_build', '', '0000-00-00 00:00:00', 0, '1', 0, '', ''),
	('mPortal/components/build_pages', '', '0000-00-00 00:00:00', 0, '1', 0, '', ''),
	('mPortal/pages/build_all', '', '0000-00-00 00:00:00', 0, '1', 0, '', ''),
	('mPortal/pages/create', '', '0000-00-00 00:00:00', 0, '1', 0, '', ''),
	('mPortal/services/new', '', '0000-00-00 00:00:00', 0, '1', 0, '', ''),
	('admin/wizard/step_1', '', '0000-00-00 00:00:00', 0, '0', 0, '', '');
/*!40000 ALTER TABLE `m_services` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_services_access
CREATE TABLE IF NOT EXISTS `m_services_access` (
  `service` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `page` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `group` int(10) unsigned NOT NULL,
  KEY `service` (`service`),
  KEY `page` (`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_services_access: 3 rows
/*!40000 ALTER TABLE `m_services_access` DISABLE KEYS */;
INSERT INTO `m_services_access` (`service`, `page`, `group`) VALUES
	('admin/wizard/step_1', '', 2),
	('admin/wizard/step_2', '', 2),
	('admin/wizard/step_3', '', 2);
/*!40000 ALTER TABLE `m_services_access` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_services_compare
CREATE TABLE IF NOT EXISTS `m_services_compare` (
  `id` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `page` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `lastRun` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `counter` int(10) unsigned NOT NULL,
  `file_exists` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `filesize` int(10) unsigned NOT NULL,
  `md5` char(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `_id` varchar(256) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  KEY `id` (`id`),
  KEY `page` (`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_services_compare: 0 rows
/*!40000 ALTER TABLE `m_services_compare` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_services_compare` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_sql_errors
CREATE TABLE IF NOT EXISTS `m_sql_errors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `HTTP_HOST` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `REQUEST_URI` varchar(500) COLLATE utf8_polish_ci NOT NULL,
  `HTTP_USER_AGENT` varchar(500) COLLATE utf8_polish_ci NOT NULL,
  `REMOTE_ADDR` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `query` text COLLATE utf8_polish_ci NOT NULL,
  `error` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1546 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_sql_errors: 27 rows
/*!40000 ALTER TABLE `m_sql_errors` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_sql_errors` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_start_menu_groups
CREATE TABLE IF NOT EXISTS `m_start_menu_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `ord` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_start_menu_groups: 0 rows
/*!40000 ALTER TABLE `m_start_menu_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_start_menu_groups` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_start_menu_items
CREATE TABLE IF NOT EXISTS `m_start_menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `ord` int(11) NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `href` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`,`href`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_start_menu_items: 0 rows
/*!40000 ALTER TABLE `m_start_menu_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_start_menu_items` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_system_processes
CREATE TABLE IF NOT EXISTS `m_system_processes` (
  `user` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `cpu` decimal(5,2) unsigned NOT NULL,
  `mem` decimal(5,2) unsigned NOT NULL,
  `vsz` int(10) unsigned NOT NULL,
  `rss` int(10) unsigned NOT NULL,
  `tty` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `stat` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `start` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `command` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `params` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_system_processes: 0 rows
/*!40000 ALTER TABLE `m_system_processes` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_system_processes` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_users
CREATE TABLE IF NOT EXISTS `m_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fb_id` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `link` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `email_verified` enum('0','1','2','3','4','5') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '0',
  `registration_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` enum('sm','fb') COLLATE utf8_polish_ci NOT NULL,
  `expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token` char(90) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `login_hash` char(40) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `bd_date` date NOT NULL DEFAULT '0000-00-00',
  `postal_code` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `email_pass` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `remember_me` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `reg_ip` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `cookie_load_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fb_app_id` bigint(20) NOT NULL,
  `pass_recover` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `pass_recover_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `deleted_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_secret` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `api_key` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `api_count` int(11) unsigned NOT NULL DEFAULT '0',
  `api_total_count` int(11) unsigned NOT NULL DEFAULT '0',
  `news_email_freq` enum('0','1','2','3') COLLATE utf8_polish_ci NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fb_id` (`fb_id`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `m_users` DISABLE KEYS */;
INSERT INTO `m_users` (`id`, `fb_id`, `name`, `first_name`, `last_name`, `link`, `username`, `gender`, `email`, `email_verified`, `group`, `registration_time`, `update_time`, `type`, `expires`, `token`, `login_hash`, `bd_date`, `postal_code`, `email_pass`, `remember_me`, `reg_ip`, `cookie_load_timestamp`, `fb_app_id`, `pass_recover`, `pass_recover_ts`, `is_active`, `is_deleted`, `deleted_ts`, `api_secret`, `api_key`, `api_count`, `api_total_count`, `news_email_freq`) VALUES
	(1, 0, '', '', '', '', 'admin', '', 'admin@ochparliament.pl', '3', 2, '2013-01-22 00:00:00', '2013-01-22 00:00:00', 'sm', '0000-00-00 00:00:00', '2;Z8Z24R9BPHG?E7>>BUB<5?7OOTAIR3C?C:80:4YZ=TI<98B?3?=8C3J:DH5COF:><8QTP;3B:004=3V<4OIY6MBJ', '0bacd04db92672e14d9924bed97e960f61924d0b', '0000-00-00', '', '', '0', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', '1', '0', '0000-00-00 00:00:00', '', '', 0, 0, '2');
/*!40000 ALTER TABLE `m_users` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_users_api
CREATE TABLE IF NOT EXISTS `m_users_api` (
  `user_id` int(10) unsigned NOT NULL,
  `key` char(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `secret` char(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  UNIQUE KEY `user_id` (`user_id`,`key`,`secret`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_users_api: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_users_api` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_users_api` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_users_copy1
CREATE TABLE IF NOT EXISTS `m_users_copy1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fb_id` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `link` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `email_verified` enum('0','1','2','3') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '0',
  `registration_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` enum('sm','fb') COLLATE utf8_polish_ci NOT NULL,
  `expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token` char(90) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `login_hash` char(40) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `bd_date` date NOT NULL DEFAULT '0000-00-00',
  `postal_code` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `email_pass` char(10) COLLATE utf8_polish_ci NOT NULL,
  `remember_me` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `reg_ip` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `cookie_load_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fb_app_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fb_id` (`fb_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_users_copy1: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_users_copy1` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_users_copy1` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_users_groups
CREATE TABLE IF NOT EXISTS `m_users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_users_groups: 0 rows
/*!40000 ALTER TABLE `m_users_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_users_groups` ENABLE KEYS */;


-- Dumping structure for table ochparliament_local.m_vars
CREATE TABLE IF NOT EXISTS `m_vars` (
  `key` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `value` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_vars: 0 rows
/*!40000 ALTER TABLE `m_vars` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_vars` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
