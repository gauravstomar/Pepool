<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class SettingsController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->db = Zend_Registry::get('db');
		$this->user = new UsersModel($this->session->user["id"]);
		$this->admin = new AdminModel();
		$this->view->user = $this->session->user;
		if($this->session->error!="") $this->view->error = $this->session->error;
		$this->session->error = NULL;
	}

	function pictureAction()
	{
		
	}
	
	function personalAction()
	{
		if(POST)
		{
			$this->user->PersonalUpdate($_POST);
			$this->view->user = $this->session->user = $this->user->Info();
			die('gst.message("Your personal information updated.",12,"success")');
		}
		$this->view->visible = $this->admin->Visible();
		$this->view->country = $this->admin->Country();
		$this->view->language = $this->admin->Language();
		$this->view->interested = $this->admin->Interested();
		$this->view->relationshipStatus = $this->admin->RelationshipStatus();
	}
	
	function privacyAction()
	{
	
	}
	
	function socialAction()
	{
		if(POST)
		{
			$this->user->SocialUpdate($_POST);
			$this->view->user = $this->session->user = $this->user->Info();
			die('gst.message("Your social information updated.",12,"yeppe")');
		}
		$this->view->socials = $this->admin->Socials();
	}

	function professionalAction()
	{
	
	}
	
	function notificationAction()
	{
	
	}
}
?>