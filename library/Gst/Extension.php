<?php

function crop_image($src,$target,$expected_length=100,$widthonly = false)
{
	$quality = 90;
	$size = getimagesize($src);
	$selected_length = 100;

	if($widthonly)
	{
		list($width, $height, $type, $attr) = getimagesize($src);
		if($width>$expected_length)
		{
			$diff = $width-$expected_length;
			$percnt_reduced = (($diff/$width)*100);
			$EXnew_height = ceil($height-(($percnt_reduced*$height)/100));
			$EXnew_width = $width-$diff;
		}
		else
		{
			$EXnew_height = $height;
			$EXnew_width = $width;
		}
	}
	else
	{
		  if($size[0] < $size[1])
		  {
			 $selected_length = $size[0];
			 $x = 0;
			 $y = (($size[1]-$size[0])/2);
		  }
		  else
		  {
			 $selected_length = $size[1];
			 $x = (($size[0]-$size[1])/2);
			 $y = 0;
		  }
	 }
	
  $create_images = array('image/png'=>'imagecreatefrompng','image/jpeg'=>'imagecreatefromjpeg','image/gif'=>'imagecreatefromgif');
  $save_images = array('image/png'=>'imagepng','image/jpeg'=>'imagejpeg','image/gif'=>'imagegif');
  $extensions = array('image/png'=>'.png','image/jpeg'=>'.jpg','image/gif'=>'.gif');
  if (!$create_image = $create_images[$size['mime']]) {trigger_error("MIME Type unsupported: {$size['mime']}",E_USER_WARNING);exit;}
  if (!$save_image = $save_images[$size['mime']]) {trigger_error("MIME Type unsupported: {$size['mime']}",E_USER_WARNING);exit;}
  if (!$extension = $extensions[$size['mime']]) {trigger_error("MIME Type unsupported: {$size['mime']}",E_USER_WARNING);exit;}
  if($extension==".png")$quality = 9;
  $img_r = $create_image($src);

	if($widthonly)
	{
		$dst_r = ImageCreateTrueColor($EXnew_width, $EXnew_height);
		imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $EXnew_width, $EXnew_height, $width, $height);
		$return = array("width"=>$EXnew_width,"height"=>$EXnew_height);
	}
	else
	{
		$dst_r = ImageCreateTrueColor($expected_length, $expected_length);
		imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $expected_length, $expected_length, $selected_length, $selected_length);
		$return = array("width"=>$expected_length,"height"=>$expected_length);
	}

	$save_image($dst_r, $target, $quality);//or die("error in resizing");
	
	imagedestroy($img_r);
	imagedestroy($dst_r);
	
	return $return;
}

function HackCheck()
{
	$myServer = str_replace('http://','',WWW_ROOT);
	if(!strpos($_SERVER['HTTP_REFERER'],$myServer))@header("Location:".WWW_ROOT);
}
function str($return)
{
	$return = nl2br(stripslashes($return));
	return $return;
}
function __autoload($class)
{
    require_once($class.'.php');
}
function maxLen($a,$b)
{
	return strlen($a)>$b?substr($a,0,$b)."..":$a;
}
function pprint($a)
{	print is_array($a)?"<pre>":"<hr noshade />";
	print_r($a);
	print is_array($a)?"</pre>":"<hr noshade />";
}
function remove($file)
{
	if (!is_file($file)) {
		return false;
	}
	if (!@unlink($file)) {
		return false;
	}
	return true;
}
function jsonHeaders()
{
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	//header('Content-Type: text/javascript; charset=UTF-8');
}
function jencode($v)
{	
	jsonHeaders();
	die(json_encode($v));
}
function jdecode($v)
{	
	$vRaw = json_decode($v); $v = array();
	if(is_object($vRaw) || is_array($vRaw))foreach($vRaw as $k=>$vParse)$v[$k] = $vParse;
	return $v;
}
function array_unique_diff_key($array1, $array2)
{
  if (is_array($array1) && is_array($array2))
    return array_diff_key($array1, $array2) + array_diff_key($array2, $array1);
  else if (is_array($array1)) return $array1;
  else if (is_array($array2)) return $array2;
  else return array();
} 
function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}
function goBack()
{
	@header("Location:".$_SERVER['HTTP_REFERER']);
}
function cmp($a, $b)
{
    return strcmp($a["timestamps"], $b["timestamps"]);
}
function timeDiff($time, $opt = array())
{	$defOptions = array(
		'to' => 0,
		'parts' => 2,
		'precision' => 'second',
		'distance' => TRUE,
		'separator' => ', ',
		'next'=>'ago',
		'prev'=>'away'
	);
	$opt = array_merge($defOptions, $opt);
	$db = Zend_Registry::get('db');
	$span = $db->query("SELECT NOW() as t");
	$span = $span->fetchAll();
	(!$opt['to']) && ($opt['to'] = strtotime($span[0]["t"]));
	$str = '';
	$diff = ($opt['to'] > $time) ? $opt['to']-$time : $time-$opt['to'];
	$periods = array(
		'year' => 31556926,
		'month' => 2629744,
		'week' => 604800,
		'day' => 86400,
		'hour' => 3600,
		'minute' => 60,
		'second' => 1
	);
	if ($opt['precision'] != 'second')
		$diff = round(($diff/$periods[$opt['precision']])) * $periods[$opt['precision']];
	(0 == $diff) && ($str = 'less than 1 '.$opt['precision']);
	foreach ($periods as $label => $value) {
		(($x=floor($diff/$value))&&$opt['parts']--) && $str.=($str?$opt['separator']:'').($x.' '.$label.(($x>1)?'s':''));
		if ($opt['parts'] == 0 || $label == $opt['precision']) break;
		$diff -= $x*$value;
	}$opt['distance'] && $str.=" ".(($str&&$opt['to']>$time)?$opt['next']:$opt['prev']);
	return $str;
}

function encode($id,$input="")
{	$return = (function_exists(mcrypt_encrypt))?mcrypt_encrypt(base64_encode($id)):str_replace("=","",base64_encode($id));
	if($input!="")$return = trim(ereg_replace(' +',' -',preg_replace('/[^a-zA-Z0-9\s]/','-',strtolower($input))))."-".$return;  
	return str_replace(array(' ','--'),array('','-'),$return);  
}

function decode($string)
{	$s = substr(strrchr($string,"-"),1); if($s!="")$string = $s;
	$id=(function_exists(mcrypt_decrypt))?mcrypt_decrypt(base64_decode($string)): base64_decode($string);
	return $id;
}

function resize($filename, $savepath, $width=100,$height=100)
{
    list($width_orig, $height_orig, $type) = getimagesize($filename);
    if($width_orig>$width || $height_orig>$height)
    {
        if ($width && ($width_orig < $height_orig))
        {
               $width = ($height / $height_orig) * $width_orig;
        }
        else
        {
               $height = ($width / $width_orig) * $height_orig;
        }
    }
    else
    {
        $width=$width_orig;
        $height=$height_orig;
    }
    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    if($type==2)
    {
        $image = imagecreatefromjpeg($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        imagejpeg($image_p, $savepath , 100);
    }
    elseif($type==3)
    {
        $image = imagecreatefrompng($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        imagepng($image_p, $savepath , 100);
    }
    elseif($type==1)
    {
        $image = imagecreatefromgif($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        imagegif($image_p, $savepath , 100);
    }
    elseif($type)
    {
        $image = imagecreatefromjpeg($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        imagejpeg($image_p, $savepath , 100);
    }
}

function browser_detection( $which_test ) {
	static $dom_browser, $safe_browser, $browser_user_agent, $os, $browser_name, $s_browser, $ie_version, 
	$version_number, $os_number, $b_repeat, $moz_version, $moz_version_number, $moz_rv, $moz_rv_full, $moz_release, 
	$type, $math_version_number;
	if ( !$b_repeat )
	{
		$dom_browser = false;
		$type = 'bot';// default to bot since you never know with bots
		$safe_browser = false;
		$os = '';
		$os_number = '';
		$a_os_data = '';
		$browser_name = '';
		$version_number = '';
		$math_version_number = '';
		$ie_version = '';
		$moz_version = '';
		$moz_version_number = '';
		$moz_rv = '';
		$moz_rv_full = '';
		$moz_release = '';
		$b_success = false;// boolean for if browser found in main test

		$browser_user_agent = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';

		$a_browser_types[] = array( 'opera', true, 'op', 'bro' );
		$a_browser_types[] = array( 'omniweb', true, 'omni', 'bro' );// mac osx browser, now uses khtml engine:
		$a_browser_types[] = array( 'msie', true, 'ie', 'bro' );
		$a_browser_types[] = array( 'konqueror', true, 'konq', 'bro' );
		$a_browser_types[] = array( 'safari', true, 'saf', 'bro' );

		$a_browser_types[] = array( 'gecko', true, 'moz', 'bro' );
		$a_browser_types[] = array( 'netpositive', false, 'netp', 'bbro' );// beos browser
		$a_browser_types[] = array( 'lynx', false, 'lynx', 'bbro' ); // command line browser
		$a_browser_types[] = array( 'elinks ', false, 'elinks', 'bbro' ); // new version of links
		$a_browser_types[] = array( 'elinks', false, 'elinks', 'bbro' ); // alternate id for it
		$a_browser_types[] = array( 'links ', false, 'links', 'bbro' ); // old name for links
		$a_browser_types[] = array( 'links', false, 'links', 'bbro' ); // alternate id for it
		$a_browser_types[] = array( 'w3m', false, 'w3m', 'bbro' ); // open source browser, more features than lynx/links
		$a_browser_types[] = array( 'webtv', false, 'webtv', 'bbro' );// junk ms webtv
		$a_browser_types[] = array( 'amaya', false, 'amaya', 'bbro' );// w3c browser
		$a_browser_types[] = array( 'dillo', false, 'dillo', 'bbro' );// linux browser, basic table support
		$a_browser_types[] = array( 'ibrowse', false, 'ibrowse', 'bbro' );// amiga browser
		$a_browser_types[] = array( 'icab', false, 'icab', 'bro' );// mac browser 
		$a_browser_types[] = array( 'crazy browser', true, 'ie', 'bro' );// uses ie rendering engine
		$a_browser_types[] = array( 'sonyericssonp800', false, 'sonyericssonp800', 'bbro' );// sony ericsson handheld

		$a_browser_types[] = array( 'googlebot', false, 'google', 'bot' );// google 
		$a_browser_types[] = array( 'mediapartners-google', false, 'adsense', 'bot' );// google adsense
		$a_browser_types[] = array( 'yahoo-verticalcrawler', false, 'yahoo', 'bot' );// old yahoo bot
		$a_browser_types[] = array( 'yahoo! slurp', false, 'yahoo', 'bot' ); // new yahoo bot 
		$a_browser_types[] = array( 'yahoo-mm', false, 'yahoomm', 'bot' ); // gets Yahoo-MMCrawler and Yahoo-MMAudVid bots
		$a_browser_types[] = array( 'inktomi', false, 'inktomi', 'bot' ); // inktomi bot
		$a_browser_types[] = array( 'slurp', false, 'inktomi', 'bot' ); // inktomi bot
		$a_browser_types[] = array( 'fast-webcrawler', false, 'fast', 'bot' );// Fast AllTheWeb
		$a_browser_types[] = array( 'msnbot', false, 'msn', 'bot' );// msn search 
		$a_browser_types[] = array( 'ask jeeves', false, 'ask', 'bot' ); //jeeves/teoma
		$a_browser_types[] = array( 'teoma', false, 'ask', 'bot' );//jeeves teoma
		$a_browser_types[] = array( 'scooter', false, 'scooter', 'bot' );// altavista 
		$a_browser_types[] = array( 'openbot', false, 'openbot', 'bot' );// openbot, from taiwan
		$a_browser_types[] = array( 'ia_archiver', false, 'ia_archiver', 'bot' );// ia archiver
		$a_browser_types[] = array( 'zyborg', false, 'looksmart', 'bot' );// looksmart 
		$a_browser_types[] = array( 'almaden', false, 'ibm', 'bot' );// ibm almaden web crawler 
		$a_browser_types[] = array( 'baiduspider', false, 'baidu', 'bot' );// Baiduspider asian search spider
		$a_browser_types[] = array( 'psbot', false, 'psbot', 'bot' );// psbot image crawler 
		$a_browser_types[] = array( 'gigabot', false, 'gigabot', 'bot' );// gigabot crawler 
		$a_browser_types[] = array( 'naverbot', false, 'naverbot', 'bot' );// naverbot crawler, bad bot, block
		$a_browser_types[] = array( 'surveybot', false, 'surveybot', 'bot' );// 
		$a_browser_types[] = array( 'boitho.com-dc', false, 'boitho', 'bot' );//norwegian search engine 
		$a_browser_types[] = array( 'objectssearch', false, 'objectsearch', 'bot' );// open source search engine
		$a_browser_types[] = array( 'answerbus', false, 'answerbus', 'bot' );// http://www.answerbus.com/, web questions
		$a_browser_types[] = array( 'sohu-search', false, 'sohu', 'bot' );// chinese media company, search component
		$a_browser_types[] = array( 'iltrovatore-setaccio', false, 'il-set', 'bot' );

		$a_browser_types[] = array( 'w3c_validator', false, 'w3c', 'lib' ); // uses libperl, make first
		$a_browser_types[] = array( 'wdg_validator', false, 'wdg', 'lib' ); // 
		$a_browser_types[] = array( 'libwww-perl', false, 'libwww-perl', 'lib' ); 
		$a_browser_types[] = array( 'jakarta commons-httpclient', false, 'jakarta', 'lib' );
		$a_browser_types[] = array( 'python-urllib', false, 'python-urllib', 'lib' ); 

		$a_browser_types[] = array( 'getright', false, 'getright', 'dow' );
		$a_browser_types[] = array( 'wget', false, 'wget', 'dow' );// open source downloader, obeys robots.txt

		$a_browser_types[] = array( 'mozilla/4.', false, 'ns', 'bbro' );
		$a_browser_types[] = array( 'mozilla/3.', false, 'ns', 'bbro' );
		$a_browser_types[] = array( 'mozilla/2.', false, 'ns', 'bbro' );

		$moz_types = array( 'firebird', 'phoenix', 'firefox', 'iceweasel', 'galeon', 'k-meleon', 'camino', 'epiphany', 'netscape6', 'netscape', 'multizilla', 'rv' );

		$i_count = count($a_browser_types);
		for ($i = 0; $i < $i_count; $i++)
		{

			$s_browser = $a_browser_types[$i][0];// text string to id browser from array

			if (stristr($browser_user_agent, $s_browser)) 
			{

				$safe_browser = true;

				// assign values based on match of user agent string
				$dom_browser = $a_browser_types[$i][1];// hardcoded dom support from array
				$browser_name = $a_browser_types[$i][2];// working name for browser
				$type = $a_browser_types[$i][3];// sets whether bot or browser

				switch ( $browser_name )
				{

					case 'ns':
						$safe_browser = false;
						$version_number = browser_version( $browser_user_agent, 'mozilla' );
						break;
					case 'moz':

						$moz_rv_full = browser_version( $browser_user_agent, 'rv' );
						// this slices them back off for math comparisons
						$moz_rv = substr( $moz_rv_full, 0, 3 );

						// this is to pull out specific mozilla versions, firebird, netscape etc..
						$i_count = count( $moz_types );
						for ( $i = 0; $i < $i_count; $i++ )
						{
							if ( stristr( $browser_user_agent, $moz_types[$i] ) ) 
							{
								$moz_version = $moz_types[$i];
								$moz_version_number = browser_version( $browser_user_agent, $moz_version );
								break;
							}
						}

						if ( !$moz_rv ) 
						{ 
							$moz_rv = substr( $moz_version_number, 0, 3 ); 
							$moz_rv_full = $moz_version_number; 

						}

						if ( $moz_version == 'rv' ) 
						{
							$moz_version = 'mozilla';
						}
						
						$version_number = $moz_rv;

						$moz_release = browser_version( $browser_user_agent, 'gecko/' );

						if ( ( $moz_release < 20020400 ) || ( $moz_rv < 1 ) )
						{
							$safe_browser = false;
						}
						break;
					case 'ie':
						$version_number = browser_version( $browser_user_agent, $s_browser );

						if ( stristr( $browser_user_agent, 'mac') )
						{
							$ie_version = 'ieMac';
						}

						elseif ( $version_number >= 5 )
						{
							$ie_version = 'ie5x';
						}
						elseif ( ( $version_number > 3 ) && ( $version_number < 5 ) )
						{
							$dom_browser = false;
							$ie_version = 'ie4';
							// this depends on what you're using the script for, make sure this fits your needs
							$safe_browser = true; 
						}
						else
						{
							$ie_version = 'old';
							$dom_browser = false;
							$safe_browser = false; 
						}
						break;
					case 'op':
						$version_number = browser_version( $browser_user_agent, $s_browser );
						if ( $version_number < 5 )// opera 4 wasn't very useable.
						{
							$safe_browser = false; 
						}
						break;
					case 'saf':
						$version_number = browser_version( $browser_user_agent, $s_browser );
						break;
					default:
						$version_number = browser_version( $browser_user_agent, $s_browser );
						break;
				}

				$b_success = true;
				break;
			}
		}

		if ( !$b_success ) 
		{

			$s_browser = substr( $browser_user_agent, 0, strcspn( $browser_user_agent , '();') );

			ereg('[^0-9][a-z]*-*\ *[a-z]*\ *[a-z]*', $s_browser, $r );
			$s_browser = $r[0];
			$version_number = browser_version( $browser_user_agent, $s_browser );

		}

		$a_os_data = which_os( $browser_user_agent, $browser_name, $version_number );
		$os = $a_os_data[0];// os name, abbreviated
		$os_number = $a_os_data[1];// os number or version if available

		// this ends the run through once if clause, set the boolean 
		//to true so the function won't retest everything
		$b_repeat = true;

		// pulls out primary version number from more complex string, like 7.5a, 
		// use this for numeric version comparison
		$m = array();
		if ( ereg('[0-9]*\.*[0-9]*', $version_number, $m ) )
		{
			$math_version_number = $m[0]; 
			//print_r($m);
		}
		
	}

	switch ( $which_test )
	{
		case 'safe':// returns true/false if your tests determine it's a safe browser
			return $safe_browser; 
			break;
		case 'ie_version': // returns ieMac or ie5x
			return $ie_version;
			break;
		case 'moz_version':// returns array of all relevant moz information
			$moz_array = array( $moz_version, $moz_version_number, $moz_rv, $moz_rv_full, $moz_release );
			return $moz_array;
			break;
		case 'dom':// returns true/fale if a DOM capable browser
			return $dom_browser;
			break;
		case 'os':// returns os name
			return $os; 
			break;
		case 'os_number':// returns os number if windows
			return $os_number;
			break;
		case 'browser':// returns browser name
			return $browser_name; 
			break;
		case 'number':// returns browser number
			return $version_number;
			break;
		case 'full':// returns all relevant browser information in an array
			$full_array = array( $browser_name, $version_number, $ie_version, $dom_browser, $safe_browser, 
				$os, $os_number, $s_browser, $type, $math_version_number );
			return $full_array;
			break;
		case 'type':// returns what type, bot, browser, maybe downloader in future
			return $type;
			break;
		case 'math_number':// returns numerical version number, for number comparisons
			return $math_version_number;
			break;
		default:
			break;
	}
}

// gets which os from the browser string
function which_os ( $browser_string, $browser_name, $version_number  )
{
	// initialize variables
	$os = '';
	$os_version = '';

	$a_mac = array( 'mac68k', 'macppc' );// this is not used currently
	// same logic, check in order to catch the os's in order, last is always default item
	$a_unix = array( 'freebsd', 'openbsd', 'netbsd', 'bsd', 'unixware', 'solaris', 'sunos', 'sun4', 'sun5', 'suni86', 'sun', 'irix5', 'irix6', 'irix', 'hpux9', 'hpux10', 'hpux11', 'hpux', 'hp-ux', 'aix1', 'aix2', 'aix3', 'aix4', 'aix5', 'aix', 'sco', 'unixware', 'mpras', 'reliant', 'dec', 'sinix', 'unix' );
	// only sometimes will you get a linux distro to id itself...
	$a_linux = array( 'ubuntu', 'kubuntu', 'xubuntu', 'mepis', 'xandros', 'linspire', 'sidux', 'kanotix', 'debian', 'opensuse', 'suse', 'fedora', 'redhat', 'slackware', 'slax', 'mandrake', 'mandriva', 'gentoo', 'sabayon', 'linux' );
	$a_linux_process = array ( 'i386', 'i586', 'i686' );// not use currently
	// note, order of os very important in os array, you will get failed ids if changed
	$a_os = array( 'beos', 'os2', 'amiga', 'webtv', 'mac', 'nt', 'win', $a_unix, $a_linux );

	//os tester
	$i_count = count( $a_os );
	for ( $i = 0; $i < $i_count; $i++ )
	{
		//unpacks os array, assigns to variable
		$s_os = $a_os[$i];

		if ( !is_array( $s_os ) && stristr( $browser_string, $s_os ) && !stristr( $browser_string, "linux" ) )
		{
			$os = $s_os;

			switch ( $os )
			{
				case 'win':
					if ( strstr( $browser_string, '95' ) )
					{
						$os_version = '95';
					}
					elseif ( ( strstr( $browser_string, '9x 4.9' ) ) || ( strstr( $browser_string, 'me' ) ) )
					{
						$os_version = 'me';
					}
					elseif ( strstr( $browser_string, '98' ) )
					{
						$os_version = '98';
					}
					elseif ( strstr( $browser_string, '2000' ) )// windows 2000, for opera ID
					{
						$os_version = 5.0;
						$os = 'nt';
					}
					elseif ( strstr( $browser_string, 'xp' ) )// windows 2000, for opera ID
					{
						$os_version = 5.1;
						$os = 'nt';
					}
					elseif ( strstr( $browser_string, '2003' ) )// windows server 2003, for opera ID
					{
						$os_version = 5.2;
						$os = 'nt';
					}
					elseif ( strstr( $browser_string, 'vista' ) )// windows vista, for opera ID
					{
						$os_version = 6.0;
						$os = 'nt';
					}
					elseif ( strstr( $browser_string, 'ce' ) )// windows CE
					{
						$os_version = 'ce';
					}
					break;
				case 'nt':
					if ( strstr( $browser_string, 'nt 6.0' ) )// windows server 2003
					{
						$os_version = 6.0;
						$os = 'nt';
					}
					elseif ( strstr( $browser_string, 'nt 5.2' ) )// windows server 2003
					{
						$os_version = 5.2;
						$os = 'nt';
					}
					elseif ( strstr( $browser_string, 'nt 5.1' ) || strstr( $browser_string, 'xp' ) )// windows xp
					{
						$os_version = 5.1;//
					}
					elseif ( strstr( $browser_string, 'nt 5' ) || strstr( $browser_string, '2000' ) )// windows 2000
					{
						$os_version = 5.0;
					}
					elseif ( strstr( $browser_string, 'nt 4' ) )// nt 4
					{
						$os_version = 4;
					}
					elseif ( strstr( $browser_string, 'nt 3' ) )// nt 4
					{
						$os_version = 3;
					}
					break;
				case 'mac':
					if ( strstr( $browser_string, 'os x' ) ) 
					{
						$os_version = 10;
					}
					//this is a crude test for os x, since safari, camino, ie 5.2, & moz >= rv 1.3 
					//are only made for os x
					elseif ( ( $browser_name == 'saf' ) || ( $browser_name == 'cam' ) || 
						( ( $browser_name == 'moz' ) && ( $version_number >= 1.3 ) ) || 
						( ( $browser_name == 'ie' ) && ( $version_number >= 5.2 ) ) )
					{
						$os_version = 10;
					}
					break;
				default:
					break;
			}
			break;
		}

		elseif ( is_array( $s_os ) && ( $i == ( count( $a_os ) - 2 ) ) )
		{
			$i_count = count($s_os);
			for ($j = 0; $j < $i_count; $j++)
			{
				if ( stristr( $browser_string, $s_os[$j] ) )
				{
					$os = 'unix'; //if the os is in the unix array, it's unix, obviously...
					$os_version = ( $s_os[$j] != 'unix' ) ? $s_os[$j] : '';// assign sub unix version from the unix array
					break;
				}
			}
		} 

		elseif ( is_array( $s_os ) && ( $i == ( count( $a_os ) - 1 ) ) )
		{
			$i_count = count($s_os);
			for ($j = 0; $j < $i_count; $j++)
			{
				if ( stristr( $browser_string, $s_os[$j] ) )
				{
					$os = 'lin';
					// assign linux distro from the linux array, there's a default
					//search for 'lin', if it's that, set version to ''
					$os_version = ( $s_os[$j] != 'linux' ) ? $s_os[$j] : '';
					break;
				}
			}
		} 
	}

	// pack the os data array for return to main function
	$os_data = array( $os, $os_version );
	return $os_data;
}

// function returns browser number, gecko rv number, or gecko release date
//function browser_version( $browser_user_agent, $search_string, $substring_length )
function browser_version( $browser_user_agent, $search_string )
{
	// 12 is the longest that will be required, handles release dates: 20020323; 0.8.0+
	$substring_length = 12;
	//initialize browser number, will return '' if not found
	$browser_number = '';

	// use the passed parameter for $search_string
	// start the substring slice right after these moz search strings
	// there are some cases of double msie id's, first in string and then with then number
	$start_pos = 0;  
	/* this test covers you for multiple occurrences of string, only with ie though
	 with for example google bot you want the first occurance returned, since that's where the
	numbering happens */
	for ( $i = 0; $i < 4; $i++ )
	{
		//start the search after the first string occurrence
		if ( strpos( $browser_user_agent, $search_string, $start_pos ) !== false )
		{
			//update start position if position found
			$start_pos = strpos( $browser_user_agent, $search_string, $start_pos ) + strlen( $search_string );
			if ( $search_string != 'msie' )
			{
				break;
			}
		}
		else 
		{
			break;
		}
	}

	if ( $search_string != 'gecko/' ) 
	{ 
		if ( $search_string == 'omniweb' )
		{
			$start_pos += 2;// handles the v in 'omniweb/v532.xx
		}
		else
		{
			$start_pos++; 
		}
	}

	$browser_number = substr( $browser_user_agent, $start_pos, $substring_length );

	$browser_number = substr( $browser_number, 0, strcspn($browser_number, ' );') );

	if ( !is_numeric( substr( $browser_number, 0, 1 ) ) )
	{ 
		$browser_number = ''; 
	}

	return $browser_number;
}
