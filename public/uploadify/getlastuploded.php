<?php
include "../../library/Gst/Extension.php";
$conn = mysql_connect("localhost","pepool_root","uejipbtjtZga") or ($msql = "Unable to connect to DB: " . mysql_error());
mysql_select_db("pepool_pepool") or ($msql = "Unable to select mydbname: " . mysql_error());
if($_REQUEST['title'])
{
	$Pics = @mysql_fetch_assoc(mysql_query("select * from user_pics where caption = '".mysql_escape_string($_REQUEST['title'])."' order by timestamps desc"));
	$Pics["caption"] = stripslashes($Pics["caption"]); $Pics["timestamps"] = "just added";
	$Pics["id"] = encode($Pics["id"]); $Pics["uid"] = encode($Pics["uid"]);
	$Pics["W"] = $Pics["width"]; unset($Pics["width"]);
	$Pics["H"] = $Pics["height"]; unset($Pics["height"]);
}
die(json_encode($Pics));
?>