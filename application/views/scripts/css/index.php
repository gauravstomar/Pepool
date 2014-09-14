<?php
ob_start("compress");
function compress($buffer) 
{
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}
header ("content-type: text/css; charset: UTF-8");
header ("cache-control: must-revalidate");
header ("expires: ".gmdate("D, d M Y H:i:s",time()+(60*60))." GMT");
if(1==2){?><style><? }?>
@charset "utf-8";
*{margin:0;padding:0;width:100%;font-family:Verdana, Helvetica, sans-serif;}
#W8,#cVr{width:1px;z-index:999;position:fixed;top:0;left:0;}
#W8{width:auto;left:45%;background:#FFF;}#cVr{height:900px;}
.W8{background:url(<?=IMAGES?>loading.gif) no-repeat!important;padding:1px 1px 1px 20px;margin-top:15px;color:#008FD1;}
body{font-size:12px;color:#2f2933;font-weight:normal;}
img{border:0}
a{text-decoration:none;outline:none!important;}
ul{list-style-type:none;}
h1,h2,h3{color:#008fd1;}
h1{font-size:12px;}
h2{font-size:24px;font-weight:normal;}
h3{border-bottom:1px dotted #0096DB}
.wa,img{height:auto;width:auto!important;}
br,.fn{float:none!important}
.iB{border:2px solid #dbf3ff}
#W{width:950px; margin:0 auto;}
#F,#F li,#H,#H li{height:36px;float:left;}
a,.blue{color:#008fd1}
#H{ margin-top:5px;}
#H .l{ width:9px;height:36px;background:url(<?=IMAGES?>headLeft.jpg);}
#H .c{background:#dbf3ff; width:932px; background:url(<?=IMAGES?>headMid.jpg) repeat-x;}
#H h1{display:none;}
#H .c img{ margin-left:10px;float:left;}
#H .c form{text-align:right;margin:10px 10px 0 0;float:right}
.inp,#H .c input{border:1px solid #008fd1;background:#fff;margin-right:10px;padding:1px 4px;text-align:center}
.but,#H .c input[type=submit],#H .c input[type=button]{border:0;background:#008fd1;color:#FFFFFF;padding:2px;font-weight:bold}
#H .r{ width:9px;height:36px;background:url(<?=IMAGES?>headRight.jpg);float:right;}

#B *{float:left}
#B #Ba{ margin:20px 0; float:left;font-size:14px;}
#Ba h1,#Ba span{width:500px;}
#Ba h1{font-size:14px; margin:10px 0 0 10px;}
#Ba span{ margin-left:10px; font-size:12px}

#Bb .r{background:#}
#Bb .l{width:200px;}
#Bb .l li{ margin-bottom:15px;}
#Bb .l a{ background:#daf3fe url(<?=IMAGES?>leftNavBg2.jpg) no-repeat; font-weight:bold; color:#008fd1; padding:6px 0 0 10px;height:22px;}
#Bb .l a:hover,#Bb .l a.std{ background:#008fd1 url(<?=IMAGES?>leftNavBg.jpg) no-repeat;color:#ffffff;}
#Bb .c{margin:-4px 0 0 -54px;width:720px; background:url(<?=IMAGES?>loadingB.gif!) no-repeat;}
#Bb .cA{background:url(<?=IMAGES?>bBoxLeftTop.gif) no-repeat; height:53px;}
#Bb .cA .cAa{ background:url(<?=IMAGES?>bBoxRightTop.gif) no-repeat right top;height:53px;}
#Bb .cA span{ background:#FFF; line-height:50px; border-top:3px #0096db solid; margin-left:53px; width:620px; font-size:16px;height:50px;}
#Bb .cB{background:#FFFFFF; width:674px; border-left:3px #0096db solid; border-right:3px #0096db solid; padding:0 20px;overflow:hidden;}
#profile .tasks {margin-top:10px}
#profile .tasks li{margin-top:5px}
#Bb #profile a{width:auto; float:none;}
#Bb #profile .navi li{ margin-top:2px;}
#Bb #profile .navi img{ margin-right:5px;}
#profile dt,#profile dd{margin-top:2px;padding:2px;}
#profile dt{ float:left; width:150px; color:#666;}
#profile dd{ float:left; width:500px;}
#profile h3{ border-bottom:2px solid #DBF3FF; margin-top:10px;}
#profile h3 a{font-weight:normal;font-size:10px;}
#Bb .cC{background:url(<?=IMAGES?>bBoxLeftBottom.gif) no-repeat;}
#Bb .cC div{ background:url(<?=IMAGES?>bBoxRightBottom.gif) no-repeat right top;}
#Bb .cC span{ border-bottom:3px #0096db solid; margin-left:11px; width:700px; line-height:8px; background:#FFFFFF; }
#Bb .r{width:75px; margin-left:8px;}
#Bb .r a{height:25px;width:69px;text-align:center;background:url(<?=IMAGES?>rightNavBoxH.gif); margin-bottom:10px;font-weight:bold;padding:6px 0;}
#Bb .r span{font-size:10px;color:#2f2933 }
#Bb .r a:hover,#Bb .r a.std{background:url(<?=IMAGES?>rightNavBox.gif);color:#FFFFFF;}
#Bb .r a:hover span,#Bb .r a.std span{color:#EEEEEE}
<? /*facebook start*/?>
#Bc .x{height:225px;margin-top:10px;width:464px}
#Bc .r{ margin-left:10px}
.bx .t{background:url(<?=IMAGES?>cBoxLT.gif) no-repeat left top;}
.bx .t div{background:url(<?=IMAGES?>cBoxRT.gif) no-repeat right top;}
.bx .t div h2{border-top:#008fd1 3px solid; margin-left:10px; width:446px; line-height:15px;}
.bx .b{border-left:#008fd1 3px solid; border-right:#008fd1 3px solid; width:438px;padding:0 10px;height:205px;}
.bx .l{background:url(<?=IMAGES?>cBoxLB.gif) no-repeat left top;}
.bx .l div{background:url(<?=IMAGES?>cBoxRB.gif) no-repeat right top;}
.bx .l div span{border-bottom:#008fd1 3px solid; margin-left:10px; width:96%; height:7px; }
<? /*facebook over*/?>
#F{margin-top:25px; border-top:2px outset #008FD1; padding-top:10px;}
#F li{width:475px}
#F .r{text-align:right;}
#Bb .r a,.f11{font-size:11px}
.xB{ background:#dbf3ff; width:auto; z-index:999; position:fixed}
.xB .tL,.xB .tR,.xB .bR,.xB .bL{height:10px; width:10px; float:left;}
.xB .tL{ background:url(<?=IMAGES?>xBtL.gif) no-repeat;}
.xB .tR{ background:url(<?=IMAGES?>xBtR.gif) no-repeat right top;float:right!important;}
.xB .bL{ background:url(<?=IMAGES?>xBbL.gif) no-repeat;}
.xB .bR{ background:url(<?=IMAGES?>xBbR.gif) no-repeat right bottom;float:right!important;}
<? /*Tweet CSS*/?>
.tB{margin-top:6px;position:absolute; width:620px;}.tB li{height:50px;}
.tBl{background:url(<?=IMAGES?>tBoxL.gif) no-repeat;width:11px;}
.tBc{background:url(<?=IMAGES?>tBoxC.gif) repeat-x;width:556px;}
.tBr{background:url(<?=IMAGES?>tBoxR.gif) no-repeat;width:51px;}
.tBc h6{background:#FFFFFF;height:15px;margin-top:2px;width:140px;line-height:11px; text-align:center;}
.tBc input[type=text]{background:#FFF;border:1px solid #FFF;font-size:16px;width:510px;height:28px!important;}
<? if(BROWSER=='saf'){?>.tBr select{margin:11px 0 0 -45px;}<? }else{?>.tBr select{margin:10px 0 2px -40px;*margin:10px 0 0 -42px;}<? }?>
#videos li,#tweet li{ background:url(<?=IMAGES?>bbot.gif) repeat-x bottom; padding:10px; width:650px; font-size:14px;}
#videos h2,#tweet h2{ color:#008fd1; font-size:24px;}
#videos ul,#tweet ul{margin-top:10px}
#videos span,#tweet span{ font-size:11px; color:#999; width:600px;}
#videos a.del,#tweet a.del{width:45px; font-size:11px;}
#videos .vDesc{width:385px;} #videos .vDesc div{width:335px;}
#videos .vImg{width:260px;} #videos .vImg img{width:253px;height:190px}
<? /*Settings page Navigation*/?>
#sNav{border-bottom:2px solid #0096db;}
#sNav * {height:22px;}
#sNav a{margin-left:10px; background:#daf3fe url(<?=IMAGES?>tabL_.gif) no-repeat;}
#sNav span{font-size:12px; background:url(<?=IMAGES?>tabR_.gif) right top no-repeat; padding:0 10px; line-height:22px;}
#sNav a:hover,#sNav a.std{ background:#0096db url(<?=IMAGES?>tabL.gif) no-repeat; }
#sNav a:hover span,#sNav a.std span{ background:url(<?=IMAGES?>tabR.gif) right top no-repeat; color:#ffffff; }
<? /*User setting page css*/?>
#setting dt,#setting dd{padding:5px;}
#setting label{padding:3px}
#setting dl{ margin-top:10px; width:525px;}
#setting dt{width:200px;text-align:right;font-weight:bold;height:22px;}
#setting dd{width:300px;text-align:left;}
#setting select{width:auto;height:22px;*height:26px}
#setting select,#setting input,#setting textarea{border:1px solid #daf3fe;}
#setting input[type=text],#setting input[type=password]{width:200px;padding:2px;}
#setting option,#setting input[type=checkbox]{width:auto;padding:1px 2px;}
#setting .stngLT{height:18px;} #setting textarea{height:120px;}
<? /*User scrapbook*/?>
#scrapH select{ width:100px; border:1px solid #FFFFFF; margin-top:15px; padding:1px 5px;}
#scrapH .l{float:left;}
#scrapH .r{float:right;text-align:right}
.vS{margin-top:25px}
.vS li{ margin-top:5px; background:url(<?=IMAGES?>bbot.gif) repeat-x bottom;}
.vS li img{ margin:5px}
.vS li div div{text-align:right;}
.vS li p{width:600px;overflow:auto;}
.vS li div div a{font-size:11px;float:none!important;}
.vS li div{width:600px; padding:5px;} .pS{width:656px;margin-left:12px;}
.pS .t{ background:url(<?=IMAGES?>pSt.gif) no-repeat;height:11px;}
.pS .m{ background:url(<?=IMAGES?>pSm.gif) repeat-y; padding:0 10px; width:636px;}
.stngLT,.twtLT,.scrpLT,.slmLT{width:auto;font-size:11px;border:1px solid #CCCCCC;}
.pS li{margin-top:0;}
.pS .m textarea{border:1px solid #FFFFFF; width:630px; font-size:14px;}
.pS .b{background:url(<?=IMAGES?>pSb.gif) no-repeat;height:10px;}
.pS .m img{margin:0} .pS .m label{margin:2px 6px 0 0; font-size:11px;*line-height:20px;}
.vS .m textarea{height:60px!important}
.vS .pS{display:none}
.vS .t{background-position:0 -14px}
.vS .b{margin-bottom:10px}
<? /*Invite page css*/?>
#invite .nav{width:75px; margin-top:20px;}
#invite .nav li{margin:2px;}
#invite .nav li a{padding:5px 4px 4px;background:#daf3fe url(<?=IMAGES?>inv.tab.gif) no-repeat;width:65px}
#invite .nav li a:hover,#invite .nav li .std{color:#FFFFFF;background-color:#008fd1;}
#invite .nav li .std{width:75px}
#invite .insite{ margin:10px 0 0 10px;width:615px;}
#invite .insite li{height:52px;padding-top:1px;width:145px;margin:5px 0 0 5px;}
#invite .insite .e{width:60px;}
#invite .insite .e img{border:1px solid #DAF3FE;}
#invite .insite .n{width:85px;font-weight:bold;overflow:hidden;}
#invite .insite .n span{font-size:10px;font-weight:normal;}
#invite .field{width:550px;border:1px dotted #008FD1;margin-bottom:10px}
#invite .field ul,#invite .field div{margin-left:155px;width:394px;}
#invite .field ul{height:500px;overflow:auto;}
#invite .field label{ margin:2px 0; width:370px;}#invite .field span{width:325px}#invite .field .e{ font-weight:bold}
#invite .field .n{ font-size:10px}#invite .field input{ width:10px; margin:7px 5px}
#invite .field div .l{line-height:25px; width:100px}
#invite .field div .r{width:150px;float:right;margin-top:5px;cursor:pointer}
#invPro{position:absolute; height:52px; width:132px; background:#008fd1; top:314px; padding-left:5px;opacity:0}
#invPro input[type=password],#invPro input[type=text]{border:1px solid #daf3fe; width:100px;}
#invPro input[type=button]{ width:20px; border:0; background:#DAF3FE}
#invPro input{margin:5px 5px 0 0}#invPro input[type=text]{width:125px}
<? /*Friends */?>
#friend{margin-top:15px}
#friend a{font-weight:bold}
#friend img{margin:0 7px}
#friend span{width:400px}
#friend .frnd{width:auto;float:right;}
<? /*search page css*/?>
#search .top{ background:#f4fcff url(<?=IMAGES?>search-top.gif) no-repeat;padding:10px;width:641px}
#search .top input,#search .top select{width:110px;float:right;}
#search .top label{width:200px;padding:5px;line-height:20px;}
#search .top span{width:80px;float:left;}
#search p.hyper{display:none}
#search .bot{ background:url(<?=IMAGES?>search-bot.gif) no-repeat; height:29px;width:661px;}
#search .bot a{text-align:right; line-height:40px;}
#sButton{margin-left:305px;cursor:pointer}
#searchResult li{margin-bottom:5px;padding:5px 0;border-bottom:1px dashed #daf3fe}
#searchResult img{margin:0 10px}
#searchResult span{font-size:10px}
#searchResult a,#searchResult span{width:500px}
<? /*slam*/?>
#slam form li{padding:5px; width:200px; margin-left:5px;}
#slam form li p{height:60px;}
#slam form li div span{ font-size:11px;}
#slam #post li{width:95%; margin-top:10px;}
#slam #post li strong{font-size:14px;font-weight:normal;}
#slam #post li textarea{margin:5px 0;font-size:14px!important;color:#2f2933;border:2px solid;height:100px;}
#slam #post li label{width:auto;line-height:10px; margin-right:10px;}
#slam #post li select{margin-top:-4px;}
#slam #post li input[type=radio]{width:auto;*margin-top:-5px;}
#slam .vSlam h3 a{float:right;font-size:11px;font-weight:bold;width:auto;margin-left:10px;}
#slam .vSlam div{padding-bottom:10px;}
#slam .vSlam div strong{padding:2px;background:#EEFAFF;}
#slam .vSlam div span{font-size:14px;margin-top:6px;}
#slam #custom ul{list-style:decimal-leading-zero;}
#slam #custom li{width:100%;margin-left:40px;}
#slam #custom li div{cursor:move;width:620px;font-size:14px;}
#slam #custom li div a{ font-size:12px; float:right;}
#slam #requested li p{width:60px}
#slam #requested li div{width:140px}
.rf{background:url(<?=IMAGES?>remove.jpg);}
.af{background:url(<?=IMAGES?>add.jpg);}
.rs{background:url(<?=IMAGES?>slam.jpg);}
.wf{background:url(<?=IMAGES?>waiting.jpg);color:#2f2933;cursor:default;}
.cf{background:url(<?=IMAGES?>confirm.jpg);}
.alert{background:url(<?=IMAGES?>alert.jpg);}
.alert,.slam,.frnd{padding-left:20px;background-repeat:no-repeat}
.fr{float:right!important}
#myGroup{width:440px;height:170px;overflow:auto;}
.goog-transliterate-indic-suggestion-menuitem,.goog-transliterate-indic-suggestion-menu,#myGroup *,#a2apage_dropdown{float:none; width:auto; margin:auto;}
.goog-transliterate-indic-suggestion-menuitem{font-size:12px;background:#DAF3FE;padding:0 2px!important;}
.goog-transliterate-indic-suggestion-menuitem-highlight{background:#0096DB!important;color:#FFFFFF!important;}
.goog-transliterate-indic-suggestion-menu{border:none!important;}
#a2apage_dropdown *{width:auto}
#a2apage_powered_by{display:none}
<? /*google adsense*/?>
.gAds{padding-left:12px}
<? //navigation?>
.scr{background:url(<?=IMAGES?>pageNav.jpg) no-repeat top center;padding:2px 0;text-align:center;font-weight:bold;}
.scr:hover{background-position:bottom center;color:#FFFFFF;}
.lBox{position:fixed;top:-100px;left:-100px;}.lBox .c{padding:24px 0;overflow:hidden;}
.lBox .c,.lBox .m{background:url(<?=IMAGES?>lBoxBg.png);}.lBox .m{height:0}
.lBox div{height:24px;width:24px;float:left;}.lBox .c{width:0;}
.lBox .l .t ,.lBox .r .t,.lBox .l .b,.lBox .r .b{background:url(<?=IMAGES?>lBoxCor.png) no-repeat;}
.lBox .r .t{background-position:right top;}.lBox .l .b{background-position:bottom left;}.lBox .r .b{background-position:right bottom;}
.addNew{position:absolute;margin-left:10px;width:50px}
.time{font-size:10px;color:#999999}
.ytPs img,.imgUpd img{margin:4px 4px 0 0;}
.imgUpd img{height:100px;width:100px;}
<? //activeFriends?>
<? if(BROWSER=='saf'){?>  <? }?>
.actvFrnds li{width:140px;height:56px;margin:7px 0 0 5px; }
.actvFrnds span,.actvFrnds a{width:80px;margin-left:2px;}
.actvFrnds span{font-size:10px}
<? //part?>
.pArt{width:444px;height:242px;margin:10px;overflow:hidden;}.pArt a{margin-left:10px;}
.pArt p{height:22px;width:22px;float:left;font-size:16px;text-align:center;cursor:pointer;}
.pArt p.pAa{background:#FFFFFF url(<?=IMAGES?>pArtBg.jpg) no-repeat;font-weight:bold;}

#more div{margin:0 10px 25px 100px; float:left; width:auto;}
#more h1,#more h2,#more h3{display:none}
<?php ob_end_flush();?>