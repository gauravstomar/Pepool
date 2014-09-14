<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<link href="../../../../public/css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Vote for <?=$this->vote["name"]?></h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/votes/of/<?=$this->vote["id"]?>">Manage existing votes</a> </li>
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
<input type="hidden" value="<?=$this->vote["id"]?>" name="id" />
<table cellspacing="2" cellpadding="4" border="0" align="center" width="50%">
	<tbody>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>Vote</strong></td>
			<td align="left" width="50%" valign="top" class="org">
			<label><input type="radio" value="Y" name="vote" <? if($this->vote["vote"]=="Y"){?>checked="checked"<? }?> /> + ive</label>
			<label><input type="radio" value="N" name="vote" <? if($this->vote["vote"]!="Y"){?>checked="checked"<? }?> /> - ive</label>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top" class="org"><strong>Comment</strong><br /></td>
			<td align="left" valign="top" class="org"><textarea name="comment" rows="7" class="textbox" id="comment" style="width: 200px;"><?=stripslashes($this->vote["comment"])?></textarea></td>
		</tr>
		<tr>
			<td align="left" valign="middle"><strong>Contest</strong></td>
			<td align="left" valign="middle">
			<select name="cid" id="cid" class="textbox">
				<? foreach($this->contests as $contest){?>
				<option value="<?=$contest["id"]?>" <? if($this->vote["cid"] == $contest["id"]){?> selected="selected" <? }?>><?=$contest["name"]?></option>
				<? }?>
			</select>			</td>
		</tr>
		<tr>
			<td align="left" valign="middle"><strong>User</strong></td>
			<td align="left" valign="middle"><select name="uid" id="uid" class="textbox">
				<? foreach($this->users as $user){?>
				<option value="<?=$user["id"]?>" <? if($this->vote["uid"] == $user["id"]){?> selected="selected" <? }?> ><?=$user["username"]?></option>
				<? }?>
			</select>			</td>
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