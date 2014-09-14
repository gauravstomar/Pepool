<?php
class VideoModel
{
	private $db;
	public $uid;
	private $table;

	function VideoModel($uid = 0)
	{	
		$this->uid = $uid;
		$this->table = array("user_video");
		$this->db = Zend_Registry::get('db');
	}

	function Count()
	{	
		$select = $this->db->select()
							->from($this->table[0],array('COUNT(*) count'))
							->where('uid = ?',$this->uid);
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
		$this->db->delete($this->table[0],"id = '$data'");
	}

	function Get($Limit,$uid = NULL,$ob = 'ASC')
	{	
		$select =  $this->db->select()
							->from($this->table[0])
							->where("uid = ?",$uid?$uid:$this->uid)
							->order("timestamps $ob");
		if($Limit>0)$select->limitPage(0,$Limit);
		$userTweetsRaw = $this->db->fetchAll($select);
		foreach($userTweetsRaw as $Tweet)
		{
			$Tweet["tweet"] = stripslashes($Tweet["tweet"]);
			$userTweets[] = $Tweet;
		}
		return is_array($userTweets)?$userTweets:false;
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