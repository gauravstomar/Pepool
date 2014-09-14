<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class InviteController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->view->user = $this->session->user;
		$this->user = new UsersModel($this->session->user["id"]);
		if($this->session->error)$this->view->error = $this->session->error;$this->session->error = NULL;
	}
	
	function indexAction()
	{

		if(POST)
		{ 	set_time_limit(999999);
			$emails = $users = array();
			$emailRaw = $this->user->ImportContacts($_POST['of'],$_POST["n"],$_POST["p"]);
			foreach($emailRaw["out"] as $k=>$v)
			{
				if($this->user->CheckEmail($v[0]))
				{
					$usr = $this->user->GetDetailsByEmail($v[0]);
					$usrNam = (strlen($usr["fname"].$usr["lname"])<10)?$usr["fname"]." ".$usr["lname"]:(strlen($usr["fname"])<10?$usr["fname"]:substr($usr["fname"],0,10).'..');
					$users[] = array(encode($usr["id"]),$usr["image"],$usrNam,($usr["gender"]=="M"?"Male":"Female").", ".timeDiff(strtotime($usr["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>'')));
				}
				else
				{
					$eM = array("n"=>$k,"i"=>encode($v[1]));

					if(strpos($v[0],"@"))$eM = array_merge($eM,array("e"=>$v[0]));

					if($v[2]>0)$eM = array_merge($eM,array("m"=>$v[2]));
					$emails[] = $eM;
				}
			}
			die(json_encode(array("emails"=>$emails,"users"=>$users,"m"=>count($emails)>0?"You got ".count($emails)." contacts from your ".$_POST["of"]." id.":"<strong>No contacts found.</strong><br />May be your login are invalid.","mT"=>count($emails)>0?"yeppe":"")));
		}
		
		$this->view->outContacts = $this->user->outContacts();
		$this->view->inContacts = $this->user->inContacts();

	}
	
	function iphoneAction()
	{
	 	set_time_limit(999999);
		$emails = $users = array();
		
		
		$off = $_REQUEST['of'];
		$nn  = $_REQUEST['n'];
		$p   = $_REQUEST['p'];
		
		
		$n = strpos($nn,"@")>0?$nn:$nn."@".$off.".com";
		if($off)$e = array($n,$p,$off); else return false;

		$ch = curl_init(); curl_setopt($ch, CURLOPT_POST, 1); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, "http://www.pepool.com/OpenInviter/example.php");
		curl_setopt($ch, CURLOPT_POSTFIELDS, "&email_box=".$e[0]."&password_box=".$e[1]."&provider_box=".$e[2]."&import=Import Contacts&step=get_contacts");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0"); curl_setopt($ch,CURLOPT_ENCODING , "UTF-8"); $content = curl_exec($ch);
		curl_close($ch); $return = jdecode($content); $rtX = array("in"=>array(),"out"=>array());

		$emailRaw = array();
		
		foreach($return['contacts'] as $v=>$k)
		{
			$emailRaw[] = array($k,$v);
		}

		die(json_encode(array("emails"=>$emailRaw,"m"=>count($emailRaw)>0?"You got ".count($emailRaw)." contacts from your ".$_REQUEST["of"]." id":"No contacts found. May be your login are invalid")));
	}

	function iphonesendAction()
	{
		$emails = explode("|",$_REQUEST["emails"]);
		die(count($emails)>1?"Card send to ".count($emails)." contacts":"Card send to ".$emails[0]);
	}

	function sendAction()
	{
		$id = array(); $emails = explode(",",$_POST["e"]);
		foreach($emails as $e)if(strlen($e)>1)$id[] = decode($e);
		$responce = $this->user->SendInvite($id); 
		//print_r($responce);die;
		die($e);
	}


}
?>