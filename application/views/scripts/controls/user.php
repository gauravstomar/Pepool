<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Manage Users on the site</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/addedituser/">Add an user</a> </li>
                              </ul>
                          </div></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
					<?
					if(count($this->users)>0)
					{
					?>
                      <tr>
                        <th width="16" align="left" valign="top" >&nbsp;</th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/user/orderby/username">Username</a></th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/user/orderby/email">EMail</a></th>
                        <th align="left" valign="top">&nbsp;</th>
                        <th align="left" valign="top">&nbsp;</th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/user/orderby/country.country_name">Country</a></th>
                        <th colspan="3" align="center" valign="top">Action</th>
                        </tr>
						<?
						$i=1;
						foreach($this->users as $user)
						{
						?>
						<tr class="bgg1" onMouseOver="this.className='bgg2'" onMouseOut="this.className='bgg1'">
							<td align="left" valign="top"><?=$i++?></td>
							<td align="left" valign="top"><?=$user["username"]?></td>
							<td align="left" valign="top"><?=$user["email"]?> <? if($user["status"]=="X"){?><span style="font-size:9px">(not verified)</span><? }?></td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top"><?=$user["country_name"]?></td>
							<td width="25" align="left" valign="top" class="link1">
							<? if($user["status"] == "Y")
							{ ?><a href="<?=WWW_ROOT?>controls/blockuser/id/<?=$user["id"]?>/set/N">[unblock]</a>
							<? }else{?>
							<a href="<?=WWW_ROOT?>controls/blockuser/id/<?=$user["id"]?>/set/Y">[block]</a>
							<? }?>							</td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/addedituser/for/<?=$user["id"]?>" >[edit]</a></td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/deleteuserpage/for/<?=$user["id"]?>" onClick="return confirm('Sure to delete?')">[delete]</a></td>
						</tr>
						<?
						}}
						else
						{
						?>
                      <tr>
                      	<td height="100" colspan="10" align="center" valign="bottom">No records in this section.</td>
                      	</tr>
						<?
						}
						?>
                    </table></td>
    </tr>

              </table>