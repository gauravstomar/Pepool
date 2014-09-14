<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var friend = function()
{
	wwF = "<?=WWW_ROOT?>users/";
}
friend.prototype = {
init:function(uri)
{	gst.hideBody();
	if(!gst.gE("friend"))
	{	
		$("#profileH").fadeIn();
		<? /*Ul = gst.cE("ul");
		$(Ul).attr({"id":"friendH"}).appendTo(".cA div span");
		$("<li>").addClass("l").html("<h2>My friends</h2>").appendTo(Ul);
		$("<li>").addClass("r f11").html("").appendTo(Ul); */?>
		
		$("<div>").attr({"id":"friend"}).prependTo(".c .cB");
		$.getJSON(wwF+"friends/"+(uid?"of/"+uid:""),function(d){$.each(d,function(i,itm){frnD.divFrnd(i,itm)})});
	}
	else
	{	$("#friend").fadeIn("fast");
		$("#profileH").fadeIn("fast");
		<? /*$("#friendH").fadeIn("fast");*/?>
	}
},
divFrnd:function(id,d)
{
	div = $("<div>").html("<h3>"+d.title+"</h3>").attr("id",id).appendTo("#friend");
	if(id=="recived-friend")t = {"c":"af","t":"Confirm as friend","a":"c"};
	else if(id=="real-friend")t = {"c":"rf","t":"Remove friend","a":"r"}; else t = null;
	$.each(d.data,function(i,itm)
	{	diV = gst.cE(); $(diV).css({"margin":"10px"}).appendTo(div);
		$("<img>").addClass("iB").attr({"border":"0","src":img+"user/icon/"+itm.image}).appendTo(diV);
		$("<a>").attr({"href":www+"bio/"+itm.uid}).html(itm.username).prependTo($("<span>").html(itm.addr).appendTo(diV));
		if(t && (uid==uExt || !uid))A=$("<a>").attr({"href":"javascript:;","rel":t.a+"-"+itm.uid}).addClass(t.c+" frnd").html(t.t).prependTo(diV);
	}); gst.navs();
}
				};
frnD = new friend();
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>