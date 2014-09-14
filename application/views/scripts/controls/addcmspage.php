<script type="text/javascript" src="<?=JSEXT?>tiny_mce/tiny_mce.js"></script>
<script language="javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, separator,bullist,numlist,indent,outdent,undo,redo,link,unlink,separator,forecolor,backcolor",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
	});
	
</script>
<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<link href="../../../../public/css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Add Page</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/cms">Manage Content</a> </li>
                              </ul>
                          </div></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellpadding="5" cellspacing="0">
                      <tr>
                        <td align="left" valign="top">
						<form name="form1" method="post" action="">
						<? 
						if($this->cms["id"]!="")
						{
						?>
							<input type="hidden" name="id" value="<?=$this->cms["id"]?>">
						<?
						}
						?>
						<table width="100%" border="0" cellspacing="5" cellpadding="0">
                          <tr>
                            <td width="120"><span class="g1 bold1">Page Title</span></td>
                            <td><input name="title" type="text" class="textbox" id="title" value="<?=stripslashes($this->cms["title"])?>" style="width:250px;" maxlength="99"/></td>
                            </tr>
                          <tr>
                            <td width="120"  class="g1 bold1">Make link on site</td>
                            <td  class="g1 bold1">
							<label><input name="status" type="radio" value="Y" <? if($this->cms["status"]=="Y"){?>checked<? }?> id="status" /> Yes </label>
							<label><input name="status" type="radio" value="N" <? if($this->cms["status"]!="Y"){?>checked<? }?> id="status" /> No </label>							</td>
                            </tr>
                          <tr>
                            <td width="120">Content of the page </td>
                            <td>&nbsp;</td>
                            </tr>
                          <tr>
                          	<td colspan="2" class="g1 bold1">
                          		<textarea name="content" id="content" style="height:200px; width:500px"><?=stripslashes($this->cms["content"])?></textarea>                          	</td>
                          	</tr>
                          <tr>
                            <td width="120" class="g1 bold1">&nbsp;</td>
                            <td class="g1 bold1"><input name="button" type="submit" class="button1" id="button" value="Submit" /></td>
                            </tr>
                        </table></form></td>
                        </tr>
                    </table></td>
                  </tr>
              </table>