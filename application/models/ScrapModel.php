<?php
class ScrapModel
{
	private $db;
	public $uid;
	private $table;

	function ScrapModel($uid = 0)
	{	
		$this->uid = $uid;
		$this->table = array("user_scraps","user");
		$this->db = Zend_Registry::get('db');
	}

	function Count($guestUid)
	{	
		$select = $this->db->select()->from($this->table[0],array('COUNT(*) count'))->where('toUid = ?',$this->uid);
		if($guestUid!=$this->uid)$select->where("(privacy = 'N' OR fromUid = '$guestUid')");
		$count = $this->db->fetchRow($select);
		return $count["count"]>0?$count["count"]:0;
	}

	function Add($data = array())
	{	
		$this->db->insert("user_scraps",array("fromUid"=>$this->uid,"toUid"=>$data["uid"],"privacy"=>$data["privacy"],"scrap"=>$data["scrap"]));
		return $this->db->lastInsertId();
	}

	function Delete($data)
	{	
		$this->db->delete("user_scraps"," id = '$data' AND (fromUid = '".$this->uid."' OR	toUid = '".$this->uid."')");
	}

	function Scrapers()
	{	
		$q = "SELECT u.id,u.fname,u.lname,count(s.toUid) tot 
				FROM ".$this->table[0]." s LEFT JOIN ".$this->table[1]." u ON u.id=s.fromUid 
				WHERE toUid = '".$this->uid."'
				GROUP BY u.id
				ORDER BY s.timestamps DESC ";
		$select =  $this->db->query($q);
		$userScrap = $select->fetchAll();
		return is_array($userScrap)?$userScrap:array();
	}
	
	function Get($From = NULL,$Limit = NULL,$uid = NULL)
	{	
	
		$q = "SELECT s.id,u.id uid,u.fname,u.lname,u.image,s.scrap,s.privacy,s.timestamps 
				FROM ".$this->table[0]." s LEFT JOIN ".$this->table[1]." u ON u.id=s.fromUid 
				WHERE toUid = '".($uid?$uid:$this->uid)."'
				ORDER BY s.timestamps DESC ";
		if($From && $Limit)$q.= "LIMIT $From,$Limit";
		$select =  $this->db->query($q);
		$userScrap = $select->fetchAll();
		foreach($userScrap as $uS)
		{
			$uS["scrap"] = stripslashes($uS["scrap"]);
			$userScraps[] = $uS;
		}
		return is_array($userScraps)?$userScraps:false;
	}
	


}