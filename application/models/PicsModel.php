<?php
class PicsModel
{
	private $db;
	public $uid;
	private $table;

	function PicsModel($uid = 0)
	{	
		$this->uid = $uid;
		$this->table = array("user_pics");
		$this->db = Zend_Registry::get('db');
	}

	function Count()
	{	
		$select = $this->db->select()->from($this->table[0],array('COUNT(*) count'))->where('uid = ?',$this->uid);
		$count = $this->db->fetchRow($select);
		return $count["count"]>0?$count["count"]:0;
	}

	function Add($YTid,$title,$details)
	{	
		$select = $this->db->select()->from($this->table[0],array('id'))->where('uid = ?',$this->uid)->where('url = ?',$YTid);
		$select = $this->db->fetchRow($select);	if($select['id']>0)return 2;
		$this->db->insert($this->table[0],array("uid"=>$this->uid,"url"=>$YTid,"title"=>$title,"details"=>$details));
		return $this->db->lastInsertId()>0?1:false;
	}

	function Delete($data)
	{	

		$select =  $this->db->select()->from($this->table[0])->where("id = '$data'");
		$userPicsRaw = $this->db->fetchRow($select);
		$this->db->delete($this->table[0],"id = '$data'");
		return $userPicsRaw["image"];
	}

	function Get($Limit,$uid = NULL,$ob = 'ASC')
	{	
		$select =  $this->db->select()->from($this->table[0])->where("uid = ?",$uid?$uid:$this->uid)->order("timestamps $ob");
		if($Limit>0)$select->limitPage(0,$Limit);
		$userPicsRaw = $this->db->fetchAll($select);
		foreach($userPicsRaw as $Pics)
		{
			$Pics["caption"] = stripslashes($Pics["caption"]);
			$userPics[] = $Pics;
		}
		return is_array($userPics)?$userPics:false;
	}

	function Current()
	{	
		$select =  $this->db->select()
							->from($this->table[0])
							->where("uid = ?",$this->uid)
							->order('timestamps DESC')
							->limit(0,1);
		$userTweets = $this->db->fetchRow($select);
		$userTweets["tweet"] = stripslashes($userTweets["tweet"]);
		return is_array($userTweets)?$userTweets:false;
	}


}