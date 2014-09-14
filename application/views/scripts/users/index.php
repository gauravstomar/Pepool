<?
	extract($this->user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$this->render("accessories/dochead.php")?>
</head>
<div id="W">
<?=$this->render("accessories/header.php")?>
	<div id="B">
		<div id="Ba">
			<div class="iB wa"><img src="<?=IMAGES?>user/thumb/<?=$image?>" /><iframe allowtransparency="true" src="<?=WWW_ROOT?>users/uploadimage" style="width:70px;height:20px;display:none;position:absolute" scrolling="no" frameborder="0"></iframe></div>
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
	                <li><a href="#profile" class="std">My Home</a></li>
	                <? if(1==2){?>
                    <!--<li><a href="#updates">Updates</a></li>
                    <li><a href="#visitors">Recent Visitors</a></li>-->
                    <? }?>
	                <li><a href="#invite">Pool Friends</a></li>
	                <li><a href="#search">Search Users</a></li>
	                <li><a href="#settings/personal">Settings</a></li>
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
                        <h2>Add your favorite Games by clicking on the  "Add to My Games" button under the Games.</h2>
                        <h3>has been removed from My Games.</h3>
                        <div>
							<script type="text/javascript">
								google_ad_client = "pub-6720925791493319";
								google_ad_slot = "0592924453";
								google_ad_width = 468;
								google_ad_height = 15;
                            </script>
                            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> </script>
                        </div>
						<h1>The game</h1>
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
<? if(count($this->stuff["slams"]["request"])>0){?>
<ul class="tasks">
<h3>New slam requests</h3>
<?
	foreach($this->stuff["slams"]["request"] as $id=>$user)
	{
?>
	<li>You recived a request from <a href="<?=WWW_ROOT?>bio/<?=encode($id)?>"><?=$user['fname']." ".$user['lname']?></a> to fill <?=$user["gender"]=='M'?"his":"her"?> <a href="<?=WWW_ROOT?>bio/<?=encode($id)?>#slams/post" class="x">slambook</a></li>
<?
	}
?>
</ul>
<? }?>

<? if(count($this->user["recivedRequest"])>0){?>
<ul class="tasks">
    <h3>Friend Requests</h3>
	<li><span class="alert">You have <a href="#friends"><?=count($this->user["recivedRequest"])?> new</a> friend requests.</span></li>
</ul>
<? }?>


<? if(count($this->visitors)>0){?>
<ul class="tasks">
    <h3>Recent visitors</h3>
    <li>
    <? $i = 0; foreach($this->visitors as $user){?>
        <a title="<?=timeDiff(strtotime($user['timestamps']))?>" href="<?=WWW_ROOT?>bio/<?=encode($user['id'])?>"><?=$user['fname'].' '.$user['lname']?></a><? if($i!=count($this->visitors)-1){$i++; print ", ";}?>
    <? }?>
    </li>
</ul>
<? }?>

<? if(count($this->updates)>0){?>
    <ul class="tasks">
    <h3>Friends updates</h3>
    <?	foreach($this->updates as $update){?>
        <li><?=$update['data']?><span class="time"><?=timeDiff($update['time'])?></span></li>
    <?	}?>
    </ul>
<? }?>

<ul class="tasks">
<h3>How to make fun</h3>
	<li><a href="javascript:;" class="a2a_dd">Spread your slambook</a> among your friends</li>
    <li>Pass friends your slambook url <input type="text" onclick="this.select()" style="width:200px;float:none;border:none;color:#008FD1;" value="pepool.com/user/<?=encode($this->user["id"])?>" /></li>
    <li>Checkout your <a href="#slams/recived">online slambook</a></li>
    <li><a href="#invite">Invite friends</a> to fill your slambook and know what they think about you..</li>
    <li>Grow up your network and make fun, <a href="#tweets">tweet</a> and let your <a href="#friends">friends</a> know what you are doing today</li>
    <li>Make <a href="#scraps">scraps</a> to friends..</li>
    <? if(1==2){?>
    <li><fb:share-button class="url" href="http://pepool.com/user/<?=encode($this->user["id"])?>" type="link"></fb:share-button></li>
    <? }?>
</ul>
                    </div>
                    <div id="loding"></div>
                </div>
            	<div class="cC"><div><span>&nbsp;</span></div></div>
            </div>
            <div class="r">
            		<?
                    $count = $this->stuff["count"];
					?>
                	<a href="#slams/recived">Slams<span>(<?=$count["slams"]?>)</span></a>
                	<a href="#scraps">Scraps<span>(<?=$count["scrap"]?>)</span></a>
                	<a href="#tweets">Tweets<span>(<?=$count["tweet"]?>)</span></a>
                	<a href="#friends">Friends<span>(<?=$count["friends"]?>)</span></a>
                    <a href="#photos">Photos<span>(<?=$count["photos"]?>)</span></a>
					<a href="#videos">Videos<span>(<?=$count["videos"]?>)</span></a>
                	<? if(1==2){?>
                    <!--
                	<a href="#community">Community<span>(<?=$count["community"]?>)</span></a>-->
					<? }?>
            </div>
        </div>
		<div id="Bc">
			<div class="l x bx">
            	<div class="t"><div><h2>&nbsp;</h2></div></div>
            	<div class="b">
                <h3>Recently active friends</h3>
				<ul class="actvFrnds">
				<? if(count($this->Friends)){foreach($this->Friends as $uid=>$F){?>
                    <li>
                        <img border="0" class="iB" src="<?=IMAGES?>user/icon/<?=$F['image']?>"><a href="<?=WWW_ROOT?>bio/<?=encode($uid)?>"><?=strlen($F["username"])>12?substr($F["username"],0,12)."..":$F["username"]?></a>
                        <span><?=str_replace(' years ','',timeDiff(strtotime($F["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))).", ".($F["gender"]=="M"?"Male":"Female")?></span>
                       <? /*<p class="time">Active <?=timeDiff(strtotime($F['inTime']))?></p>*/ ?>
                    </li>
                <? }}else{?><br />
                   	<strong>Oops you don't have any friend.</strong><br />
                    <a href="#invite" class="wa">Invite</a> your friends to pool your own pepool.
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