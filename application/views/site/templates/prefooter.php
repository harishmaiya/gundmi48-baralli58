<!---popup banner jquery-->
<link href="js/jquery-gallery.css" rel="stylesheet" type="text/css">

<script src="js/jquery-gallery.js"></script>


<script>
var sdcsd = jQuery.noConflict();
sdcsd(document).jquerygallery({

// displays a thumbnails navigation
'coverImgOverlay' : true,

// CSS classes
'imgActive' : "imgActive",
'thumbnail' : "coverImgOverlay",
'overlay' : "overlay",

// the height of the thumbnails
'thumbnailHeight' : 120,

// custom navigation controls. 
// requires Font Awesome
'imgNext' : "<i class='fa fa-angle-right'></i>",
'imgPrev' : "<i class='fa fa-angle-left'></i>",
'imgClose' : "<i class='fa fa-times'></i>",

// animation speed
'speed' : 300

});
</script>