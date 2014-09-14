<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var slam = function()
{	wwSlm = "<?=WWW_ROOT?>slam/";	naviSlm = null;
	slmLT = gst.lansTrans();
}
slam.prototype = {
init:function(uri)
{	gst.hideBody();
	if(!gst.gE("slamH"))
	{	dU = gst.cE();$("<h2/>").attr({"id":"slamH"}).html((uabbr?uabbr['n']+"'s":"My")+" slambook").appendTo(".cA div span");
		$(dU).attr("id","slam").prependTo(".c .cB"); h3 = gst.cE("h3");$(h3).attr({"id":"sNav"}).appendTo(dU);
		$.getJSON(wwSlm+"navi/of/"+uid,function(d){naviSlm=d;for(i=0;i<naviSlm.length;i++)$(slM.navL(naviSlm[i])).appendTo(h3);slM.navExe(uri)});
	}else{this.navExe(uri);$("#slam").fadeIn("fast");$("#slamH").fadeIn("fast");}
},
post:function(u)
{	r='post'; if($('#slam #'+r+' ul').length>0)$('#slam #'+r+' ul:first').css({"display":"block"});
	else{	$.getJSON(wwSlm+r+(uid?"/of/"+uid:""),function(d)
			{	if(d['HTML'])
				{	$("#slam #"+r).html(d['HTML']);
				}	Ul = $("<ul>").appendTo("#slam #"+r);idAry=new Array();
				$.each(d['QA'],function(i,item){idAry[i]="slm_que_"+item[0];slM.addQA(item,d['QA'].length-i);});
				slmLT.makeTransliteratable(idAry);//gst.addPageing(Ul,9);
			});
		}
},
addQA:function(item,ti)
{	c = "#333"; Li = $("<li>").css({"color":c}).html("<strong>"+item[1]+"</strong>").prependTo("#post ul:first");
	$("<textarea>").css({"border-color":c}).val(item[2]?item[2]:"").attr({"id":"slm_que_"+item[0],"tabindex":ti}).focus(function()
	{	$($(this).parents().eq(0)).css({"color":"#008FD1"}); $(this).css({"border-color":"#008FD1"});
	}).blur(function()
	{	gst.msg='Saving'; c = "#333";$($(this).parents().eq(0)).css({"color":c}); $(this).css({"border-color":c});
		if($(this).val()!='') $.post(wwSlm+"answer",{"q":item[0],"of":uid,"ans":$(this).val()},function(d){eval(d)})
	}).appendTo(Li); atr = {"name":"radio_"+item[0],"type":"radio"};
	inpA = $("<input>").attr(atr).prependTo($("<label>").html("&nbsp;Public").appendTo(Li).click(function(){$.post(wwSlm+"property",{"q":item[0],"of":uid,"p":"B"})})); 
	inpB = $("<input>").attr(atr).prependTo($("<label>").html("&nbsp;Private").appendTo(Li).click(function(){$.post(wwSlm+"property",{"q":item[0],"of":uid,"p":"A"})}));
	gst.langMenu(Li,slmLT,'slmLT');	if(item[3]=='A')$(inpB).attr({"checked":"true"}); else $(inpA).attr({"checked":"true"});
},
recived:function(u)
{
	this.evalNav(u);
},
sent:function(u)
{
	this.evalNav(u);
},
requested:function(u)
{
	this.evalNav(u);
},
evalNav:function(u)
{
	u = u.split('/'); if(u[2]) this.show(u); else this.push(u[1]);
},
show:function(u)
{	ref = '#slam #'+u[1]; id = 'slam_'+u[1]+'_'+u[2]; $(ref+' ul:first').css({"display":"none"});
	if(gst.gE(id))$('#'+id).css({"display":"block"});else
	{	vD=$("<div>").addClass('vSlam').attr({"id":id}).appendTo(ref);$.getJSON(wwSlm+'grab/for/'+u[1]+'/ref/'+u[2]+(uid?"/of/"+uid:""),function(d)
		{	if(d.HTML)$(ref+' #'+id).html(d.HTML); $.each(d.data,function(i,item){slM.addSlam(item,id);});gst.navs();
			$(vD).find('.rub').click(function(){	if(confirm('Sure to erase this slam page?'))
													{	 $.post(wwSlm+'delete',{'ref':u[2]},function(d){eval(d)});
														 $(id).fadeOut(function(){$(this).remove()});
													}
												})
		});
	}
},
addSlam:function(item,id)
{
	Div = $("<div>").html("<strong>"+item[1]+"</strong>");
	$("<span>").html(item[2]?item[2]:"No answer.").appendTo(Div);
	if(!item[2])$(Div).animate({"opacity":".5"}); $(Div).appendTo('#'+id);
},
push:function(r)
{	ref = '#slam #'+r; uf = ' ul:first'; $(ref+' .vSlam').css({"display":"none"}); if($(ref+uf).length>0)$(ref+uf).css({"display":"block"});
	else{$("<ul>").prependTo('#slam #'+r);$.getJSON(wwSlm+r+(uid?"/of/"+uid:""),function(d)
	{	if(d.HTML)$(ref+uf).html(d.HTML); $.each(d.data,function(i,item){slM.addUser(item,r);});gst.navs();
	});}
},
addUser:function(item,r)
{	
	Li = gst.cE('li'); Sp = gst.cE('span'); diV = gst.cE();
	$(Li).hover(function(){$(this).css({"background":"#f5f5f5"})},function(){$(this).css({"background":""})}).addClass("_"+item.uid);
	P = $("<p>").appendTo(Li); href = '#slams/'+r+'/'+item.uid;
	$("<img>").addClass("iB").attr({"src":img+'user/icon/'+item.image,"align":"absmiddle"}).appendTo(P);
	if(r!='requested')$("<img>").attr({"src":img+'view.png'}).appendTo($("<a>").addClass("fr wa").attr({"href":href}).appendTo(P));
	$("<a>").addClass("bio wa").attr({"href":www+"bio/"+item.uid}).html(item.name).appendTo(diV);
	$(diV).append(gst.tN(item.scrap)).appendTo(Li); $(gst.tN(item.timestamps)).appendTo(Sp); $(Sp).appendTo(diV);
	$(Li).appendTo('#slam #'+r+' ul:first');
},
navExe:function(uri)
{	if(uri.match('/'))
	{	try{uD = uri.split('/')[1];
			$("#slam .std").removeClass("std");
			$("#slam form").css({"display":"none"});
			for(i=0;i<naviSlm.length;i++)if(naviSlm[i].b==uD)
			{	if(gst.gE(uD))$('#'+uD).show();	else $("<form>").attr({"id":uD}).appendTo("#slam");
				eval("this."+uD+"('"+uri+"')"); $($("#slam a").eq(i)).addClass("std");
			}
		}catch(e){alert(e);}
	}
},
navL:function(t)
{	A = gst.cE("a");
	$(A).attr({"href":"#slams/"+t.b}).addClass("wa").click(function(){$(this).addClass("std");slM.navExe($(this).attr("href"));});	$("<span>").addClass("wa").html(t.a).appendTo(A);
	return A;
},
custom:function()
{	r='custom'; if($('#slam #'+r+' ul').length>0)$('#slam #'+r+' ul:first').css({"display":"block"});
	else{		$.getJSON(wwSlm+r+(uid?"/of/"+uid:""),function(d)
				{	if(d['HTML'])$("#slam #"+r).html(d['HTML']);
				 	Ul = $("<ul>").appendTo("#slam #"+r);
					$.each(d['QA'],function(i,item){slM.addCustomQ(item)});
					$.getScript(www+'js/custom/',slM.makeDragable)
				});
		}
},
makeDragable:function()
{
	$('#slam #custom li div').unbind().bind('drag',function(e){$(this).css({top:e.offsetY})})
	.bind('dragstart',function(e){if(!$(e.target).is('.x'))return false; return $(this).css({'opacity':.5,'position':'absolute'}).clone().css({'position':'relative'}).insertAfter(this);})
	.bind('dragend',function(e){$(e.dragProxy).remove();$(this).css({'position':''}).animate({top:e.offsetY,opacity:1})});
	$('#slam #custom li').unbind().bind('dropstart',function(e){if(this==e.dragTarget.parentNode)return false;$(this).animate({'opacity':.1})})
	.bind('drop',function(e)
	{	fD=$(this).find('div:first');
		$(e.dragTarget.parentNode).append(fD.clone()).animate({opacity:.1},function(){$(this).animate({opacity:1},function(){slM.updateBook()})});fD.remove();$(this).append(e.dragTarget);
		slM.makeDragable();
	}).bind('dropend',function(e){$(this).animate({opacity:1})});
},
updateBook:function()
{	gst.msg = "Saving";
	odr={};$('#slam #custom li div').each(function(i){odr[i]=$(this).attr('id');});$.post(wwSlm+'rearrange',odr);
},
addCustomQ:function(item)
{	
	dIv = $("<div>").attr({'id':item[0]}).addClass("x").html(item[1]+' ').appendTo($("<li>").prependTo("#custom ul:first"));
	$("<a>").addClass('wa').attr({"href":"javascript:;"}).html("[delete]").appendTo(dIv).click(function(){
	$(this).parents().eq(1).fadeOut(function(){$(this).remove();slM.updateBook();});
	});
}
				};
slM = new slam();
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>