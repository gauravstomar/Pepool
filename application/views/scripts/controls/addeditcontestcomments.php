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
<table cellspacing="2" cellpadding="4" border="0" align="center" width="100%">
	<tbody>
		<? if(count($this->discussion)>0){?>
		<? foreach($this->discussion as $discussion){?>
		<tr>
			<td align="left" width="50%" valign="middle" class="org">Comment submited by <strong><?=$discussion["username"]?></strong> on <?=$discussion["timestamps"]?> ,currently <strong><?=$discussion["status"]=="Y"?"active":"blocked"?></strong></td>
			<td align="left" width="50%" valign="top" class="org"><?=stripslashes($discussion["comment"])?></td>
			<td align="left" width="10" valign="top" class="org"><input name="id[]" type="checkbox" value="<?=$discussion["id"]?>" /></td>
		</tr>
		<? }}else{?>
		<tr>
			<td align="center" valign="middle" class="org" colspan="3"><strong>No comments yet</strong></td>
		</tr>
		<? }?>
		<tr>
			<td align="center" valign="middle" colspan="3">
			<input type="submit" class="button1" name="delete" value="delete" /> &nbsp; 
			<input type="submit" class="button1" name="block" value="block" /> &nbsp; 
			 <input type="submit" class="button1" name="unblock" value="unblock" /></td>
		</tr>
	</tbody>
</table>
</form></td>
                        </tr>
                    </table></td>
                  </tr>
              </table>