<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
var update = function()
{
}
update.prototype = {
init:function(u)
{	gst.hideBody();
	if(!gst.gE("updateH"))
	{	dU = gst.cE();
		$("<h2/>").attr({"id":"updateH"}).html("Updates from my friends").appendTo(".cA div span");
		$(dU).attr("id","update").prependTo(".c .cB");	
		for(i=0;i<20;i++)$("<p>").html(i).appendTo(dU);
	}
	else
	{
		$("#update").fadeIn("fast");
		$("#updateH").fadeIn("fast");
	}

}
				};
upDt = new update();
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>