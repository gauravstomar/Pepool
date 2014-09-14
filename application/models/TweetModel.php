<?php
class TweetModel
{
	private $db;
	public $uid;
	private $table;

	function TweetModel($uid = 0)
	{	
		$this->uid = $uid;
		$this->table = array("user_tweet");
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

	function Add($data)
	{	
		$this->db->insert($this->table[0],array("uid"=>$this->uid,"tweet"=>$data));
		return $this->db->lastInsertId();
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