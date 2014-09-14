<?php
class PhotoModel
{
	private $db;
	public $uid;
	private $table;

	function PhotoModel($uid = 0)
	{	
		$this->uid = $uid;
		$this->table = array("user_pics");
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



}