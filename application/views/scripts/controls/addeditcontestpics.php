<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr> 
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Add pics to <?=$this->contests["name"]?></h2></td>
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
<form action="" method="post" enctype="multipart/form-data">
<table cellspacing="2" cellpadding="4" border="0" align="center" width="50%">
	<tbody>
		<tr>
			<td colspan="3" align="left" valign="middle" class="org"><h2>Contest image</h2></td>
			</tr>
		<tr>
			<td colspan="3" align="center" valign="middle" style="background:url(<?=IMAGES?>bgsq.gif)" class="org"><img src="<?=IMAGES?>contest/<?=$this->contests["logo"]?>" /><br /><br />
			<input type="submit" class="button1" name="deleteMain" value="delete" /> &nbsp; 
			<input type="file" class="textbox" name="logoMain" /> &nbsp; 
			<input type="submit" class="button1" name="updateMain" value="update" /></td>
			</tr>
		<tr>
			<td colspan="3" align="left" valign="middle" class="org">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="left" valign="middle" class="org"><h2>Contest album images</h2></td>
		</tr>
		<? if(count($this->pics)>0){?>
		<? foreach($this->pics as $pics){?>
		<tr>
			<td align="left" width="50%" valign="middle" class="org">Pic submited by <strong><?=$pics["username"]?></strong> on <?=$pics["timestamps"]?> ,currently <strong><?=$pics["status"]=="Y"?"active":"blocked"?></strong></td>
			<td align="left" width="50%" valign="top" class="org"><img width="200" src="<?=IMAGES?>contestAlbum/<?=$pics["logo"]?>" /></td>
			<td align="left" width="10" valign="top" class="org"><input name="id[]" type="checkbox" value="<?=$pics["id"]?>" /></td>
		</tr>
		<? }}else{?>
		<tr>
			<td align="center" valign="middle" class="org" colspan="3"><strong>No pics yet</strong></td>
		</tr>
		<? }?>
		<tr>
			<td align="center" valign="middle" colspan="3">
			<input type="submit" class="button1" name="delete" value="delete" /> 
			<input type="submit" class="button1" name="block" value="block" /> 
			<input type="submit" class="button1" name="unblock" value="unblock" /><br />&nbsp;<br />
			<input type="file" class="button1" name="logo" /> 
			<select name="uid" id="uid" class="textbox">
				<? foreach($this->users as $user){?>
				<option value="<?=$user["id"]?>" <? if($this->contests["uid"] == $user["id"]){?> selected="selected" <? }?> ><?=$user["username"]?></option>
				<? }?>
			</select>
			<input type="submit" class="button1" name="add" value="add" /> 
			
						</td>
		</tr>
	</tbody>
</table>
</form></td>
                        </tr>
                    </table></td>
                  </tr>
              </table>