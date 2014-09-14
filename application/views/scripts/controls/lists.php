<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Lists on the site (<?=count($this->votes)?>). </h2></td>
                          <td>&nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
					<?
					if(count($this->votes)>0)
					{
					?>
                      <tr>
                        <th width="16" align="left" valign="top" >&nbsp;</th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/c.name">List Name</a></th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/u.username">By User</a></th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/c.timestamps">Posted On</a></th>
                        <th colspan="2" align="center" valign="top">Action</th>
                        </tr>
						<?
						$i=1;
						foreach($this->votes as $vote)
						{
						?>
						<tr class="bgg1" onMouseOver="this.className='bgg2'" onMouseOut="this.className='bgg1'">
							<td align="left" valign="top"><?=$i++?></td>
							<td align="left" valign="top"><strong><?=$vote["name"]?></strong></td>
							<td align="left" valign="top"><?=$vote["username"]?> </td>
							<td align="left" valign="top"><?=$vote["timestamps"]?></td>
							<td width="200" align="center" valign="top" class="link1">
							<? if($vote["index_status"]!="Y"){?>
							<a href="?s=Y&id=<?=$vote["id"]?>">[show]</a>
							<? }else{?>
							<a href="?s=N&id=<?=$vote["id"]?>">[hide]</a>
							<? }?>
							<a href="?delete=<?=$vote["id"]?>" onclick="return confirm('Sure to delete this list?')">[delete]</a>							</td>
						</tr>
						<?
						}}
						else
						{
						?>
                      <tr>
                      	<td height="100" colspan="7" align="center" valign="bottom">No records in this section.</td>
                      	</tr>
						<?
						}
						?>
                    </table></td>
    </tr>

              </table>