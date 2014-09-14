<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Votes given on <?=$this->contest["name"]?></h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT."controls/contests"?>">Back</a> </li>
                                <li><a href="<?=WWW_ROOT."controls/addeditvote/of/".$this->contest["id"]?>">Add vote</a> </li>
                              </ul>
                          </div></td>
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
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/c.name">Response</a></th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/u.username">By User</a></th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/allvotes">Comment</a></th>
                        <th align="left" valign="top"><a href="<?=WWW_ROOT?>controls/contests/orderby/c.timestamps">Posted On</a></th>
                        <th colspan="3" align="center" valign="top">Action</th>
                        </tr>
						<?
						$i=1;
						foreach($this->votes as $vote)
						{
						?>
						<tr class="bgg1" onMouseOver="this.className='bgg2'" onMouseOut="this.className='bgg1'">
							<td align="left" valign="top"><?=$i++?></td>
							<td align="left" valign="top"><strong><?
							if($vote["vote"]=="Y")
							{
								print "+ ive";
							}
							else
							{
								print "- ive";
							}
							?></strong></td>
							<td align="left" valign="top"><?=$vote["username"]?> </td>
							<td align="left" valign="top"><?=($vote["comment"]!="")?stripslashes($vote["comment"]):"No Comment."?></td>
							<td align="left" valign="top"><?=$vote["timestamps"]?></td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/addeditvote/for/<?=$vote["id"]?>/back/<?=$vote["cid"]?>" >[edit]</a></td>
							<td width="25" align="left" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/deletevote/for/<?=$vote["id"]?>/back/<?=$vote["cid"]?>" onClick="return confirm('Sure to delete?')">[delete]</a></td>
						</tr>
						<?
						}}
						else
						{
						?>
                      <tr>
                      	<td height="100" colspan="8" align="center" valign="bottom">No records in this section.</td>
                      	</tr>
						<?
						}
						?>
                    </table></td>
    </tr>

              </table>