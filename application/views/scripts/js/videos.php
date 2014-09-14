<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var vidO = function()
{
	yTKey = 'AI39si61GHOUa4QCvosb1BXlgVk-K0h739H_WD0C8qamk6FEdRta-qWhvSuhc6h6BJ9LeKd7hgs2BXKb0QWUL3ROoNNwkCaWlw';
	yTCId = '';
}
vidO.prototype = {
init:function(u)
{	gst.hideBody();
	if(!gst.gE("videosH"))
	{	
		tH = $('<div>').attr({"id":"videosH"});
		if(!uid)
		{	$(tH).load(www+"videos/get/html/true",function(){vdO.postVideo()});
		} else $("<h2 />").html((uabbr?uabbr['p']:'My')+' videos').appendTo(tH);
		$(tH).appendTo(".cA div span");	$("<div>").attr("id","videos").prependTo(".c .cB"); $("<ul>").appendTo("#videos");
		$.getJSON(www+"videos/get/"+(uid?"of/"+uid:""),function(data){$.each(data,function(i,item){vdO.addVideo(item)})});
	}
	else
	{
		$("#videosH").fadeIn("fast");
		$("#videos").fadeIn("fast");
	}
},
postVideo:function()
{	
	I = $('#videosH .tBc input');
	$('<img>').click(function()
					{	if($(I).attr('title')==$(I).attr('value') || $(I).attr('value')=='')
						{
							gst.message('Please insert an URL',7);
						}
						else
						{	
							vdO.submitVideo($(I).attr("value"));
							$(I).attr({"value":$(I).attr('title')});
						}
					}).attr({"src":img+"add.png"}).css({'cursor':'pointer','margin-top':'20px'}).appendTo($('#videosH .tBr'));
},
submitVideo:function()
{
	gst.msg = 'Adding video';
	$.getJSON(www+'videos/add',{"URL":$('#videosH .tBc input').val()},function(d)
	{	
		gst.message(d.m,7,d.t);
		if(d.d)vdO.addVideo(d.d,true);
	})
},
addVideo:function(item,e)
{	
	Li = gst.cE('li');
	$(Li).hover(function(){$(this).css({"background":"#f5f5f5"})},function(){$(this).css({"background":""})});
	$("<img>").attr('src',img+'ytBig.png').css('background','#000 url(http://i3.ytimg.com/vi/'+item.url+'/hqdefault.jpg) no-repeat center center').appendTo($("<a>").addClass('ytPl').attr('href','javascript:;').click(function(){gst.ytPlay(item.url)}).appendTo($("<div>").addClass('vImg').appendTo(Li)));
	Cd = $("<div>").addClass('vDesc fr').appendTo(Li); $('<div>').html('<strong>'+item.title+'</strong>'+item.details).appendTo(Cd);
	$('<span>').html('Added '+item.timestamps).appendTo(Cd);
	if(uExt==item.uid)$("<a>").addClass("del wa fr").attr({"href":"javascript:;","id":item.id}).html("[delete]")
					.click(function()
							{	gst.msg = 'Deleting';
								$.post(www+"videos/delete",{"id":$(this).attr("id")},function(){gst.message('Video deleted.',5,'success')});
								$($(this).parents().eq(1)).animate({"height":($(this).height()+300)+"px"}).slideUp("fast");
							}).prependTo(Cd);
	$(Li).prependTo('#videos ul');
}
				};
vdO = new vidO();
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>