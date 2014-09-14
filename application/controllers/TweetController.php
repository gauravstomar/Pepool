<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class TweetController extends Zend_Controller_Action
{
    function init()
    {	
		HackCheck();
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->db = Zend_Registry::get('db');
		$this->tweet = new TweetModel($this->session->user["id"]);
		$this->admin = new AdminModel();
		$this->user = new UsersModel($this->session->user["id"]);
		$this->view->user = $this->session->user;
		if($this->session->error!="") $this->view->error = $this->session->error;
		$this->session->error = NULL;
	}
	
	function addAction()
	{
		if($this->tweet->Add($_REQUEST['tweet']))
		{
			$uT = $this->tweet->Current();
			$user = $this->view->user;

$Friends = $this->user->GetFriends();

foreach($Friends["friends"] as $friend)
{
	$msg="Hello ".$friend['username'].",<br />
		 <a href='".WWW_ROOT."user/".encode($user["id"])."'>".$user["fname"]." ".$user["lname"]."</a> tweets:<br /><br />
		
		<strong style='font-size:16px'>".$uT["tweet"]."</strong><br /><br />
		to view more more what ".($user["gender"]=='M'?'he':'she')." says <a href='".WWW_ROOT."user/".encode($user["id"])."'>click here</a>.
		<br /><br />Thanks<br /><a href='".WWW_ROOT."'>Pepool.com</a>";
	sendmail($user["fname"]." ".$user["lname"]." tweets..",$msg,$friend['email'],$friend['username']);
}

			$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
			$uT["id"] = encode($uT["id"]);
			$uT["uid"] = encode($uT["uid"]);
			jencode($uT);
		}
	}
	
	function deleteAction()
	{
		if(POST)
		{
			$this->tweet->Delete(decode($_REQUEST['id']));
		}
		die;
	}
	
	function getAction()
	{	
		if(!$this->getRequest()->getParam('html'))
		{	$uTw = array();
			$tweet = $this->tweet->Get($_REQUEST['limit'],$this->getRequest()->getParam('of')?decode($this->getRequest()->getParam('of')):NULL,($_REQUEST['limit']==1?'DESC':'ASC'));
			if($tweet)
			{
				foreach($tweet as $uT)
				{	$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
					$uT["id"] = encode($uT["id"]);
					$uT["uid"] = encode($uT["uid"]);
					$uTw[] = $uT;
				}
			}
			jencode($uTw); die;
		}
	}
}
?>