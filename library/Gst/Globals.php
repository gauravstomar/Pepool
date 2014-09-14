<?php
$browser = browser_detection('full');
$config = Zend_Registry::get('config');
define("BROWSER",$browser[0]);
define("BROWSER_VERSION",$browser[0]);
define('DOCUMENT_ROOT',$config->www->baseurl);
define('WWW_ROOT',$config->www->sitename);
define('IMAGES',WWW_ROOT."public/images/");
define('CSS',WWW_ROOT."css/");
define('JS',WWW_ROOT."js/");
define('JSEXT',WWW_ROOT."public/js/");
define('POST',$_SERVER['REQUEST_METHOD']=='POST');
define('MAX_ITEM_NAME_LENGTH',16);

//For Mail
