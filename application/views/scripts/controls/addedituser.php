<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<link href="../../../../public/css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Add an user</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/user">Manage existing users</a> </li>
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
<input type="hidden" value="<?=$this->user["id"]?>" name="id" />
<table cellspacing="2" cellpadding="4" border="0" align="center" width="50%">
	<tbody>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>Username</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="username" type="text" class="textbox" id="username" style="width: 200px;" value="<?=$this->user["username"]?>"/></td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>EMail</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="email" type="text" class="textbox" id="email" style="width: 200px;" value="<?=$this->user["email"]?>"/></td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>Password</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="password" type="text" class="textbox" id="password" style="width: 200px;" value="<?=$this->user["password"]?>"/></td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>Gender</strong></td>
			<td align="left" width="50%" valign="top" class="org">
			<label><input type="radio" name="gender" <? if($this->user["gender"] == "M"){?>checked="checked"<? }?> id="gender" value="M" />Male</label>
			<label><input type="radio" name="gender" <? if($this->user["gender"] == "F"){?>checked="checked"<? }?> id="gender" value="F" />Female</label>
			</td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>Birth Day</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="bday" type="text" class="textbox" id="bday" style="width: 200px;" value="<?=$this->user["bday"]?>"/></td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>Country</strong></td>
			<td align="left" width="50%" valign="top" class="org"><select name="country" id="country" class="textbox" >
				<? 
				foreach($this->country as $country)
				{
				?>
				<option value="<?=$country["id"]?>" <? if($this->user["country"]==$country["id"]){?>selected="selected"<? }?>><?=$country["country_name"]?></option>
				<?
				}
				?>
			</select>
</td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>City</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="city" type="text" class="textbox" id="city" style="width: 200px;" value="<?=$this->user["city"]?>"/></td>
		</tr>
		<tr>
			<td align="left" width="50%" valign="middle" class="org"><strong>State</strong></td>
			<td align="left" width="50%" valign="top" class="org"><input name="state" type="text" class="textbox" id="state" style="width: 200px;" value="<?=$this->user["state"]?>"/></td>
		</tr>
		<tr>
			<td align="left" valign="middle"><strong>Blocked</strong></td>
			<td align="left" valign="middle"><select name="status" class="textbox">
				<option value="Y" <? if($this->user["status"]=="Y"){?>selected="selected"<? }?> >Y</option>
				<option value="N" <? if($this->user["status"]!="Y"){?>selected="selected"<? }?> >N</option>
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