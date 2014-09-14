<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=WWW_ROOT?>js"></script>
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><h2>Content Management System</h2></td>
                          <td><div align="right" id="tab2">
                              <ul>
                                <li><a href="<?=WWW_ROOT?>controls/addcmspage">Add New Page</a> </li>
                              </ul>
                          </div></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
                     <?
					if(count($this->cms)>0)
					{?> 
                     <tr>
                        <th width="16" align="left" valign="middle" class="a12green">&nbsp;</th>
                        <th align="left" valign="middle">  Title</th>
                        <th colspan="3" align="center" valign="top">Action</th>
                        </tr>
					<? $i = 1;
					foreach($this->cms as $cms)
					{
					?>
                      <tr class="bgg1" onmouseover="this.className='bgg2'" onmouseout="this.className='bgg1'">
                        <td align="left" valign="top"><?=$i++?></td>
                        <td align="left" valign="top"><?=$cms["title"]?></td>
                        <td width="25" align="center" valign="top" class="link1">
						<?
						if($cms["status"]=="Y")
						{
						?>
						<a href="<?=WWW_ROOT?>controls/updatestatus/for/<?=$cms["id"]?>/to/N">[block]</a>
						<?
						}
						else
						{
						?>
						<a href="<?=WWW_ROOT?>controls/updatestatus/for/<?=$cms["id"]?>/to/Y">[unblock]</a>
						<?
						}
						?>											</td>
                        <td width="25" align="center" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/deletecmspage/for/<?=$cms["id"]?>" onclick="return confirm('Sure to delete?')">[delete]</a></td>
                        <td width="25" align="center" valign="top" class="link1"><a href="<?=WWW_ROOT?>controls/addcmspage/for/<?=$cms["id"]?>">[edit]</a>	</td>
                      </tr>
					<?
					}}
					else
					{
					?>	
                      <tr>
                      	<td height="100" colspan="5" align="center" valign="middle"><strong>No Records.</strong></td>
                      	</tr>
					<?
					}
					?>
                    </table></td>
    </tr>

              </table>