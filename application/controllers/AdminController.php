<?php

require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';

class AdminController extends Zend_Controller_Action
{
    function init()
    {
		$this->session = Zend_Registry::get('session');
		$this->db = Zend_Registry::get('db');
		if($this->session->admin == "")
		{
			$this->_redirect("login/admin/");
		}
	}
	
	function indexAction()
	{
	 	$admin_log = $this->db->query("SELECT * FROM admin_log  WHERE valid= 'Y' order by timestamps desc limit 1,2");
		$admin_log = $admin_log->fetchAll();
		$this->view->admin_log = $admin_log[0];

	 	$admin_log_invalid = $this->db->query("SELECT count(valid)
												FROM admin_log 
												WHERE valid= 'N' 
												AND timestamps > DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 7 DAY)");
		$admin_log_invalid = $admin_log_invalid->fetchAll();
		$this->view->admin_log_invalid = $admin_log_invalid[0];
	}
	
	function logoutAction()
	{
		$this->session->admin = "";
		$this->_redirect("login/admin/");
	}

}
?>
