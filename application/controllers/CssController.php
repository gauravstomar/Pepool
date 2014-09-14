<?php
class CssController extends Zend_Controller_Action
{
	function init()
	{
		$this->session = Zend_Registry::get('session');
		$this->view->user = $this->session->user;
		$this->view->css = $this->getRequest()->getParam('of');
	}
	function indexAction(){}
	function homeAction(){}
	function picsAction(){}
	function extensionAction(){}
}
?>
