<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$this->render("accessories/dochead.php")?>
<link href="<?=CSS?>home" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="W">
<?=$this->render("accessories/header.php")?>
		<div id="B">
    <? if($this->InviteeUser["id"]==""){?>
		<div id="sUpA">
<p class="a"><strong>My slam book in my language, </strong>&nbsp; slam book filled in your own language online was never so easy, Your friends now come together online and <span> share their experiences, views and much more about you in just a single step..</span></p>
<p class="b"><strong>Introducing first time</strong>&nbsp; a community site which provides you a healthy environment to interact and chat instantly through instant scraps and then getting your own <span> personalized slam book filled by your friends as a token of friendship in a new and exciting manner with everything online.</span></p>
<p class="c">Start Pooling <a href="javascript:;" class="fn">SignUp now &raquo;</a></p>
        </div>
        <? }else{?>
        <div id="sUpA" style="background-image:url(<?=IMAGES?>invited-banner<?=rand(0,4)?>.jpg);">
            <div style="margin:20px 10px;width:185px;text-align:center;height:225px;overflow:hidden;">
				<? if($this->InviteeUser["image"]!='boy.gif' && $this->InviteeUser["image"]!='girl.gif'){?>
                <img src="<?=IMAGES?>user/thumb/<?=$this->InviteeUser["image"]?>" style="float:none" align="absmiddle" />
                <? }else{?>
                <img src="<?=IMAGES?>baby.jpg" style="float:none" align="absmiddle" />
                <? }?>
                <br />
                <span style="font-size:24px;color:#333;float:none;"><?=$this->InviteeUser["fname"]?> <?=$this->InviteeUser["lname"]?> </span>
            </div>
        </div>
        <? }?>
		<div id="sUpB">
<form method="post" action="<?=WWW_ROOT?>users/registration/" enctype="application/x-www-form-urlencoded" id="signupForm">
	<input type="hidden" name="rid" value="<?=encode($this->InviteeUser["id"])?>" />
  <dl class="zend_form">
    <dt>
      <label class="required" for="fname">First Name:</label>
    </dt>
    <dd>
      <input type="text" value="<?=$_POST["fname"]?$_POST["fname"]:$this->InvitedUser["name"]?>" id="fname" name="fname"/>
    </dd>
    <dt>
      <label class="required" for="lname">Last Name:</label>
    </dt>
    <dd>
      <input type="text" value="<?=$_POST["lname"]?>" id="lname" name="lname"/>
    </dd>
    <dt>
      <label for="email" class="required">Email address:</label>
    </dt>
    <dd>
      <input type="text" value="<?=$_POST["email"]?$_POST["email"]:$this->InvitedUser["email"]?>" id="email" name="email"/>
    </dd>
    <dt>
      <label for="password" class="required">Password:</label>
    </dt>
    <dd>
      <input type="password" value="<?=$_POST["password"]?>" id="password" name="password"/>
    </dd>
    <dt>
      <label class="required" for="gender">Select gender:</label>
    </dt>
    <dd>
<select id="gender" name="gender">
	<option></option>
    <option value="F">Female</option>
    <option value="M">Male</option>
</select>
    </dd>
    <dt>
      <label class="required" for="gender">Select birthday:</label>
    </dt>
    <dd>
    <select id="month" name="month">
<?
	$M = array("M","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
foreach($M as $k=>$m)
{	
?>
        <option value="<?=$k?>" <? if($k==$_POST["month"]){?>selected="selected"<? }?>><?=$m?></option>
<?
}
?>
    </select>
    <select id="day" name="day">
        <option value="0">D</option>
<? for($i=1;$i<32;$i++){?>
        <option value="<?=$i?>" <? if($i==$_POST["day"]){?>selected="selected"<? }?>><?=$i?></option>
<? }?>
    </select>
    <select id="year" name="year">
    	<option value="0">Y</option>
<? for($i=date("Y")-12;$i>(date("Y")-80);$i--){?>
        <option value="<?=$i?>" <? if($i==$_POST["year"]){?>selected="selected"<? }?>><?=$i?></option>
<? }?>
    </select>
    </dd>
    <dt>&nbsp;</dt>
    <dd><a href="javascript:;" onclick="$('#signupForm').submit()"><img src="<?=IMAGES?>sUpBut.png" border="0" /></a></dd>
  </dl>
</form>
        </div>
        <ul id="new">
            <li class="l">
	            <a href="<?=WWW_ROOT?>take-two-minute-challenge"></a>
            </li>
            <li class="r">
            	<a href="<?=WWW_ROOT?>users/forgetpass" class="iBox">forget password?</a> or <a href="mailto:info@pepool.com">unable to register?</a>
				<img src="<?=IMAGES?>line.jpg" /><br />
                help us to <a href="javascript:;" class="a2a_dd">spread pepool</a>
            </li>
        </ul>
        <div style="padding-top:3px; width:950px;">
				<script type="text/javascript"><!--
                google_ad_client = "ca-pub-6720925791493319";
                google_ad_slot = "3509168030";
                google_ad_width = 728;
                google_ad_height = 90;
                //-->
                </script>
                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
				<img src="<?=IMAGES?>promo.png" style="float:right" />
        </div>
        <div id="onLu">
        <h1>Energizing Pepoolians &nbsp; </h1>
        <ul>
            <? $i=0; foreach($this->users as $r){?>
            <li <? $i++;if($i>6)$i=0;if($i%2){?>class="rand"<? }?>>
            	<a href="<?=WWW_ROOT?>user/<?=encode($r["id"])?>"><img src="<?=IMAGES?>user/icon/<?=$r["image"]?>" /><span><?=(strlen($r["username"])<10)?$r["username"]:substr($r["username"],0,10).'..'?><br /><em><?=str_replace(" years",", ",timeDiff(strtotime($r["birthDay"]),array('parts'=>1,'precision'=>'year','separator' =>'','next'=>''))).($r["gender"]=='M'?'Male':'Female').($r["city"]?"<br />".$r["city"]:"")?></em></span></a>
            </li>
            <? }?>
        </ul>
        </div>
  </div>
<script type="text/javascript">
var xeno = true;
$(document).ready(function(){setInterval(function(){
	$("#new .l a").animate({'opacity':'0.5','background-position':'0 '+(xeno?'-37px':'0')},function(){$("#new .l a").animate({'opacity':'1'})}); xeno = (xeno?false:true);
	gst.msg = (Math.floor(Math.random()*7+1)+' users just pooled');
	$.get('<?=WWW_ROOT?>index/energizing',function(d){
		$('#onLu ul li:first').fadeOut('fast',function(){$(this).remove(); Li = $('<li>').html(d).css('display','none').appendTo('#onLu ul'); 
		$('#onLu ul li').removeClass('rand');$('#onLu ul li:odd').addClass('rand'); Li.fadeIn(); }
		);
	})
},2000);
});

a2a_onclick = 1;a2a_color_main="D7E5ED";a2a_color_border="008fd1";a2a_color_link_text="008fd1";a2a_color_link_text_hover="008fd1";
a2a_linkname="Pepool.com (an online slam book)";a2a_linkurl="<?=WWW_ROOT?>";
function requestPass()
{	$.post(www+'users/forgetpass',{'e':$('input[name=recoveryEmail]').val()},function(e){eval(e)});
	$('input[name=recoveryEmail]').val("");gst.iBoxHide('users-forgetpass');return false;
}
</script>
<?=$this->render("accessories/footer.php")?>
</div>
</body>
</html>
