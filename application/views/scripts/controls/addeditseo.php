<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<link href="../../../../public/css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Add SEO Element to a part of the site</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/seo">Manage SEO</a> </li>
                              </ul>
                          </div></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellpadding="5" cellspacing="0">
                      <tr>
                        <td align="left" valign="top">
<form action="" method="post">
<input type="hidden" value="<?=$this->seo["id"]?>" name="id" />
<table cellspacing="2" cellpadding="4" border="0" align="center" width="50%">
	<tbody>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>URI</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="URI" type="text" class="textbox" id="URI" style="width: 200px;" value="<?=$this->seo["URI"]?>"/></td>
		</tr>
		<tr>
			<td align="left" valign="middle"><strong>Title</strong></td>
			<td align="left" valign="middle">				<input name="title" type="text" class="textbox" id="title" style="width: 200px;" value="<?=$this->seo["title"]?>"/>				</td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle"><strong>Meta keywords</strong></td>
			<td align="left" width="50%" valign="middle">				<input name="metaKeyword" type="text" class="textbox" id="metaKeyword" style="width: 200px;" value="<?=$this->seo["metaKeyword"]?>"/>				</td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle"><strong>Meta description</strong></td>
			<td align="left" width="50%" valign="middle">				<input name="metaDescri" type="text" class="textbox" id="metaDescri" style="width: 200px;" value="<?=$this->seo["metaDescri"]?>"/>				</td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle"><strong>Revisit-after</strong></td>
			<td align="left" width="50%" valign="middle">				<input name="revisitAfter" type="text" class="textbox" id="revisitAfter" style="width: 200px;" value="<?=$this->seo["revisitAfter"]?>"/>				</td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle"><strong>Author</strong></td>
			<td align="left" width="50%" valign="middle">				<input name="author" type="text" class="textbox" id="author" style="width: 200px; background-color: rgb(255, 255, 160);" value="<?=$this->seo["author"]?>"/>				</td>
		</tr>
		<tr>
			<td align="left" valign="middle"><strong>Blocked</strong></td>
			<td align="left" valign="middle"><select name="status" class="textbox">
				<option value="Y" <? if($this->seo["status"]=="Y"){?>selected="selected"<? }?> >Y</option>
				<option value="N" <? if($this->seo["status"]!="Y"){?>selected="selected"<? }?> >N</option>
			</select></td>
		</tr>
		<tr>
			<td align="center" valign="middle" colspan="2"><input type="submit" class="button1" value="Submit"/>			</td>
		</tr>
	</tbody>
</table>
</form></td>
                        </tr>
                    </table></td>
                  </tr>
              </table>