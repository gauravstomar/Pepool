<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class UsersController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->db = Zend_Registry::get('db');
		$this->user = new UsersModel($this->session->user["id"]);
		if($this->session->user["id"] && $this->getRequest()->getParam('bio'))
		{
			$this->userExt = new UsersModel(decode($this->getRequest()->getParam('bio')));
			$this->view->userExt = $this->userExt->Info();
			if($this->view->userExt["id"]=="")$this->_redirect("");
		}
//		pprint($this->view->userExt);die(decode($this->getRequest()->getParam('bio')));
		if($this->session->user["id"])$this->view->user = $this->user->Info();
		$this->admin = new AdminModel();
		if($this->session->error!="") $this->view->error = $this->session->error;
		$this->session->error = NULL;
	}
	
	function moreAction()
	{
		
		
	}
	
	function forgetpassAction()
	{
		HackCheck();
		if(POST)
		{
			$user = $this->user->GetUserPasswordByEmail($_POST['e']);
			if($user)
			{
				$msg="Hello buddy,<br /><br />Your pepool password is <strong>".$user['password']."</strong><br /><br />Thanks<br />Pepool.com";
				sendmail("Pepool password recovery ".$user["fname"]." ".$user["lname"],$msg,$_POST['e'],$user['fname'].' '.$user['lname']);
				die("gst.message('Password send to your email address',5,'success')");
			}
			else
			{
				die("gst.message('Email address invalid',5)");
			}
		}
	}
	
	function uploadimageAction()
	{
		if(POST)
		{
			if(!empty($_FILES["logo"]["name"]))
			{	$v = explode(".",$_FILES["logo"]["name"]);
				$base = "public/images/user/";
				$logo = encode(rand(0,time())).".".$v[count($v)-1];
				if(is_file($base.$this->session->user["image"]) && $this->session->user["image"]!='boy.gif' && $this->session->user["image"]!='girl.gif')
				{
					unlink($base.$this->session->user["image"]);
				 	unlink($base."icon/".$this->session->user["image"]);
				 	unlink($base."thumb/".$this->session->user["image"]);
				}
				resize($_FILES['logo']['tmp_name'],$base."thumb/".$logo,150,150);
				resize($_FILES['logo']['tmp_name'],$base."icon/".$logo,50,50);
				move_uploaded_file($_FILES['logo']['tmp_name'],$base.$logo);
				$this->db->update("user",array("image"=>$logo),"id=".$this->session->user["id"]);
				$this->session->error = array("Your profile pic changed.",10,"yeppe");
				$this->view->user["image"] = $this->session->user["image"] = $logo;
			}
			else $this->view->error=array("Invalid image format uploaded",10);
			goBack();
		}
	}
	
	function userDetails($uid)
	{
		$slam =  new SlamModel($uid);
		$user["count"]["slams"] = $slam->Count();
		$user["slams"]["request"] = $slam->GetRequests();
		$scrap =  new ScrapModel($uid);
		$user["count"]["scrap"] = $scrap->Count($this->view->user['id']);
		$tweet =  new TweetModel($uid);
		$user["count"]["tweet"] = $tweet->Count();
		$user["count"]["friends"] = count($this->view->userExt?$this->view->userExt["friends"]:$this->view->user["friends"]);
		$photos =  new PicsModel($uid);
		$user["count"]["photos"] = $photos->Count();
		$videos =  new VideoModel($uid);
		$user["count"]["videos"] = $videos->Count();
		$community =  new CommunityModel($uid);
		$user["count"]["community"] = $community->Count();
		$this->view->stuff = $user;
	}
	
	function Personals()
	{
		$this->view->visible = $this->admin->Visible();
		$this->view->country = $this->admin->Country();
		$this->view->language = $this->admin->Language();
		$this->view->interested = $this->admin->Interested();
		$this->view->relationshipStatus = $this->admin->RelationshipStatus();
	}
	
	function indexAction()
	{	
		if($this->session->user["id"]=="")$this->_redirect("");
		$this->Personals();
		
		
		$FriendsRaw = $this->user->GetFriends();
		$Friends = $FriendsRaw["friends"];
		
		$Updates = new UpdatesModel(array_keys($Friends),$this->session->user["id"]);
		$this->view->updates = $Updates->Get();
		
		$this->view->Friends = array_slice($Friends,0,9,true);
		
		$this->view->EnergizingPepoolians = $this->user->Energizing(array(0,9),array_merge_recursive(array($this->session->user["id"]),array_keys($FriendsRaw["friends"]),array_keys($FriendsRaw["sentRequest"]),array_keys($FriendsRaw["recivedRequest"])),array("gender ".($this->view->user["gender"]=="M"?"DESC":"ASC")));
		
		$this->userDetails($this->user->id);
		$this->view->socials = $this->admin->Socials();
		$this->view->visitors = $this->user->GetVisitors();
	}
	
	function logoutAction()
	{
		$this->user->Logout($this->session->user["lastLog"]);
		$this->session->user = NULL;
		$this->session->error = array("Thanks for using Pepool.",10,"thanks");
		$this->_redirect();
		die;
	}
	

	function loginAction()
	{	
		if(POST)
		{
			$log = ($_POST['email']!='' && $_POST['pass']!='')?$this->user->Login($_POST):NULL;
			if($log)
			{	
				$this->session->user = $log;
				if($log['regStatus']!='Y')
				{
					$this->session->error = array("<strong>A verification email was send to you.</strong><br /><br />Please follow the link to varify and access your account.<br />if you did not get it check your span folder also",45);
					$msg = "<strong>Hello ".$log["fname"]." ".$log["lname"]."</strong> ;-)<br /><br />
							To confirm your email address go to the link below:<br />
							<a href=\"".WWW_ROOT."greet/".$log["regStatus"]."/\">".WWW_ROOT."greet/".$log["regStatus"]."</a>
							<br /><br />Thanks<br />Pepool.com";
					sendmail($log["fname"]." ".$log["lname"]." pepool.com email confirmation",$msg,$log["email"],$log['fname']." ".$log['lname']);
					//@header("Location:".WWW_ROOT);die;
				}
				else
				{
					$this->session->error = array($this->admin->Message("welcome"),5,"welcome");
					//@header("Location:".WWW_ROOT.'my');die;
				}
				if($_REQUEST['rid']!='')
				{
					@header("Location:".WWW_ROOT.'bio/'.$_REQUEST['rid'].'#slams/post');die;
				}
				@header("Location:".WWW_ROOT.'my');die;
			}
			else
			{
				$this->session->error = array("Email or Password is invalid.<br /><strong>Try again.</strong>",20);
				@header("Location:".WWW_ROOT);die;
			}
		}
		goBack();
		die;
	}
	
	function registrationAction()
	{	
		if(POST)
		{
			$regError = array();
			$_POST["rid"] = $_POST["rid"]==""?0:decode($_POST["rid"]);
			if($_POST["fname"]=="")$regError["fname"] = "First name should not blank.";
			if($_POST["lname"]=="")$regError["lname"] = "Last name should not blank.";
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$_POST["email"]))$regError["email"] = "Invalid email.";
			elseif($this->user->CheckEmail($_POST["email"]))$regError["email"] = "Email already registered. Try with another.";
			if($_POST["email"]=="")$regError["email"] = "Email should not blank.";
			if(strlen($_POST["password"])<6)$regError["password"] = "Password must be greater then 6 character.";
			if($_POST["gender"]=="")$regError["gender"] = "Please select your gender.";
			if(!$_POST["month"]>0)$regError["month"] = "Please select your birth month.";
			if(!$_POST["day"]>0)$regError["day"] = "Please select your birth day.";
			if(!$_POST["year"]>0)$regError["year"] = "Please select your birth year.";
			if(!count($regError)>0)
			{
				$reg = $this->user->Register($_POST);
				if($reg)
				{	$this->session->user = $user = $this->user->Login($_POST);
					$this->session->error = array("<strong>Yo buddy</strong> ;-)<br />You are now a Pepoolean. We are waiting for your email confirmation.<br /><br />Please go to ".$_POST["email"]." and follow the link..",45,"welcome");
					
					$msg = "<strong>Yo buddy</strong> ;-)<br /><br />
							You are now a Pepoolean.<br />
							To confirm your email address go to the link below:<br />
							<a href=\"".WWW_ROOT."greet/".$user["regStatus"]."/\">".WWW_ROOT."greet/".$user["regStatus"]."</a>
							<br /><br />Thanks<br />Pepool.com";
					
					sendmail($user["fname"]." ".$user["lname"]." welcome to pepool.com",$msg,$user["email"],$user['fname']." ".$user['lname']);
					
					if($_POST["rid"]>0)
					{
						$invitee = new UsersModel($_POST["rid"]);
						$invitee = $invitee->Info();
						
						$msg="Hello ".$invitee['fname']." ".$invitee['lname'].",<br /><br />
						
						".$user["fname"]." ".$user["lname"]." just joined you on pepool.<br />
						To view ".($user["gender"]=='M'?'his':'her')." profile <a href=\"".WWW_ROOT."user/".encode($user["id"])."/\">click here</a>.
						
						<br /><br />Thanks<br />Pepool.com";
						
						sendmail($user["fname"]." ".$user["lname"]." is now a pepoolian",$msg,$invitee['email'],$invitee['fname'].' '.$invitee['lname']);

//						$this->session->user = $user;
						
						@header("Location:".WWW_ROOT.'bio/'.encode($_POST['rid']).'#slams/post'); die;
					}
					@header("Location:".WWW_ROOT.'my#invite'); die;
				}
				else
				{
					$this->session->error = array("<strong>SYSTEM DOWN!</strong><br />Please try again later.",15);
					$this->admin->Report("REG_0001");
				}
			}
			else
			{
				$this->session->error = array(implode("<br />",$regError),15);
			}
			goBack();die;
		}
	}
	
	function friendsAction()
	{
		HackCheck();
		if($_REQUEST['json']=='y')
		{
			if($_REQUEST['act'])
			{
				$act = explode("-",$_REQUEST['act']);
				if($act[0]=="r")
				{
					$this->user->RemoveFriend(decode($act[1]));
					$r = array("af frnd","Add as friend","a-".$act[1]);
				}
				if($act[0]=="a")
				{

					$this->user->AddFan(decode($act[1]));
					
					$user = new UsersModel(decode($act[1]));
					$user = $user->Info();
					$invitee = $this->view->user;
					
					$msg = "<strong>Hi ".$user['fname']." ".$user['lname']."</strong><br /><br />
							<a href=\"".WWW_ROOT."user/".encode($invitee["id"])."/\">".$invitee['fname']." ".$invitee['lname']."</a> wants to be your friend on pepool.com.<br />
							To accept his request and view user profile go to the link below:<br />
							<a href=\"".WWW_ROOT."user/".encode($invitee["id"])."/\">".WWW_ROOT."user/".encode($invitee["id"])."</a>
							<br /><br />Thanks<br />Pepool.com";
					
					sendmail($invitee["fname"]." ".$invitee["lname"]." wants to be your friend ",$msg,$user["email"],$user['fname']." ".$user['lname']);

					$r = array("wf frnd","Friend request pending","");
					
				}
				if($act[0]=="c")
				{	
					$this->user->ConfirmFriend(decode($act[1]));
					$r = array("rf frnd","Remove friend","r-".$act[1]);
				}
			}
			jencode($r);
		}
		
		$of = $this->getRequest()->getParam('of')?decode($this->getRequest()->getParam('of')):$this->session->user['id'];
		$user = new UsersModel($of); $userFriends = $user->GetFriends(); $user = $user->Info();
		$prefix = $this->session->user['id']==$of?'My':($user['gender']=='M'?'His':'Her');

		if(count($userFriends["recivedRequest"])>0 && $of && $prefix=='My')
		{
			$rU["recived-friend"]["title"] = "You have new friend request";
			foreach($userFriends["recivedRequest"] as $id=>$v)
			$rU["recived-friend"]["data"][] = array("uid"=>encode($id),"username"=>$v["username"],"image"=>$v["image"],"addr"=>(timeDiff(strtotime($v["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))).", ".($v["gender"]=="M"?"Male":"Female")."<br />".($v["address"]?$v["address"].", ":"").($v["city"]?$v["city"].", ":"").$v["state"]);
		}
		
		if(count($userFriends["friends"])>0)
		{	$rU["real-friend"]["title"] = $prefix." real friends";
			foreach($userFriends["friends"] as $id=>$v)
			$rU["real-friend"]["data"][] = array("uid"=>encode($id),"username"=>$v["username"],"image"=>$v["image"],"addr"=>(timeDiff(strtotime($v["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))).", ".($v["gender"]=="M"?"Male":"Female")."<br />".($v["address"]?$v["address"].", ":"").($v["city"]?$v["city"].", ":"").$v["state"]);
		}
		else
		{
			$rU["real-friend"]["title"] = "So sad, ".$prefix." account of friends are empty";
		}

		if(count($userFriends["sentRequest"])>0 && $of && $prefix=='My')
		{
			$rU["sent-friend"]["title"] = "Pending friend request you send";
			foreach($userFriends["sentRequest"] as $id=>$v)
			$rU["sent-friend"]["data"][] = array("uid"=>encode($id),"username"=>$v["username"],"image"=>$v["image"],"addr"=>(timeDiff(strtotime($v["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>''))).", ".($v["gender"]=="M"?"Male":"Female")."<br />".($v["address"]?$v["address"].", ":"").($v["city"]?$v["city"].", ":"").$v["state"]);
		}
		jencode($rU);die;
	}
	
	function searchAction()
	{
		$this->view->country = $this->admin->Country();
		if(POST)
		{	$rU = array();
			$result = $this->user->Search($_POST);
			foreach($result as $r)
			$rU[] = array("id"=>encode($r["id"]),"i"=>$r["image"],"u"=>$r["username"],"a"=>timeDiff(strtotime($r["birthDay"]),array('parts'=>1,'precision' =>'year','separator' =>'','next'=>'')).", ".($r["gender"]=='M'?'Male':'Female')."<br />".($r["city"]).($r["state"]?", ".$r["state"]:"")."<br />".$this->view->country[$r["country"]]);
			die(json_encode($rU));
		}
	}
	
	function profileAction()
	{
		if($this->session->user["id"]=="" && $this->getRequest()->getParam('bio'))
		{
			$this->_redirect("user/".$this->getRequest()->getParam('bio'));
		}
		if($this->session->user["id"]!=$this->view->userExt["id"])$this->userExt->AddVisitor($this->session->user["id"]);

		$FM = $this->user->GetFriends();
		$Rest = array_merge_recursive(array($this->session->user["id"]),array_keys($FM["friends"]),array_keys($FM["sentRequest"]),array_keys($FM["recivedRequest"]));
		$this->view->EnergizingPepoolians = $this->user->Energizing(array(0,9),$Rest,array("gender ".($this->view->user["gender"]=="M"?"DESC":"ASC")));
		$this->view->NewfangledPepoolians = $this->user->Newfangled(array(0,9),$Rest,array("gender ".($this->view->user["gender"]=="M"?"DESC":"ASC")),true);
		
		$this->Personals();
		$this->userDetails(decode($this->getRequest()->getParam('bio')));
		$this->view->socials = $this->admin->Socials();

		if(!file_exists("public/images/user/".$this->view->userExt["image"]))
		{
			$this->db->update("user",array("image"=>($this->view->userExt["gender"]=="M"?"boy.gif":"girl.gif")),"id=".$this->view->userExt["id"]);
		}

	}
	
}
?>