<?php
class AdminModel
{
	
	function AdminModel($uid = 0)
	{	
		$this->adminEmails = array("info@pepool.com");
		$this->db = Zend_Registry::get('db');
	}
#Login	
	function Report($data)
	{	
		mail($this->adminEmails,"Error in Pepool.com","Error in Pepool.com <br />Reference code:$data");
	}
	
	function Message($data)
	{
		$query = $this->db->query("SELECT msg FROM message WHERE type = '$data' ORDER BY RAND() LIMIT 0,1");
		$query = $query->fetchAll();
		return $query[0]["msg"];
	}
	
	function UTFs($Limit = array(0,99))
	{
		$query = $this->db->query("SELECT * FROM utfs LIMIT ".$Limit[0].",".$Limit[1]);
		$query = $query->fetchAll(); $return = array();
		foreach($query as $q)$return[$q['name']] = utf8_decode($q['utfs']);
		return $return;
	}
	
	function Country()
	{
		$query = $this->db->query("SELECT id,country_name 
									FROM country 
									ORDER BY country_name");
		$query = $query->fetchAll();
		foreach($query as $q)$co[$q["id"]] = $q["country_name"];
		return $co;
	}
	
	function Language()
	{
		$query = $this->db->query("SELECT id,language 
									FROM language 
									ORDER BY language");
		$query = $query->fetchAll();
		foreach($query as $q)$co[$q["id"]] = $q["language"];
		return $co;
	}
	
	function Interested()
	{
		return array(1=>"friends",
					2=>"activity partners",
					3=>"business networking",
					4=>"dating (men & women)",
					5=>"dating (men)",
					6=>"dating (women)");
	}
	function Visible()
	{
		return array(1=>"show",2=>"hide");
	}
	function RelationshipStatus()
	{
		return array(1=>"single",
					2=>"married",
					3=>"committed",
					5=>"open marriage",
					6=>"open relationship");
	}

	function Children()
	{
		return array(0=>"no answer",
					1=>"no",
					2=>"yes - at home full time",
					3=>"yes - at home part time",
					4=>"yes - not at home");
	}

	function Ethnicity()
	{
		return array("0"=>"no answer",
						"1"=>"african american (black)",
						"2"=>"asian",
						"3"=>"caucasian (white)",
						"4"=>"east indian",
						"5"=>"hispanic/latino",
						"6"=>"middle eastern",
						"7"=>"native american",
						"8"=>"pacific islander",
						"9"=>"multi-ethnic",
						"10"=>"other");
	}

	function Religion()
	{
		return array("0"=>"no answer",
					"1"=>"Agnostic",
					"2"=>"Atheist",
					"16"=>"Baha'i",
					"3"=>"Buddhist",
					"19"=>"Cao Dai",
					"26"=>"Christian/Anglican",
					"4"=>"Christian/Catholic",
					"5"=>"Christian/LDS",
					"27"=>"Christian/Orthodox",
					"7"=>"Christian/Other",
					"6"=>"Christian/Protestant",
					"8"=>"Hindu",
					"17"=>"Jain",
					"9"=>"Jewish",
					"10"=>"Muslim",
					"21"=>"Neo-Paganist",
					"23"=>"Rastafarian",
					"12"=>"Religious humanism",
					"24"=>"Scientologist",
					"18"=>"Shinto",
					"15"=>"Sikh",
					"11"=>"Spiritual but not religious",
					"25"=>"Taoist",
					"20"=>"Tenrikyo",
					"22"=>"Unitarian Universalist",
					"14"=>"Zoroastrian",
					"13"=>"other");
	}
	
	
	function PoliticalView()
	{
		return array("0"=>"no answer",
						"1"=>"right-conservative",
						"2"=>"very right-conservative",
						"3"=>"centrist",
						"4"=>"left-liberal",
						"5"=>"very left-liberal",
						"6"=>"libertarian",
						"7"=>"very libertarian",
						"8"=>"authoritarian",
						"9"=>"very authoritarian",
						"10"=>"depends",
						"11"=>"not political");
	}

	
	
	function SexualOrientation()
	{
		return array("0"=>"no answer",
						"1"=>"straight",
						"2"=>"gay",
						"3"=>"bisexual",
						"4"=>"bi-curious");
	}
	

	function Smoking()
	{
		return array("0"=>"no answer",
						"1"=>"no",
						"2"=>"socially",
						"3"=>"occasionally",
						"4"=>"regularly",
						"5"=>"heavily",
						"6"=>"trying to quit",
						"7"=>"quit");
	}

	

	function Drinking()
	{
		return array("0"=>"no answer",
						"1"=>"no",
						"2"=>"socially",
						"3"=>"occasionally",
						"4"=>"regularly",
						"5"=>"heavily");
	}

	

	function Pets()
	{
		return array("0"=>"no answer",
						"1"=>"i love my pet(s)",
						"2"=>"i like them at the zoos",
						"3"=>"i like pet(s)",
						"4"=>"i don't like pets");
	}

	function Humor()
	{
		return array("1"=>"raunchy",
						"2"=>"obscure",
						"3"=>"goofy/slapstick",
						"4"=>"friendly",
						"5"=>"clever/quick witted",
						"6"=>"dry/sarcastic",
						"7"=>"campy/cheesy");
	}

	function Fashion()
	{
		return array("1"=>"alternative (i'm stylish in my own special way)",
						"2"=>"casual (i'm usually in my favorite jeans)",
						"3"=>"classic (my tastes echo long-established norms)",
						"4"=>"contemporary (i'm cool, but i don't need labels)",
						"5"=>"designer (i'm a slave to designer labels)",
						"6"=>"minimal (clothes are strictly optional)",
						"7"=>"natural (i only wear natural fabrics)",
						"8"=>"outdoorsy (i'm usually dressed for the bush)",
						"9"=>"smart (it's all about quality)",
						"10"=>"trendy (i wear whatever's new and now)",
						"11"=>"urban (my style is fresh from the city streets)");
	}

	function Living()
	{
		return array("1"=>"alone",
						"2"=>"with roommate(s)",
						"3"=>"with partner",
						"4"=>"with pet(s)",
						"5"=>"with kid(s)",
						"6"=>"with parents",
						"7"=>"friends visit often",
						"8"=>"party every night");
	}
	
	function Socials()
	{
		$return['children'] = $this->Children();
		$return['ethnicity'] = $this->Ethnicity();
		$return['religion'] = $this->Religion();
		$return['politicalView'] = $this->PoliticalView();
		$return['sexualOrientation'] = $this->SexualOrientation();
		$return['smoking'] = $this->Smoking();
		$return['drinking'] = $this->Drinking();
		$return['pets'] = $this->Pets();
		$return['humor'] = $this->Humor();
		$return['fashion'] = $this->Fashion();
		$return['living'] = $this->Living();
		return $return;
	}

}