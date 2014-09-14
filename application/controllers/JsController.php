<?php
class JsController extends Zend_Controller_Action
{
	function init()
	{
		$this->session = Zend_Registry::get('session');
		$this->db = Zend_Registry::get('db');
		$this->view->user = $this->session->user;
		$this->view->userExt = array("id"=>decode($this->getRequest()->getParam('of')));
		$this->view->js = $this->getRequest()->getParam('for');
	}
	function indexAction()
	{
	
	}
	function friendAction()
	{
		HackCheck();
	}
	function updatesAction()
	{
		HackCheck();
	}
	function settingsAction()
	{
		HackCheck();
	}
	function slamAction()
	{
		HackCheck();
	}
	function scrapsAction()
	{
		HackCheck();
	}
	function jqueryAction()
	{
		HackCheck();
	}
	function inviteAction()
	{
		HackCheck();
	}
	function gchartAction()
	{
		HackCheck();
	}
	function videosAction()
	{
		HackCheck();
	}
	function customAction()
	{
		HackCheck();
	}
	function picsAction()
	{
		HackCheck();
	}
}
?>
