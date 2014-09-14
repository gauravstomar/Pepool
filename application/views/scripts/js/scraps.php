<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var scraps = function()
{
	wwSp = "<?=WWW_ROOT?>scrap/";
	wwSu = (uid?"/of/"+uid+"/":"");
	scrpLT = gst.lansTrans();
}
scraps.prototype = {
init:function(uri)
{	gst.hideBody();
	if(!gst.gE("scrapH"))
	{	
		Ul = gst.cE("ul");
		$(Ul).attr({"id":"scrapH"}).appendTo(".cA div span");
		$("<li>").addClass("l").html("<h2>"+(uabbr?uabbr['p']:'My')+" scraps</h2>").appendTo(Ul);
		$("<option>").appendTo($("<select>").change(function(){
			if($(this).val()=="all")$("#scrap #_vS li").css({"display":"block"});
			else
			{	$("#scrap #_vS li").css({"display":"none"});
				$("#scrap #_vS ._"+$(this).val()).css({"display":"block"});
			}
		}).appendTo($("<li>").addClass("r").appendTo(Ul)).addClass("f11")).html("all");
		$("<li>").addClass("r f11").html("<strong>from:</strong>").appendTo(Ul);
		$("<div>").attr({"id":"scrap"}).prependTo(".c .cB"); U2 = gst.cE("ul");
		$.getJSON(wwSp+"scraper"+wwSu,function(data){$.each(data,function(i,item){$("<option>").attr({"value":item.i}).html(item.j).appendTo("#scrapH .r select")})});
		$(U2).attr({"id":"_pS"}).addClass('pS').prependTo("#scrap"); $("<li>").addClass("t").appendTo(U2); Li = $("<li>").addClass("m").appendTo(U2);
		$('<input>').addClass('wa').attr({'type':'checkbox'}).prependTo($('<label>').addClass('wa').html('Private').appendTo(Li));
		scrpLT.makeTransliteratable($("<textarea>").attr({"rows":"5","rel":uid?uid:uExt}).prependTo(Li)); gst.langMenu(Li,scrpLT,'scrpLT');
		$("<img>").click(scraP.postScrap).addClass('fr').css({"cursor":"pointer"}).attr({"src":img+"post.gif"}).appendTo(Li);
		$("<li>").addClass("b").appendTo(U2); $("<ul>").attr({"id":"_vS"}).addClass('vS').appendTo("#scrap");
		$.getJSON(wwSp+"get"+wwSu,function(data){$.each(data,function(i,item){scraP.add(item)})});
	}
	else
	{	$("#scrap").fadeIn("fast");
		$("#scrapH").fadeIn("fast");
	}
},
add:function(item,e)
{	
	Li = gst.cE('li'); Sp = gst.cE('span'); diV = gst.cE();
	$(Li).hover(function(){$(this).css({"background":"#f5f5f5"})},function(){$(this).css({"background":""})}).addClass("_"+item.uid);
	$("<img>").addClass("iB").css({"float":"left"}).attr({"src":img+'user/icon/'+item.image,"align":"absmiddle"}).appendTo(Li);
	$("<p>").html('<br />'+item.scrap).appendTo($(diV).appendTo(Li));
	$("<a>").attr({"href":www+"bio/"+item.uid}).html('<strong>'+item.fname+' '+item.lname+'</strong>').prependTo(diV);
	diB = $('<div>').appendTo(diV); $(Sp).html((item.privacy=='Y'?'(private scrap) ':'')+item.timestamps).addClass('time wa').appendTo(diB);
	if(item.d){$("<a>").attr({"href":"javascript:;","id":item.id}).html("[delete]").click(function(){if(!confirm('Sure to delete your scrap?'))return false;$.post(wwSp+"delete"+wwSu,{"id":$(this).attr("id")});$($(this).parents().eq(2)).slideUp("fast");gst.message('Scrap deleted.',5,'success');}).appendTo(diB);}
	if(item.r){$("<a>").attr({"href":"javascript:;"}).click(function(){
		pnLi = $(this).parents().eq(2);	Cl = $(pnLi).find('.pS');
		if(!Cl.length>0)
		{	Cl = $('#scrap #_pS').clone(); scrpLT.makeTransliteratable($(Cl).find('textarea').attr('rel',item.uid));
			$(Cl).find('.scrpLT').remove();	gst.langMenu($(Cl).find('.m'),scrpLT,'scrpLT');
			$(Cl).find('img').click(scraP.postScrap); $(Cl).attr('id','').appendTo(pnLi).slideDown();
		} else Cl.slideToggle();
	}).html("[reply]").appendTo(diB);}
	if(e)$(Li).prependTo('#scrap #_vS').fadeOut("slow").fadeIn("slow");else $(Li).appendTo('#scrap #_vS');
},
postScrap:function()
{	tArea = $(this).parent().find('textarea'); vaL = $(tArea).val(); $(tArea).val("");
	if(vaL=='') gst.message('Please add or write something to be scraped.',7); else
	{	gst.msg = "Posting"; pBuser = $(tArea).attr('rel');
		$.post(wwSp+'add',{"scrap":vaL,"id":pBuser,"privacy":$($(this).parent().find('input[type=checkbox]')).attr("checked")==true?'Y':'N'},function(data){gst.message('Scrap posted.',7,'yeppe');
		if(pBuser==uid)scraP.add(eval('('+data+')'),true)});
	}
	$('.vS .pS').slideUp();
}
				};
scraP = new scraps();
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>