<?php
class SlamModel
{
	private $db;
	public $uid;
	private $table;

	function SlamModel($uid = 0)
	{	
		$this->uid = $uid;
		$this->table = array("slam","slam_que","slam_ans","slam_ans_prop","slam_invite","slam_order");
		$this->db = Zend_Registry::get('db');
	}
	
	function Rearrange($data)
	{
		$this->db->delete($this->table[5],"uid = '".$this->uid."'");
		$this->db->insert($this->table[5],array("uid"=>$this->uid,"setup"=>json_encode($data)));
	}
	
	function AddRequest($fromUid,$toUid)
	{
		$q = $this->db->query("SELECT r.id FROM ".$this->table[4]." r WHERE r.toUid = '$toUid' AND r.fromUid = '$fromUid' LIMIT 0,1");
		$q = $q->fetchAll(); if($q[0]["id"]>0)return false;
		$this->db->insert($this->table[4],array("fromUid"=>$fromUid,"toUid"=>$toUid));
		return $this->db->lastInsertId();
	}
	
	function Delete()
	{

	}
	
	function GetRequests()
	{
		$q = $this->db->query("SELECT u.fname,u.gender,u.lname,u.id 
								FROM ".$this->table[4]." r,user u 
								WHERE r.toUid = '".$this->uid."' AND u.id = r.fromUid");
		$MeSlammedTo = $this->MeSlammedTo();
		$users = $q->fetchAll();
		$return = array();
		foreach($users as $user)
		{
			if(!in_array($user["id"],$MeSlammedTo))
			{
				$return[$user["id"]] = $user;
				unset($return[$user["id"]]["id"]);
			}
		}
		return $return;
	}
	
	function MeSlammedTo()
	{
		$sent = $this->Sent();
		$userIds = array();
		foreach($sent as $user)$userIds[] = $user["id"];
		return $userIds;
	}
	
	function MySlammers()
	{
		$select = $this->db->select()->from($this->table[3],array('uidFrom'))->where('uidTo = ?',$this->uid)->group('uidFrom');
		$select = $this->db->fetchAll($select);
		$users = array();
		foreach($select as $user)
		{
			$users[] = $user['uidFrom'];
		}
		return $users;
	}
	
	function Count()
	{	
		$slammers = $this->Received();
		return count($slammers);
	}
	
	function Grab($uidFrom,$uidTo,$Limit = NULL)
	{
		$select = $this->db->select()->from($this->table[1],array('que','id','(select prop from '.$this->table[3].' where qid = '.$this->table[1].'.id and uidFrom = '.$uidFrom.' and uidTo = '.$uidTo.') P'))->where('status = ?',"Y")->order('priority');
		if($Limit)$select->limit($Limit[1],$Limit[0]);
		$data = $this->db->fetchAll($select);
		$dat = array();
		foreach($data as $d)if($d['P']!='A')
		{
			$ans = $this->db->select()->from($this->table[2],array('ans',''))
							->where('qid = ?',$d["id"])
							->where('uidFrom = ?',$uidFrom)
							->where('uidTo = ?',$uidTo)
							->limit(0,1)->order('timestamps DESC');
			$ans = $this->db->fetchRow($ans);
			$d["ans"] = stripslashes($ans["ans"]);
			$dat[$d["id"]] = $d;
			unset($dat[$d["id"]]["id"]);
		}
		return $dat;
	}
	
	function Questions($Limit = NULL,$uidFrom,$uidTo = NULL)
	{

		$prop = array('(select prop from '.$this->table[3].' where qid = '.$this->table[1].'.id and uidFrom = '.$uidFrom.' and uidTo = '.$uidTo.') P');
		$select = array('que','id');
		
		$orderByRaw = $this->db->select()->from($this->table[5],'setup')->where('uid = ?',$uidTo?$uidTo:$this->uid)->order('timestamps DESC')->limit('0,1');
		$orderByRaw = $this->db->fetchRow($orderByRaw); $orderByRaw = jdecode($orderByRaw['setup']); $orderBy = array();
		if(count($orderByRaw)>0)foreach($orderByRaw as $k=>$order)$orderBy[$k] = decode($order);

		$select = $this->db->select()->from($this->table[1],$uidTo?array_merge($prop,$select):$select)->where('status = ?',"Y")->order('priority DESC');
		if($Limit)$select->limit($Limit[1],$Limit[0]);

		$data = $this->db->fetchAll($select);
		$dat = array();

		foreach($data as $d)
		{
			if($uidTo)
			{
				$ans = $this->db->select()->from($this->table[2],array('ans'))
							->where('qid = ?',$d["id"])
							->where('uidFrom = ?',$uidFrom)
							->where('uidTo = ?',$uidTo)
							->limit(0,1)->order('timestamps DESC');
				$ans = $this->db->fetchRow($ans);
				$d["ans"] = $ans["ans"];
			}
			$dat[$d["id"]] = $d;
			unset($dat[$d["id"]]["id"]);
		}
		$return = array();
		if(count($orderBy)>0)foreach($orderBy as $k)if($dat[$k]["que"]!="") $return[$k] = $dat[$k];
		return count($return)>0?array_reverse($return):$dat;
	}
	
	function AnswerProperty($qid,$prop,$uid)
	{
		$select = $this->db->select()
							->from($this->table[3],array('id'))
							->where('qid = ?',$qid)
							->where('uidFrom = ?',$uid)
							->where('uidTo = ?',$this->uid);
		$id = $this->db->fetchRow($select);
		if($id["id"]>0)$this->db->update($this->table[3],array("prop"=>$prop),"qid = '$qid' AND uidFrom = '$uid' AND uidTo = '".$this->uid."'");
		else{$this->db->insert($this->table[3],array("qid"=>$qid,"uidFrom"=>$uid,"uidTo"=>$this->uid,"prop"=>$prop));$id["id"] = $this->db->lastInsertId();}
		return $id["id"];
	}
	
	function AddAnswer($qid,$ans,$uid)
	{
		$select = $this->db->select()->from($this->table[2],array('id'))->where('qid = ?',$qid)->where('uidFrom = ?',$uid)->where('uidTo = ?',$this->uid)->where('ans = ?',$ans);
		$id = $this->db->fetchRow($select); if($id["id"]>0)return 2;
		$this->db->insert($this->table[2],array("qid"=>$qid,"uidFrom"=>$uid,"uidTo"=>$this->uid,"ans"=>$ans));
		$return = $this->db->lastInsertId();
		if($return>0) return 1;else return 0;
	}
	
	function GetAnswer($qid,$uid)
	{
		$q = $this->db->query("SELECT * FROM ".$this->table[2]." A
							LEFT JOIN ".$this->table[3]." P ON P.qid = A.qid AND P.uidFrom = A.uidFrom AND P.uidTo = A.uidTo 
							WHERE A.qid = '$qid' AND A.uidFrom = '$uid' AND A.uidTo = '".$this->uid."'
							ORDER BY A.timestamps DESC LIMIT 0,1");
		print_r($this->db->fetchRow($q));
	}
	
	function Sent()
	{
		$q = $this->db->query("SELECT u.fname,u.id,u.lname,u.image,u.image,s.timestamps 
								FROM ".$this->table[2]." s,user u 
								WHERE s.uidFrom = '".$this->uid."' AND u.id=s.uidTo 
								GROUP BY s.uidTo
								ORDER BY s.timestamps DESC");
		$q = $q->fetchAll();
		return $q;
	}
	
	function Received()
	{
		$q = $this->db->query("SELECT u.fname,u.id,u.lname,u.image,u.image,s.timestamps 
								FROM ".$this->table[2]." s,user u 
								WHERE s.uidTo = '".$this->uid."' AND u.id=s.uidFrom 
								GROUP BY s.uidFrom
								ORDER BY s.timestamps DESC");
		$q = $q->fetchAll();
		return $q;
	}
	
	function Requested()
	{
		$q = $this->db->query("SELECT u.fname,u.id,u.lname,u.image,u.image,s.timestamps 
								FROM ".$this->table[4]." s,user u 
								WHERE s.fromUid = '".$this->uid."' AND u.id=s.toUid 
								ORDER BY s.timestamps DESC");
		$q = $q->fetchAll();
		return $q;
	}
}