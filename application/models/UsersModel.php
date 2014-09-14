<?php

class UsersModel
{
	function UsersModel($uid = 0)
	{	$this->id = $uid;
		$this->db = Zend_Registry::get('db');
	}
#Login	
	function Login($data = array())
	{	extract($data);
		$select =  $this->db->select()->from('user')->where("email = ?",$email)->where("password = ?",$pass?$pass:$password);
		$userDetails = $this->db->fetchRow($select);
		if(is_array($userDetails))
		{
			$this->id = $userDetails["id"];
			$userDetails["lastLog"] = $this->AddLog();
		}
		return is_array($userDetails)?$this->Info():false;
	}
	
	function AddVisitor($uid = NULL)
	{
		if($uid)$this->db->insert('user_visitors',array('guestUid'=>$uid,'hostUid'=>$this->id));
		return $this->db->lastInsertId();
	}
	
	function GetVisitors($Limit = NULL)
	{
		$Limit = $Limit?$Limit[0].",".$Limit[1]:"0,20";
		$visitors = $this->db->query("SELECT u.fname,u.lname,u.image,u.id,v.timestamps 
									  FROM user_visitors v 
									  LEFT JOIN user u on u.id = v.guestUid 
									  WHERE v.hostUid = '".$this->id."' 
									  GROUP BY v.guestUid 
									  ORDER BY v.timestamps DESC 
									  LIMIT $Limit");
		return $visitors->fetchAll();
	}
	
	function ConfirmEmailCode($refCode)
	{
		$select =  $this->db->select()->from('user')->where("regStatus = ?",$refCode);
		$userDetails = $this->db->fetchRow($select);
		if($userDetails['id']>0) $this->db->update("user",array("regStatus"=>"Y"),"id = '".$userDetails['id']."'");
		return $userDetails['id']>0;
	}
	
	function GetUserPasswordByEmail($email)
	{	
		$select =  $this->db->select()->from('user')->where("email = ?",$email);
		$userDetails = $this->db->fetchRow($select);
		return is_array($userDetails)?$userDetails:false;
	}
	
	function AddLog()
	{
		$this->db->insert("user_log",array("ipAdd"=>$_SERVER['REMOTE_ADDR'],"uid"=>$this->id));
		return $this->db->lastInsertId();
	}
	
	function Logout()
	{
		$this->db->update("user_log",array("outTime"=>date("Y-m-d H:i:s")),"");
	}
	
#User Info	
	function Info()
	{	
		$select =  $this->db->select()->from('user')->where("id = ?",$this->id);
		$userDetails = $this->db->fetchRow($select);
		
		$select =  $this->db->select()->from('user_social')->where("uid = ?",$this->id);
		$userDetails["social"] = $this->db->fetchRow($select);
		
		$select =  $this->db->select(array("language","priority","ability","timestamps"))->from('user_language')->where("uid = ?",$this->id);
		$user_language = $this->db->fetchAll($select);
		
		$userDetails["language"] = $user_language;
		$userDetails["interested"] = jdecode($userDetails["interested"]);

		$userDetails = array_merge($userDetails,$this->GetFriends());

		$userDetails["chopName"] = (strlen($userDetails["fname"].$userDetails["lname"])<10)?$userDetails["fname"]." ".$userDetails["lname"]:(strlen($userDetails["fname"])<10?$userDetails["fname"]:substr($userDetails["fname"],0,10).'..');

		return $userDetails;
	}
#Registration	
	function Register($data = array())
	{	
		$this->db->insert("user",array("fname"=>$data["fname"],
										"lname"=>$data["lname"],
										"rid"=>$data["rid"],
										"email"=>$data["email"],
										"gender"=>$data["gender"],
										"regIP"=>$_SERVER['REMOTE_ADDR'],
										"regStatus"=>md5(rand(0,time())),
										"image"=>$data["gender"]=="M"?"boy.gif":"girl.gif",
										"birthDay"=>$data["year"]."-".$data["month"]."-".$data["day"],
										"password"=>$data["password"]));
		$this->id = $this->db->lastInsertId();
//		$this->db->insert("user_friends",array("uidto"=>$this->id,"uidfrom"=>1,"status"=>"Y"));
		if($data["rid"]>0)$this->db->insert("user_friends",array("uidto"=>$this->id,"uidfrom"=>$data["rid"],"status"=>"Y"));
		$this->db->insert("user_notification",array("uid"=>$this->id));
		$this->db->insert("user_professional",array("uid"=>$this->id));
		$this->db->insert("user_personal",array("uid"=>$this->id));
		$this->db->insert("user_social",array("uid"=>$this->id));
		return true;
	}
#UserNotifications
	function setNotifications($data)
	{
		$data = array_merge(array("tripsOrganize"=>"N",
								"tripsParticipate"=>"N",
								"additionFriends"=>"N",
								"friendsRecentActivity"=>"N",
								"deadlinesAlerts"=>"N",
								"tripRelatedEvents"=>"N",
								"travelHistory"=>"N",
								"travelDeals"=>"N"),$data);
		
		if($this->getNotifications()) $this->db->update('users_notifications',$data,"uid = '".$this->id."'");
		else $this->db->insert('users_notifications',array_merge($data,array("uid"=>$this->id)));
	}

	function getNotifications()
	{
		$select =  $this->db->select()
							->from('users_notifications')
							->where("uid = ?",$this->id);
		$userDetails = $this->db->fetchRow($select);
		return is_array($userDetails)?$userDetails:false;
	}
#UserPrivacy
	function setPrivacy($data)
	{
		$data = array_merge(array("friendsList"=>"N",
								"recentActivity"=>"N",
								"tripInvitees"=>"N",
								"myFriends"=>"N",
								"RAnnonymous"=>"N",
								"favorites"=>"N",
								"travelHistory"=>"N",
								"fullName"=>"N",
								"email"=>"N",
								"dob"=>"N",
								"location"=>"N"),$data);
		if($this->getPrivacy()) $this->db->update('users_privacy',$data,"uid = '".$this->id."'");
		else $this->db->insert('users_privacy',array_merge($data,array("uid"=>$this->id)));
	}

	function getPrivacy()
	{
		$select =  $this->db->select()
							->from('users_privacy')
							->where("uid = ?",$this->id);
		$userDetails = $this->db->fetchRow($select);
		return is_array($userDetails)?$userDetails:false;
	}
# User Elements
	function setElements($data)
	{	$data = array_merge(array("generalTravel"=>"N",
								"internationalTravel"=>"N",
								"planningTricks"=>"N",
								"travelPolitics"=>"N",
								"travelSafety"=>"N"),$data);
		if($this->getElements()) $this->db->update('users_elements',$data,"uid = '".$this->id."'");
		else $this->db->insert('users_elements',array_merge($data,array("uid"=>$this->id)));
	}

	function getElements()
	{	$select =  $this->db->select()
							->from('users_elements')
							->where("uid = ?",$this->id);
		$userDetails = $this->db->fetchRow($select);
		return is_array($userDetails)?$userDetails:false;
	}
# User Favorites
	function setFavorites($data)
	{
		if($this->getFavorites()) $this->db->update('users_favorites',$data,"uid = '".$this->id."'");
		else $this->db->insert('users_favorites',array_merge($data,array("uid"=>$this->id)));
	}

	function getFavorites()
	{
		$select =  $this->db->select()
							->from('users_favorites')
							->where("uid = ?",$this->id);
		$userDetails = $this->db->fetchRow($select);
		return is_array($userDetails)?$userDetails:false;
	}
# update User Data
	function updateData($data)
	{	$this->db->update('user',$data,"id = '".$this->id."'");
		return $this->Info(); 
	}
#getUserDataById	
	function GetDetailsByEmail($email)
	{	$select = $this->db->select()->from('user')->where("email = ?",$email);
		$userDetails = $this->db->fetchRow($select);
		return is_array($userDetails)?$userDetails:false;
	}
#user Mails
	function InboxMails()
	{
		$select = $this->db->select()
							->from(array('m'=>'users_mails'))
							->join(array('u'=>'user'),'u.id = m.uidfrom',array("username"=>"concat(u.fname,' ',u.lname)"))
							->where("m.uidto = ?",$this->id)
							->order("m.timestamps DESC");
		$userMails = $this->db->fetchRow($select);
		
		if(is_array($userMails))
		{	
			$mails["read"] = $mails["junk"] = $mails["unread"] = array();
			foreach($userMails as $m)
			{	if($m["status"]=="Y")$mails["read"][] = $m;
				if($m["status"]=="M")$mails["junk"][] = $m;
				if($m["status"]=="N")$mails["unread"][] = $m;
			}
			return $mails;
		}
		else return false;
	}
#user friends
	function GetFriends($uid = NULL)
	{
		$uid = $uid?$uid:$this->id;
		$userFriends = $this->db->query("select cca.status,cca.uidto,cca.uidfrom,mi.image,concat(mi.fname,' ',mi.lname) username,mi.address,mi.email,(select inTime from user_log where uid=mi.id order by inTime  desc limit 0,1 ) inTime,mi.birthDay,mi.gender,mi.city,mi.state,mi.country from user mi inner join user_friends cca on (mi.id =cca.uidto or  mi.id =cca.uidfrom)and mi.id!=".$uid." and (uidto =".$uid." or uidfrom =".$uid.") order by inTime DESC");
		$userFriends = $userFriends->fetchAll();
		$friends["sentRequest"] = $friends["friends"] = $friends["recivedRequest"] = array();
		if(is_array($userFriends))
		{	
			foreach($userFriends as $m)
			{	if($m["status"]=="Y")$friends["friends"][$m["uidto"]==$uid?$m["uidfrom"]:$m["uidto"]] = $m;
				if($m["status"]=="N" && $m["uidto"]==$uid)$friends["sentRequest"][$m["uidfrom"]] = $m;
				if($m["status"]=="N" && $m["uidfrom"]==$uid)$friends["recivedRequest"][$m["uidto"]] = $m;
			}
		}
		return $friends;
	}

	function RemoveFriend($id)
	{
		$this->db->delete("user_friends","(uidto = '".$id."' AND uidfrom = '".$this->id."') OR (uidto = '".$this->id."' AND uidfrom = '".$id."')");
	}
	
	function ConfirmFriend($id)
	{
		$this->db->update("user_friends",array("status"=>"Y"),"(uidto = '".$id."' AND uidfrom = '".$this->id."') OR (uidto = '".$this->id."' AND uidfrom = '".$id."')");
	}
	
	function AddFan($id)
	{
		$this->db->insert("user_friends",array("uidto"=>$this->id,"uidfrom"=>$id));
		return $this->db->lastInsertId();
	}
	
	function CheckEmail($email)
	{	
		$select =  $this->db->select()
							->from('user')
							->where("email = ?",$email);
		$userDetails = $this->db->fetchRow($select);
		return is_array($userDetails)?true:false;
	}
	
	function PersonalUpdate($data = array())
	{
		extract($data);
		$interested = array();
		for($i=1;$i<6;$i++)if($data["interested_".$i])$interested[] = $data["interested_".$i];
		$this->db->update("user",array("email"=>$email,
										"password"=>$password,
										"fname"=>$fname,
										"lname"=>$lname,
										"gender"=>$gender,
										"relationshipStatus"=>$relationshipStatus,
										"birthDay"=>$year."-".$month."-".$day,
										"city"=>$city,
										"state"=>$state,
										"zip"=>$zip,
										"country"=>$country,
										"interested"=>json_encode($interested),
										"address"=>$address,
										"address_visible"=>$address_visible),"id = '".$this->id."'");
		$this->db->delete("user_language","uid = '".$this->id."'");
		$this->db->insert("user_language",array("uid"=>$this->id,"language"=>$language));
	}
	
	function Energizing($limit = NULL,$restricted = NULL,$customOrder = NULL)
	{

		$users = $r = array(); 
		$whereRaw = array("id NOT IN (1,41".(is_array($restricted)?",".implode(",",$restricted):"").") ");
		$u = $this->db->query("SELECT hostUid FROM user_visitors WHERE guestUid = '".$this->id."' GROUP BY hostUid");
		$usrs = $u->fetchAll(); $ids = array(); foreach($usrs as $id)$ids[] = $id["hostUid"];
		if(count($ids)>0)$whereRaw[] = "id NOT IN (".implode(",",$ids).") ";
		$admin = new AdminModel(); $where = implode(" AND ",$whereRaw);
		$selectF = "SELECT id,image,CONCAT(fname,' ',lname)username,birthDay,gender,city,state,country,(select inTime from user_log where user_log.uid = user.id order by uid desc limit 0,1) inTime,(select count(uid) from user_log where user_log.uid = user.id group by uid limit 0,1) tot";
		$ob = "ORDER BY tot DESC".(is_array($customOrder)?",".implode(",",$customOrder):"");
		$limit = is_array($limit)?" LIMIT ".$limit[0].",".$limit[1]:"";
		$q = "$selectF FROM user WHERE $where $ob $limit";
		$u = $this->db->query($q); $usrs = $u->fetchAll();
		return $usrs;
	}
	
	function Newfangled($limit = NULL,$restricted = NULL,$customOrder = NULL)
	{

		$users = $r = array(); 
		$whereRaw = array("id NOT IN (1,41".(is_array($restricted)?",".implode(",",$restricted):"").") ");
		$u = $this->db->query("SELECT hostUid FROM user_visitors WHERE guestUid = '".$this->id."' GROUP BY hostUid");
		$usrs = $u->fetchAll(); $ids = array(); foreach($usrs as $id)$ids[] = $id["hostUid"];
		if(count($ids)>0)$whereRaw[] = "id NOT IN (".implode(",",$ids).") ";
		$whereRaw[] = "(select count(uid) from user_log where user_log.uid = user.id group by uid limit 0,1)=1";
		$admin = new AdminModel(); $where = implode(" AND ",$whereRaw);
		$selectF = "SELECT id,image,CONCAT(fname,' ',lname)username,birthDay,gender,city,state,country,(select inTime from user_log where user_log.uid = user.id order by uid desc limit 0,1) inTime";
		$ob = "ORDER BY inTime DESC".(is_array($customOrder)?",".implode(",",$customOrder):"");
		$limit = is_array($limit)?" LIMIT ".$limit[0].",".$limit[1]:"";
		$q = "$selectF FROM user WHERE $where $ob $limit";
		$u = $this->db->query($q); $usrs = $u->fetchAll();
		return $usrs;
	}
	
	function Search($data = array(),$limit = NULL,$restricted = NULL,$customOrder = NULL)
	{

		$data = array_merge(array("fname"=>"","lname"=>"","email"=>"","city"=>"","country"=>"","gender"=>"","maxAge"=>"","minAge"=>"","state"=>""), $data);
		$users = $r = array(); $whereRaw = array("id NOT IN (1,41".(is_array($restricted)?",".implode(",",$restricted):"").") ");
		$country = $data['country'];
		$admin = new AdminModel();

		if($data['fname']!='')$whereRaw[] = " fname LIKE '".$data['fname']."%'";
		if($data['lname']!='')$whereRaw[] = " lname LIKE '".$data['lname']."%'";
		if($data['email']!='')$whereRaw[] = " email = '".$data['email']."'";


		if($country!='')$whereRaw[] = " country = '".$country."'"; $city = $data['city'];
		if($city!='')$whereRaw[] = "city = '$city'";
		$state = $data['state'];if($state!='')$whereRaw[] = "state LIKE '%$state%'";
		$gender = $data['gender'];if($gender!='')$whereRaw[] = "gender = '$gender'";
		$where = implode(" AND ",$whereRaw);
		$selectF = "SELECT id,image,CONCAT(fname,' ',lname)username,birthDay,gender,city,state,country,(select inTime from user_log where user_log.uid = user.id order by uid desc limit 0,1) inTime";
		$ob = "ORDER BY inTime DESC".(is_array($customOrder)?",".implode(",",$customOrder):"");

		if($data['minAge']!="") $where.=" AND date_format(birthDay,'%Y') <= ".date("Y",strtotime(($data['minAge'])." years ago"));
		if($data['maxAge']!="") $where.=" AND date_format(birthDay,'%Y') >= ".date("Y",strtotime(($data['maxAge'])." years ago"));

		$limit = is_array($limit)?" LIMIT ".$limit[0].",".$limit[1]:"";
		
		$q = "$selectF FROM user WHERE $where $ob $limit";

		$u = $this->db->query($q); $usrs = $u->fetchAll();
		return $usrs;
	}
	
	function outContacts()
	{
		$u = $this->db->query("SELECT c.* FROM user_contacts c LEFT JOIN user u ON u.email != c.email WHERE mailsend = 0 AND c.uid = '".$this->id."' LIMIT 0,99");
		$contacts = $u->fetchAll(); $cont = array();
		foreach($contacts as $c) $cont[$c["id"]] = array("name"=>$c["name"],"email"=>$c["email"],"status"=>$c["status"],"mailsend"=>$c["mailsend"],"timestamps"=>$c["timestamps"]);
		return $cont;
	}
	
	function inContacts()
	{
		$friends = $this->GetFriends();
		$friends = array_keys($friends['friends']);
		if(count($friends)>0)$where = "u.id NOT IN (".implode(",",$friends).") AND ";
		$u = $this->db->query("SELECT u.fname,u.id,u.gender,u.birthDay,u.lname,u.image 
								FROM user_contacts c,user u 
								WHERE $where c.uid = '".$this->id."' AND u.email = c.email 
								ORDER BY c.timestamps DESC");
		$contacts = $u->fetchAll();	$cont = array();
		foreach($contacts as $c) $cont[$c["id"]] = $c;
		return $cont;
	}
	
	function ImportContacts($off,$nn,$p)
	{
			$n = strpos($nn,"@")>0?$nn:$nn."@".$off.".com";
			if($off)$e = array($n,$p,$off); else return false;
			$this->db->delete("user_contacts","uid = '".$this->id."' AND email LIKE '".$off."/%'");
			$ch = curl_init(); curl_setopt($ch, CURLOPT_POST, 1); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, "http://www.pepool.com/OpenInviter/example.php");
			curl_setopt($ch, CURLOPT_POSTFIELDS, "&email_box=".$e[0]."&password_box=".$e[1]."&provider_box=".$e[2]."&import=Import Contacts&step=get_contacts");
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0"); curl_setopt($ch,CURLOPT_ENCODING , "UTF-8"); $content = curl_exec($ch);
			curl_close($ch); $return = jdecode($content); $rtX = array("in"=>array(),"out"=>array());
			
			$session = Zend_Registry::get('session');
			$session->oi_session_id = array($off=>array("id"=>$return['oi_session_id'],"email"=>$e[0]));

			foreach($return['contacts'] as $v=>$k)
			{
				$v = strpos($v,"@")?$v:$off."/".$v; $cD = $this->ContactDetails($v);
				if($cD["id"]>0 && $cD["mailsend"]==0 && eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$v))
				{
					$rtX["in"][$k] = array($v,$cD["id"]);
				}
				else
				{
					if(!$cD["id"]>0) $this->db->insert("user_contacts",array("uid"=>$this->id,"status"=>"N","name"=>$k,"email"=>$v));
					$rtX["out"][$k] = array($v,$this->db->lastInsertId(),$cD["mailsend"]);
				}
			}
			return $rtX;
	}
	
	function ContactDetails($email)
	{
		$select = $this->db->select()
							->from('user_contacts')
							->where("uid = ?",$this->id)
							->where("email = ?",$email);
		$userSearch = $this->db->fetchRow($select);
		return $userSearch;
	
	}
	
	function InvitedContact($id)
	{
		$select = $this->db->select()
							->from('user_contacts')
							->where("id = ?",$id);
		$userSearch = $this->db->fetchRow($select);
		return $userSearch;
	}
	
	function SendInviteAutomated($data = array())
	{
		error_reporting(E_ALL);
		$session = Zend_Registry::get('session');
		foreach($data as $id)
		{
			$select = $this->db->select()->from('user_contacts')->where("id = ?",$id);
			$in = $this->db->fetchRow($select);

			
			$this->id = $in['uid'];

			$my = $this->Info();

			$in["name"] = strlen($in["name"])>0?substr($in['email'],0,strpos($in['email'],'@')):"buddy";//" friend ";
			//$in["name"] = strlen($in["name"])>0?$in["name"]:"buddy";//" friend ";
			$msg = 'Hi '.$in["name"].',<br /><br />What you think about me? Let me know.. Please fill my slambook at the link below:<br /><a href="'.WWW_ROOT.'i/'.encode($in["id"]).'">'.WWW_ROOT.'i/'.encode($in["id"]).'</a><br /><br />Yours truly,<br />'.$my["fname"].' '.$my["lname"];
			$subject = "Pepool Slambook request from ".$my["fname"]." ".$my["lname"];
			
			//$in['email'] = 'gauravstomar@gmail.com';

			if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$in['email']))
			{
				
try
{
	$mail = new Zend_Mail();
	$mail->setBodyHtml($msg)->setFrom('info@pepool.com', 'Pepool')->addTo($in['email'],$in['name'])->setSubject($subject)->send();
}
catch (Zend_Exception $e)
{
	print"<hr />";
	print_r($in);
	print_r($e->getMessage());
	print"<hr />";
?>
	<script type="text/javascript">
	
		setTimeout(function(){window.location.reload();},55000);
        
    </script>
<?
	
	exit;
}

			}
			$this->db->update("user_contacts",array("systemMails"=>$in["systemMails"]+1),"id = '$id'");
		}
	}
	
	function SendInvite($data = array())
	{
		$session = Zend_Registry::get('session');
		foreach($data as $id)
		{
			$select = $this->db->select()->from('user_contacts')->where("id = ?",$id);
			$in = $this->db->fetchRow($select);
			$this->db->update("user_contacts",array("mailsend"=>$in["mailsend"]+1),"id = '$id'");
			$my = $this->Info();

			$in["name"] = strlen($in["name"])>0?$in["name"]:"buddy";//" friend ";
			$msg = 'Hi '.$in["name"].',<br /><br />What you think about me? Let me know.. Please fill my slambook at the link below:<br /><a href="'.WWW_ROOT.'i/'.encode($in["id"]).'">'.WWW_ROOT.'i/'.encode($in["id"]).'</a><br /><br />Yours truly,<br />'.$my["fname"].' '.$my["lname"];
			$subject = "Pepool Slambook request from ".$my["fname"]." ".$my["lname"];

			if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$in['email']))sendmail($subject,$msg,$in['email'],$in['name']);
			else
			{
				$msg = 'Hi '.$in["name"].', What you think about me? Let me know.. Please fill my slambook here: '.WWW_ROOT.'i/'.encode($in["id"]).' i am waiting.';

				$I = explode("/",$in['email']); $S = $session->oi_session_id[$I[0]];

				$vars = "&check_1=1&message_box=".$msg."&email_1=".$I[1]."&name_1=".$in['name']."&provider_box=".$I[0]."&send=Send invites&step=send_invites&email_box=".$S["email"]."&oi_session_id=".$S["id"];

				$ch = curl_init(); curl_setopt($ch,CURLOPT_POST,1); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch,CURLOPT_URL,"http://www.pepool.com/OpenInviter/example.php"); curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
				curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0"); curl_setopt($ch,CURLOPT_ENCODING,"UTF-8"); $content = curl_exec($ch);
				curl_close($ch); 
				return jdecode($content);
			}
		}
	}

	function SocialUpdate($data = array())
	{	extract($data);
		$this->db->update("user_social",array(	"children"=>$children,
												"ethnicity"=>$ethnicity,
												"religion"=>$religion,
												"political"=>$political,
												"humor"=>$humor,
												"sexualOrientation"=>$sexualOrientation,
												"fashion"=>$fashion,
												"smoking"=>$smoking,
												"drinking"=>$drinking,
												"pets"=>$pets,
												"living"=>$living,
												"hometown"=>$hometown,
												"webpage"=>$webpage,
												"aboutMe"=>$aboutMe,
												"passions"=>$passions,
												"sports"=>$sports,
												"activities"=>$activities,
												"books"=>$books,
												"music"=>$music,
												"tvShows"=>$tvShows,
												"movies"=>$movies,
												"cuisines"=>$cuisines),"uid = '".$this->id."'");
	}
}