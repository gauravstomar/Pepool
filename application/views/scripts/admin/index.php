<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mtw">
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="background:#0099FF url(<?=IMAGES?>adminTopBg.jpg) repeat-x"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" align="right"><img src="<?=IMAGES?>adminLogo.jpg" alt="admin" /></td>
            <td align="right" valign="bottom" class="link1" style="padding:5px;"><a href="<?=WWW_ROOT?>" target="_blank">View Site</a> | <a href="<?=WWW_ROOT?>admin/logout/">Logout</a>&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" class="tn1"><div id="tab1">
                <ul>
                  <li><a href="<?=WWW_ROOT?>admin/" target="_self">Home </a></li>
                  <!--<li><a href="<?=WWW_ROOT?>controls/seo" target="gst" >SEO</a></li>-->
                  <li><a href="<?=WWW_ROOT?>controls/cms" target="gst" >CMS</a></li>
                  <li><a href="<?=WWW_ROOT?>controls/user" target="gst" >Users</a></li>
                  <li><a href="<?=WWW_ROOT?>controls/contests" target="gst" >Items</a></li>
                  <li><a href="<?=WWW_ROOT?>controls/lists" target="gst" >Lists</a></li>
                </ul>
            </div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td align="left" valign="top"><iframe id="gst" name="gst" frameborder="0" width="100%" height="500px" src="<?=WWW_ROOT?>controls/"></iframe></td>
              <td width="250" align="left" valign="top" class="left_line"><? print $this->render('navigation/adminRight.php');?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="footer">
      <tr>
        <td align="center" class="a12gray">Copyright 2005 - 2008 iVoting.  All Rights Reserved. iVoting is a registered trademark.<br /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
