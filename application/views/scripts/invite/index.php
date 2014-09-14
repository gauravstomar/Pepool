<div>
	<div id="invPro">
    	<form>
        	<input name="of" type="hidden" value="orkut" />
        	<input name="n" title="userid" type="text" value="userid" />
            <input name="p" title="password" type="password" value="password" />
            <input type="button" value="&raquo;" />
        </form>
    </div>
  <ul class="nav">
    <li><a href="#invite/orkut" class="std">Orkut</a></li>
    <li><a href="#invite/facebook">Facebook</a></li>
    <li><a href="#invite/gmail">Gmail</a></li>
    <li><a href="#invite/yahoo">Yahoo</a></li>
    <li><a href="#invite/hi5">Hi5</a></li>
    <li><a href="#invite/hotmail">Hotmail</a></li>
    <li><a href="#invite/skyrock">Skyrock</a></li>
    <li><a href="#invite/tagged">Tagged</a></li>
    <li><a href="#invite/aol">AOL</a></li>
    <li><a href="#invite/msn">MSN</a></li>
    <li><a href="#invite/icqmail">ICQ mail</a></li>
    <li><a href="#invite/indiatimes">Indiatimes</a></li>
    <li><a href="#invite/rediffmail">Rediffmail</a></li>
    <li><a href="#invite/zapak">Zapakmail</a></li>
  </ul>
  <div class="field">
	<div><span class="l"><input id="selectAll" type="checkbox" />select all</span><span class="r"><img src="<?=IMAGES?>reqslm.gif" alt="request slam" /></span></div>
    <ul class="outsite">
	<? foreach($this->outContacts as $id=>$d)if(strpos($d["email"],"@")){?>
    <label><input type="checkbox" name="id[]" value="<?=encode($id)?>"/><span class="e"><?=strpos($d["email"],"@")?$d["email"]:$d["name"]?></span><span class="n"><?=strpos($d["email"],"@")?$d["name"]:"Social contact"?><?
    if($d["mailsend"]>0){?> (invited <?=$d["mailsend"]?> times)<? }?></span></label><? }?>
    </ul>
  </div>
	<h3>Users already in pepool</h3>
  <div class="insite">
    <ul>
	<? foreach($this->inContacts as $id=>$d){?>
    <li class="<?=encode($id)?>">
    	<span class="e"><img src="<?=IMAGES.'user/icon/'.$d["image"]?>" /></span>
        <span class="n">
			<?=(strlen($d["fname"].$d["lname"])<12)?$d["fname"]." ".$d["lname"]:(strlen($d["fname"])<12?$d["fname"]:substr($d["fname"],0,10).'..')?>
	        <span><?=($d["gender"]=="M"?"Male":"Female").", ".timeDiff(strtotime($d["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))?></span>
        </span>
    </li>
    <? }?>
    </ul>
  </div>
  
</div>
