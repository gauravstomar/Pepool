<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class IndexController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->view->user = $this->session->user;
		if($this->session->error)$this->view->error = $this->session->error;
		$this->session->error = NULL;
	}
	
	function donothingAction()
	{
		
		
		
		
	}
	
	function energizingAction()
	{
		$user = new UsersModel();
		$this->session->from = $this->session->from>0?($this->session->from+1):30;
		$users = $user->Search(array(),array($this->session->from,1),NULL,array("gender DESC"));
?>
        <? $i=0; foreach($users as $r){?>
            <a href="<?=WWW_ROOT?>user/<?=encode($r["id"])?>"><img src="<?=IMAGES?>user/icon/<?=$r["image"]?>" /><span><?=(strlen($r["username"])<10)?$r["username"]:substr($r["username"],0,10).'..'?><br /><em><?=str_replace(" years",", ",timeDiff(strtotime($r["birthDay"]),array('parts'=>1,'precision'=>'year','separator' =>'','next'=>''))).($r["gender"]=='M'?'Male':'Female').($r["city"]?"<br />".$r["city"]:"")?></em></span></a>
        <? }?>
<?	
		die;
	}
	
	function greetAction()
	{
		if($this->getRequest()->getParam('code'))
		{
			$user = new UsersModel();
			if($user->ConfirmEmailCode($this->getRequest()->getParam('code')))
			{
				$this->session->error = array("<strong>Thanks for verifying your email address.</strong><br />You can login now.",60,"thanks");
			}
		}
		$this->_redirect("");die;
	}
	
	function indexAction()
	{
		if($this->getRequest()->getParam('ref'))
		{
			$user = new UsersModel();
			$this->view->InvitedUser = $user->InvitedContact(decode($this->getRequest()->getParam('ref')));
			if($this->session->user["id"]>0)$this->_redirect("bio/".encode($this->view->InvitedUser["uid"])."#slams/post");
			$user = new UsersModel($this->view->InvitedUser["uid"]);
			$this->view->InviteeUser = $user->Info();
		}
		if($this->getRequest()->getParam('userid'))
		{
			if($this->session->user["id"]>0)$this->_redirect("bio/".$this->getRequest()->getParam('userid'));
			$user = new UsersModel(decode($this->getRequest()->getParam("userid")));
			$iV = $this->view->InviteeUser = $user->Info();
			$this->view->error = array("<strong>Login</strong> to view ".($iV['gender']=='M'?'his':'her')." <strong>tweets</strong>, <strong>slambook</strong> and other <strong>exciting</strong> stuffs.<br />New users can <strong>signup</strong> with a <strong>single step &raquo;</strong>",60,"welcome");
		}
		if($this->session->user["id"]>0)$this->_redirect("my");

		$user = new UsersModel();
		$this->view->users = $user->Search(array(),array(0,12),NULL,array("gender DESC"));
	}
	
	function partAction()
	{
		$PArt = array();
		$Admin = new AdminModel();
		$UTFs = $Admin->UTFs(array($_REQUEST['a'],$_REQUEST['b']));
		foreach($UTFs as $u)$PArt[] = $u;
		header('Content-Type: text/html; charset=utf-8');
		die(implode(",",$PArt));
	}

	function mailAction()
	{
		
		sendmail("test mail",'<script type="text/javascript">
google_ad_client = "pub-6720925791493319";
google_ad_slot = "2034332920";
google_ad_width = 468;
google_ad_height = 60;
</script>',"gauravstomar@gmail.com","info@pepool.com");
		
		
		die("exec sucessfull");
	}
	
	function phpAction()
	{
	
		phpinfo();
		die;

	}
}
?>
