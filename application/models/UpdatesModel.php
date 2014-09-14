<?php

class UpdatesModel
{
	function UpdatesModel($uid = 0,$for = 0)
	{
		$this->id = is_array($uid)?implode(",",$uid):$uid;
		$this->uid = $for;
		$this->db = Zend_Registry::get('db');
	}
	
	function NewVideo()
	{
		$query = "SELECT u.id,u.fname,u.lname,v.timestamps,v.url,v.title FROM user_video v,user u WHERE v.uid IN (".$this->id.")  AND u.id = v.uid ORDER BY v.timestamps DESC";
		$userVideos = $this->db->query($query);
		$userVideos = $userVideos->fetchAll();

		$Vdos = $Videos = array();
		foreach($userVideos as $V)
		{
			$block = date('Ymd',strtotime($V['timestamps']));
			$Vdos[$block][$V['id']]["User"] = "<a class='x' href='".WWW_ROOT.'bio/'.encode($V['id'])."'>".$V['fname'].' '.$V['lname']."</a>";
			$Vdos[$block][$V['id']]["Vido"][] = "<a class='x ytPs' rel='".$V['url']."' href='javascript:;'><img src='".IMAGES."ytThumb.png' style='background:#000  url(http://i3.ytimg.com/vi/".$V['url']."/default.jpg) no-repeat center center;'></a>";
			$Vdos[$block][$V['id']]['timestamps'] = $V['timestamps'];
		}

		foreach($Vdos as $id=>$Vdo)
		{
			foreach($Vdo as $id=>$V)
			{
				$Videos[] = array("data"=>"<div>".$V["User"]." added ".count($V["Vido"])." new video".(count($V["Vido"])>1?"s":"")."</div><div style='width:650px;overflow:auto;'>".implode(" ",$V["Vido"])."</div>","time"=>strtotime($V['timestamps']));
			}
		}
		return $Videos;

	}
	
	function NewPics()
	{
		$query = "SELECT u.id,u.fname,u.lname,v.image,v.id picid,v.height,v.width,v.timestamps FROM user_pics v,user u WHERE v.uid IN (".$this->id.")  AND u.id = v.uid ORDER BY v.timestamps DESC";

		$userVideos = $this->db->query($query);
		$userVideos = $userVideos->fetchAll();

		$Vdos = $Videos = array();
		foreach($userVideos as $V)
		{	
			$block = date('Ymd',strtotime($V['timestamps']));
			$Vdos[$block][$V['id']]["User"] = "<a class='x' href='".WWW_ROOT.'bio/'.encode($V['id'])."'>".$V['fname'].' '.$V['lname']."</a>";
			$Vdos[$block][$V['id']]["Vido"][] = "<a class='x imgUpd' href='".WWW_ROOT.'bio/'.encode($V['id'])."#photos/".encode($V['picid'])."'><img src='".IMAGES."nothing.png' style='background:#E7F7FE url(".IMAGES."album/100/".$V["image"].") no-repeat center center;'></a>";
			$Vdos[$block][$V['id']]['timestamps'] = $V['timestamps'];
		}
		
		foreach($Vdos as $id=>$Vdo)
		{
			foreach($Vdo as $id=>$V)
			{
				$Videos[] = array("data"=>"<div>".$V["User"]." added ".count($V["Vido"])." new pic".(count($V["Vido"])>1?"s":"")."</div><div style='width:650px;overflow:auto;'>".implode(" ",$V["Vido"])."</div>","time"=>strtotime($V['timestamps']));
			}
		}
		
		return $Videos;

	}
	
	
	function NewFriends()
	{
		$query = "select cca.timestamps,cca.uidto,cca.uidfrom,concat(mi.fname,' ',mi.lname) unamea,mi.id,(select concat(fname,' ',lname) uname from user where (id != mi.id) AND (id = cca.uidto OR id = cca.uidfrom)) unameb 
from user mi inner join user_friends cca on (mi.id = cca.uidto or  mi.id = cca.uidfrom) 
where mi.id NOT IN (".$this->id.",".$this->uid.") and (uidto IN (".$this->id.") or uidfrom IN (".$this->id.")) and cca.status = 'Y' 
order by cca.timestamps DESC LIMIT 0,10";
		$userFriends = $this->db->query($query);
		$userFriends = $userFriends->fetchAll();
/*
		$query = "select cca.timestamps,cca.uidto,cca.uidfrom,concat(mi.fname,' ',mi.lname) username 
from user mi inner join user_friends cca on (mi.id = cca.uidto or  mi.id = cca.uidfrom) 
where  IN (".$this->id.") and (uidto IN (".$this->id.") or uidfrom IN (".$this->id.")) and cca.status = 'Y' 
order by cca.timestamps DESC LIMIT 0,10";
		$userMutualFriends = $this->db->query($query);
		$userMutualFriends = $userMutualFriends->fetchAll();
		print"<pre> FRIENDS";print_r($userFriends);die;
		print"<br> MUTUAL FRIENDS <br>";print_r($userMutualFriends);
		die;		
*/
		$Friends = array();
		foreach($userFriends as $F)
		{
			$NameA = "<a class='x' href='".WWW_ROOT.'bio/'.encode($F['id'])."'>".$F['unamea']."</a>";
			$NameB = "<a class='x' href='".WWW_ROOT.'bio/'.encode($F['id']==$F['uidto']?$F['uidfrom']:$F['uidto'])."'>".$F['unameb']."</a>";
			$A = (in_array($F['id'],explode(",",$this->id)))?$NameA:$NameB;
			$B = ($A==$NameB)?$NameA:$NameB;
			$Friends[] = array("data"=>"Your friend $A is now friends with $B ","time"=>strtotime($F['timestamps']));
		}
		return $Friends;
	}
	
	function Tweets()
	{
		$select =  $this->db->query('SELECT u.id,u.fname,u.lname,t.tweet,t.timestamps 
									 FROM user_tweet t LEFT JOIN user u ON u.id = t.uid 
									 WHERE t.uid IN ('.$this->id.')
									 ORDER BY t.timestamps DESC LIMIT 0,10');
		$userTweetsRaw = $select->fetchAll();
		$Tweets = array();
		foreach($userTweetsRaw as $k=>$t)
		{
			$Tweets[] = array("data"=>"<a class='x' href='".WWW_ROOT.'bio/'.encode($t['id']).'#tweets'."'>".$t['fname'].' '.$t['lname']."</a> tweets: ".stripslashes($t['tweet']),
							  "time"=>strtotime($t['timestamps']));
		}
		return $Tweets;
	}
	
	function Get($Limit = array(0,20))
	{
		if($this->id==0)return array();

		$CubeUpdates = array_merge_recursive($this->NewVideo(),$this->NewPics());
		
		$Updates = array_merge_recursive($this->Tweets(),$this->NewFriends(),$CubeUpdates);
		
		usort($Updates,"SortUpdates");
		
		$Updates = array_reverse($Updates);
		
		$Updates = array_slice($Updates,$Limit[0],$Limit[1]);

		return $Updates;
	}
	
}
function SortUpdates($a,$b)
{
    return strcmp($a["time"], $b["time"]);
}