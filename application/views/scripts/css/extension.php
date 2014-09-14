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
*{ width:auto; margin:0; padding:0; }
h1{color:#008FD1; font-family:Arial,Helvetica,sans-serif; font-size:24px; font-weight:normal}
<?php ob_end_flush();?>