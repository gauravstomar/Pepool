<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
*{margin:0; padding:0;}
body{font-family:Arial;color:#000;font-size:12px;font-weight:normal;}
.upload{position:relative;}
.upload input[type=file]{position:relative;text-align:right;-moz-opacity:0;filter:alpha(opacity: 0);opacity:0;z-index:2;width:99px}
.upload div{position:absolute;top:0;left:0;z-index:1;}
.fl{float:left;}
.w100{width:100%;}
.bluecolor{color:#008fd1;}
</style>
</head>
<body>
<div>
	<form name="userImgForm" enctype="multipart/form-data" method="post">
		<div class="w100 fl bluecolor upload">
			<input type="file" name="logo" onChange="chk(this)" />
			<div><img src="<?=IMAGES?>chgPic.png" /></div>
		</div>
	</form>
</div>
<script type="text/javascript">
<? if($this->error!=""){?>
parent.gst.message('<?=$this->error[0]?>','<?=$this->error[1]?>','<?=$this->error[2]?>');
parent.$("#Ba img").attr({'src':'<?=IMAGES.'user/thumb/'.$this->user["image"]?>'});
setTimeout(function(){parent.$("#tempLoadingImg").remove();},1000);
<? }?>
function chk(obj)
{	if(parent.gst.isImg(obj))
	{	parent.gst.dLoad("#Ba img");
		document.userImgForm.submit();
	}
	else parent.gst.message("Invalid image format! Try Again!",7);
}
</script>
</body>
</html>
