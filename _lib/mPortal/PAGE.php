<?php
//require_once( $_SERVER['DOCUMENT_ROOT'].'/_lib/mPortal/PATTERN.php' );
require_once( ROOT . '/_lib/mPortal/PATTERN.php' );

class PAGE extends PATTERN {
	var $ID, $NAME, $TITLE, $FORCE_TITLE, $FORCE_ICON, $LOGIN, $FULLSCREEN, $LAYOUT, $FRONT_MENU, $FRONT_SUBMENUS, $FRONT_MENU_SELECTED, $isIpad, $WIDEHEADER, $NOHEADER, $DATASET_BASE_ALIAS, $HEADER_TITLE;
	var $google_maps = false;
	var $SEARCH_DIV_STATUS = false;
	var $META = array();
	var $REL = array(
	  'prev' => false,
	  'next' => false,
	);
	var $JSSLIBS = array();
	var $JSLIBS = array();
	var $EXTERNALJSSLIBS = array();
	var $CSSLIBS = array();
	var $LIGHTBOXES = array();
	var $COMPONENTS = array();
	var $MENU = array();
	var $MENUGROUPS = array();
	var $MENUGROUPSIDS = array();
	var $STAMPS = array();
	var $LINKS = array();
	var $CUSTOM_FB_LOGO = false;
	var $FB_USER = false;
	var $LIBRARIES = array();
	var $SIDE_MENUS = array();
	var $OBJECT_TABS = array();
	var $OBJECT = false;
	var $OBJECT_TAB = false;
	var $BREAD_CRUMBS = array();
	var $DOM = false;
	var $SUBMENUS_TABLE = false;
	var $disqus_url = false;
	var $disqus_identifier = false;
	var $goHomeOnLogin = false;

	var $mainmenu = array(
			array('url'=>'', 'label'=>''),
	);

	var $TEMPMENU;

	var $FB_APP_ID = '';

	function PAGE($page){
	  
	
		$this->ID = $page;
		parent::PATTERN();
		
		$this->BREAD_CRUMBS = array();
		$this->isIpad = strstr($_SERVER['HTTP_USER_AGENT'], 'iPad');
	
		
		if( $page=='' || $page=='homepage' ) {


			$page = 'homepage';
			$this->ID = 'homepage';
			$_GET['_PAGE'] = 'homepage';


		} else {
			 			
			list($dataset_base_alias, $results_class, $datasetname) = $this->DB->selectRow("SELECT base_alias, results_class, name FROM api_datasets WHERE base_alias='$page' AND base_alias!='pisma'");
			if( $dataset_base_alias ) {

				$this->ID = '_dataset';
				if( isset($_REQUEST['__VERSION']) )
					$this->ID .= '_' . $_REQUEST['__VERSION'];

				$page = $this->ID;
				$this->DATASET_BASE_ALIAS = $dataset_base_alias;



				if(isset( $_GET['_ID'] ) && $_GET['_ID'] ) {
					if( class_exists($results_class) ) {
						$this->OBJECT = new $results_class( $_GET['_ID'] );

						if( $this->OBJECT ) {
							$this->ID = isset($_REQUEST['__VERSION']) ? '_objects_'. $_REQUEST['__VERSION'] .'/'.$results_class : '_objects/'.$results_class;
							$page = $this->ID;
								
							$this->TITLE = $this->OBJECT->getTitle();
							$desc = $this->OBJECT->getDescription();
								
							if( $desc )
								$this->set_meta('description', $desc);

							$this->addBC( 'dane', 'Dane' );
							$this->addBC( $dataset_base_alias, $datasetname );
							// $this->addBC( $dataset_base_alias.'/'.$this->OBJECT->id, $this->TITLE );
							 
								
							$this->OBJECT_TABS = $this->DB->selectAssocs("SELECT tab_id as 'id', tab_name as 'name', type, hidden, minimal, object, count FROM api_objects_tabs WHERE object='$results_class' ORDER BY ord ASC");
								
							if( !empty($this->OBJECT_TABS) ) {
								 
								 
								 
								foreach( $this->OBJECT_TABS as $i => &$obj ){
									if( $obj['count']=='1' && $obj['type'] == 'dataset' ){

										$file = ROOT.'/_pages/_objects/'.$results_class.'/tabs/'.$obj['id'].'.php';
										if( file_exists( $file ) ){
											include( $file );
											 
											$count = $this->OBJECT_TAB['dataset']->count();
											 
											 
											unset( $this->OBJECT_TAB['dataset'] );
											if( $count === 0 ){
												unset( $this->OBJECT_TABS[$i] );
												continue;
											}
										}
									}
									if( $obj['id']==$_GET['_TAB_ID'] ){
										$obj['s'] = true;
										$this->OBJECT_TAB = $obj;
									}
									 
								}
								 
								 
								 
								 
								if( !$this->OBJECT_TAB ) {
									$this->OBJECT_TABS[0]['s'] = true;
									$this->OBJECT_TAB = $this->OBJECT_TABS[0];
									 
								}
								 
								$this->OBJECT_TABS = array_values( $this->OBJECT_TABS );
								 
								 
									
							}
								
								
							$logic_file = ROOT.'/_pages/_objects/'.$results_class.'/tabs/'.$this->OBJECT_TAB['id'].'.php';
							if( file_exists($logic_file) )
								include( $logic_file );
								
								
							if( $this->OBJECT_TAB['dataset'] )
								$this->OBJECT_TAB['dataset']->get_info();
								
								
								
						}
						 
					} else {
						header("Location: /".$dataset_base_alias);
						die();
					}
				}

			}

		}
		 
		 
		 
		 

		$pagedata = $this->DB->selectRow("SELECT ".DB_TABLE_pages.".title, ".DB_TABLE_pages.".fullscreen, ".DB_TABLE_pages.".layout, ".DB_TABLE_pages.".js_stamp, ".DB_TABLE_pages.".css_stamp, ".DB_TABLE_pages_access.".group, ".DB_TABLE_pages.".front_menu FROM ".DB_TABLE_pages." LEFT JOIN ".DB_TABLE_pages_access." ON ".DB_TABLE_pages.".id=".DB_TABLE_pages_access.".page WHERE ".DB_TABLE_pages.".id='".$page."'");
		if( $pagedata && $this->OBJECT ) {


			// var_export( $this->OBJECT_TABS );

			$pagedata[2] = 'object';

			if( isset($_REQUEST['__VERSION']) )
				$pagedata[2] .= '_' . $_REQUEST['__VERSION'];

			if( !empty($this->OBJECT_TABS) )
				$pagedata[2] .= '-tabs';


			$pagedata[6] = 'dane';


		}
		 




		if( empty($pagedata) ) {
			 
			$this->ID = ERROR_PAGE;
			 
			 
			$pagedata = $this->DB->selectRow("SELECT ".DB_TABLE_pages.".title, ".DB_TABLE_pages.".fullscreen, ".DB_TABLE_pages.".layout, ".DB_TABLE_pages.".js_stamp, ".DB_TABLE_pages.".css_stamp, ".DB_TABLE_pages_access.".group, ".DB_TABLE_pages.".front_menu FROM ".DB_TABLE_pages." LEFT JOIN ".DB_TABLE_pages_access." ON ".DB_TABLE_pages.".id=".DB_TABLE_pages_access.".page WHERE ".DB_TABLE_pages.".id='".$this->ID."'");
			parent::PATTERN();
		}
		 

		 
		 
		 
		$this->setAccess( $pagedata[5] );
		$this->DICT = array_merge( $this->DICT, include( ROOT.'/_lang/local_engine.php' ) );
		 
		 

		 

		list($title, $fullscreen, $layout, $js_stamp, $css_stamp, $access, $front_menu) = $pagedata;
		 
		// Ustawiamy podstawowe właściwości
		$pathparts = pathinfo($this->ID);

		if( $title )
			$this->TITLE = $title;
		 
		$this->FRONT_MENU_SELECTED = $front_menu;
		$this->LAYOUT = $layout ? $layout : DEFAULT_PAGE_LAYOUT;
		$this->FULLSCREEN = ($fullscreen=='1');
		$this->STAMPS = array(
				'js' => $js_stamp,
				'css' => $css_stamp,
		);
		 
		$stamps = $this->DB->selectAssocs("SELECT file, ext, stamp FROM ".DB_TABLE_files_stamps);
		foreach( $stamps as $s ) $this->STAMPS[ $s['file'].'_'.$s['ext'] ] = $s['stamp'];
		 
		$this->NAME = $pathparts['filename'];
		$this->META = $this->DB->selectRows("SELECT name, content FROM ".DB_TABLE_meta."");


		// PAGE LIBS
		$libs = $this->DB->selectValues("SELECT lib FROM ".DB_TABLE_pages_libs." WHERE page='".$this->ID."'");
		foreach( $libs as $lib ) $this->addLib($lib);

		$file = ROOT.'/_lib/mPortal/PAGE-addon.php';
		if( file_exists($file) ) include $file;
	}

	function resetBC(){
		$this->BREAD_CRUMBS = array();
	}

	function addBC( $url, $name ){
		if( $url && $name )
			$this->BREAD_CRUMBS[] = array(
					'url' => $url,
					'name' => $name,
			);
	}

	function unshiftBC( $url, $name ){
		if( $url && $name )
			array_unshift($this->BREAD_CRUMBS, array(
					'url' => $url,
					'name' => $name,
			));
	}

	function add_meta_keywords($data){
		if( is_string($data) ) $array = explode(',', $data);
		elseif( is_array($data) ) $array = $data;
		else return false;

		foreach( $this->META as &$m ) {
			if( $m[0]=='keywords' ) {
				$m[1] = implode(', ', $array).', '.$m[1];
				return $m;
			}
		}

		$this->META[] = array(
				'keywords', implode(', ', $array),
		);
	}

	function set_meta($name, $content, $property_label=false) {
		foreach( $this->META as &$m ) {
			if( $m[0]==$name ) return $m[1] = $content;
		}
		$this->META[] = array($name, $content, $property_label);
		return true;
	}





	function render_page(){
		if( $this->RESPONSE_TYPE == 'json'){
			$this->render_json();
		} elseif( $this->RESPONSE_TYPE == 'xml'){
			$this->render_xml();
		} else {
			$this->render_html();
		}
	}

	function render_json(){

		header("Content-type: application/json");

		$jsonRoot = array(
		  'document' => array(
		    'content' => array(),
		  ),
		);

		if( $this->DATASET_BASE_ALIAS && !$this->OBJECT ){

			// DATASET


			$page_file_api = ROOT.'/_pages/_dataset/_dataset-api.php';
			if( file_exists($page_file_api) ) {

				list( $dataset, $objects ) = @include($page_file_api);
				if( $dataset ) {
						
					$jsonRoot['document']['resource'] = 'ep_Dataset';

					$data_object = $dataset->data ? $dataset->data : array();
					$objects_object = array(
							'params' => array(
									'offset' => $dataset->offset,
									'limit' => $dataset->limit,
							),
							'content' => array(),
					);
					$links_object = array();


					if( !empty($objects) )
						foreach( $objects as $o )
						$objects_object['content'][] = $this->render_object( $o, 'json' );

						
					$jsonRoot['document']['content'] = array(
							'dataset' => $data_object,
							'objects' => $objects_object,
							'links' => array(),
					);

						
				}
			}
				
				
		} elseif( $this->OBJECT ) {

			// OBJECT
			$jsonRoot['document']['resource'] = 'ep_Dataset';
			$jsonRoot['document']['content'] = $this->render_object( $this->OBJECT, 'json' );

		}

		echo json_encode( $jsonRoot );
		die();

	}

	function render_object( $object, $mode='xml' ) {
		 
		if( $mode=='xml' ) {
			 
			$object_object = $this->DOM->createElement("ep_Object");
			$data_object = $this->DOM->createElement("data");
			$layers_object = $this->DOM->createElement("layers");
			$link_object = $this->DOM->createElement("links");



			// id attribute
			$object_object_id = $this->DOM->createAttribute('id');
			$object_object_id->value = $object->data['id'];
			$object_object->appendChild( $object_object_id );



			// class attribute
			$object_object_class = $this->DOM->createAttribute('class');
			$object_object_class->value = get_class( $object );
			$object_object->appendChild( $object_object_class );



			// data
			if( is_array( $object->data ) )
				foreach( $object->data as $key => $val )
				$data_object->appendChild( $this->DOM->createElement( $key, $val ) );
				
				
				
			$object_object->appendChild( $data_object );
			$object_object->appendChild( $layers_object );
			$object_object->appendChild( $link_object );
				
			return $object_object;
				
		} elseif( $mode=='json' ) {
			 
			return array(
					'id' => $object->data['id'],
					'class' => get_class( $object ),
					'data' => $object->data,
					'layers' => array(),
					'links' => array(),
			);
			 
		};
		 
		return false;
		 
	}

	function render_xml(){

		header("Content-type: text/xml");
		$this->DOM = new DOMDocument('1.0', 'UTF-8');
		$this->DOM->formatOutput = true;

		$xmlRoot = $this->DOM->appendChild( $this->DOM->createElement("document") );
		$xmlRootAttribute = $this->DOM->createAttribute('resource');

		if( $this->DATASET_BASE_ALIAS && !$this->OBJECT ){

			// DATASET


			$page_file_api = ROOT.'/_pages/_dataset/_dataset-api.php';
			if( file_exists($page_file_api) ) {

				list( $dataset, $objects ) = @include($page_file_api);
				if( $dataset ) {
						
					$xmlRootAttribute->value = 'ep_Dataset';

					$data_object = $this->DOM->createElement("dataset");
					$objects_object = $this->DOM->createElement("objects");
					$links_object = $this->DOM->createElement("links");






					$objects_attributes = array(
							'offset' => $this->DOM->createAttribute('offset'),
							'limit' => $this->DOM->createAttribute('limit'),
					);

					$objects_attributes['offset']->value = $dataset->offset;
					$objects_attributes['limit']->value = $dataset->limit;

					$objects_object->appendChild( $objects_attributes['offset'] );
					$objects_object->appendChild( $objects_attributes['limit'] );







					if( is_array( $dataset->data ) )
						foreach( $dataset->data as $key => $val )
						$data_object->appendChild( $this->DOM->createElement( $key, $val ) );

					if( !empty( $objects ) )
						foreach( $objects as $object )
						$objects_object->appendChild( $this->render_object($object, 'xml') );

						
					$xmlRoot->appendChild( $data_object );
					$xmlRoot->appendChild( $objects_object );
					$xmlRoot->appendChild( $links_object );
						
				}
			}
				
				
		} elseif( $this->OBJECT ) {

			// OBJECT
			$xmlRootAttribute->value = 'ep_Object';
			$xmlRoot->appendChild( $this->render_object( $this->OBJECT, 'xml' ) );

		}

		$xmlRoot->appendChild( $xmlRootAttribute );
		echo $this->DOM->saveXML();
		die();

	}

	function render_html(){

		 
		 
		$this->load_smarty_modules();
		// $groups = $this->DB->selectRow("SELECT `group` FROM ".DB_TABLE_pages_access." WHERE page='".$page."'");

		$this->SMARTY->template_dir = ROOT.'/_pages/'.$this->ID.'/';
		$this->SMARTY->compile_dir  = ROOT.'/_pages/'.$this->ID.'/_templates_c/';
		$this->SMARTY->config_dir   = ROOT.'/_pages/'.$this->ID.'/_configs/';
		$this->SMARTY->cache_dir    = ROOT.'/_pages/'.$this->ID.'/_cache/';



		$layout_logic_file = ROOT.'/_layout/'.$this->LAYOUT.'.php';
		if( file_exists($layout_logic_file) ) include($layout_logic_file);


		$logic_file = ROOT.'/_pages/'.$this->ID.'/'.$this->NAME.'.php';
		if( file_exists($logic_file) ) include($logic_file);






		$image_src = $this->CUSTOM_FB_LOGO ? $this->CUSTOM_FB_LOGO : '/g/fblogo.png';
		$this->LINKS[] = array('rel'=>'image_src', 'href'=>$image_src);



		$this->FRONT_MENU = array(
		  array(
		    'url' => 'homepage',
		    'name' => 'Homepage',
		  ),
		  array(
		    'url' => 'data',
		    'name' => 'Data',
		  ),
		  
		  /*
		  array(
		    'url' => 'alerts',
		    'name' => 'Alerts',
		  ),
		  array(
		    'url' => 'search',
		    'name' => 'Search',
		  ),
		  array(
		    'url' => 'api',
		    'name' => 'API',
		  ),
		  */
		);


			



		foreach( $this->FRONT_MENU as &$item )
			if( $item['url']==$this->FRONT_MENU_SELECTED )
			$item['s'] = true;


		 

		// Przygotowujemy sekcję META
		$smarty_params = array(
				'ROOT' => ROOT,
				'SITE_ROOT' => SITE_ROOT,
				'SITE_ADDRESS' => SITE_ADDRESS,
				'MENUGROUPS' => $this->MENUGROUPS,
				'MENUGROUPSIDS' => $this->MENUGROUPSIDS,
				'MENU' => $this->MENU,
				'TEMPMENU' => $this->TEMPMENU,
				'ID' => $this->ID,
				'LOGIN' => $this->LOGIN,
				'NAME' => $this->NAME,
				'TITLE' => $this->TITLE,
				'FORCE_TITLE' => $this->FORCE_TITLE,
				'FORCE_ICON' => $this->FORCE_ICON,
				'META' => $this->META,
				'JSLIBS' => $this->JSLIBS,
				'CSSLIBS' => $this->CSSLIBS,
				'LIGHTBOXES' => $this->LIGHTBOXES,
				'LAYOUT' => $this->LAYOUT,
				'jsInline' => file_exists(ROOT.'/_pages/'.$this->ID.'/'.$this->NAME.'-inline.js'),
				'jsConfig' => file_exists(ROOT.'/_pages/'.$this->ID.'/'.$this->NAME.'-inline-config.js'),
				'cssInline' => file_exists(ROOT.'/_pages/'.$this->ID.'/'.$this->NAME.'-inline.css'),
				'jsFile' => file_exists(ROOT.'/js/'.$this->ID.'-'.$this->STAMPS['js'].'.js'),
				'cssFile' => file_exists(ROOT.'/css/'.$this->ID.'-'.$this->STAMPS['css'].'.css'),
				'USER' => $this->USER,
				'SUBMENUS_TABLE' => $this->SUBMENUS_TABLE,
				'FULLSCREEN' => $this->FULLSCREEN,
				'DEFAULT_PAGE_TITLE' => DEFAULT_PAGE_TITLE,
				'STAMPS' => $this->STAMPS,
				'FRONT_MENU' => $this->FRONT_MENU,
				'FRONT_SUBMENUS' => $this->FRONT_SUBMENUS,
				'FRONT_MENU_SELECTED' => $this->FRONT_MENU_SELECTED,
				'LINKS' => $this->LINKS,
				'EXTERNALJSSLIBS' => $this->EXTERNALJSSLIBS,
				'disqus_url' => $this->disqus_url,
				'disqus_identifier' => $this->disqus_identifier,
				'FB_USER' => $this->FB_USER,
				'logoutUrl' => $this->FB->getLogoutUrl(array('next'=>SITE_ADDRESS.'/logout?next=' . $_SERVER['REQUEST_URI'] )),
				'isAdmin' => $this->isAdmin(),
				'isLogged' => $this->isLogged(),
				'_FB_COOKIE' => $this->_FB_COOKIE,
				'isIpad' => $this->isIpad,
				'goHomeOnLogin' => $this->goHomeOnLogin,
				'WIDEHEADER' => $this->WIDEHEADER,
				'REL' => $this->REL,
				'DICT' => $this->DICT,
				'LANG' => $this->LANG,
				'lang_redirection_url' => $this->lang_redirection_url,
				'FB_APP_ID' => $this->FB_APP_ID,
				'_REFERRER' => isset( $_SESSION['_REFERRER'] ) ? $_SESSION['_REFERRER'] : '',
				'SIDE_MENUS' => $this->SIDE_MENUS,
				'OBJECT_TABS' => $this->OBJECT_TABS,
				'OBJECT_TAB' => $this->OBJECT_TAB,
				'DATASET_BASE_ALIAS' => $this->DATASET_BASE_ALIAS,
				'BREAD_CRUMBS' => $this->BREAD_CRUMBS,
				'google_maps' => $this->google_maps,
				'HEADER_TITLE' => $this->HEADER_TITLE,
				'NOHEADER' => $this->NOHEADER,
				'SEARCH_DIV_STATUS' => $this->SEARCH_DIV_STATUS,
		);
		
		
		
		 
		 
		 
		$this->SMARTY->assign('M', $smarty_params);
		$template_file = ROOT.'/_pages/'.$this->ID.'/'.$this->NAME.'.tpl';
		if( $this->OBJECT ) {
			$this->SMARTY->assign('O', $this->OBJECT);
			$template_file = ROOT.'/_pages/_objects/object.tpl';
		}
	  
		$menu_html = $this->SMARTY->fetch( ROOT.'/_lib/mPortal/resources/menu.tpl' );
		// $submenus_html = $this->SMARTY->fetch( ROOT.'/lib/mPortal/resources/layout/mPortal-sub-menus.tpl' );
		 

	  
		$page_html = '';
		if( file_exists($template_file) ) {
			$page_html = $this->SMARTY->fetch($template_file);
		} 
		 
		/*
	  $template_file = ROOT.'/_pages/'.$this->ID.'/'.$this->NAME.'-header.tpl';
		if( file_exists($template_file) ) {$page_header_html = $this->SMARTY->fetch($template_file); }
		*/
		 
		$_SESSION['_REFERRER'] = $_SERVER['REQUEST_URI'];

		$smarty_params = array_merge($smarty_params, array(
				'MENU_HTML' => $menu_html,
				'PAGE_HTML' => $page_html,
		));
		$this->SMARTY->assign('M', $smarty_params);
		 
		 
		 
		 

		$output = $this->SMARTY->fetch( ROOT.'/_lib/mPortal/resources/layout.tpl' );

		// Minify and display final html output
		if( isset( $_REQUEST['MINIFY_OUTPUT'] ) && $_REQUEST['MINIFY_OUTPUT'] !==' 0' ){
			$output = minify_html($output);
		}
		echo $output;

	}

	function addLib($lib){
		$parts = parse_url($lib);
		 
		 
		 
		if( $parts['scheme'] ) {
			 
			$this->EXTERNALJSSLIBS[] = $lib;
			 
		} else {
			$lib = $parts['path'];
			$params = $parts['query'];
			$fulllib = $lib.'.js';
			if( !empty($params) ) {
				$fulllib .= '?'.$params;
			}
			if( file_exists(ROOT.'/jsLibs/'.$lib.'.js') ) {
				$this->JSLIBS[] = $fulllib;
			}

			$fulllib = $lib.'.css';
			if( !empty($params) ) {
				$fulllib .= '?'.$params;
			}
			if( file_exists(ROOT.'/cssLibs/'.$lib.'.css') ) {
				$this->CSSLIBS[] = $fulllib;
			}
			 
		}
		 
	}

}