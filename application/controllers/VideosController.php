<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Registry.php';
class VideosController extends Zend_Controller_Action
{
    function init()
    {	
		//HackCheck();
		Zend_Loader::loadClass('Zend_Gdata_YouTube');
		$this->youtube = new Zend_Gdata_YouTube();
		$this->session = Zend_Registry::get('session');
		$this->cache = Zend_Registry::get('cache');
		$this->db = Zend_Registry::get('db');
		$this->video = new VideoModel($this->session->user["id"]);
		$this->user = new UsersModel($this->session->user["id"]);
		$this->admin = new AdminModel();
		$this->view->user = $this->session->user;
		if($this->session->error!="") $this->view->error = $this->session->error;
		$this->session->error = NULL;
	}
	
	function addAction()
	{

		$ytURL = $_REQUEST["URL"]; $ytvIDlen = 11; $idStarts = strpos($ytURL, "?v=");
		if($idStarts === FALSE) $idStarts = strpos($ytURL, "&v=");
		if($idStarts === FALSE) jencode(array("m"=>"<strong>Video URL is invalid</strong><br /> Try another URL","t"=>""));
		$idStarts +=3; $yTid = substr($ytURL, $idStarts, $ytvIDlen);

		$this->youtube->setMajorProtocolVersion(1);
		$query = $this->youtube->newVideoQuery();
		$query->setOrderBy('viewCount');
		$query->setVideoQuery($yTid);
		$videoFeed = $this->youtube->getVideoFeed($query->getQueryUrl(2));

		foreach($videoFeed as $videoEntry)
		{
			$VideoTitle = $videoEntry->getVideoTitle();
			$VideoDescription = $videoEntry->getVideoDescription();
		}
		
		$Video = $this->video->Add($yTid,$VideoTitle,$VideoDescription);

		if($Video==1)
		{
			$uT = $this->video->Current();
			$user = $this->view->user;
			$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
			$uT["id"] = encode($uT["id"]);
			$uT["uid"] = encode($uT["uid"]);
			$uT["title"] = $VideoTitle;
			$uT["details"] = $VideoDescription;
			jencode(array("m"=>"Video added successfully","t"=>"yeppe","d"=>$uT));
		}
		elseif($Video==2)
		{
			jencode(array("m"=>"<strong>You already added this video</strong>","t"=>""));
		}
		else
		{
			jencode(array("m"=>"<strong>Unable to add video</strong><br /> Try after some time","t"=>""));
		}
		die;
	}
	
	function deleteAction()
	{
		if(POST)
		{
			$this->video->Delete(decode($_REQUEST['id']));
		}
		die;
	}
	
	function imageAction()
	{
		header('content-type: image/jpeg'); 
		$id = $this->getRequest()->getParam('of');
		$watermark = imagecreatefrompng(IMAGES."ytThumb.png");  
		$watermark_width = imagesx($watermark);  
		$watermark_height = imagesy($watermark);  
		$image = imagecreatetruecolor($watermark_width, $watermark_height);  
		$image = imagecreatefromjpeg("http://i3.ytimg.com/vi/".$V['url']."/default.jpg");  
		$size = getimagesize("http://i3.ytimg.com/vi/".$V['url']."/default.jpg");  
		$dest_x = $size[0] - $watermark_width - 0;  
		$dest_y = $size[1] - $watermark_height - 0;  
		imagecopymerge($image, $watermark, $dest_x, $dest_y, 0,0, $watermark_width, $watermark_height, 100);  
		imagejpeg($image);  
		imagedestroy($image);  
		imagedestroy($watermark);
		die;
	}
	
	function getAction()
	{	
		if(!$this->getRequest()->getParam('html'))
		{	$uTw = array();
			$tweet = $this->video->Get($_REQUEST['limit'],$this->getRequest()->getParam('of')?decode($this->getRequest()->getParam('of')):NULL,($_REQUEST['limit']==1?'DESC':'ASC'));
			if($tweet)
			{
				foreach($tweet as $uT)
				{	$uT["timestamps"] = timeDiff(strtotime($uT["timestamps"]));
					$uT["id"] = encode($uT["id"]);
					$uT["uid"] = encode($uT["uid"]);
					$uTw[] = $uT;
				}
			}
			jencode($uTw); die;
		}
	}
}
?>