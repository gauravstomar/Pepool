<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var invite = function(){}
invite.prototype = {
init:function(u)
{	gst.hideBody();
	if(!gst.gE("inviteH"))
	{	$("<h2 />").html("Pool friends to fill your slambook").appendTo(".cA div span").attr({"id":"inviteH"});
		$(gst.cE()).attr("id","invite").prependTo(".c .cB");
		$("#invite").load(www+'invite/',function(){
		 of = $("#invite .nav .std").offset();
		$("#invPro").animate({opacity:".1",top:(of.top-12)+"px",left:(of.left+80)+"px"}).animate({opacity:"1"});
		$("#invPro :button").click(function(){inV.get()});
		$("#invite .field .r").click(function(){inV.send()});
		$("#invPro form").submit(function(){inV.get();return false;})
		$("#invPro :password,#invPro :text").blur(function(){if($(this).attr("value")=="")$(this).attr({"value":$(this).attr("title")})}).focus(function(){if($(this).attr("value")==$(this).attr("title"))$(this).attr({"value":""})});
		inV.userControl();
														});
	}
	else
	{
		$("#inviteH").fadeIn("fast");
		$("#invite").fadeIn("fast");
	}
},
navs:function()
{
	$("#invite .nav a").unbind().click(function(){
			$("#invite .nav a").removeClass("std");$("#invPro :text").attr({"value":"userid"});
			$("#invPro :password").attr({"value":"password"});
			$($("#invPro :input").eq(0)).attr({"value":$(this).attr("href").replace("#invite/","")});
			$(this).addClass("std"); of = $("#invite .nav .std").offset();
			$("#invPro").animate({opacity:".1",top:(of.top-12)+"px",left:(of.left+80)+"px"}).animate({opacity:"1"});
											});
},
userControl:function()
{	$("#selectAll").unbind().click(function(){$("#invite input[type=checkbox]").attr("checked",$(this).attr("checked"));})
	$("#invite .insite li,#invite .field label").unbind().css({"cursor":"pointer"}).hover(function(){$(this).css({"background":"#DAF3FE"})},function(){$(this).css({"background":""})})
	$("#invite .insite li").click(function(){window.location.href=www+'bio/'+$(this).attr("class")});
},
get:function()
{	arY='';$("#invPro :input").each(function(){
		if($(this).attr("value")=='userid' && $(this).attr("title")=='userid')
		{	gst.message('Please enter a valid login'); return false;
		}	arY += $(this).attr("name")+'='+encodeURI($(this).attr("value"))+'&';
		if($(this).attr("name")!='of' && $(this).attr("name")!='')$(this).val($(this).attr("title"));
	});
	if(arY.length>15)
	{
	$.ajax({type:"POST",url:www+'invite',data:arY,success:function(d){				
		gst.ajaxOver(); d=eval('('+d+')'); gst.message(d.m,7,d.mT);
		for(i=0;i<d.emails.length;i++)inV.addContacts(d.emails[i]);
		for(i=0;i<d.users.length;i++)inV.addUsers(d.users[i]);
		$("#invite .field li:even").css({"background":"#f5f5f5"}); inV.userControl();
				}});
	}
},
addContacts:function(h)
{	lI = gst.cE("label");$("<input>").attr({"type":"checkbox","name":"id[]","value":h.i}).appendTo(lI);
	$("<span>").addClass("e").html(h.e?h.e:h.n).appendTo(lI);$("<span>").addClass("n").html(h.e?h.n:'Social contact'+(h.m?' (invited '+h.m+' times)':'')).appendTo(lI);
	$(lI).prependTo("#invite .field .outsite");
},
addUsers:function(u)
{	ref="#invite .insite ."+u[0];
	if($(ref).length>0){$(ref).css({"opacity":".1"}).animate({"opacity":"1"},"slow");return false;}
	Li = $("<li>").addClass(u[0]).prependTo("#invite .insite ul");
	$("<img>").attr({"src":img+'user/icon/'+u[1]}).appendTo($("<span>").addClass("e").appendTo(Li));
	$("<span>").html(u[2]).prependTo($("<span>").html(u[3]).addClass("n").appendTo(Li));
},
send:function(h)
{	if($("#invite .field label").length>0)
	{	$("#invite .field input:checked").each(function()
		{	gst.msg='Sending invite';
			if($(this).attr('id')!='selectAll')$(this).fadeOut(function(){$("<input>").attr({'src':img+'loading.gif','type':'image'}).prependTo($(this).parent());});
			$.ajax({type:"POST",url:www+'invite/send',data:'e='+encodeURI($(this).val()),success:function(d){$('input[value='+d+']').parent().fadeOut();}});
		});
	} else gst.message("No any contacts imported to invite.",7);
}
	}
var inV = new invite();
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>