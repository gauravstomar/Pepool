<?php 

include "../../library/Gst/Extension.php";

$folder		=	explode("/",$_POST["folder"]);
$userid   	= 	decode($folder[1]);
$name 		= 	$_FILES["Filedata"]["name"];
$info 		= 	pathinfo($name);
$thumbnail 	= 	encode(rand(0,time())).".".$info['extension'];
$basepath	= 	"../images/album/";
$original 	= 	$basepath."original/".$thumbnail;
$msql 		= 	"Inserted";

if(!in_array($info['extension'],array("gif","GIF","jpeg","JPEG","jpg","JPG","png","PNG")))
{
	header("HTTP/1.x 500 Internal Server Error");
	exit;
}



move_uploaded_file($_FILES["Filedata"]["tmp_name"],$original);
crop_image($original,$basepath."100/".$thumbnail,100,true);
$size = crop_image($original,$basepath."670/".$thumbnail,670,true);

$conn = mysql_connect("localhost","pepool_root","uejipbtjtZga") or ($msql = "Unable to connect to DB: " . mysql_error());
mysql_select_db("pepool_pepool") or ($msql = "Unable to select mydbname: " . mysql_error());
mysql_query("INSERT INTO user_pics (uid,image,caption,height,width) VALUES ('$userid','$thumbnail','".mysql_escape_string($name)."','".$size["height"]."','".$size["width"]."')")or ($msql = "Query error: ".mysql_error());

switch ($_FILES['Filedata']['error'])
{  	case 0:	$msg = "No Error";break;
	case 1:	$msg = "The file is bigger than this PHP installation allows";break;
	case 2:	$msg = "The file is bigger than this form allows";break;
	case 3:	$msg = "Only part of the file was uploaded";break;
	case 4:	$msg = "No file was uploaded";break;
	case 6:	$msg = "Missing a temporary folder";break;
	case 7:	$msg = "Failed to write file to disk";break;
	case 8:	$msg = "File upload stopped by extension";break;
	default:$msg = "unknown error ".$_FILES['Filedata']['error'];break;
}

$stringData = "FILE INFORMATION\n\n userid: $userid\n\n name:$name\n\n info:$info\n\n thumbnail:$thumbnail\n\n basepath:$basepath\n\n original:$original\n\n msql:$msql";
$fh = fopen("uploadVARresults.txt","w"); fwrite($fh, $stringData.$result); fclose($fh); die("\n\nOK DONE");