<div style="margin-top:60px"><center><img src="sign.jpg" align="middle" alt="Sorry closed for maintenance, we will back soon :)" /><h1>Sorry closed for maintenance, we will back soon :)</h1></center></div>

<?php
//@author Gaurav S Tomar, gauravstomar@gmail.com,gauravstomar.blogspot.com

exit;

ini_set('memory_limit', '64M');
if(strpos($_SERVER['HTTP_HOST'],"www")===false && strpos($_SERVER['HTTP_HOST'],"localhost")===false)@header("Location:http://www.pepool.com".$_SERVER['REQUEST_URI']);

include "library/Zend/Loader.php";
define('PATH_ROOT', realpath(dirname(__FILE__) . '/'));
set_include_path('.'.PATH_SEPARATOR.'./library'.PATH_SEPARATOR.'./application/models/'.PATH_SEPARATOR.get_include_path());
Zend_Loader::registerAutoload();
Zend_Loader::loadClass('Zend_Controller_Front');
Zend_Loader::loadClass('Zend_Registry');
Zend_Loader::loadClass('Zend_View');
Zend_Loader::loadClass('Zend_Config_Ini');
Zend_Loader::loadClass('Zend_Db');
Zend_Loader::loadClass('Zend_Db_Table');
Zend_Loader::loadClass('Zend_Debug');
Zend_Loader::loadClass('Zend_Auth');
$logger = new Zend_Log(new Zend_Log_Writer_Null());

$config = new Zend_Config_Ini(PATH_ROOT.'/config/config.ini','general');

Zend_Registry::set('config', $config);
$config = Zend_Registry::get('config');
include "library/Gst/Loader.php";
$cache = Zend_Cache::factory('Core','File',array('lifetime'=>(60*60*24)),array('cache_dir'=>'public/temp'));
$cache->clean(Zend_Cache::CLEANING_MODE_OLD);
Zend_Registry::Set('cache',$cache);
$db = Zend_Db::factory($config->db->adapter,$config->db->config->toArray());
Zend_Db_Table::setDefaultAdapter($db);
Zend_Registry::set('db', $db);
$session = new Zend_Session_Namespace('gauravstomar');
Zend_Registry::set('session', $session);
try 
{	
	$front = Zend_Controller_Front::getInstance();
	$front->throwExceptions(true);
	$front->setControllerDirectory(PATH_ROOT.'/application/controllers');

	$route['do-nothing'] = new Zend_Controller_Router_Route('take-two-minute-challenge',array('controller'=>'index','action'=>'donothing'));
	$route['user'] = new Zend_Controller_Router_Route('user/:user/:tweet',array('controller'=>'users','action'=>'profile'));
	$route['my'] = new Zend_Controller_Router_Route('my/',array('controller'=>'users','action'=>'index'));
	$route['bio'] = new Zend_Controller_Router_Route('bio/:bio',array('controller'=>'users','action'=>'profile'));
	$route['ref'] = new Zend_Controller_Router_Route('i/:ref',array('controller'=>'index','action'=>'index'));
	$route['user'] = new Zend_Controller_Router_Route('user/:userid',array('controller'=>'index','action'=>'index'));
	$route['greet'] = new Zend_Controller_Router_Route('greet/:code',array('controller'=>'index','action'=>'greet'));
	foreach($route as $n=>$r)$front->getRouter()->addRoute($n,$r);
	$front->setBaseUrl($config->baseurl);
	$front->dispatch();
}
catch (Zend_Controller_Exception $e)
{	include 'errors/404.php';
}
catch (Exception $e)
{	include 'errors/500.php';
}