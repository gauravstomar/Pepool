<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class ExpandController extends Zend_Controller_Action
{
    function init()
    {	
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->user = new UsersModel();
		$this->db = Zend_Registry::get('db');
	}

	function autoAction()
	{
		$q  = $this->db->query('select id from user where id >= (select uid from user_contacts where systemMails = 0 order by id limit 0,1) order by id limit 0,5');
		$q  = $q->fetchAll();
		
		print"<pre><h1>User ID uncer process</h1>";
		print_r($q);
		
		$data = array();
		foreach($q as $uid)
		{
			$r  = $this->db->query('select id from user_contacts where systemMails = 0 and uid = '.$uid['id'].' order by id');
			$r  = $r->fetchAll();
			foreach($r as $iid)$data[] = $iid['id'];
		}

		print"<hr /><h1>Email ID uncer process</h1>";
		print_r($data);

		$responce = $this->user->SendInviteAutomated($data); 
?>
	<script type="text/javascript">
	
		setTimeout(function(){window.location.reload();},55000);
        
    </script>
<?
		die();
	}

}
?>