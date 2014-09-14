<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var setting = function()
{	wwSet = "<?=WWW_ROOT?>settings/"; stngLT = gst.lansTrans();
	naviSet = eval(([{"a":"Personal","b":"personal"},{"a":"Social","b":"social"},{"a":"Change Photo","b":"picture"}
				  /*{"a":"Privacy","b":"privacy"},
				  {"a":"Professional","b":"professional"},
				  {"a":"Notification","b":"notification"}*/]));
}
setting.prototype = {
init:function(uri)
{	gst.hideBody();
	if(!gst.gE("settingH"))
	{	dU = gst.cE();
		$("<h2/>").attr({"id":"settingH"}).html("My account settings").appendTo(".cA div span");
		$(dU).attr("id","setting").prependTo(".c .cB");	
		h3 = gst.cE("h3"); $(h3).attr({"id":"sNav"}).appendTo(dU);
		for(i=0;i<naviSet.length;i++)$(this.navL(naviSet[i])).appendTo(h3);
	}
	else
	{	$("#setting").fadeIn("fast");
		$("#settingH").fadeIn("fast");
	}
	this.navExe(uri);
},
personal:function()
{
	this.postForm("personal");
},
privacy:function()
{
},
social:function()
{
	this.postForm("social");
},
professional:function()
{
},
notification:function()
{
},
postForm:function(a)
{	arY = ''; i=0;  gst.msg='Saving';
	$("#setting #"+a+" :input").each(function(){if(($(this).attr("type")=="checkbox" && $(this).attr("checked")==true) || ($(this).attr("type")!="checkbox"))arY += $(this).attr("name")+'='+$(this).attr("value")+'&';});
    $.ajax({type:"POST",url:wwSet+a,data:arY,success:function(d){eval(d)}});
},
navExe:function(uri)
{	if(uri.match('/'))
	{	try{uD = uri.split('/')[1];
			$("#setting .std").removeClass("std");
			$("#setting form").css({"display":"none"});
			for(i=0;i<naviSet.length;i++)if(naviSet[i]['b']==uD)
			{	if(gst.gE(uD))$('#'+uD).show();	else 
				$("<form>").load(wwSet+uD,function()
				{	$('#'+uD+' dd a img').click(function(){eval("seT."+uD+"('"+uri+"')");});
					stngLT.makeTransliteratable($('#'+uD+' dd textarea'));
					$('#'+uD+' dd').each(function(){if($(this).find('textarea').length>0)gst.langMenu($(this),stngLT,'stngLT')})
				}).attr({"id":uD}).appendTo("#setting");
				$($("#setting a").eq(i)).addClass("std");
			}
		}catch(e){alert(e);}
	}
},
navL:function(t)
{	A = gst.cE("a");
	$(A).attr({"href":"#settings/"+t.b}).addClass("wa").click(function(){$(this).addClass("std");seT.navExe($(this).attr("href"));});	$("<span>").addClass("wa").html(t.a).appendTo(A);
	return A;
}				};
seT = new setting();
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>