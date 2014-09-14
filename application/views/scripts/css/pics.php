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
#pics li{width:100px;margin:5px;float:left;}
#pics li .act{position:absolute;display:none;margin:2px;}
#picsH #uploadifyUploader{width:41px;float:right;margin-top:15px;}
.uploadifyQueue{position:fixed;top:20%;left:38%;height:325px;overflow:auto;width:380px;z-index:999;opacity:0.9;display:none;text-align:center!important}
.uploadifyQueueItem {font-size:11px;padding:6px 5px;width:350px;z-index:98;background:url(<?=IMAGES?>uploadbg.png) no-repeat;}
.uploadifyQueueItem p{width:auto!important;line-height:normal!important;color:#FFFFFF;}
.uploadifyError {border:2px solid #008FD1!important;background:#DBF3FF!important;}
.uploadifyError p{color:#008FD1!important}
.uploadifyQueueItem .cancel {float:right!important;width:auto;}
.uploadifyProgress {background:#FFFFFF;border-top:1px solid #808080;border-left:1px solid #808080;border-right:1px solid #C5C5C5;border-bottom:1px solid #C5C5C5;margin-top:5px;width:100%;}
.uploadifyProgressBar{background:#0099FF;width:1px;height:3px;}
<?php ob_end_flush();?>