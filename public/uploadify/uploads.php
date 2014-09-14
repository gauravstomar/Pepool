<?
require_once('../../includes/SiteSetting.php');
include_once('../../includes/common.lib.php');
require_once('../../includes/classes/class.photo.php');


$photoObj = new Photo();

$vars = explode("/",$_REQUEST['folder']);
$userid   	= $vars[1];
$moduleid 	= $vars[2];
$itemid   	= $vars[3];
$file     	= $_FILES['Filedata'];
$title    	= $_FILES['Filedata']['name'];
$setupFile  = "uploadVARresults.txt";

$result =  $photoObj->uploadPhotoByUser($moduleid, $itemid,$userid,$title,$file,"-1");

$fh 		= fopen($setupFile,'w');
$stringData = "FILE INFORMATION NEXT\n	 folder: ".$_REQUEST['folder']."
										 moduleid: $moduleid \n
										 itemid: $itemid \n
										 userid: $userid \n
										 title: $title
										 result: $result";

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
fwrite($fh, $stringData.$result);
fclose($fh);
die("1");

