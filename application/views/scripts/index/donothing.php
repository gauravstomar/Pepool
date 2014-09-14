<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$this->render("accessories/dochead.php")?>
<link href="<?=CSS?>home" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="W">
<?=$this->render("accessories/header.php")?>
</div>
<div id="X" style="position:absolute;left:45%;top:200px;">
    <h1>do nothing for 2 minutes</h1>
    <h2 style="text-align:center;font-size:70px;">2:00</h2>
</div>
<div id="Y" style="position:absolute;left:45%;display:none;top:100px;">
	<center>
    <h1 style="margin-bottom:50px">You just win the two minute challenge!</h1>
        <div style="background:url(<?=IMAGES?>share.jpg) no-repeat; height:142px; width:194px; padding-top:40px;">
            <a href="http://www.facebook.com/sharer.php?u=<?=urlencode(WWW_ROOT."take-two-minute-challenge")?>&t=<?=urlencode("I just win 2 minute challenge.. Can you?")?>" target="_blank" style="margin-top:20px;"><img src="<?=IMAGES?>facebook.png" /></a>
            <a href="http://twitter.com/share?url=<?=urlencode(WWW_ROOT."take-two-minute-challenge")?>&text=<?=urlencode("I just win 2 minute challenge.. Can you?")?>" target="_blank" style="margin-top:20px;"><img src="<?=IMAGES?>twitter.png" /></a>
        </div>
    </center>
</div>
<style>
h1,h2{text-align:center;}
</style>
<script type="text/javascript">

t = 1500; s = 120;
tOutA = tOutB = null;

$(document).ready(function(){
	
	$("#cVr").remove();
	
	tOutA = setInterval(function(){
		s--; m = Math.floor(s/60); sx = s-(m*60);
		if(s>=0)$("#X h2").html(m+":"+((sx<10)?"0"+sx:sx)).css({'color':'#008FD1'});
		else
		{
			$("#Y").fadeIn(); $("#X").remove();
			gst.message('Congratulations! You won :)',10,'yeppe')
			clearInterval(tOutA);
		}
	
	},1000);
				
	setTimeout(function(){
	//$("#W").fadeOut();
	$(document).bind('mouseleave blur mouseenter focus keydown mousemove mousedown', function(e) { 
		
		if(s<0) return; $("#X h2").css({'color':'#CC0000'});
		gst.message('You lost in '+e.type+'.',5,'tryagain')
		s = 121; /*$("#W").fadeIn();*/ clearTimeout(tOutB);
		tOutB = setTimeout(function(){/*$("#W").fadeOut();*/},t);
		
	});

}, t);

	
	
	
})


</script>


</body>
</html>
