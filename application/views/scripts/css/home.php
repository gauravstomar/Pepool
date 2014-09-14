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
header ("expires: " . gmdate ("D, d M Y H:i:s", time() + (60 * 60)) . " GMT");
if(1==2){?><style><? }?>
*{ width:auto;}
#sUpA,#sUpB{margin:5px 0; height:270px; }
#new .l,#sUpA{width:630px; margin-right:35px;}
#sUpA{ background:#dbf3ff url(<?=IMAGES?>sUpABg.gif) no-repeat; }
#sUpA p{padding-top:10px;font-size:13px;}
#sUpA p.c{width:290px; float:right;font-size:20px;}
#sUpA p.b{margin-left:330px;width:295px;}
#sUpA p.a{margin-left:140px; width:485px;}
#sUpA .a span{ width:330px; float:right}
#sUpA .b span{ width:275px; float:right}
#new .r,#sUpB{width:283px;}
#sUpB{background:#0096db url(<?=IMAGES?>signup.png)}
#sUpB dl{ margin:50px 0 0 10px; color:#FFFFFF; font-weight:bold;}
#sUpB dt,#sUpB dd{padding:5px 0;}
#sUpB dt{ width:115px;}
#sUpB input,#sUpB select{border:1px solid #FFFFFF}
#sUpB input[type=text],#sUpB input[type=password]{width:140px}
#sUpB select{width:auto; margin-right:2px; font-size:11px;}#new{height:38px;}#new ul li{display:none;}
#new ul{ width:520px; padding-top:11px; margin-left:100px;}
#new .l a{height:38px; width:100%; display:block;background:url(<?=IMAGES?>do-nothing.png) no-repeat;font-size:14px;}
#new .l a:hover{ background-position:0 -37px;}
#new .r a{float:none;}#new .r{text-align:center;} 
#onLu h1{ background:url(<?=IMAGES?>e-p-bg.png) no-repeat bottom;width:950px;font-size:20px; line-height:35px; text-align:right;font-weight:normal;display:block;}
#onLu ul{width:950px;}
#onLu li{width:150px;height:55px;margin:6px 4px 0 4px;} #onLu li img{margin:3px 2px 0px 3px;}
#onLu li em{font-size:10px;font-style:normal;color:#2f2933;} #onLu li *{display:block;} .rand{background:#effaff}
#onLu li span{width:90px}
iframe{width:728px}
<?php ob_end_flush();?>