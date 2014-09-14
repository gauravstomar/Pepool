<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class SlamController extends Zend_Controller_Action
{
    function init()
    {	
		HackCheck();
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->db = Zend_Registry::get('db');
		$user = new UsersModel($this->getRequest()->getParam('of')=="null" || $this->getRequest()->getParam('of')==""?$this->session->user["id"]:decode($this->getRequest()->getParam('of')));;
		$this->view->userExt = $user->Info();
		$this->slam = new SlamModel($this->view->userExt["id"]);
		$this->admin = new AdminModel();
		$this->view->user = $this->session->user;
		$this->prefix = $this->session->user['id']==$this->view->userExt['id']?'You':($this->view->userExt['gender']=='M'?'He':'She');
		if($this->session->error!="") $this->view->error = $this->session->error;
		$this->session->error = NULL;
	}
	
	function requestAction()
	{
		$this->slam->AddRequest($this->session->user["id"],decode($_REQUEST["u"]));
		jencode(array("wf slam","Request send for slam",$_REQUEST["u"]));
	}
	
	function rearrangeAction()
	{
		$this->slam->Rearrange($_POST);
		die('arranged');
	}

	function addAction()
	{
		if(POST)
		{
			$this->slam->Add(array("scrap"=>$_REQUEST['scrap'],"uid"=>decode($_REQUEST['id'])));
			$uT = $this->slam->Get(0,1); $uT = $uT[0];
			$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
			$uT["id"] = encode($uT["id"]);
			$uTw[] = $uT; jencode($uTw);
		}
		die;
	}
	
	function deleteAction()
	{
		if(POST)
		{
			$this->slam->Delete(decode($_REQUEST['id']));
			die("gst.message('Unable to delete')");
		}
		die;
	}
	
	function getAction()
	{
		$scrap = $this->slam->Get();
		if($scrap)
		{
			foreach($scrap as $uT)
			{	$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
				$uT["id"] = encode($uT["id"]);
				$uT["uid"] = encode($uT["uid"]);
				$uTw[] = $uT;
			}
			jencode($uTw);
		}	die;
	}
	
	function postAction()
	{	
		$return = array();
		$return["HTML"] = "<div style='margin:10px'><strong>Hi ".$this->session->user["fname"].",</strong>Fill my slambook and let me know how much you crushes on me</div>";
		$return["QA"] = array();
		$QA = $this->slam->Questions(array(1,99),$this->session->user["id"],$this->view->userExt["id"]);
		foreach($QA as $k=>$v)
		{
			$return["QA"][] = array(encode($k),$v["que"],$v["ans"],$v["P"]);
		}
		jencode($return);
	}
	
	function customAction()
	{	
		$return = array();
		$return["HTML"] = "<div style='margin:10px;font-weight:bold'>Select your slambook questions and arrange them in your favorite order</div>";
		$return["QA"] = array();
		$QA = $this->slam->Questions(array(1,99),$this->session->user["id"]);
		foreach($QA as $k=>$v) $return["QA"][] = array(encode($k),$v["que"]);
		jencode($return);
	}
	
	function propertyAction()
	{
		$this->slam->AnswerProperty(decode($_REQUEST["q"]),$_REQUEST["p"],$this->session->user["id"]);
	} 
	
	function answerAction()
	{
		$response = $this->slam->AddAnswer(decode($_REQUEST["q"]),$_REQUEST["ans"],$this->session->user["id"]);
		if($response == 2)die("null"); if($response == 1)die("null");//die("gst.message('Answer saved',1,'yeppe')"); 
		if($response == 0)die("gst.message('Unable to save answer.<br />Try again later.',1,'oops')");
	}
	
	function naviAction()
	{
		if($this->getRequest()->getParam('of')=='null')
		{
			$nav = array(array("a"=>"Recived","b"=>"recived"),
						 array("a"=>"Sent","b"=>"sent"),
						 array("a"=>"Requested","b"=>"requested"),
						 array("a"=>"Customize","b"=>"custom"));
		}
		else
		{	
			$nav = array(array("a"=>"Recived","b"=>"recived"),
						 array("a"=>"Sent","b"=>"sent"),
						 array("a"=>"Post","b"=>"post"));
		}
		jencode($nav);
	}
	
	function recivedAction()
	{
		$return = array();
		$sent = $this->slam->Received();
		$return["data"] = array();
		if(count($sent)>0)
		$return["HTML"] = "<ul style='margin:10px 0 20px 0'><strong>".$this->prefix." received ".count($sent)." slam(s).</strong><ul>";
		else $return["HTML"] = "<ul style='margin-top:10px'><strong>Oops ".$this->prefix." not received a slam yet.</strong><br />".($this->prefix=='You'?"You can go to your <a href='#friends' class='fn'>friends</a> profile and remember them for a slam or you can  <a href='#invite' class='fn'>invite</a> a friend to pepool.":"")."<ul>";
		
		foreach($sent as $a)
		{	  extract($a);
			  $return["data"][] = array("uid"=>encode($id),
										"name"=>$fname." ".$lname,
										"image"=>$image,
										"timestamps"=>timeDiff(strtotime($timestamps)));
		}
		jencode($return);
	}
	
	function requestedAction()
	{
		
		$return = array("data"=>array(),"HTML"=>"<ul style='margin:10px 0'><strong>You don't requested someone for a slam.</strong>".($this->prefix=='You'?"<br />You can go to your <a href='#friends' class='fn'>friends</a> profile and request them for a slam.":"")."<ul>");
		$requested = $this->slam->Requested();
		
		if(count($requested)>0)
		{
			$return["HTML"] = "<ul style='margin: 10px 0pt 20px;'><strong>You send ".count($requested)." pending requests.</strong><br />You can <a href='#invite' class='fn'>invite</a> more friends to fill your slambook.<ul></ul><ul>";
			
			foreach($requested as $a)
			{	  extract($a);
				  $return["data"][] = array("uid"=>encode($id),
											"name"=>$fname." ".$lname,
											"image"=>$image,
											"timestamps"=>timeDiff(strtotime($timestamps)));
			}
		}
		jencode($return);
	}
	
	function sentAction()
	{
		$return = array();
		$sent = $this->slam->Sent();
		if(count($sent)>0)
		$return["HTML"] = "<ul style='margin:10px 0 20px 0'><strong>".$this->prefix." slammed to ".count($sent)." friends.</strong><ul>";
		else $return["HTML"] = "<ul style='margin-top:10px'><strong>".$this->prefix." never sent a slam.</strong>
		".($this->prefix=='You'?"<br />Its not good you should go to your <a href='#friends' class='fn'>friends</a> profile and let them know what you think about them.":"")."<ul>";
		$return["data"] = array();
		foreach($sent as $a)
		{	  extract($a);
			  $return["data"][] = array("uid"=>encode($id),
										"name"=>$fname." ".$lname,
										"image"=>$image,
										"timestamps"=>timeDiff(strtotime($timestamps)));
		}
		jencode($return);
	}
	
	function grabAction()
	{
		$return = array();
		$ref[0] = decode($this->getRequest()->getParam('ref'));
		$ref[1] = $this->getRequest()->getParam('of')?decode($this->getRequest()->getParam('of')):$this->session->user["id"];
		if($this->getRequest()->getParam('for')=='recived')
		{
			$uidFrom = $ref[0];
			if($uidFrom==$this->session->user["id"])$from = "Me";
			else
			{
				$from = new UsersModel($uidFrom); $from = $from->Info();
				$from = $from["fname"]." ".$from["lname"];
			}

			$uidTo   = $ref[1];
			if($uidTo==$this->session->user["id"])$to = "Me";
			else
			{
				$to = new UsersModel($uidTo); $to = $to->Info();
				$to = $to["fname"]." ".$to["lname"];
			}
		}
		elseif($this->getRequest()->getParam('for')=='sent')
		{
			$uidFrom = $ref[1];
			if($uidFrom==$this->session->user["id"])$from = "Me";
			else
			{
				$from = new UsersModel($uidFrom); $from = $from->Info();
				$from = $from["fname"]." ".$from["lname"];
			}
			
			
			$uidTo   = $ref[0];
			if($uidTo==$this->session->user["id"])$to = "Me";
			else
			{
				$to = new UsersModel($uidTo); $to = $to->Info();
				$to = $to["fname"]." ".$to["lname"];
			}
		}

		$grabbed = $this->slam->Grab($uidFrom,$uidTo);
		if(count($grabbed)>0)
		{
			if($this->session->user['id']==$uidFrom || $this->session->user['id']==$uidTo)$erase = "<a href='javascript:;' class='rub'>[erase]</a>";
//			$pubPvt = "<a href='javascript:;' class='pvt'>[make private]</a>";
			$return["HTML"] = "<h3 style='margin:10px 0'>Slambook filled by $from for $to $erase $pubPvt</h3>";
			foreach($grabbed as $k=>$v)
			{
				$return["data"][] = array(encode($k),$v["que"],str($v["ans"]));
			}

		}
		jencode($return);
	}
}
?>