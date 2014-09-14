<?php
	if(extension_loaded('zlib'))ob_start('ob_gzhandler');
	header ("content-type: text/javascript; charset: UTF-8");
	header ("cache-control: must-revalidate");
	header ("expires: " . gmdate ("D, d M Y H:i:s", time()) . " GMT");
	if(1==2){?><script>
<? }?>
wwG = "<?=WWW_ROOT?>gchart/";
google.load('visualization','1',{packages:['orgchart']});
google.setOnLoadCallback(function()
{	$.post(wwG,function(boo)
	{
		if(!boo.length>0)
		{
			$('<img>').css({"float":"right"}).attr({'src':img+'no-followers.jpg'}).appendTo('#myGroup');
			return false;
		}
		var data = new google.visualization.DataTable();
        data.addColumn('string','A');
        data.addColumn('string','B');
        data.addColumn('string','C');
        data.addRows(eval('('+boo+')'));
        var chart = new google.visualization.OrgChart(gst.gE('myGroup'));
        chart.draw(data, {allowHtml:true});
	})
})
<?php 
	if(extension_loaded('zlib'))
	ob_end_flush();
?>