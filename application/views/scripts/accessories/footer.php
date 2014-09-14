    <ul id="F">
        <li class="l"> &copy; Pepool.com 2010 </li>
        <li class="r fr"> 
        	<a href="javascript:;" class="x" onclick="alert('we are here to pooling people ;)')">About Us</a> :  
            <a href="mailto:info@pepool.com">Contact Us</a> : 
            <a href="javascript:;" class="x" onclick="alert('no nudity, no spam, no fake! only friends ;)')">Terms & Conditions</a> 
        </li>
    </ul>
<? if(!$this->user["id"]>0 && false):?>
    <div style="position:fixed; top:0; left:0; width:100%; height:2000px; background:#333333; display:none; z-index:98" class="help helpus"></div>
    <div style="height:115px;width:735px; top:200px; border:5px solid #008FD1; left:25%;position:fixed;background:#FFFFFF; z-index:99; display:none;" class="help">
		<center>
            <strong style="line-height:20px; font-size:10px">
                We need your help to run this website. Please click on the banner below to promote us.
                <a href="javascript:;" onclick="$('.help').remove()">or, Click Here to continue</a>
            </strong>
			<script type="text/javascript"><!--
            google_ad_client = "ca-pub-6720925791493319";
            google_ad_slot = "3509168030";
            google_ad_width = 728;
            google_ad_height = 90;
            //-->
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        </center>
    </div>
<? endif;?>
<script type="text/javascript">
	a2a_onclick = 1;
	a2a_color_main="D7E5ED";
	a2a_color_border="008fd1";
	a2a_color_link_text="008fd1";
	a2a_color_link_text_hover="008fd1";
	a2a_linkname="<?=($this->userExt["id"]==$this->user["id"] || $this->userExt["id"]=="")?"My":($this->userExt["fname"]." ".$this->userExt["lname"]."'s")?> Online Slambook on Pepool.com";
	a2a_linkurl="<?=WWW_ROOT?>user/<?=($this->userExt["id"]==$this->user["id"] || $this->userExt["id"]=="")?encode($this->user["id"]):encode($this->userExt["id"])?>";
</script>
<script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>
<?php /*?>
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script><script type="text/javascript">FB.init("4cf4261e618188b7413d3bae961281b9");</script>
<?php */?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	try{var pageTracker = _gat._getTracker("UA-3182225-13"); pageTracker._trackPageview();}catch(err){}
</script>