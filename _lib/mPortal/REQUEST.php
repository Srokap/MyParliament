<?php
require_once( '../_lib/mPortal/config.php' );
require_once('ep_API/ep_API.php');
require_once('general_functions.php');
require_once('db.php');
require_once('facebook.php');
setlocale(LC_ALL, 'pl_PL.UTF8');

class REQUEST {

	var $DB;
	var $USER, $LOGIN;
	var $ACCESS = array();
	var $DONT_VERIFY_USER = false; // to jest potrzebne dla użytkownika crona
	var $FB, $FB_UID, $FB_TOKEN, $_FB_COOKIE, $FB_USER_TOKEN, $FB_APP_ID, $FB_APP_SECRET, $RESPONSE_TYPE, $RESPONSE_VERSION;
	var $LANG = 'pl';
	var $LANGS_ALLOWED = array('pl', 'en');
	var $DICT = array();
	var $lang_redirection_url;

	function REQUEST($params = null){
		$_SERVER['M'] = &$this;

		ini_set('session.gc_maxlifetime', REGULAR_SESSION_MAXLIFE);
		add_include_path( ROOT."/_lib" );
		add_include_path( ROOT."/_lib/Zend" );		
		require_once( ROOT."/_lib/Zend/Session.php" );
		
		Zend_Session::start();

		if( !empty($params['ACCESS']) ) {
			$this->ACCESS = $params['ACCESS'];
		}
		$this->DB = new DB(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

		$versions_array = array( 'v1' );
		$types_array = array( 'json', 'xml' );
			
		if( strpos( $_SERVER["HTTP_ACCEPT"], 'application/vnd.EPF_API.' ) === 0 ){
			$accept = str_replace( 'application/vnd.EPF_API.', '', $_SERVER["HTTP_ACCEPT"] );
			$array = @explode('+', $accept, 2 );
			if( count( $array ) == 2 ){
				$version = null;
				if( in_array( $array[0], $versions_array) ){
					$version = $array[0];
				}

				$type = null;
				if( in_array( $array[1], $types_array) ){
					$type = $array[1];
				}

				if( $version && $type ){
					$this->RESPONSE_VERSION = $version;
					$this->RESPONSE_TYPE = $type;
				}
			}
		}


			

		$this->USER = &$_SESSION['mPortal']['USER'];
		setcookie('sm_token', '', time()+REMEMBER_ME_SESSION_MAXLIFE, '/');
			
			
			
			
			
		if( $_SERVER['SERVER_NAME']=='mampytanie.net' ) {

			$this->FB_APP_ID = 158881954243930;
			$this->FB_APP_SECRET = '3c9f0afb84babf5e3a674f8f128c61c1';


		} else {

			$this->FB_APP_ID = FB_APP_ID;
			$this->FB_APP_SECRET = FB_APP_SECRET;

		}

		$this->FB = new Facebook(array(
		  'appId' => $this->FB_APP_ID,
		  'secret' => $this->FB_APP_SECRET,
				'cookie' => true,
				'fileUpload' => false,
		));



		$this->FB_USER_ID = $this->FB->getUser();
		$this->FB_TOKEN = $this->FB->getAccessToken();


		// Trying to login
			
			
			
			
			

		if( $_SERVER['REMOTE_ADDR']=='80.72.34.251' ) {
			// $this->FB_USER_TOKEN = $this->FB->getUserAccessToken();

			// header( 'Location:'.$this->FB->getLogoutUrl() );
			// die();

			/*
			 var_export( 'FB_USER_ID= '.$this->FB_USER_ID ); echo "\n\n";
			var_export( 'FB_TOKEN= '.$this->FB_TOKEN ); echo "\n\n";
			var_export( 'FB_USER_TOKEN= '.$this->FB_USER_TOKEN ); echo "\n\n";
			echo '<hr/>';
			var_export( $this->USER );
			echo '<hr/>';
			var_export( $_COOKIE );
			echo '<hr/>';
			*/

		}




		if( $this->FB_USER_ID ) {



			if( $this->FB_TOKEN!=$this->USER['token'] ) {

				try {
					$this->USER = $this->FB->api('/'.$this->FB_USER_ID);

					$this->USER['type'] = 'fb';
					$this->USER['fb_id'] = $this->FB_USER_ID;
					$this->USER['token'] = $this->FB_TOKEN;

					$data = array(
							'type' => 'fb',
							'token' => $this->USER['token'],
					);

					foreach( array('name', 'first_name', 'last_name', 'link', 'username', 'gender', 'email') as $f )
						$data[$f] = addslashes( $this->USER[$f] );

					$user_id = $this->DB->selectValue("SELECT id FROM ".DB_TABLE_users." WHERE fb_id=".$this->USER['fb_id']);
					if( $user_id ) {
						$data['update_time'] = 'NOW()';
						$this->DB->update_assoc(DB_TABLE_users, $data, $user_id);
						$this->USER['id'] = $user_id;
					} else {
						$data['fb_id'] = $this->USER['fb_id'];
						$data['fb_app_id'] = $this->FB_APP_ID;
						$data['registration_time'] = 'NOW()';
						$data['update_time'] = 'NOW()';
						$this->DB->insert_assoc(DB_TABLE_users, $data);
						$this->USER['id'] = $this->DB->insert_id;
					}

					setcookie('fb_token', $this->USER['token'], time()+REMEMBER_ME_SESSION_MAXLIFE, '/');
					setcookie('sm_token', false, 0, '/');
				} catch (FacebookApiException $e) {



				}
					
			}

		} elseif( isset( $_COOKIE['fb_token'] ) && $_COOKIE['fb_token'] ) {



			$this->logout();
			setcookie('fb_token', false, 0, '/');
			$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
			header('Location: ' . $protocol . '://' . $_SERVER['HTTP_HOST'] . '/login?next=' . urlencode( $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ));

		} elseif( isset($_COOKIE['sm_token']) && $_COOKIE['sm_token'] && $_COOKIE['sm_token']!=$this->USER['token'] ) {



			$this->USER = $this->DB->selectAssoc("SELECT id, name, first_name, last_name, link, username, gender, email, email_verified, type FROM ".DB_TABLE_users." WHERE token='".$_COOKIE['sm_token']."'");
			if( empty($this->USER) ) {
				$this->logout();
			} else {
				$this->USER['token'] = make_token(90);
				$this->save_session();
				$this->DB->q("UPDATE ".DB_TABLE_users." SET token='".$this->USER['token']."' WHERE id=".$this->USER['id']);
				setcookie('sm_token', $this->USER['token'], time()+REMEMBER_ME_SESSION_MAXLIFE, '/');
				setcookie('fb_token', false, 0, '/');
			}

		} elseif( isset( $this->USER['fb_id']  ) && $this->USER['fb_id'] ) {

			$this->logout();

		}






		if( $this->USER['id'] ) $this->USER['group'] = $this->DB->selectValue("SELECT `group` FROM `".DB_TABLE_users."` WHERE id=".$this->USER['id']);

		/*
		 if( $_SERVER['REMOTE_ADDR']=='31.178.14.166' )
			$this->USER['group'] = 2;
		*/
			
		if( isset($this->USER['email_verified ']) ) {
			$this->USER['email_verified'] = $this->USER['email_verified '];
			unset(  $this->USER['email_verified '] );
		}


		$this->DB->q("SET SESSION group_concat_max_len = 10240000");





		if( isset( $_SESSION['mPortal']['LANG'] ) ){
			$this->LANG = $_SESSION['mPortal']['LANG'];
		} else {
			$_SESSION['mPortal']['LANG'] = $this->LANG;
		}

		$this->DICT = include( ROOT.'/_lang/engine.php' );
		$GET = array();
		if( is_array($_GET) && !empty($_GET) )
			foreach( $_GET as $k => $v )
			if( $k['0']!='_' && $k!='lang' )
			$GET[ $k ] = $v;

		$data = parse_url( $_SERVER['REQUEST_URI'] );
		$query = http_build_query( $GET );
		$redirection_url = $data['path'];

		if( $query )
			$redirection_url .= '?'.$query;
			
		$this->lang_redirection_url = $redirection_url;
			
		if( isset($_REQUEST['lang']) && $_REQUEST['lang']!=$this->LANG && in_array($_REQUEST['lang'], $this->LANGS_ALLOWED) ) {
			$this->LANG = $_REQUEST['lang'];
			$_SESSION['mPortal']['LANG'] = $this->LANG;
			$this->save_session();
			header('Location: '.$SITE_ADDRESS.$redirection_url);
		}




		// require_once(ROOT.'/_lib/epapi/epapi-local.php');

	}




	function fb_rest_api( $method, $params=array() ){
		$params = array_merge(
				array(
						'access_token' => $this->FB->getAccessToken(),
						'format' => 'json',
				), $params
		);
		$url = 'https://api.facebook.com/method/'.$method.'?'.http_build_query($params, null, '&');
		$resp = file_get_contents( $url );
			
		return params_decode($resp);
	}




	function setAccess($params){
		// Interpretujemy parametry
		if( is_array($params) )
			$access = $params;
		else {
			if( $params )
				$access = array($params);
			else
				$access = array();
		}

		if( is_array($access) ) {
			$this->ACCESS = $access;
			// Autoryzacja dostępu
			if( !empty($this->ACCESS) && !in_array($this->USER['group'], $this->ACCESS) ) {
				// Żądanie nieuprawnione

				// echo "x";

				header("Location: ".$SITE_ADDRESS."/start");
				die();
			}
		}
	}


	function isAdmin(){
		return $this->USER['group']=='2';
	}

	function isLogged(){
		return !empty( $this->USER['id'] );
	}

	function removecookie(){
		setcookie('PHPSESSID', '');
	}

	function setVar($key, $value){
		if(!empty($key)) {
			return $this->DB->q("INSERT INTO `".DB_TABLE_vars."` (`key`, `value`) VALUES ('$key', '$value') ON DUPLICATE KEY UPDATE `value`='$value'");
		}
	}

	function getVar($key){
		if(!empty($key)) {
			return $this->DB->selectValue("SELECT value FROM `".DB_TABLE_vars."` WHERE `key`='$key' LIMIT 1");
		}
	}

	function service($s, $_PARAMS=null){
		$q = "SELECT page FROM `".DB_TABLE_services."` WHERE id='$s' AND (`page`='' OR `page`='".$this->ID."') ORDER BY page DESC LIMIT 1";
		$page = $this->DB->selectValue($q);
			
		if( is_null($page) ) return false;
		$groups = $this->DB->selectValues("SELECT `group` FROM ".DB_TABLE_services_access." WHERE `service`='$s' AND `page`='$page'");
		if( empty($groups) || in_array($this->USER['group'], $groups) ) {
			$file = $page==='' ? ROOT.'/_services/'.$s.'.php' : ROOT.'/_pages/'.$this->ID.'/_services/'.$s.'.php';

			if( $this->USER['group']==2 ) {
				return include $file;
			} else {
				return @include $file;
			}

		} else return false;
			
	}

	function S($s, $_PARAMS=null){
		return $this->service($s, $_PARAMS);
	}

	function save_session(){
		$_SESSION['mPortal']['USER'] = $this->USER;
	}

	function logout(){
		unset( $this->USER );
		unset( $_SESSION['mPortal'] );
		setcookie('sm_token', false, 0, '/');
		setcookie('fb_token', false, 0, '/');
	}

	function ep_api_call($s, $_PARAMS=null){
		$file = ROOT . '/_api/'.$s.'.php';
		if( file_exists($file) ) {
			return include $file;
		} else {
			return false;
		}
	}
}