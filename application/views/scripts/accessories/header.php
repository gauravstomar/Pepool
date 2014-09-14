	<div id="cVr"></div><div id="W8" class="W8"><strong>Loading</strong></div>
	<ul id="H" style="padding-bottom:5px;">
		<h1>Online Slambook</h1>
        <li class="l"></li>
		<li class="c">
        	<a href="<?=WWW_ROOT?>" title="online slambook"><img src="<?=IMAGES?>logo.jpg" border="0" alt="online slambook" /></a> 
            <form class="wa" method="post" id="topLoginForm" action="<?=WWW_ROOT?>users/login">
            <?
            if(!$this->user["id"]>0)
			{
			?>
            <input type="hidden" name="rid" value="<?=encode($this->InviteeUser["id"])?>" />
            <input type="text" name="email" onblur="if(this.value=='')this.value='email';" onkeyup="if(this.value.length>7)this.size=this.value.length+2;else this.size=7;" size="7" onfocus="if(this.value=='email')this.value='';" value="email" />
            <input type="password" name="pass" onblur="if(this.value=='')this.value='password';" onfocus="if(this.value=='password')this.value='';" size="10" value="password" />
            <input class="f11" type="submit" value="login" />
            <?
            }
			else
			{
			?>
            <a href="<?=WWW_ROOT?>my"><strong>Home</strong></a> &nbsp; | &nbsp; 
            <a href="<?=WWW_ROOT?>my" class="a2a_dd"><strong>
            
            Share <?=($this->userExt["id"]==$this->user["id"] || $this->userExt["id"]=="")?"My":($this->userExt["gender"]=="M"?"His":"Her")?> SlamBook
            
            
            </strong></a> &nbsp; | &nbsp; 
            <a href="<?=WWW_ROOT?>users/logout"><strong>Logout</strong></a>
            <?
            }
			?>
            </form>
        </li>
		<li class="r"></li>
    </ul>