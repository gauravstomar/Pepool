<?php
//header("HTTP/1.x 500 Internal Server Error");
if(strpos($_SERVER['HTTP_HOST'],"localhost")===false)@header("Location:http://www.pepool.com");
require_once 'Zend/Registry.php';
$config = Zend_Registry::get('config');
?>
<html>
<head>
	<title>Zets - 500 Internal Server Error</title>
</head>
<body>
<?php 
$db = Zend_Registry::get('db');
$seo = $db->query("SELECT * FROM errors WHERE page = 500");
$seo = $seo->fetchAll();
print_r(nl2br($seo[0]["content"]));

if ($config->debug): ?>
	<div style="overflow: auto; margin-top: 10px; padding: 2px; border: 1px dashed black; background-color: #eee">
		<strong>Debugging information:</strong><br />
		<pre><?= $e->__toString(); ?></pre>
	</div>
<?php endif; ?>
</body>
</html>