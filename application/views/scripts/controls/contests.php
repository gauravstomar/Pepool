<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Manage items of the site</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/addeditcontest/">Add item</a> </li>
                              </ul>
                          </div></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
					<?
					if(count($this->contests)>0)
					{
					?>
                      <tr>
                        <th width="16" align="left" valign="top" >&nbsp;</th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/c.name">Name</a></th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/u.username">By User</a></th>
                        <th align="center" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/allvotes">Votes</a></th>
                        <th align="left" valign="top">Tags</th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/c.timestamps">Last Updated On</a></th>
                        <th colspan="5" align="center" valign="top">Action</th>
                        </tr>
						<?
						$i=1;
						foreach($this->contests as $contest)
						{
						?>
						<tr class="bgg1" onMouseOver="this.className='bgg2'" onMouseOut="this.className='bgg1'">
							<td align="left" valign="top"><?=$i++?></td>
							<td align="left" valign="top"><?=$contest["name"]?></td>
							<td align="left" valign="top"><?=$contest["username"]?> </td>
							<td align="center" valign="top"><a href="<?=WWW_ROOT?>controls/votes/of/<?=$contest["id"]?>"><strong><?=$contest["allvotes"]?></strong></a></td>
							<td align="left" valign="top">
							<?
							if(count($contest["tags"])>0)
							{
								foreach($contest["tags"] as $tag)
								{
									$p.= $tag["tag"].", ";
								}
								print substr($p,0,count($p)-3);
								$p = NULL;
							}
							?></td>
							<td align="left" valign="top" nowrap="nowrap"><?=$contest["timestamps"]?></td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/addeditcontestcomments/for/<?=$contest["id"]?>" >[comments]</a></td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/addeditcontestpics/for/<?=$contest["id"]?>" >[pics]</a></td>
							<td width="25" align="left" valign="top" class="link1">
							<? if($contest["status"] == "Y")
							{ ?><a href="<?=WWW_ROOT?>controls/blockcontest/id/<?=$contest["id"]?>/set/N">[unblock]</a>
							<? }else{?>
							<a href="<?=WWW_ROOT?>controls/blockcontest/id/<?=$contest["id"]?>/set/Y">[block]</a>
							<? }?>							</td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/addeditcontest/for/<?=$contest["id"]?>" >[edit]</a></td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/deletecontestpage/for/<?=$contest["id"]?>" onClick="return confirm('Sure to delete?')">[delete]</a></td>
						</tr>
						<?
						}}
						else
						{
						?>
                      <tr>
                      	<td height="100" colspan="12" align="center" valign="bottom">No records in this section.</td>
                      	</tr>
						<?
						}
						?>
                    </table></td>
    </tr>

              </table>