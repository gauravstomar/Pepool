 <link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<link href="../../../../public/css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td><h2>Database Backup</h2></td>
    </tr>
                  <tr>
                    <td><table width="100%" border="0" cellpadding="5" cellspacing="0">
                      <tr>
                        <td align="left" valign="top">
<form action="" method="post">
	<table cellspacing="0" cellpadding="5" border="0" align="center" width="50%">
	<tbody>
		<tr>
			<td width="50%" align="center" valign="middle" class="bgg1"><strong>Current Backup</strong></td>
			<td width="50%" align="center" valign="middle" class="bgg1"><a href="<?=WWW_ROOT."controls/download/path/".$this->backup[0]["name"]?>" ><? print $this->backup[0]["timestamps"]; unset($this->backup[0]);?></a><div style="font-size:10px">(click above to download .sql file of backup)</div></td>
			</tr>
		<tr>
			<td colspan="2" align="left" valign="middle" class="org">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="middle" class="org"><strong>Last 9 backup of database</strong>
			<div style="font-size:10px">(click below dates to download .sql file of given date)</div></td>
			</tr>
		<?
		foreach($this->backup as $backup)
		{
		?>
		<tr>
			<td colspan="2" align="left" valign="middle" class="org"><a href="<?=WWW_ROOT."controls/download/path/".$backup["name"]?>" >
			Taken on <?=$backup["timestamps"]?>
			</a></td>
			</tr>
		<?
		}
		?>	
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