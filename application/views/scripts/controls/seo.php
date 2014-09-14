<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Magane SEO Part of the site</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/addeditseo/">Add a SEO element</a> </li>
                              </ul>
                          </div></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
					<?
					if(count($this->seo)>0)
					{
					?>
                      <tr>
                        <th width="16" align="left" valign="top" class="a12green">&nbsp;</th>
                        <th align="left" valign="top"> Page/Part of the site</th>
                        <th colspan="3" align="right" valign="top">Action</th>
                        </tr>
						<?
						$i=1;
						foreach($this->seo as $seo)
						{
						?>
						<tr class="bgg1" onmouseover="this.className='bgg2'" onmouseout="this.className='bgg1'">
							<td align="left" valign="top"><?=$i++?></td>
							<td align="left" valign="top"><?=$seo["title"]?> (<?=$seo["URI"]?>)</td>
							<td width="25" align="left" valign="top" class="link1">
							<? if($seo["status"] == "Y")
							{ ?><a href="<?=WWW_ROOT?>controls/blockseo/id/<?=$seo["id"]?>/set/N">[unblock]</a>
							<? }else{?>
							<a href="<?=WWW_ROOT?>controls/blockseo/id/<?=$seo["id"]?>/set/Y">[block]</a>
							<? }?>							</td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/deleteseopage/for/<?=$seo["id"]?>" onclick="return confirm('Sure to delete?')">[delete]</a></td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/addeditseo/for/<?=$seo["id"]?>">[edit]</a></td>
						</tr>
						<?
						}}
						else
						{
						?>
                      <tr>
                      	<td height="100" colspan="5" align="center" valign="bottom">No records in this section.</td>
                      	</tr>
						<?
						}
						?>
                    </table></td>
    </tr>

              </table>