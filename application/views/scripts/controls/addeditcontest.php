<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<link href="../../../../public/css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Add a contest</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/contests">Manage existing items</a> </li>
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
<input type="hidden" value="<?=$this->contest["id"]?>" name="id" />
<table cellspacing="2" cellpadding="4" border="0" align="center" width="50%">
	<tbody>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>Contest name</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="name" type="text" class="textbox" id="contestname" style="width: 200px;" value="<?=$this->contest["name"]?>"/></td>
		</tr>
		<tr>
			<td align="left" valign="top" class="org"><strong>Details</strong>	<br /></td>
			<td align="left" valign="top" class="org"><textarea name="details" rows="7" class="textbox" id="details" style="width: 200px;"><?=$this->contest["details"]?></textarea></td>
		</tr>
		<tr>
			<td align="left" valign="top"><strong>Tags</strong></td>
			<td align="left" valign="middle"><textarea name="tags" rows="7" class="textbox" id="tags" style="width: 200px;"><?
			if(count($this->tags)>0)
			{
				foreach($this->tags as $tag)
				{
					$p.= $tag["tag"].", ";
				}
				print substr($p,0,count($p)-3);
				$p = NULL;
			}
			?></textarea></td>
		</tr>
		<tr>
			<td align="left" valign="middle"><strong>User</strong></td>
			<td align="left" valign="middle"><select name="uid" id="uid" class="textbox">
				<? foreach($this->users as $user){?>
				<option value="<?=$user["id"]?>"><?=$user["username"]?></option>
				<? }?>
			</select>			</td>
		</tr>
		<tr>
			<td align="left" valign="middle"><strong>Blocked</strong></td>
			<td align="left" valign="middle"><select name="status" class="textbox">
				<option value="Y" <? if($this->contest["status"]=="Y"){?>selected="selected"<? }?> >Y</option>
				<option value="N" <? if($this->contest["status"]!="Y"){?>selected="selected"<? }?> >N</option>
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