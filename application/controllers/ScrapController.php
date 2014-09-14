<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class ScrapController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->db = Zend_Registry::get('db');
		$this->scrap = new ScrapModel($this->getRequest()->getParam('of')?decode($this->getRequest()->getParam('of')):$this->session->user["id"]);
		$this->admin = new AdminModel();
		$this->view->user = $this->session->user;
		if($this->session->error!="") $this->view->error = $this->session->error;
		$this->session->error = NULL;
	}

	function scraperAction()
	{
		$scraper = $this->scrap->Scrapers();
		$scr = array();
		foreach($scraper as $sc)
		{
			$scr[] = array("i"=>encode($sc["id"]),"j"=>$sc["fname"]." ".$sc["lname"]." (".$sc["tot"].")");
		}
		jencode($scr);
		die;
	}
	function addAction()
	{
		if(POST)
		{
			$uTw = array(); $uid = decode($_REQUEST['id']);
			$this->scrap->Add(array("scrap"=>$_REQUEST['scrap'],"privacy"=>$_REQUEST['privacy'],"uid"=>$uid));
			$uT = $this->scrap->Get(0,1,$uid); $uT = $uT[0]; $privacy = $_REQUEST['privacy']=='Y'?' private ':'';
			if($uid!=$this->session->user['id'])
			{
				$scrapTo = new UsersModel($uid); $scrapTo = $scrapTo->Info();
				$scrapBy = new UsersModel($this->session->user['id']); $scrapBy = $scrapBy->Info();
				$msg="Hello ".$scrapTo['fname']." ".$scrapTo['lname'].",<br />
						<a href='".WWW_ROOT."user/".encode($scrapBy["id"])."'>".$scrapBy["fname"]." ".$scrapBy["lname"]."</a> just send a  $privacy scrap to you,<br /><br />
						<strong style='font-size:16px'>".$uT['scrap']."</strong><br /><br />
						to make reply or read more got to <a href='".WWW_ROOT."'>Pepool</a>.
						<br /><br />Thanks<br /><a href='".WWW_ROOT."'>Pepool.com</a>";
				sendmail($scrapBy["fname"]." ".$scrapBy["lname"]." just send $privacy scrap to you..",$msg,$scrapTo['email'],$scrapTo['fname'].' '.$scrapTo['lname']);
			}

			$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
			$uT["id"] = encode($uT["id"]);
			$uT["uid"] = encode($uT["uid"]);
			$uT["scrap"] = str($uT["scrap"]);
			$uT["privacy"] = $uT["privacy"];
			$uT["d"] = true;
			$uT["r"] = false;
			die(json_encode($uT));
		}
		die;
	}
	
	function deleteAction()
	{
		if(POST)
		{
			$this->scrap->Delete(decode($_REQUEST['id']));
		}
		die;
	}
	
	function getAction()
	{
		$scrap = $this->scrap->Get();
		$uTw = array();
		if($scrap)
		{
			$recivedBy = $this->scrap->uid;
			foreach($scrap as $uT)
			{	$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
				$postedBy = $uT["uid"];
				$uT["id"] = encode($uT["id"]);
				$uT["uid"] = encode($uT["uid"]);
				$uT["scrap"] = str($uT["scrap"]);
				$uT["r"] = $recivedBy == $this->session->user['id'];
				$uT["d"] = $postedBy == $this->session->user['id'] || $recivedBy == $this->session->user['id'];
				if($uT["d"] || $uT["privacy"]=='N')$uTw[] = $uT;
			}
			jencode($uTw);
		}	die;
	}
}
?>