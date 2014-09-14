<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var gt = function()
{	piC = vdO = ajax = twtLT = uabbr = uid = inV = slM = frnD = scraP = seT = upDt = null; iBoxcW = 50;
	www='<?=WWW_ROOT?>';img='<?=IMAGES?>';wH=$(window).height();wW=$(window).width();
	uExt = '<?=encode($this->user['id'])?>'; pArtPp = 200;
}
gt.prototype = {
init:function(i)
{	$("#cVr").fadeOut(function(){$("#cVr").css({"width":"1px","position":"absolute","display":"block"})});
	$('#W8').ajaxSend(this.ajaxBegain).ajaxStart(this.ajaxBegain).ajaxStop(this.ajaxOver).ajaxSuccess(this.ajaxOver).ajaxError(this.ajaxErrorHandle);
	$('.helpus').css({'opacity':'.3'}); $('.help').fadeIn();
	if(gst.gE('Ba'))
	{	if(i['id']){uid = i['id']; uabbr = i;} this.userImg(); this.exeNav();
		$.getJSON(www+"tweet/get/"+(uid?"of/"+uid:"")+"?limit=1",function(d){gst.setTweet(d.length>0?d[0]['tweet']:"Let's make fun with pepool")});
		$("#profile dt:odd,#profile dd:odd").css({"background":"#eefaff"});
	}
},
msg:"Loading",
lansTrans:function(){return new google.elements.transliteration.TransliterationControl({sourceLanguage:'en',destinationLanguage:gst.langs,shortcutKey:'ctrl+g',transliterationEnabled:false})},
langs:['ar','bn','fa','gu','hi','kn','ml','mr','ne','pa','ta','te','ur'],
langMenu:function(obj,cls,id)
{	S = $('<select>').addClass(id).change(function(){$('.'+id).val($(this).val());cls.disableTransliteration();if(cls.setLanguagePair('en',$(this).val()))cls.enableTransliteration()}).appendTo(obj);
	$.each({'English':'en','Hindi':'hi','Arabic':'ar','Bengali':'bn','Gujarati':'gu','Kannad':'kn','Malayalam':'ml','Marathi':'mr','Nepali':'ne','Persian':'fa','Punjabi':'pa','Tamol':'ta','Telugu':'te','Urdu':'ur'},function(k,v){$('<option>').val(v).html(k).appendTo(S);});
},
ajaxBegain:function()
{
	$('#W8').addClass('W8').html('<strong>'+gst.msg+'</strong>').fadeIn();
	ajax = setTimeout(gst.ajaxReport,9999);
},
ajaxReport:function()
{
	if($('#W8').css('display')!='none')
	{
		//$('#W8').html('<strong>Still Working...</strong>');
		//gst.message('Try to reload the page.<br />We are experiencing technical difficulties that may prevent your request from being sent.');
	}
},
ajaxOver:function()
{
	$('#W8').fadeOut(); gst.msg = "Loading"; clearTimeout(ajax);
	gst.navs();
},
ajaxErrorHandle:function(e,XMLHttpRequest,ajaxOptions,thrownError)
{
	ret='<strong>Error in processing request</strong>';<?
//	ret+='<br /><br /><strong>Thrown Error:</strong> '+thrownError+'<br />Event: ';
//	$.each(e,function(k,v){ret+=' '+k+' => '+v;});
//	ret+='<br />XMLHttpRequest: '+XMLHttpRequest+'<br />Ajax Options: '+ajaxOptions.url
	?>$('#W8').removeClass('W8').html(ret).css('display','block');
},
setTweet:function(t)
{
	$("#profileH").html(t.length>42?t.substr(0,42)+'...':t);
	if(!uid)$("<a>").attr("href","javascript:;").html("[post&nbsp;new]").appendTo("#profileH")
			.click(function()
						{
							gst.loadTweetHeader();
						})
			.addClass('addNew').animate({"fontSize":"10px"});
},
dLoad:function(iD)
{	oFF = $(iD).offset();
	$("<img>").css({"position":"fixed","top":(oFF.top+10)+"px","left":(oFF.left+10)+"px"}).attr({"src":img+"loading.gif","id":"tempLoadingImg"}).appendTo("body");
},
userImg:function()
{
	$("#Ba div").hover(function(){off = $(this).offset();$("#Ba iframe").css({"left":(off.left+$(this).height()/4)+"px","top":(off.top+$(this).height()-20)+"px"}).fadeIn()},function(){$("#Ba iframe").css({"display":"none"})});
},
isImg:function(o)
{	validformFile = /(.jpg|.JPG|.jpeg|.JPEG|.gif|.GIF)$/;
	return validformFile.test(o.value);
},
xBox:function(H,iD)
{	$('.xB').css('display','none'); if(!iD) iD = gst.randStr();
	if(!this.gE(iD))
	{	$("<div>").addClass("l x bx xBox").attr({"id":"xBox"}).prependTo("body");
		$("<dl>").attr({"id":iD}).addClass("xB").appendTo("body");iD = "#"+iD;
		$("<dt>").addClass("tL").appendTo(iD);$("<dd>").addClass("tR").appendTo(iD);
		$("<dt>").appendTo(iD); $("<dd>").css({"padding":"5px"}).html(H).appendTo(iD);
		$("<dt>").addClass("bL").appendTo(iD);$("<dd>").addClass("bR").appendTo(iD);
		$("<a>").css({"height":"13px","width":"13px","top":"-10px","right":"-10px","background":"url("+img+"xBexit.png)","position":"absolute"}).attr({"href":"javascript:;"}).hover(function(){$(this).css({"background-position":"0 13px"})},function(){$(this).css({"background-position":"0 0"})}).click(function(){$($(this).parent()).remove()}).appendTo(iD);
		$(iD).css({"position":"fixed","top":(($(window).height()/2)-($(iD).innerHeight()/2))+"px","left":((($(window).width()/2)-($(iD).innerWidth()/2))+"px")});
	}else $(this.gE(iD)).css('display','block');
},
randStr:function()
{
	chars="abcdefghiklmnopqrstuvwxyz";sL=8;randomstring='temp_';
	for(i=0;i<sL;i++){rnum=Math.floor(Math.random()*chars.length);randomstring+=chars.substring(rnum,rnum+1);}
	return randomstring;
},
randColor:function()
{
	rint = Math.round(0xffffff * Math.random());
	return ('#0' + rint.toString(16)).replace(/^#0([0-9a-f]{6})$/i, '#$1');
},
exeNav:function(uri)
{	if(!uri)uri=window.location.hash;else window.location.hash=uri;
	if(uri.match('#'))
	{	uri = uri.replace('#','');
		$('.l .std,.r .std').removeClass('std');
		$('a[href=#'+uri+']').addClass('std');
		try{eval("gst."+uri.split('/')[0]+"('"+uri+"')");}
		catch(e){/*alert(e);*/}
	}
},
navs:function()
{	$('a').each(function()
	{	href = $(this).attr('href');if($(this).hasClass('iBox'))$(this).unbind().click(function(){gst.iBox($(this).attr('href'));return false;});
		if(href!='javascript:;' && !$(this).hasClass('x') && href.match('#'))$(this).unbind().click(function(){gst.exeNav($(this).attr('href'));return false;})
		if($(this).hasClass('ytPs'))$(this).click(function(){gst.ytPlay($(this).attr('rel'))})
	});
	$('.frnd').unbind().click(function(){o=$(this);if($(o).hasClass('wf'))gst.message('Your request is waiting for approval');else $.getJSON(www+"users/friends",{"json":"y","act":$(o).attr("rel")},function(d){$(o).attr({"class":d[0],"rel":d[2]}).html(d[1]);})})
	$('.rs').unbind().click(function(){o=$(this);if($(o).hasClass('wf'))gst.message('Your request is waiting for approval');else $.getJSON(www+"slam/request",{"json":"y","u":$(o).attr("rel")},function(d){$(o).attr({"class":d[0],"rel":d[2]}).html(d[1]);})});
	if(inV)inV.navs();
	$('input[type=text],textarea').unbind('focus',gst.pArt).unbind('blur',gst.pArtHide);
	$('input[type=text],textarea').bind('focus',gst.pArt).bind('blur',gst.pArtHide);
},
pArtL:1,
pArt:function()
{	<? if($this->user['id']>0){?>
	gst.PArtTarget = $(this); O = gst.PArtTarget.offset();
	$('<img>').attr({'src':img+'part.png'}).addClass('pButton').css({'cursor':'pointer','position':'absolute','top':(O.top-30)+'px','left':(O.left+gst.PArtTarget.outerWidth()-20)+'px'}).click(gst.showPArt).appendTo("body");
	<? }?>
},
pArtHide:function()
{
	$('.pButton').fadeOut(function(){$(this).remove()});
},
showPArt:function()
{	
	cP = gst.pArtL; iD = 'PArt-'+cP;
	if(!gst.gE(iD))
	{	Div = $('<div>').addClass('pArt'); DBx = $('<div>').css({'overflow':'hidden','height':'222px'}).appendTo(Div);
		$.post(www+'index/part',{'a':cP,'b':pArtPp},function(d){d=d.split(',');
		$.each(d,function(k,v){$('<p>').html(v).appendTo(DBx).hover(function(){$(this).addClass('pAa')},function(){$(this).removeClass('pAa')})
								.click(function(){
									rge = gst.PArtTarget.getSelection(); val = gst.PArtTarget.val();
									val = (val.substring(0,rge.start)+val.substring(rge.start+((gst.PArtTarget.get(0).checked)?rge.text.whitespace():rge.text).length,val.length));
									gst.PArtTarget.val(val.substring(0,rge.start)+$(this).html()+val.substring(rge.start,val.length));
									gst.PArtTarget.setCursorPosition(rge.start+1);})})
		PagD = $('<div>').css({'overflow':'hidden'}).appendTo(Div);
		$('<span>').addClass('wa time').html('Some characters are not compatible to your browser').appendTo(PagD);
		$('<a>').attr('href','javascript:;').html('more&raquo;').addClass('wa fr').click(gst.showPArt).appendTo(PagD);
		if(cP>=pArtPp)$('<a>').attr('href','javascript:;').addClass('wa fr').html('&laquo;back').click(gst.showPArtPrev).appendTo(PagD);
								});
	}
	gst.xBox(Div,iD); O = gst.PArtTarget.offset();
	$('#'+iD).css({'position':'absolute','top':(10+O.top+gst.PArtTarget.outerHeight())+'px'});
	
	gst.pArtL = cP+pArtPp;
},
PArtTarget:null,
showPArtPrev:function()
{
	gst.pArtL = gst.pArtL-pArtPp;
	gst.xBox('','PArt-'+(gst.pArtL-pArtPp));
},
gH:function(tH)
{
	$(".c .cB").animate({"height":$(tH).outerHeight()+"px"});
},
loadTweetHeader:function()
{	this.hideHead();
	if(!this.gE("tweetH"))
	{	tH = $(this.cE()).attr({"id":"tweetH"}); H2 = (uabbr?uabbr['p']:'My')+" Previous Tweets"; 
		if(!uid)
		{	$(tH).load(www+"tweet/get/html/true",function(){gst.postTweet()});
			if(gst.gE('tweet'))$("<h2 />").html(H2).appendTo("#tweet");
		} else $("<h2 />").html(H2).appendTo(tH); $(tH).appendTo(".cA div span");
	}
	else
	{
		$("#tweetH").fadeIn("fast");
	}
},
tweets:function()
{
	this.hideBody();this.loadTweetHeader();
	if(!this.gE("tweet"))
	{
		$(this.cE()).attr("id","tweet").prependTo(".c .cB"); $(this.cE("ul")).appendTo("#tweet");
		$.getJSON(www+"tweet/get/"+(uid?"of/"+uid:""),function(data){$.each(data,function(i,item){gst.addTweet(item)})});
	}
	else $("#tweet").fadeIn("fast");
},
postTweet:function()
{	twtLT = this.lansTrans(); gst.langMenu($('#tweetH .tBr'),twtLT,'twtLT');
	I = $('#tweetH .tBc input'); twtLT.makeTransliteratable(I);
	$('<img>').click(function()
					{	if($(I).attr('title')==$(I).attr('value') || $(I).attr('value')=='')
						{
							gst.message('Please tweet something.',7);
						}
						else
						{	
							gst.updateTweet($(I).attr("value"));
							$(I).attr({"value":$(I).attr('title')});
						}
					}).attr({"src":img+"update.png"}).css('cursor','pointer').appendTo($('#tweetH .tBr'));
},
updateTweet:function(t)
{
	gst.msg = 'Tweeting';
	$.getJSON(www+'tweet/add',{"tweet":t},function(d)
	{	gst.message('Your new tweet is distributed among your friends.',7,'yeppe');
		if(gst.gE("tweet"))gst.addTweet(d,true);
		if(gst.gE("profileH"))gst.setTweet(t);
		if($('#profile').css('display')!='none'){gst.hideHead();$('#profileH').fadeIn();}
	})
},
addTweet:function(item,e)
{	
	Li = gst.cE('li'); Sp = gst.cE('span');
	$(Li).hover(function(){$(this).css({"background":"#f5f5f5"})},function(){$(this).css({"background":""})});
	$("<div>").html(gst.tN(item.tweet)).appendTo(Li); $(gst.tN('Posted '+item.timestamps)).appendTo(Sp); $(Sp).appendTo(Li);
	if(uExt==item.uid)$("<a>").addClass("del").attr({"href":"javascript:;","id":item.id}).html("[delete]")
								.click(function()
										{	$.post(www+"tweet/delete",{"id":$(this).attr("id")});
											$($(this).parent()).animate({"height":($(this).height()+50)+"px"}).slideUp("fast");
											gst.message('Your tweet deleted.',5,'success');
										}).appendTo(Li);
	$(Li).prependTo('#tweet ul');
},
friends:function(u)
{	if(!frnD) $.getScript(www+"js/friend",function(){frnD.init(u)})
	else frnD.init(u);
},
more:function(u)
{	

	this.hideBody();
	this.hideHead();

	if(!this.gE("moreH"))
	{
		$("<h2 />").html("More fun stuffs..").appendTo($(this.cE()).attr({"id":"tweetH"}).appendTo(".cA div span"));
	}
	else
	{
		$("#moreH").fadeIn("fast");
	}
	
	if(!this.gE("more"))
	{
		$("<div>").css({"height":"300px"}).appendTo($(this.cE()).attr("id","more").prependTo(".c .cB").load(www+"users/more"));
	}
	else
	{
		$("#more").fadeIn("fast");
	}

},
slams:function(u)
{	if(!slM) $.getScript(www+"js/slam",function(){slM.init(u)})
	else slM.init(u);
},
scraps:function(u)
{	if(!scraP) $.getScript(www+"js/scraps",function(){scraP.init(u)})
	else scraP.init(u);
},
photos:function(u)
{	if(!piC) $.getScript(www+"js/pics",function(){piC.init(u)})
	else piC.init(u);
},
videos:function(u)
{	if(!vdO) $.getScript(www+"js/videos",function(){vdO.init(u)})
	else vdO.init(u);
},
community:function()
{
	this.hideBody();
	alert("mebo");
},
updates:function(u)
{	if(!upDt) $.getScript(www+"js/updates",function(){upDt.init(u)})
	else upDt.init(u);
},
profile:function()
{
	this.hideBody();
	$("#profileH").fadeIn("fast");
	$("#profile").fadeIn("fast");
},
invite:function(u)
{
	if(!inV) $.getScript(www+"js/invite",function(){inV.init(u)})
	else inV.init(u);
},
search:function()
{
	this.hideBody();
	if(!this.gE("searchH"))
	{
		$("<h2 />").html("Search for friends on pepool").appendTo(".cA div span").attr({"id":"searchH"});
		$(this.cE()).attr("id","search").load(www+'users/search/',function(){
		
		$(".reset").click(function(){$("#userSearch :input").val("")})
		$("a.hyper").click(function(){$("#userSearch p.hyper").slideToggle()})
		$("#sButton").click(function(){
			arY='';$("#userSearch :input").each(function(){if($(this).attr("value")!='')arY += $(this).attr("name")+'='+$(this).attr("value")+'&';});
			if(arY==''){gst.message('Please enter something to be searched');return false;}
			tGt = gst.gE(arY);$("#searchResult ul").hide("fast");
			if(tGt)$(tGt).show("fast");	else
			{	gst.msg = "Searching";
				$.ajax({type:"POST",url:www+'users/search/',data:arY,success:function(d){d=eval('('+d+')');
					uL = gst.cE("ul"); $(uL).attr({"id":arY}).appendTo("#searchResult");
					for(i=0;i<d.length;i++)
					{	dR = gst.cE("li"); $(dR).appendTo(uL);
						$("<img>").addClass("iB").attr({"src":img+"user/icon/"+d[i].i}).appendTo(dR);
						$("<a>").attr({"href":www+"bio/"+d[i].id}).html(d[i].u).appendTo(dR);
						$("<span>").html(d[i].a).appendTo(dR);
					}
				}});		
			} 	
		})}).prependTo(".c .cB");
	}
	else
	{
		$("#searchH").fadeIn("fast");
		$("#search").fadeIn("fast");
	}
},
iBox:function(uri)
{
	id = uri.replace(www,'').replace('/','-');
	if(this.gE(id)) this.iBoxShow(id); else
	{	LB = $('<div>').attr({"id":id}).addClass('lBox').appendTo('body'); c = '#'+id+' .m .c';
		$.each(['l','c','r'],function(i,c){uL=$('<div>').addClass(c).appendTo(LB);if(c!='c')$.each(['t','m','b'],function(ii,cc){$('<div>').addClass(cc).appendTo(uL)})});
		$(LB).animate({"top":(wH/2-iBoxcW)+"px","left":(wW/2-iBoxcW)+"px"});
		$('<div>').addClass('x').appendTo('#'+id+' .c').load(uri,function(){t=$(this).children().eq(0);w=$(t).css('width');h=$(t).css('height');
		$(LB).animate({"top":((wH/2)-(parseInt(h)/2+iBoxcW))+"px","left":((wW/2)-(parseInt(w)/2+iBoxcW))+"px"})
		$('#'+id+' .m,#'+id+' .c').animate({'height':h},function(){$('#'+id+' .c').animate({'width':w})})});
	}
},
iBoxShow:function(id)
{	$('#'+id+' .c .x').css('display','block');
	LB=$('#'+id).fadeIn();t=$($('#'+id+' .c .x').children().eq(0));w=$(t).css('width');h=$(t).css('height');
	$(LB).animate({"top":((wH/2)-(parseInt(h)/2+iBoxcW))+"px","left":((wW/2)-(parseInt(w)/2+iBoxcW))+"px"},function(){$('#'+id+' .m,#'+id+' .c').animate({'height':h},function(){$('#'+id+' .c').animate({'width':w})})})		
},
iBoxHide:function(id)
{
	if(this.gE(id))
	{	$('#'+id+' .c .x').css('display','none');
		$('#'+id+' .m,#'+id+' .c').animate({'height':'0'},function(){$('#'+id+' .c').animate({'width':'0'},function(){$('#'+id).animate({"top":(wH+iBoxcW)+"px","left":(wW+iBoxcW)+"px"},function(){$(this).css({"top":"-"+iBoxcW+"px","left":"-"+iBoxcW+"px","display":"none"})})})});
	}else $('.lBox').fadeOut();
},
visitors:function()
{
	this.hideBody();
	if(!this.gE("visitorH"))
	{
		$("<h2 />").html("My recent visitors").appendTo(".cA div span").attr({"id":"visitorH"});
		$(this.cE()).attr("id","visitor").prependTo(".c .cB");
		$(".c .cB").animate({"height":$(".c .cB").height()+"px"});
		$(this.cE("ul")).appendTo("#visitor");
		$.getJSON(www+"visitor/get",function(data){$.each(data,function(i,item){gst.addVisitor(item)})});
	}
	else
	{
		$("#visitorH").fadeIn("fast");
		$("#visitor").fadeIn("fast");
	}
},
addVisitor:function(d)
{
	alert(d);
},
settings:function(u)
{	if(!seT) $.getScript(www+"js/settings",function(){seT.init(u);})
	else seT.init(u);
},
hideBody:function()
{	this.hideHead();
	$(".c .cB").children().each(function(){$(this).css({"display":"none"});})
	$(".c .cB #loding").css({"display":"block","height":"100px"})<?
	//gst.gH(gst.gE("tweet"));?>
},
hideHead:function()
{
	$(".cA div span").children().each(function(){$(this).css({"display":"none"});})
},
message:function(m,t,c)
{	aT = 1000; c=c?c:"mBgT"; $(".tempMsg").fadeOut();
	var eM = $(this.cE()).addClass('tempMsg').css({"left":(($("body").width()/2)-150)+"px","top":"-200px","position":"fixed","width":"309px"});
	$(eM).prepend($(this.cE()).css({"background":"url("+img+"mBgB.gif)","height":"9px"}));
	$(eM).prepend($(this.cE()).html(m).css({"background":"url(<?=IMAGES?>mBg.gif) repeat-y","padding":"0 10px","color":"#ffffff","font-size":"14px"}));
	$(eM).prepend($(this.cE()).css({"background":"url("+img+c+".gif)","height":"32px"}));
	$("body").prepend($(eM));
	$(eM).animate({top:"25px"},aT).animate({top:"10px"},aT/2);
	if(t!='manual')
	{	t = t?t*1000:10000;
		setTimeout(function(){$(eM).animate({top:"25px"},aT/2).animate({top:"-500px"},aT)},t);
		setTimeout(function(){$(eM).remove()},t+(aT*2));
	}
},
tip:function()
{
	alert($(this).id);
},
gE:function(iD)
{
	return document.getElementById(iD);
},
cE:function(o)
{
	return document.createElement(o?o:"div");
},
tN:function(o)
{
	return document.createTextNode(o?o:" ");
},
<? /* addNavigator:function(Ul,limit)
{
	if(!Ul || !limit)return false;LiS = $(Ul).find("li"); $(LiS.eq(0)).addClass('navFirst');
	$(LiS.eq(limit-1)).addClass('navLast'); $(LiS.eq(limit-1)).nextAll().css({"display":"none"})
	$("<a>").addClass("scr navPrev").attr({"href":"javascript:;"}).html("Previous").prependTo(Ul).click(function(){
	p = $(this).parents(1); cur = p.find(".navFirst");$(cur).removeClass("navFirst");$($(cur).prev()).addClass("navFirst").slideDown();
	cur = p.find(".navLast");$(cur).removeClass("navLast").slideUp();$($(cur).prev()).addClass("navLast")
	if($(p.find("li:first")).hasClass("navFirst"))$(this).css({"visibility":"hidden"});
	else $(p.find(".navNext"),$(this)).css({"visibility":"visible"})}).css({"visibility":"hidden"});
	$("<a>").addClass("scr navNext").attr({"href":"javascript:;"}).html("Next").appendTo(Ul).click(function(){
	p = $(this).parents(1); cur = p.find(".navFirst");$(cur).removeClass("navFirst").slideUp();$($(cur).next()).addClass("navFirst");
	cur = p.find(".navLast");$(cur).removeClass("navLast");$($(cur).next()).addClass("navLast").slideDown();
	if($(p.find("li:last")).hasClass("navLast"))$(this).css({"visibility":"hidden"});
	else $(p.find(".navPrev"),$(this)).css({"visibility":"visible"})})
},*/?>
addPageing:function(Ul,limit)
{
	if(!Ul || !limit)return false; LiS = $(Ul).find("li");
	$(Ul).attr({"page":1,"limit":limit});
	
	$(LiS.eq(limit-1)).nextAll().css({"display":"none"});
	A = {"href":"javascript:;"};

	Prev = $("<a>").addClass("scr").attr(A).html("Previous").prependTo(Ul).css({"visibility":"hidden"}).click(function()
	{
		L = parseInt($(Ul).attr("limit")); P = parseInt($(Ul).attr("page")); from = (P*L)-L; to = from+L-1;
		LiS.each(function(i){if(i>=from && i<=to)LiS.eq(i).fadeIn();else LiS.eq(i).css('display','none');})
		Prev.css('visibility',from>0?'visible':'hidden'); Next.css('visibility',to>LiS.length?'hidden':'visible');
		$(Ul).attr({"page":from>0?P-1:P});
	});
	Next = $("<a>").addClass("scr").attr(A).html("Next").appendTo(Ul).click(function()
	{
		L = parseInt($(Ul).attr("limit")); P = parseInt($(Ul).attr("page")); from = P*L; to = from+L-1;
		LiS.each(function(i){if(i>=from && i<=to)LiS.eq(i).fadeIn();else LiS.eq(i).css('display','none');})
		Prev.css('visibility',from>0?'visible':'hidden'); Next.css('visibility',to>LiS.length?'hidden':'visible');
		$(Ul).attr({"page":to>LiS.length?P:P+1});
	})
},
ytPlay:function(url)
{
	this.xBox('<div style="width:480px;margin:10px 5px 5px 5px;"><object width="480" height="385"><param name="movie" value="http://www.youtube-nocookie.com/v/'+url+'&hl=en_US&fs=1&color1=0xdbf3fd&color2=0xdbf3fd&autoplay=1"></param><param name="allowFullScreen" value="false"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube-nocookie.com/v/'+url+'&hl=en_US&fs=1&color1=0xdbf3fd&color2=0xdbf3fd&autoplay=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="false" width="480" height="385"></embed></object></div>',url);

}
				};
gst=new gt();
(function(){var c={getSelection:function(){var e=this.jquery?this[0]:this;return(('selectionStart'in e&&function(){var l=e.selectionEnd-e.selectionStart;return{start:e.selectionStart,end:e.selectionEnd,length:l,text:e.value.substr(e.selectionStart,l)}})||(document.selection&&function(){e.focus();var r=document.selection.createRange();if(r==null){return{start:0,end:e.value.length,length:0}}var a=e.createTextRange();var b=a.duplicate();a.moveToBookmark(r.getBookmark());b.setEndPoint('EndToStart',a);return{start:b.text.length,end:b.text.length+r.text.length,length:r.text.length,text:r.text}})||function(){return{start:0,end:e.value.length,length:0}})()},replaceSelection:function(){var e=this.jquery?this[0]:this;var a=arguments[0]||'';return(('selectionStart'in e&&function(){e.value=e.value.substr(0,e.selectionStart)+a+e.value.substr(e.selectionEnd,e.value.length);return this})||(document.selection&&function(){e.focus();document.selection.createRange().text=a;return this})||function(){e.value+=a;return this})()}};jQuery.each(c,function(i){jQuery.fn[i]=this})})();new function($){$.fn.setCursorPosition=function(pos){if($(this).get(0).setSelectionRange){$(this).get(0).setSelectionRange(pos, pos);}else if($(this).get(0).createTextRange){var range=$(this).get(0).createTextRange();range.collapse(true);range.moveEnd('character', pos);range.moveStart('character', pos);range.select();}}}(jQuery);

<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>