<link href="<?=CSS?>of/admin" rel="stylesheet" type="text/css" />
<link href="../../../../public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=JSEXT?>tiny_mce/tiny_mce.js"></script>
<script language="javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, separator,bullist,numlist,indent,outdent,undo,redo,link,unlink,separator,forecolor,backcolor",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
	});
	
</script>
<table width="100%" border="0" cellspacing="5" cellpadding="0">
	<tr>
		<td><h2>Edit Error 500 Page of the site</h2></td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td align="left" valign="top"><form action="" method="post">
							<textarea name="content" id="content" cols="111" rows="22"><?=stripslashes($this->contents)?></textarea>
							<br />
							<br />
							<input type="submit" class="button1" value="Save" />
						</form></td>
				</tr>
			</table></td>
	</tr>
</table>
