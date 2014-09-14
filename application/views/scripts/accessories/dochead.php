<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$this->user["id"]==""?"Pepool.com ":(($this->userExt["id"]==$this->user["id"] || $this->userExt["id"]=="")?"My":($this->userExt["fname"]." ".$this->userExt["lname"]."'s"))?> Pool <? if($this->InviteeUser["fname"].$this->InviteeUser["lname"]!=''){?><?=" of ".$this->InviteeUser["fname"]." ".$this->InviteeUser["lname"]?><? }?></title>
<meta name="keywords" content="Pool <? if($this->InviteeUser["fname"].$this->InviteeUser["lname"]!=''){?><?=" of ".$this->InviteeUser["fname"]." ".$this->InviteeUser["lname"]?><? }?>" />
<meta name="description" content="Pool <? if($this->InviteeUser["fname"].$this->InviteeUser["lname"]!=''){?><?=" of ".$this->InviteeUser["fname"]." ".$this->InviteeUser["lname"]?><? }?>" />
<meta name="robots" content="index,follow" />
<meta name="distribution" content="global" />
<meta name="revisit-after" content="5 days" />
<meta name="author" content="Pepool,Greater Noida,India" />
<meta name="distribution" content="Global" />
<meta name="development" content="Pepool.com" />
<meta name="rating" content="Safe For everyone" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?=CSS?>" rel="stylesheet" type="text/css" />
<meta name="google-site-verification" content="xgleUdz5rbK7gT5-T3YreQfRwwkciiZOZ-DIHmrHP34" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('jquery','1.4.1'); google.load('elements','1',{packages:'transliteration'});
google.setOnLoadCallback(function()
{	$.getScript('<?=WWW_ROOT?>js/',function(){
		gst.init({"id":"<?=encode($this->userExt["id"])?>","n":"<?=$this->userExt["chopName"]?>","p":"<?=$this->userExt["gender"]=="M"?"His":"Her"?>"});
		<? if($this->error!=""){?>gst.message('<?=$this->error[0]?>',<?=$this->error[1]?>,'<?=$this->error[2]?>')<? }?>
	})
})
</script>