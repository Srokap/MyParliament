<?
function db_clean_str($str, $strip_tags=false) {

	if( $strip_tags )
		$str = strip_tags( $str );
	$str = str_replace(array('&nbsp;'), '', $str);
	$str = preg_replace('/(\s+)/', ' ', $str);
	$str = trim( $str );
	$str = addslashes( $str );
	return $str;
}

function ___dni(){
	return array('Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela');
}


function ___miesiace() {
	return array('stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia');
}

function ____miesiace() {
	return array('styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień');
}

function _____miesiace() {
	return array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
}

function _float_array( $a ){
	if( !empty($a) )
		foreach( $a as &$e )
		$e = (float) $e;
	return $a;
}

function slug($str) {
	$str = translate_polish_letters($str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

	return $clean;
}

function _sql_get_spatial( $g ) {
	preg_match('^(.*?)\((.*?)\)^', $g, $matches);
	$data = trim($matches[2]);

	switch( $matches[1] ) {
		case 'POINT': {
			return _float_array( explode(' ', $data) );
		}
		case 'POLYGON': {
			$output = trim( str_replace( array('(', ')'), '', $data ) );
			$output = explode(',', $output);
			if( !empty($output) )
				foreach( $output as &$d )
				$d = _float_array( explode(' ', $d) );
			return $output;
		}
	}
}

function _spatial_to_sql_polygon( $spat ) {
	$points = array();
	for( $i=0; $i<count( $spat ); $i++ )
		$points[] = $spat[$i][0].' '.$spat[$i][1];
	 
	return 'POLYGON(('.implode(',', $points).'))';
}

function spat_distance( $point_a, $point_b ) {
	$x = $point_a[0] - $point_b[0];
	$y = $point_a[1] - $point_b[1];
	return pow( pow($x, 2)+pow($y, 2), .5 );
}

function spat_path_intersect( $path_a, $path_b ) {
	$result = array();
	$distances = array();
	$treshold = 0;

	for( $i=0; $i<count($path_a); $i++ ) {
		for( $j=0; $j<count($path_b); $j++ ) {
			$d = spat_distance( $path_a[$i], $path_b[$j] );
			$distances[] = $d;
			if( $d<=$treshold ) {
				$result[] = $path_a[$i];
			}
		}
	}

	return $result;
}


function get_facebook_cookie() {
	$app_id = FB_APP_ID;
	$app_secret = FB_APP_SECRET;

	$args = array();
	parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
	ksort($args);
	$payload = '';
	foreach ($args as $key => $value) {
		if ($key != 'sig') {
			$payload .= $key . '=' . $value;
		}
	}
	if (md5($payload . $app_secret) != $args['sig']) {
		return null;
	}
	return $args;
}

function microtime_float()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}

function create_password($length) {
	$chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$i = 0;
	$password = "";
	while ($i <= $length) {
		$password .= $chars{mt_rand(0,strlen($chars))};
		$i++;
	}
	return $password;
}

function login_hash($user, $pass){
	return sha1( $user.USERS_SALT.$pass );
}

function make_token( $length=90 ) {
	// we don't want one-digit token
	if ($length < 2)
		return false;
	
	$result = '';
	for ( $i = 0; $i < $length; $i++) {
		if( $i==96 ){
			$i=77;
		}
		
		$result .= chr( rand(48, 90) );
	}

	return $result;
}

function make_numeric_token( $length=10 ) {
	// we don't want one-digit token
	if ($length < 2)
		return false;

	for ( $i = 0; $i < $length; $i++) {
		$result .= rand(1,9);
	}

	return $result;
}


function params_decode($p){
	$p = json_decode( stripslashes($p) );
	convert_objects_to_arrays($p);
	return $p;
}

function to_dec($s){
	$s = (string) $s;
	if( strlen( $s )==1 ) return '0'.$s;
	else return $s;
}

function convert_objects_to_arrays(&$p){
	if( is_object($p) ) $p = get_object_vars($p);
	if( is_array($p) ) foreach( $p as $k=>&$v ) {
		convert_objects_to_arrays($v);
	}
}

function filename($path){
	$pathparts = pathinfo($path);
	return $pathparts['filename'];
}

function sm_wiek($data){
		
	$birthDate = explode("-", $data);
	$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));

	return sm_dopelniacz( $age, 'rok', 'lata', 'lat' );
}

function sm_plec($plec, $formA='',$formB=''){
	 
	if( $plec=='K' )
		return $formB;
	else
		return $formA;
	 
}

function sm_dopelniacz($count=0,$formA='',$formB='',$formC='',$formD=''){
	if( $count==0) {
		return $formD;
	}
	elseif( $count==1 ) {
		$r = $formA;
	} elseif( $count<5 ) {
		$r = $formB;
	} elseif( $count<22) {
		$r = $formC;
	} else {
		$d = $count % 10;
		if( $d<2 ) {
			$r = $formC;
		}
		elseif( $d<5 ) {
			$r = $formB;
		}
		else { $r = $formC;
		}
	}
	return $count.'&nbsp;'.$r;
}

function sm_dopelniaczb($count=0,$formA='',$formB='',$formC='',$formD='',$href=''){
	if( $count==0) {
		return $formD;
	}
	elseif( $count==1 ) {
		$r = $formA;
	} elseif( $count<5 ) {
		$r = $formB;
	} elseif( $count<22) {
		$r = $formC;
	} else {
		$d = $count % 10;
		if( $d<2 ) {
			$r = $formC;
		}
		elseif( $d<5 ) {
			$r = $formB;
		}
		else { $r = $formC;
		}
	}
	if( $href ) $r = '<a href="'.$href.'">'.$r.'</a>';
	return '<b>'.$count.'</b>&nbsp;'.$r;
}

function sm_data_slowna($data) {
	 
	$_miesiace = array(
			1 => 'stycznia',
			2 => 'lutego',
			3 => 'marca',
			4 => 'kwietnia',
			5 => 'maja',
			6 => 'czerwca',
			7 => 'lipca',
			8 => 'sierpnia',
			9 => 'września',
			10 => 'października',
			11 => 'listopada',
			12 => 'grudnia',
	);
	 
	$parts = explode('-', $data);
	if( count($parts)!=3 ) return $data;
	 
	$rok = (int) $parts[2];
	$miesiac = (int) $parts[1];
	$dzien = (int) $parts[0];
	 
	return '<span class="_ds" value="'.strip_tags($data).'">'.$rok.' '.$_miesiace[ $miesiac ].' '.$dzien.' r.</span>';
}

function sm_dzien_slowny( $data ){
	$dni = ___dni();
	$w = (int) date('w', strtotime($data));
	$w = ($w - 1) % 7;
	return $dni[ $w ];
}

function sm_czas_hm( $data ){
	return substr( $data, 11, 5 );
}

function sm_czas_dlugosc( $data ) {

	$data = (int) $data;
	$min = $data % 60;
	$h = ( $data - $min ) / 60;

	if( $min && $h )
		return $h.' godz. '.$min.' min.';
	elseif( $min && !$h )
	return $min.' min.';
	elseif( !$min && $h )
	return $h.' godz.';



}


function sm_kalendarzyk($data){
	$_miesiace = array('STY', 'LUTY', 'MAR', 'KWIE', 'MAJ', 'CZE', 'LIP', 'SIE', 'WRZ', 'PAŹ', 'LIS', 'GRU');
	$data = explode('-', $data);

	$rok = (int) $data[0];
	$miesiac = (int) $data[1];
	$miesiac = $_miesiace[$miesiac-1];
	$dzien = (int) $data[2];

	$html = '<div class="kalendarzyk';
	if( $_SERVER['M']->isIpad )
		$html .= ' iPad';
	$html .= '"><p class="rok"><span>'.$rok.'</span></p><p class="miesiac"><span class="d">'.$dzien.'</span> <span class="m">'.$miesiac.'</span></p></div>';

	return $html;
}








function url_title($string){
	$chars = 'qwertyuiopasdfghjklzxcvbnm1234567890';
	$result = '';
	$string = translate_polish_letters( trim( $string ) );
	for( $i=0; $i<strlen($string); $i++ ) {
		$c = $string[$i];
		if( $c==' ' ) {
			$result.='_';
		} else { if( stripos($chars, $c)!==false ) $result.=$c;
		}
	}
	return $result;
}

function sm_dataWzglednaEngine($data, $params=null){
	if( !empty($data) ) {
		$params = (int) $params;
		list($y,$m,$d) = explode('-',$data);
		$dni = round( ( mktime(0, 0, 0, date('n'), date('j'), date('Y')) - mktime(0, 0, 0, $m, $d, $y) ) / 86400 );
		if( $dni>30 && $params!=1) {
			$miesiace = array(
					'01'=>'stycznia',
					'02'=>'lutego',
					'03'=>'marca',
					'04'=>'kwietnia',
					'05'=>'maja',
					'06'=>'czerwca',
					'07'=>'lipca',
					'08'=>'sierpnia',
					'09'=>'września',
					'10'=>'października',
					'11'=>'listopada',
					'12'=>'grudnia',
			);
			if( $d[0]=='0' ) {
				$d=$d[1];
			}
			return array($d.' '.$miesiace[$m].' '.$y, false);
		}
		elseif ( $dni==0 ) {
			return array('dzisiaj', false);
		}
		elseif ( $dni==1 ) {
			return array('wczoraj', false);
		}
		else { return array($dni.' dni', true);
		}
		/*
		 elseif ( $dni<30 ) {
		$r = floor($dni/7);
		if( $r==1 ) { return 'tydzień temu'; }
		else { return $r.' tygodnie temu'; }
		} elseif ( $dni<45 ) { return 'miesiąc temu'; }
		else{ return '2 miesiące temu'; }
		*/
	}
}

function array_key_exists_nc($key, $search) {
	if (!(is_string($key) && is_array($search) && count($search)))
		return false;

	$key = strtolower($key);
	reset( $search );
	foreach ($search as $k => $v)
		if( strtolower($k)==$key )
		return $k;

	return false;
}

function array_search_assoc_value($array, $keyname){
	if(is_array($array)) foreach( $array as $item ) {
		if( $item['name']==$keyname ) {
			echo $item['value'];
		}
	}
}

function minify_html($html){
	$search = array("/\/\/ .*/", "/(\s){2,}/");
	$replace = array('', '$1');
	return preg_replace($search, $replace, $html);
}

function assoc_search($array, $key, $value, $field=null){
	foreach($array as $i=>$a){
		if( $a[$key]==$value ){
			return $field ? $a[$field] : $a;
		}
	}
}

function assoc_search_key($array, $key, $value){
	foreach($array as $i=>$a){
		if( $a[$key]==$value ){
			return $i;
		}
	}
}

function dir_exists($dir) {
	return file_exists($dir) && is_dir($dir);
}

function _urlencode($url){
	return str_replace(' ', '%20', $url);
}

function add_include_path($path){
	set_include_path(get_include_path().PATH_SEPARATOR.$path);
}

function force_mkdir($path){
	$folders = explode('/', $path);
	$_path = '';
	if( is_array($folders) ) foreach($folders as $f) {
		if( $f!='' && $f!='/' ) {
			$_path .= '/'.$f;
			if( !dir_exists($_path) ) {
				mkdir($_path);
			}
		}
	}
}

function recurse_copy($src, $dst) {
	$iterator++;
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) ) {
				recurse_copy($src.'/'.$file, $dst.'/'.$file);
			} else {
				@copy($src.'/'.$file, $dst.'/'.$file);
			}
		}
	}
	closedir($dir);
}

function recurse_rmdir($path){
	$dir = opendir($path);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.') && ($file!='..')) {
			if( is_dir($path.'/'.$file) ) {
				recurse_rmdir($path.'/'.$file);
			} else { @unlink($path.'/'.$file);
			}
		}
	}
	rmdir($path);
}

function force_file_put_contents($filename, $content){
	$pathinfo = pathinfo( $filename );
	force_mkdir( $pathinfo['dirname'] );
	@unlink($filename);
	file_put_contents($filename, $content);
}

function arrays_equal( $array_A, $array_B ) {
	if( is_array($array_A) && is_array($array_B) && count($array_A)==count($array_B) ) {

		asort($array_A);
		asort($array_B);
		$array_A = array_values($array_A);
		$array_B = array_values($array_B);

		for( $i=0; $i<count($array_A); $i++ ) {
			if( $array_A[$i]!=$array_B[$i] ) return false;
		}
		return true;

	} else return false;
}

function translate_polish_letters($s){
	return strtr($s, array(
			'ę' => 'e',
			'ó' => 'o',
			'ą' => 'a',
			'ś' => 's',
			'ł' => 'l',
			'ż' => 'z',
			'ź' => 'z',
			'ć' => 'c',
			'ń' => 'n',
			'Ę' => 'E',
			'Ó' => 'O',
			'Ą' => 'A',
			'Ś' => 'S',
			'Ł' => 'L',
			'Ż' => 'Z',
			'Ź' => 'Z',
			'Ć' => 'C',
			'Ń' => 'N',
	));
}

function sejm_decode( $txt ) {
	$txt = str_replace('&#260;', 'Ą', $txt);
	$txt = str_replace('&#261;', 'ą', $txt);
	$txt = str_replace('&#262;', 'Ć', $txt);
	$txt = str_replace('&#263;', 'ć', $txt);
	$txt = str_replace('&#281;', 'ę', $txt);
	$txt = str_replace('&#321;', 'Ł', $txt);
	$txt = str_replace('&#322;', 'ł', $txt);
	$txt = str_replace('&#323;', 'Ń', $txt);
	$txt = str_replace('&#324;', 'ń', $txt);
	$txt = str_replace('&#211;', 'Ó', $txt);
	$txt = str_replace('&#243;', 'ó', $txt);
	$txt = str_replace('&#346;', 'Ś', $txt);
	$txt = str_replace('&#347;', 'ś', $txt);
	$txt = str_replace('&#377;', 'Ź', $txt);
	$txt = str_replace('&#378;', 'ź', $txt);
	$txt = str_replace('&#379;', 'Ż', $txt);
	$txt = str_replace('&#380;', 'ż', $txt);
	$txt = str_replace('&#733;', '"', $txt);
	$txt = str_replace('&oacute;', 'ó', $txt);
	return $txt;
}

function post_request($url, $data, $referer='', $session_id=false) {

	// Convert the data array into URL Parameters like a=b&foo=bar etc.
	$data = http_build_query($data);



	// parse the given URL
	$url = parse_url($url);

	if ($url['scheme'] != 'http') {
		die('Error: Only HTTP request are supported !');
	}

	// extract host and path:
	$host = $url['host'];
	$path = $url['path'];

	// open a socket connection on port 80 - timeout: 30 sec
	$fp = fsockopen($host, 80, $errno, $errstr, 30);

	if ($fp){

		// send the request headers:
		fputs($fp, "POST $path HTTP/1.1\r\n");
		fputs($fp, "Host: $host\r\n");

		if ($referer != '')
			fputs($fp, "Referer: $referer\r\n");

		fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fp, "Content-length: ". strlen($data) ."\r\n");
		if( $session_id )
			fputs($fp, "Cookie: SessionID=".$session_id."\r\n");

		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $data);

		$result = '';
		while(!feof($fp)) {
			// receive the results of the request
			$result .= fgets($fp, 128);
		}
	}
	else {
		return array(
				'status' => 'err',
				'error' => "$errstr ($errno)"
		);
	}

	// close the socket connection:
	fclose($fp);

	// split the result header from the content
	$result = explode("\r\n\r\n", $result, 2);

	$header = isset($result[0]) ? $result[0] : '';
	$content = isset($result[1]) ? $result[1] : '';

	// return as structured array:
	return array(
			'status' => 'ok',
			'header' => $header,
			'content' => $content
	);
}

















// SLUGS

function my_str_split($string)
{
	$slen=strlen($string);
	for($i=0; $i<$slen; $i++)
	{
		$sArray[$i]=$string{$i};
	}
	return $sArray;
}

function noDiacritics($string)
{
	//cyrylic transcription
	$cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
	$cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia');


	$from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
	$to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");


	$from = array_merge($from, $cyrylicFrom);
	$to   = array_merge($to, $cyrylicTo);

	$newstring=str_replace($from, $to, $string);
	return $newstring;
}

function makeSlugs($string, $maxlen=0)
{
	$newStringTab=array();
	$string=strtolower(noDiacritics($string));
	if(function_exists('str_split'))
	{
		$stringTab=str_split($string);
	}
	else
	{
		$stringTab=my_str_split($string);
	}

	$numbers=array("0","1","2","3","4","5","6","7","8","9","-");
	//$numbers=array("0","1","2","3","4","5","6","7","8","9");

	foreach($stringTab as $letter)
	{
		if(in_array($letter, range("a", "z")) || in_array($letter, $numbers))
		{
			$newStringTab[]=$letter;
			//print($letter);
		}
		elseif($letter==" ")
		{
			$newStringTab[]="-";
		}
	}

	if(count($newStringTab))
	{
		$newString=implode($newStringTab);
		if($maxlen>0)
		{
			$newString=substr($newString, 0, $maxlen);
		}
		 
		$newString = removeDuplicates('--', '-', $newString);
	}
	else
	{
		$newString='';
	}

	return $newString;
}
 
 
function checkSlug($sSlug)
{
	if(ereg ("^[a-zA-Z0-9]+[a-zA-Z0-9\_\-]*$", $sSlug))
	{
		return true;
	}

	return false;
}
 
function removeDuplicates($sSearch, $sReplace, $sSubject)
{
	$i=0;
	do{

		$sSubject=str_replace($sSearch, $sReplace, $sSubject);
		$pos=strpos($sSubject, $sSearch);
		 
		$i++;
		if($i>100)
		{
			die('removeDuplicates() loop error');
		}
		 
	}while($pos!==false);

	return $sSubject;
}
 
 
 
function _truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false) {
	if ($length == 0)
		return '';

	if (strlen($string) > $length) {
		$length -= min($length, strlen($etc));
		if (!$break_words && !$middle) {
			$string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
		}
		if(!$middle) {
			return substr($string, 0, $length) . $etc;
		} else {
			return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
		}
	} else {
		return $string;
	}
}

class String{
	public static function truncate($s, $l, $e = '...', $isHTML = false){
		$i = 0;
		$tags = array();
		if($isHTML){
			preg_match_all('/<[^>]+>([^<]*)/', $s, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
			foreach($m as $o){
				if($o[0][1] - $i >= $l)
					break;
				$t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
				if($t[0] != '/')
					$tags[] = $t;
				elseif(end($tags) == substr($t, 1))
				array_pop($tags);
				$i += $o[1][1] - $o[0][1];
			}
		}
		return substr($s, 0, $l = min(strlen($s),  $l + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '') . (strlen($s) > $l ? $e : '');
	}
}



function startsWith($haystack, $needle)
{
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}

	return (substr($haystack, -$length) === $needle);
}

function week_decode( $t ){
	 
	$w = $t % 100;
	$y = round( ($t - $w) / 100 );
	 
	 
	$f = date('w', mktime(0, 0, 0, 1, 1, $y));
	$f = (7 - $f) % 7;

	 
	$ts_start = mktime(0, 0, 0, 1, ($w-1)*7+2+$f, $y);
	$ts_stop = mktime(0, 0, 0, 1, $w*7+1+$f, $y);
	 
	 
	return array(
			date('Y-m-d', $ts_start),
			date('Y-m-d', $ts_stop),
	);
	 
}


function week_encode( $s ) {
	$ts = strtotime( $s );
	list($w, $y) = explode(' ', date('W o', $ts));
	return $y*100+$w;
}

?>