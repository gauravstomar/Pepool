<?php

require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';

class ControlsController extends Zend_Controller_Action
{
    function init()
    {
		$this->session = Zend_Registry::get('session');
		$this->db = Zend_Registry::get('db');
		if($this->session->error)$this->view->error = $this->session->error;$this->session->error = NULL;
		if($this->session->admin == "")$this->_redirect("login/admin/");
	}

	function changepassAction()
	{
		if($_POST['pass']!='') $this->db->update("admin",array("pass"=>$_POST["pass"]));
	}

	function clearcacheAction()
	{
		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_ALL);
		die('<h2>CACHE CLEANING_MODE_ALL RETURN :: SUCCESSFUL</h2>');
	}
	function listsAction()
	{
		if($_GET["id"]!='')$this->db->update("lists",array("index_status"=>$_GET["s"]),"id = '".$_GET["id"]."'");
		if($_GET["delete"]!='')$this->db->delete("lists","id = '".$_GET["delete"]."'");
		$votes = $this->db->query("SELECT l.name,l.id,l.index_status,l.timestamps,u.username FROM lists l LEFT JOIN users u ON u.id=l.uid");
		$this->view->votes = $votes->fetchAll();
	}
	function create_backup_sql($file) 
	{
		$line_count = 0;
		$db_connection = $this->db_connect();
		mysql_select_db ($this->db_name(),$db_connection) or die("ERROR: Unable to connect database (code:m_s_db)");
		$tables = mysql_list_tables($this->db_name());
		$sql_string = NULL;
		while ($table = mysql_fetch_array($tables)) 
		{   
			$table_name = $table[0];
			$sql_string = "DELETE FROM $table_name";
			$table_query = mysql_query("SELECT * FROM `$table_name`");
			$num_fields = mysql_num_fields($table_query);
			while ($fetch_row = mysql_fetch_array($table_query))
			{
				$sql_string .= "INSERT INTO $table_name VALUES(";
				$first = TRUE;
				for ($field_count=1;$field_count<=$num_fields;$field_count++)
				{
					if(TRUE == $first)
					{
						$sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
						$first = FALSE;            
					}
					else
					{
						$sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
					}
				}
				$sql_string .= ");";
				if ($sql_string != "")
				{
					$line_count = $this->write_backup_sql($file,$sql_string,$line_count);        
				}
				$sql_string = NULL;
			}    
		}
		return $line_count;
	}

	function write_backup_sql($file, $string_in, $line_count) 
	{ 
		fwrite($file, $string_in);
		return ++$line_count;
	}
  
	function db_name()
	{
		return("xevoke_ivotings");
	}
  
	function db_connect()
	{
		$config = new Zend_Config_Ini(PATH_ROOT . '/config/config.ini', 'general');
		$db_connection = mysql_connect($config->db->config->hostname, $config->db->config->username, $config->db->config->password)
		or die("ERROR: Unable to connect database (code:m_c)<br />".mysql_error());
		return $db_connection;
	}  


	function indexAction()
	{
	}
	
	function downloadAction()
	{

		$filename = WWW_ROOT."public/backup/".$this->getRequest()->getParam('path');

		header("Pragma: public");
		header("Expires: 0"); // set expiration time
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");

		header("Content-Disposition: attachment; filename=".basename($filename).";");

		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".filesize($filename));
		
		@readfile($filename);
		exit(0);
	}
	
	function dbbackupAction()
	{
		
		$ccyymmdd = strtolower(encode(rand(0,time())));
		$file = fopen("public/backup/".$ccyymmdd.".sql","w");
		$line_count = $this->create_backup_sql($file);
		fclose($file);
		$this->db->insert("backup",array("name"=>$ccyymmdd.".sql"));
		$backup = $this->db->query("SELECT * FROM backup ORDER BY timestamps desc LIMIT 0,10");
		$this->view->backup = $backup->fetchAll();
	}
	
	function edit404Action()
	{
		if($_POST["content"]!="")
		{
			$this->db->update("errors",array("content"=>$_POST["content"]),"page = 404");
		}
	
		$seo = $this->db->query("SELECT * FROM errors WHERE page = 404");
		$seo = $seo->fetchAll();
		$this->view->contents = $seo[0]["content"];
	}
	
	function edit500Action()
	{
		if($_POST["content"]!="")
		{
			$this->db->update("errors",array("content"=>$_POST["content"]),"page = 500");
		}
	
		$seo = $this->db->query("SELECT * FROM errors WHERE page = 500");
		$seo = $seo->fetchAll();
		$this->view->contents = $seo[0]["content"];
	}
	
	function deletecmspageAction()
	{
		$this->db->delete('cms', "id = '".($this->getRequest()->getParam('for'))."'");
		$this->_redirect("controls/cms/");
	}
	
	function deleteseopageAction()
	{
		$this->db->delete('seo', "id = '".($this->getRequest()->getParam('for'))."'");
		$this->_redirect("controls/seo/");
	}
	
	function deletevoteAction()
	{
		$this->db->delete('votes', "id = '".($this->getRequest()->getParam('for'))."'");
		$this->_redirect("controls/votes/of/".$this->getRequest()->getParam('back'));
	}

	function deleteuserpageAction()
	{
		$this->db->delete('users', "id = '".($this->getRequest()->getParam('for'))."'");
		$this->_redirect("controls/user/");
	}

	function deletecontestpageAction()
	{
		$this->db->delete('contests', "id = '".($this->getRequest()->getParam('for'))."'");
		$this->_redirect("controls/contests/");
	}
	
	function seoAction()
	{
	 	$seo = $this->db->query("SELECT * FROM seo order by id desc");
		$this->view->seo = $seo->fetchAll();
	}
	
	function blockseoAction()
	{
		$for = $this->getRequest()->getParam('id');
		$to = $this->getRequest()->getParam('set');
		if($for!="" && $to!="")
		{
			$this->db->update("seo",array("status"=>$to),"id = ".$for);
		}
		$this->_redirect("controls/seo/");
	}
	
	function addeditseoAction()
	{
		if($this->getRequest()->getParam('for')!="")
		{
			$seo = $this->db->query("SELECT * FROM seo WHERE id = '".$this->getRequest()->getParam('for')."'");
			$seo = $seo->fetchAll();
			$this->view->seo = $seo[0];
		}
		if(POST)
		{
			$data = array("URI"=>$_POST["URI"],
							"title"=>$_POST["title"],
							"metaDescri"=>$_POST["metaDescri"],
							"revisitAfter"=>$_POST["revisitAfter"],
							"author"=>$_POST["author"],
							"metaKeyword"=>$_POST["metaKeyword"]);
			if($_POST["id"]=="")
			{
				$this->db->insert("seo",$data);
			}
			else
			{
				$this->db->update("seo",$data,"id=".$_POST["id"]);
			}
			$this->_redirect("controls/seo/");
		}
	}
	
	function addcmspageAction()
	{
		if($this->getRequest()->getParam('for')!="")
		{
			$cms = $this->db->query("SELECT * FROM cms WHERE id = '".$this->getRequest()->getParam('for')."'");
			$cms = $cms->fetchAll();
			$this->view->cms = $cms[0];
		}
		if(POST)
		{
			$data = array("title"=>$_POST["title"],"content"=>$_POST["content"],"status"=>$_POST["status"]);
			if($_POST["id"]=="")
			{
				$this->db->insert("cms",$data);
			}
			else
			{
				$this->db->update("cms",$data,"id=".$_POST["id"]);
			}
			$this->_redirect("controls/cms/");
		}
	}
	
	function updatestatusAction()
	{
		$for = $this->getRequest()->getParam('for');
		$to = $this->getRequest()->getParam('to');
		if($for!="" && $to!="")
		{
			$this->db->update("cms",array("status"=>$to),"id = ".$for);
		}
		$this->_redirect("controls/cms/");
	}
	
	function cmsAction()
	{
	 	$cms = $this->db->query("SELECT * FROM cms order by id desc");
		$this->view->cms = $cms->fetchAll();
	}
	
	function userAction()
	{
		if($this->getRequest()->getParam('orderby')=="")
		{
			$orderby = "username";
		}
		else
		{
			$orderby = $this->getRequest()->getParam('orderby');
		}
	 	$users = $this->db->query("SELECT u.*,country.country_name FROM users u LEFT JOIN country ON country.id = u.country order by $orderby ");
		$this->view->users = $users->fetchAll();
	}
	
	function blockuserAction()
	{
		$for = $this->getRequest()->getParam('set');
		$to = $this->getRequest()->getParam('id');
		if($for!="" && $to!="")
		{
			$this->db->update("users",array("status"=>$for),"id = ".$to);
		}
		$this->_redirect("controls/user/");
	}
	
	function addedituserAction()
	{	$country = $this->db->query("SELECT * FROM country ORDER BY country_name"); $this->view->country = $country->fetchAll();		
		if($this->getRequest()->getParam('for')!="")
		{
			$users = $this->db->query("SELECT * FROM users WHERE id = '".$this->getRequest()->getParam('for')."'");
			$users = $users->fetchAll();
			$this->view->user = $users[0];
		}
		if(POST)
		{
			if($_POST["id"]=="")
			{
				$this->db->insert("users",$_POST);
			}
			else
			{
				$this->db->update("users",$_POST,"id=".$_POST["id"]);
			}
			$this->_redirect("controls/user/");
		}
	}
	
	function addeditvoteAction()
	{   
		$users = $this->db->query("SELECT username,id FROM users ORDER BY username");
		$this->view->users = $users->fetchAll();

		$contests = $this->db->query("SELECT name,id FROM contests ORDER BY name");
		$this->view->contests = $contests->fetchAll();

		if($this->getRequest()->getParam('for')!="")
		{
			$votes = $this->db->query("SELECT v.*,c.name FROM votes v LEFT JOIN contests c ON c.id = v.cid WHERE v.id = '".$this->getRequest()->getParam('for')."'");
			$votes = $votes->fetchAll();
			$this->view->vote = $votes[0];
		}
		
		if($this->getRequest()->getParam('of')!="")
		{
			$contest = $this->db->query("SELECT name,id cid FROM contests WHERE id = '".$this->getRequest()->getParam('of')."' ORDER BY name");
			$contest = $contest->fetchAll();
			$this->view->vote = $contest[0];
		}
		
		if(POST)
		{
			if($_POST["id"]=="")
			{
				$this->db->insert("votes",$_POST);
			}
			else
			{
				$this->db->update("votes",$_POST,"id=".$_POST["id"]);
			}
			$this->_redirect("controls/votes/of/".$_POST["cid"]);
		}
	}
	
	function contestsAction()
	{
		if($this->getRequest()->getParam('orderby')=="")
		{
			$orderby = "c.name";
		}
		else
		{
			$orderby = $this->getRequest()->getParam('orderby');
		}
	 	$contests = $this->db->query("SELECT u.username,c.*,count(v.cid) allvotes 
									FROM contests c 
									LEFT JOIN users u ON u.id = c.uid 
									LEFT JOIN votes v on v.cid = c.id 
									GROUP BY c.id 
									ORDER BY $orderby");
		$contests = $contests->fetchAll();
		foreach($contests as $contest)
		{
			$tags = $this->db->query("SELECT tag FROM tags WHERE cid = ".$contest["id"]);
			$contest["tags"] = $tags->fetchAll();
			$cont[] = $contest;
		}
		$this->view->contests = $cont;
	}
	
	function blockcontestAction()
	{
		$for = $this->getRequest()->getParam('id');
		$to = $this->getRequest()->getParam('set');
		if($for!="" && $to!="")
		{
			$this->db->update("contests",array("status"=>$to),"id = ".$for);
		}
		$this->_redirect("controls/contests/");
	}
	
	function votesAction()
	{
		$votes = $this->db->query("SELECT v.*,u.username FROM votes v LEFT JOIN users u ON u.id = v.uid WHERE cid = '".$this->getRequest()->getParam('of')."'");
		$this->view->votes = $votes->fetchAll();

		$contests = $this->db->query("SELECT name,id FROM contests WHERE id = '".$this->getRequest()->getParam('of')."'");
		$contests = $contests->fetchAll();
		$this->view->contest = $contests[0];

	}

	function addeditcontestcommentsAction()
	{
		$users = $this->db->query("SELECT username,id FROM users ORDER BY username");
		$this->view->users = $users->fetchAll();

		if($this->getRequest()->getParam('for')!="")
		{	$contests = $this->db->query("SELECT name FROM contests WHERE id = '".$this->getRequest()->getParam('for')."'");
			$contests = $contests->fetchAll(); $this->view->contests = $contests[0];

			if(POST)
			{	if(is_array($_POST['id']))foreach($_POST['id'] as $id)
				{	if($_POST['delete']=='delete')$this->db->delete('discussion'," id='$id' ");
					if($_POST['block']=='block')$this->db->update('discussion',array("status"=>"N")," id='$id' ");
					if($_POST['unblock']=='unblock')$this->db->update('discussion',array("status"=>"Y")," id='$id' ");
				}
			}

			$discussion = $this->db->query("SELECT discussion.*,users.username 
									FROM discussion 
									LEFT JOIN users ON users.id=discussion.uid 
									WHERE discussion.cid = ".$this->getRequest()->getParam('for'));
			$this->view->discussion = $discussion->fetchAll();
		}

	}
	
	function addeditcontestpicsAction()
	{
		$users = $this->db->query("SELECT username,id FROM users ORDER BY username");
		$this->view->users = $users->fetchAll();
		
		if(POST)
		{	if(is_array($_POST['id']))foreach($_POST['id'] as $id)
			{	if($_POST['delete']=='delete')$this->db->delete('contests_album',"id='$id'");
				if($_POST['block']=='block')$this->db->update('contests_album',array("status"=>"N"),"id='$id'");
				if($_POST['unblock']=='unblock')$this->db->update('contests_album',array("status"=>"Y"),"id='$id'");
			}
			if($_POST["updateMain"]=="update" && $_FILES['logoMain']['tmp_name']!="") 
			{	$logo = rand(0,time()).".jpg";
				resize($_FILES['logoMain']['tmp_name'],"public/images/contest/$logo",130,130);
				$this->db->update("contests",array("logo"=>$logo),"id = '".$this->getRequest()->getParam('for')."'");
			}
			
			if($_POST["deleteMain"]=="delete")$this->db->update("contests",array("logo"=>"no.jpg"),"id = '".$this->getRequest()->getParam('for')."'");
			
			if($_POST["add"]=="add" && $_POST["uid"]!="")
			{	$v = explode(".",$_FILES['logo']['name']); 
				$format = $v[count($v)-1];
				$logo = rand(0,time()).".".$format;
				$Xs = getimagesize($_FILES['logo']['tmp_name']);
				if($Xs[0]<525) move_uploaded_file($_FILES['logo']['tmp_name'],"public/images/contestAlbum/$logo");
				else resize($_FILES['logo']['tmp_name'],"public/images/contestAlbum/$logo",525,525);
				resize("public/images/contestAlbum/$logo","public/images/contestAlbum/thumb/$logo",78,78);
				$array = array("logo" => $logo,"status"=>"Y","uid"=>$_POST["uid"],"cid"=>$this->getRequest()->getParam('for'));
				$this->db->insert("contests_album",$array);
			}

		}
		if($this->getRequest()->getParam('for')!="")
		{	$contests = $this->db->query("SELECT name,id,uid,logo FROM contests WHERE id = '".$this->getRequest()->getParam('for')."'");
			$contests = $contests->fetchAll();$this->view->contests = $contests[0];
			$pic = $this->db->query("SELECT contests_album.logo,contests_album.status,contests_album.id,contests_album.timestamps,users.username 
									FROM contests_album 
									LEFT JOIN users ON users.id=contests_album.uid 
									WHERE contests_album.cid = ".$this->getRequest()->getParam('for'));
			$this->view->pics = $pic->fetchAll();
		}
	}
	function addeditcontestAction()
	{
	 	$users = $this->db->query("SELECT username,id FROM users ORDER BY username");
		$this->view->users = $users->fetchAll();

		if($this->getRequest()->getParam('for')!="")
		{
			$contests = $this->db->query("SELECT * FROM contests WHERE id = '".$this->getRequest()->getParam('for')."'");
			$contests = $contests->fetchAll();
			$this->view->contest = $contests[0];
			$tags = $this->db->query("SELECT tag FROM tags WHERE cid = ".$this->getRequest()->getParam('for'));
			$this->view->tags = $tags->fetchAll();
		}
		if(POST)
		{
			$tags = explode(",",$_POST["tags"]);
			unset($_POST["tags"]);
			if($_POST["id"]=="")
			{
				$this->db->delete("tags","cid='".$_POST["id"]."'");
				$this->db->insert("contests",$_POST);
				$this->cache->remove('TheSiteTags');
			}
			else
			{
				$this->db->update("contests",$_POST,"id=".$_POST["id"]);
			}
			if(count($tags)>0)
			{
				foreach($tags as $tag)
				{
					$this->db->insert("tags",array("tag"=>trim(strtolower($tag)),"cid"=>$_POST["id"]));
					$this->cache->remove('TheSiteTags');
				}
			}
			$this->_redirect("controls/contests/");
		}
	}
	
}
?>
