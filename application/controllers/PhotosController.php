<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class PhotosController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->db = Zend_Registry::get('db');
		$this->pics = new PicsModel($this->session->user["id"]);
		$this->user = new UsersModel($this->session->user["id"]);
		$this->admin = new AdminModel();
		$this->view->user = $this->session->user;
		if($this->session->error!="") $this->view->error = $this->session->error;
		$this->session->error = NULL;
	}
	
	function headerAction()
	{
	
	}
	
	function addAction()
	{
	
	}
	
	function deleteAction()
	{
		if(POST)
		{	$base = "public/images/album/";
			$imag = $this->pics->Delete(decode($_REQUEST['id']));
			if(is_file($base."original/".$imag))unlink($base."original/".$imag);
			if(is_file($base."670/".$imag))unlink($base."670/".$imag);
			if(is_file($base."100/".$imag))unlink($base."100/".$imag);
		}
		die;
	}

	function getAction()
	{	
		if(!$this->getRequest()->getParam('html'))
		{	$uTw = array();
			$pics = $this->pics->Get($_REQUEST['limit'],$this->getRequest()->getParam('of')?decode($this->getRequest()->getParam('of')):NULL,($_REQUEST['limit']==1?'DESC':'ASC'));
			if($pics)
			{
				foreach($pics as $uT)
				{	$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
					$uT["W"] = $uT["width"]; unset($uT["width"]);
					$uT["H"] = $uT["height"]; unset($uT["height"]);
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