<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class GchartController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->view->user = $this->session->user;
		$this->gchart = new GchartModel($this->session->user["id"]);
		if($this->session->error)$this->view->error = $this->session->error;$this->session->error = NULL;
	}
	
	function indexAction()
	{
		if(POST)
		{
			$users = $this->gchart->Users();
			
			print_r($users);die;
			
			$nemo = array();
			foreach($users as $id=>$row)
			{
				$nemo[] = array(array("v"=>encode($id),"f"=>$row['username']),$id==$this->session->user["id"]?"":encode($row['rid']),"");
			}
			jencode($nemo);
		}
		
		
	}

}
?>