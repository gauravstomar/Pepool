<?
	extract($this->userExt);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$this->render("accessories/dochead.php")?>
</head>
<div id="W" class="<?=encode($id)?>">
<?=$this->render("accessories/header.php")?>
	<div id="B">
		<div id="Ba">
			<div class="iB wa"><img src="<?=IMAGES?>user/thumb/<?=$image?>" /></div>
            <h1><a href="<?=WWW_ROOT?>bio/<?=encode($id)?>"><?=$fname?> <?=$lname?></a></h1><span><?=timeDiff(strtotime($birthDay),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))?>, <?=$gender=="M"?"Male":"Female"?></span>
            <?php /*?><div style="height:60px;width:468px;float:right;margin-top:-30px;">
				<script type="text/javascript"><!--
                google_ad_client = "ca-pub-6720925791493319";
                google_ad_slot = "1003222663";
                google_ad_width = 468;
                google_ad_height = 60;
                //-->
                </script>
                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
            </div><?php */?>

        </div>
        <div id="Bb">
            <div class="l">
            	<ul>
	                <li><a href="#profile" class="std"><?=$chopName?>'s profile</a></li>
	                <? if(1==2){?>
                    <!--<li><a href="#updates">Updates</a></li>-->
                    <? }?>
	                <li><a href="#invite">Pool Friends</a></li>
	                <li><a href="#search">Search Users</a></li>
                    <?php /*?><li><a href="#more">More fun stuffs</a></li><?php */?>
                    <li class="gAds">
					<script type="text/javascript">
                    google_ad_client = "pub-6720925791493319";
                    google_ad_slot = "5699842384";
                    google_ad_width = 120;
                    google_ad_height = 600;
                    </script>
                    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                    </li>
                </ul>
            </div>
            <div class="c">
            	<div class="cA"><div class="cAa"><span><h2 id="profileH"></h2><h2 id="moreH" style="display:none">More fun stuffs..</h2></span></div></div>
                <div class="cB">
                <div id="more" style="display:none; height:700px; padding-top:10px;">
                    <h1>Play Free Online Games, fun games, puzzle games, action games, sports games, flash games, adventure games, multiplayer games and more</h1>
                    <h2>good night, sms hindi,  sms friendship,  sms text messages</h2>
                    <h3>Free Funny SMS Jokes, Lovely SMS, Love Messages, Cute Texts, Friendship Quotes, Humorous SMS, Comedy SMS, And More.</h3>
                    <div>
                        <script type="text/javascript">
                            google_ad_client = "pub-6720925791493319";
                            google_ad_slot = "0592924453";
                            google_ad_width = 468;
                            google_ad_height = 15;
                        </script>
                        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> </script>
                    </div>
                    <h1>Mobile SMS, Mobile Messages - Love SMS, SMS Jokes, Free SMS, Mobile SMS, Send SMS</h1>
                    <h2>Your gaming history will be added here as you play</h2>
                    <h3>Show all Games Sections and Full Games List</h3>
                    <div>
                        <script type="text/javascript">
                            google_ad_client = "pub-6720925791493319";
                            google_ad_slot = "6295423992";
                            google_ad_width = 468;
                            google_ad_height = 15;
                        </script>
                        <script type="text/javascript"src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                    </div>
                    <h1>Hide all Games Sections and Full Games List</h1>
                    <h2>Jump to Games here</h2>
                    <h3>Flash games</h3>
                    <div>
                        <script type="text/javascript">
                            google_ad_client = "pub-6720925791493319";
                            google_ad_slot = "7734849121";
                            google_ad_width = 468;
                            google_ad_height = 15;
                        </script>
                        <script type="text/javascript"src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                    </div>
                    <h1>Sport Games</h1>
                    <h2>Shot Football Training, Tennis Master, Home Run Mania, Yetisports 5, La Petanque, Tennis Game, Belly Flop Hero</h2>
                    <h3>Action Games, Puzzle Games</h3>
                    <div>
                        <script type="text/javascript">
                            google_ad_client = "pub-6720925791493319";
                            google_ad_slot = "8855565869";
                            google_ad_width = 468;
                            google_ad_height = 15;
                        </script>
                        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                    </div>
                    <h1>Flash Game offers free games and online games, including sports games, action games, puzzle games, flash games, multiplayer games and more.</h1>
                    <h2>games, free games, flash games, shockwave games, online game, fun game, download game, action game, adventure game, sport game, kid game, web game, browser game, online entertainment, online gaming, play online, swf game, dcr game, free online game</h2>
                    <div>
                        <script type="text/javascript">
                            google_ad_client = "pub-6720925791493319";
                            google_ad_slot = "6002825750";
                            google_ad_width = 468;
                            google_ad_height = 15;
                        </script>
                        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                    </div>
                </div>
                 <div id="profile">
<? if($this->user["id"]!=$this->userExt["id"]){?>
    <ul class="navi">

        <? if(in_array($this->userExt["id"],array_keys($this->user["friends"]))){?>
        <li><a href="javascript:;" class="rf frnd" rel="r-<?=encode($id)?>">Remove friend</a></li>
		<? }elseif(in_array($this->userExt["id"],array_keys($this->user["sentRequest"]))){?>
        <li><span class="wf frnd">Friend request pending</span></li>
        <? }elseif(in_array($this->userExt["id"],array_keys($this->user["recivedRequest"]))){?>
        <li><a href="javascript:;" class="af frnd" rel="c-<?=encode($id)?>">Confirm as friend</a></li>
        <? }else{?>
        <li><a href="javascript:;" class="af frnd" rel="a-<?=encode($id)?>">Add as friend</a></li>
        <? }?>
        
        <? if(in_array($this->user["id"],array_keys($this->stuff["slams"]["request"]))){?>
        <li><a href="javascript:;" class="wf slam">Request pending for slam</a></li>
        <? }else{?>
        <li><a href="javascript:;" class="rs slam" rel="<?=encode($id)?>">Request for slam</a></li>
        <? }?>

    </ul>
<? }?>
<dl>
<h3>My Personals</h3>
	<? $u = $this->userExt;?>
	<? if(count($u["interested"])>0){?><dt>interested in:</dt><dd><?  $interested = array();foreach($u["interested"] as $int) $interested[] = $this->interested[$int]; print implode(",",$interested);?></dd><? }?>
    <? if($u["language"][0]["language"]>0){?><dt>languages i speak:</dt><dd><?=$this->language[$u["language"][0]["language"]]?></dd><? }?>
    <? if($u["relationshipStatus"]>0){?><dt>relationship status:</dt><dd><?=$this->relationshipStatus[$u["relationshipStatus"]]?></dd><? }?>
    <? if($u["birthDay"]!="0000-00-00"){?><dt>birthday:</dt><dd><?=date("M d",strtotime($u["birthDay"]))?></dd><? }?>
    <? if($u["address_visible"]==1){?><dt>address:</dt><dd>
	<?=($u["address"]!=''?$u["address"].",":"")."
	".($u["city"]!=''?$u["city"].",":"")."
	".($u["state"]!=''?$u["state"].",":"")."
	".($u["zip"]!=''?$u["zip"].",":"")."
	".$this->country[$u["country"]]?></dd><? }?>
</dl>
<?	$s = $u["social"];?>
<dl>
<h3>My Socials</h3>
  <? $s = $u["social"];?>
  <? if($s["children"]>0){?><dt>i like children:</dt><dd><?=$this->socials['children'][$s["children"]]?></dd><? }?>
  <? if($s["ethnicity"]>0){?><dt>my ethnicity:</dt><dd><?=$this->socials['ethnicity'][$s["ethnicity"]]?></dd><? }?>
  <? if($s["religion"]>0){?><dt>my religion:</dt><dd><?=$this->socials['religion'][$s["religion"]]?></dd><? }?>
  <? if($s["political"]>0){?><dt>my political view:</dt><dd><?=$this->socials['politicalView'][$s["political"]]?></dd><? }?>
  <? if($s["humor"]>0){?><dt>my humor style:</dt><dd><?=$this->socials['humor'][$s["humor"]]?></dd><? }?>
  <? if($s["sexualOrientation"]>0){?><dt>my sexual orientation:</dt><dd><?=$this->socials['sexualOrientation'][$s["sexualOrientation"]]?></dd><? }?>
  <? if($s["fashion"]>0){?><dt>fashion funda:</dt><dd><?=$this->socials['fashion'][$s["fashion"]]?></dd><? }?>
  <? if($s["smoking"]>0){?><dt>smoking for me:</dt><dd><?=$this->socials['smoking'][$s["smoking"]]?></dd><? }?>
  <? if($s["drinking"]>0){?><dt> drinkin for me:</dt><dd><?=$this->socials['drinking'][$s["drinking"]]?></dd><? }?>
  <? if($s["pets"]>0){?><dt>my view about pets:</dt><dd><?=$this->socials['pets'][$s["pets"]]?></dd><? }?>
  <? if($s["living"]>0){?><dt>i m living:</dt><dd><?=$this->socials['living'][$s["living"]]?></dd><? }?>
  <? if($s["hometown"]!=''){?><dt>my hometown:</dt><dd><?=str($s["hometown"])?></dd><? }?>
  <? if($s["webpage"]!=''){?><dt>my webpage:</dt><dd><?=str($s["webpage"])?></dd><? }?>
  <? if($s["aboutMe"]!=''){?><dt>about me:</dt><dd><?=str($s["aboutMe"])?></dd><? }?>
  <? if($s["passions"]!=''){?><dt>my passions are:</dt><dd><?=str($s["passions"])?></dd><? }?>
  <? if($s["sports"]!=''){?><dt>sports i like:</dt><dd><?=str($s["sports"])?></dd><? }?>
  <? if($s["activities"]!=''){?><dt>activities:</dt><dd><?=str($s["activities"])?></dd><? }?>
  <? if($s["books"]!=''){?><dt>books i like:</dt><dd><?=str($s["books"])?></dd><? }?>
  <? if($s["music"]!=''){?><dt>music i listen:</dt><dd><?=str($s["music"])?></dd><? }?>
  <? if($s["tvShows"]!=''){?><dt><label for="tvShows"> tv shows i watch:</label></dt><dd><?=str($s["tvShows"])?></dd><? }?>
  <? if($s["movies"]!=''){?><dt>movies i can see again:</dt><dd><?=str($s["movies"])?></dd><? }?>
  <? if($s["cuisines"]!=''){?><dt>cuisines:</dt><dd><?=str($s["cuisines"])?></dd><? }?>
</dl>
                    </div>
                    <div id="loding"></div>
                </div>
            	<div class="cC"><div><span>&nbsp;</span></div></div>
            </div>
            <div class="r">
            		<?
						$count = $this->stuff["count"];
					?>
                	<a href="#slams/post">Slams<span>(<?=$count["slams"]?>)</span></a>
                	<a href="#scraps">Scraps<span>(<?=$count["scrap"]?>)</span></a>
                	<a href="#tweets">Tweets<span>(<?=$count["tweet"]?>)</span></a>
                	<a href="#friends">Friends<span>(<?=$count["friends"]?>)</span></a>
                    <a href="#photos">Photos<span>(<?=$count["photos"]?>)</span>
                	<a href="#videos">Videos<span>(<?=$count["videos"]?>)</span></a>
                	<? if(1==2){?>
                    <!--</a>
                	<a href="#community">Community<span>(<?=$count["community"]?>)</span></a>-->
					<? }?>
            </div>
        </div>
        <div id="Bc">
			<div class="l x bx">
            	<div class="t"><div><h2>&nbsp;</h2></div></div>
            	<div class="b">
                <h3>Newfangled Pepoolians</h3>
				<ul class="actvFrnds">
				<? if(count($this->NewfangledPepoolians)){foreach($this->NewfangledPepoolians as $F){?>
                    <li>
                        <img border="0" class="iB" src="<?=IMAGES?>user/icon/<?=$F['image']?>"><a href="<?=WWW_ROOT?>bio/<?=encode($F['id'])?>"><?=strlen($F["username"])>12?substr($F["username"],0,12)."..":$F["username"]?></a>
                        <span><?=str_replace(' years ','',timeDiff(strtotime($F["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))).", ".($F["gender"]=="M"?"Male":"Female")?></span>
                      <?  /*<p class="time">Active <?=timeDiff(strtotime($F['inTime']))?></p>*/ ?>
                    </li>
                <? }}else{?>
                   	<strong>Wow you become the Pepool's most energizing pepoolian noone is like you ;)</strong><br />
                    <a href="#invite">Spread</a> pepool to get more suggestions.
                <? }?>
                </ul>
                </div>
            	<div class="l"><div><span></span></div></div>
            </div>
			 <div class="r x bx">
           	<div class="t"><div><h2>&nbsp;</h2></div></div>
            	<div class="b">
                <h3>Energizing Pepoolians</h3>
   				<ul class="actvFrnds">
				<? if(count($this->EnergizingPepoolians)){foreach($this->EnergizingPepoolians as $F){?>
                    <li>
                        <img border="0" class="iB" src="<?=IMAGES?>user/icon/<?=$F['image']?>"><a href="<?=WWW_ROOT?>bio/<?=encode($F['id'])?>"><?=strlen($F["username"])>12?substr($F["username"],0,12)."..":$F["username"]?></a>
                        <span><?=str_replace(' years ','',timeDiff(strtotime($F["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))).", ".($F["gender"]=="M"?"Male":"Female")?></span>
                      <?  /*<p class="time">Active <?=timeDiff(strtotime($F['inTime']))?></p>*/ ?>
                    </li>
                <? }}else{?>
                   	<strong>Wow you become the Pepool's most energizing pepoolian noone is like you ;)</strong><br />
                    <a href="#invite">Spread</a> pepool to get more suggestions.
                <? }?>
                </ul>
                </div>
            	<div class="l"><div><span></span></div></div>
            </div>
        </div>
    </div>
<?=$this->render("accessories/footer.php")?>
</div>
<body>
</body>
</html>
