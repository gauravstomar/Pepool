<h2>My Pics<p id="uploadify"></p></h2>
<script type="text/javascript">
$(document).ready(function() {
    $("#uploadify").uploadify({
        'uploader'       : '<?=WWW_ROOT?>public/uploadify/uploadify.swf',
        'buttonImg'		 : '<?=IMAGES?>add-photo.png',
        'script'         : 'public/uploadify/upload.php',
        'height'		 :'17',
        'width'			 :'41',
        'cancelImg'      : '<?=IMAGES?>cancel.png',
        'folder'		 : '<?=encode($this->user["id"])?>',
        'onSelect'       : function(event,ID,fileObj,response,data){$(".uploadifyQueue").fadeIn();},
        'onAllComplete'  : function(event,ID,fileObj,response,data){$(".uploadifyQueue").fadeOut();},
        'onComplete'     : function(event,ID,fileObj,response,data){
							
	gst.msg = 'Adding pic..';
	$.post('<?=WWW_ROOT?>public/uploadify/getlastuploded.php',{"title":fileObj.name},function(d){d=eval('('+d+')');piC.add(d);});
							
							
                                                                    },
        'auto'           : true,
        'multi'          : true
    });
});
</script>