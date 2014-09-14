<?php
require_once('../../includes/SiteSetting.php');
if($_REQUEST['title'])
{
	$qry = "select * from tbl_module_photos, where moduleid = '".$_REQUEST['moduleid']."' and title = '".$_REQUEST['title']."' order by posted_date desc";
	$album_photo = $dbObj->customqry($qry,$prn); $album_photo = @mysql_fetch_assoc($album_photo);
}
?>
<p align="center"><a href="<?=SITEROOT?>profile/halit_ince"><img src="<?=SITEROOT?>uploads/user_photo/50X50/default_male.jpg" class="imgbrder"/></a></p>
<p align="center"><a href="<?=SITEROOT?>profile/halit_ince">halit</a></p>