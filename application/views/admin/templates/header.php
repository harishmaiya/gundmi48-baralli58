<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width"/>
<base href="<?php echo base_url(); ?>">
<title><?php echo $heading.' - '.$title;?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/logo/<?php echo $fevicon;?>">
<link href="css/reset.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/layout.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/themes.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/typography.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">

<!--<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">-->
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/data-table.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/form.css" rel="stylesheet" type="text/css" media="screen">

<link href="css/ui-elements.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/gradient.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/developer.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="css/site/colorbox.css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/sweetalert.css">


<!--<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />-->
<script type="text/javascript">
var BaseURL = '<?php echo base_url();?>';
var baseURL = '<?php echo base_url();?>';
</script>
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/jquery.ui.touch-punch.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>

<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/ColVis.min.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script> 
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/jquery.MultiFile.js"></script>
<script src="js/custom-scripts.js"></script>
<script src="js/validation.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="<?php echo base_url();?>js/sweetalert-dev.js"></script>
<script>
tinymce.init({
  selector: 'textarea:not(.mceNoEditor)',
  height: 100,
  visual: false,
		plugins : "table",
        theme_advanced_buttons3_add : "tablecontrols",
        table_styles : "Header 1=header1;Header 2=header2;Header 3=header3",
        table_cell_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Cell=tableCel1",
        table_row_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1",
        table_cell_limit : 100,
        table_row_limit : 5,
        table_col_limit : 5,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]

});
</script>
<!--<script type="text/javascript">
		tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		 
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		file_browser_callback : "ajaxfilemanager",
		relative_urls : false,
		convert_urls: false,
		// Example content CSS (should be your site CSS)
		content_css : "css/example.css",
		 
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "js/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js",
		 
		// Replace values for the template plugin
		template_replace_values : {
		username : "Some User",
		staffid : "991234"
		}
		});
		
		function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = '<?php echo base_url();?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
			switch (type) {
				case "image":
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: '<?php echo base_url();?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
            
            return false;			
			var fileBrowserWindow = new Array();
			fileBrowserWindow["file"] = ajaxfilemanagerurl;
			fileBrowserWindow["title"] = "Ajax File Manager";
			fileBrowserWindow["width"] = "782";
			fileBrowserWindow["height"] = "440";
			fileBrowserWindow["close_previous"] = "no";
			tinyMCE.openWindow(fileBrowserWindow, {
			  window : win,
			  input : field_name,
			  resizable : "yes",
			  inline : "yes",
			  editor_id : tinyMCE.getWindowArg("editor_id")
			});
			
			return false;
		}
</script>-->
<script type="text/javascript">
function hideErrDiv(arg) {
    document.getElementById(arg).style.display = 'none';
}
</script>

<script>
$(document).ready(function(){


		$('#cboxClose').click(function(){
			$("#details").hide();
			return false;
		});
		$(".cboxClose").click(function(){
			$("#cboxOverlay,#colorbox,#draggable").hide();
			//alert("jj");
			window.location.href = baseURL+'admin';
			});
			
		/*	var prodid = '<?php echo $this->uri->segment(4,0);?>';
			var idval =$('#prdiii').val();
			alert("Valuess"+idval);*/
			
			/*$(".dragndrop").colorbox({width:"1000px", height:"500px", href:baseURL+"admin/product/dragimageuploadedit/"+prodid});*/
			
			//$(".dragndrop1").colorbox({width:"1000px", height:"500px", href:baseURL+"admin/product/dragimageuploadinsert"});
			
			
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>


<!--<?php if($flash_data != '') {?>
                    <div class="errorContainer" id="<?php echo $flash_data_type;?>">
                        <script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 4000);</script>
                        <p style="color:#000000; font-size:16px;"><span><?php echo $flash_data;?></span></p>
                    </div>
                    <?php } ?>-->
</head>

<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
	<div id="actionsBoxMenu" class="menu">
		<span id="cntBoxMenu">0</span>
		<a class="button box_action">Archive</a>
		<a class="button box_action">Delete</a>
		<a id="toggleBoxMenu" class="open"></a>
		<a id="closeBoxMenu" class="button t_close">X</a>
	</div>
	<div class="submenu">
		<a class="first box_action">Move...</a>
		<a class="box_action">Mark as read</a>
		<a class="box_action">Mark as unread</a>
		<a class="last box_action">Spam</a>
	</div>
</div>
<?php 
		$this->load->view('admin/templates/sidebar.php');
?>

<div id="container">
	<div id="header" class="white_gel">
		<div class="header_left">
			<div class="logo">
				<img src="images/logo/<?php echo $logo;?>" alt="<?php echo $siteTitle;?>" height="38px" title="<?php echo $siteTitle;?>">
			</div>
			<div id="responsive_mnu">
				<a href="#responsive_menu" class="fg-button" id="hierarchybreadcrumb"><span class="responsive_icon"></span>Menu</a>
				<div id="responsive_menu" class="hidden">
                    <ul id="sidenav" class="accordion_mnu collapsible">

						<li><a href="<?php echo base_url();?>admin/dashboard/admin_dashboard" <?php if($currentUrl=='dashboard'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span> Dashboard</a></li>
						<li><h6 style="margin: 10px 0;padding-left:40px;font-weight:normal;color:#0D68AF;">Managements</h6></li>
						
						<?php extract($privileges); if ($allPrev == '1'){ ?>
						<li><a href="<?php echo base_url();?>admin/adminlogin/display_admin_list" <?php if($currentUrl=='adminlogin'){ echo 'class="active"';} ?>><span class="nav_icon admin_user"></span> Admin<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='adminlogin' || $currentUrl=='sitemapcreate'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="<?php echo base_url();?>admin/adminlogin/display_admin_list" <?php if($currentPage=='display_admin_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Admin Users</a></li>
							<li><a href="admin/adminlogin/change_admin_password_form" <?php if($currentPage=='change_admin_password_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Change Password</a></li>
							<li><a href="admin/adminlogin/admin_global_settings_form" <?php if($currentPage=='admin_global_settings_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
							<li><a href="admin/adminlogin/admin_smtp_settings" <?php if($currentPage=='admin_smtp_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>SMTP Settings</a></li>
						   <!-- <li><a href="admin/sitemapcreate" <?php if($currentUrl=='sitemapcreate'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sitemap Creation</a></li> -->
						   <li><a href="admin/sitemap/create_sitemap" <?php if($currentUrl=='create_sitemap'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sitemap Creation</a></li>
						</ul>
						</li>
						
						<li><a href="<?php echo base_url();?>admin/subadmin/display_sub_admin" <?php if($currentUrl=='subadmin'){ echo 'class="active"';} ?>><span class="nav_icon user"></span> Sub-Admin<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='subadmin'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/subadmin/display_sub_admin" <?php if($currentPage=='display_sub_admin'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sub-Admin List</a></li>
							<li><a href="admin/subadmin/add_sub_admin_form" <?php if($currentPage=='add_sub_admin_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Sub-Admin</a></li>
						</ul>
						</li>
						
						<?php } if ((isset($Members) && is_array($Members)) && in_array('0', $Members) || $allPrev == '1'){ 	?>
						<li><a href="admin/users/display_user_dashboard" <?php if($currentUrl=='users'){ echo 'class="active"';} ?>><span class="nav_icon users"></span>Members<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='users'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/users/display_user_dashboard" <?php if($currentPage=='display_user_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
							<li><a href="admin/users/display_user_list" <?php if($currentPage=='display_user_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Member List</a></li>
							<?php if ($allPrev == '1' || in_array('1', $Members)){?>
							<li><a href="admin/users/add_user_form" <?php if($currentPage=='add_user_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Member</a></li>
							<?php }?>
							<li><a href="admin/users/export_user_details" <?php if($currentPage=='export_user_details'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export Member List</a></li>
						</ul>
						</li>
						
						<?php } if ((isset($Host) && is_array($Host)) && in_array('0', $Host) || $allPrev == '1'){ 	?>
						<li><a href="admin/seller/display_seller_dashboard" <?php if($currentUrl=='seller'){ echo 'class="active"';} ?>><span class="nav_icon users_2"></span>Host<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='seller'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/seller/display_seller_dashboard" <?php if($currentPage=='display_seller_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
							<li><a href="admin/seller/display_seller_list" <?php if($currentPage=='display_seller_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Host List</a></li>
							<?php if ($allPrev == '1' || in_array('1', $Host)){?>
							<li><a href="admin/seller/add_seller_form" <?php if($currentPage=='add_seller_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Host</a></li>
							 <li><a href="admin/seller/customerExcelExport" <?php if($currentPage=='customerExcelExport'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export Host List</a></li>
							
							
							<?php }?>
							<!--<li><a href="admin/seller/display_seller_requests" <?php if($currentPage=='display_seller_requests'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Seller Requests</a></li>-->
							<!--<li><a href="admin/commission/display_commission_lists" <?php if($currentPage=='display_commission_lists'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Commission Tracking</a></li>-->
						</ul>
						</li>
						
						<?php } if ((isset($Properties) && is_array($Properties)) && in_array('0', $Properties) || $allPrev == '1'){ 	?>
						<li><a href="admin/product/display_rental_dashboard" <?php if($currentUrl=='product' || $currentUrl=='comments'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Properties<span class="up_down_arrow">&nbsp;</span></a>
						  <ul class="acitem" <?php if($currentUrl=='product' || $currentUrl=='comments'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
						  
						  
						  <li><a href="admin/product/display_rental_dashboard" <?php if($currentPage=='display_rental_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
						  
						  
							<li><a href="admin/product/display_product_list" <?php if($currentPage=='display_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Property List</a></li>
							<!--<li><a href="admin/product/display_user_product_list" <?php if($currentPage=='display_user_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Affiliate Rental List</a></li>
							<li><a href="admin/comments/view_product_comments" <?php if($currentPage=='view_product_comments'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Rental Comments List</a></li>-->
							<?php if ($allPrev == '1' || in_array('1', $Properties)){?>
							<li><a href="admin/product/add_product_form" <?php if($currentPage=='add_product_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Property</a></li>
							 <li><a href="admin/product/customerExcelExport" <?php if($currentPage=='display_user_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export Property List</a></li>
							<?php }?>
						</ul>
						</li>
						
						
						<?php } 
						if ((isset($Finance) && is_array($Finance)) && in_array('0', $Finance) || $allPrev == '1'){ ?>
						<li><a href="admin/order/display_order_paid" <?php if($currentUrl=='order' || $this->uri->segment(1,0)=='order-review'){ echo 'class="active"';} ?>><span class="nav_icon coverflow"></span> Finance<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='order' || $this->uri->segment(1,0)=='order-review'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/order/display_order_paid" <?php if($currentPage=='display_order_paid'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Paid Payment</a></li>
							<li><a href="admin/order/display_order_pending" <?php if($currentPage=='display_order_pending'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Failed Payment</a></li>
							
							<li><a href="admin/order/display_listing_order" <?php if($currentPage=='display_listing_order'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Listing  Payment</a></li>
							
							
						<!--	<li><a href="admin/order/display_cod" <?php if($currentPage=='display_cod'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>COD Payment</a></li> -->
							
							
							
							<li><a href="admin/order/customerExcelExport/Paid" <?php if($currentPage=='customerExcelExport'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export Finance Paid List</a></li>
							<li><a href="admin/order/customerExcelExport/Pending" <?php if($currentPage=='customerExcelExport'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export Finance Failed  List</a></li>
							<li><a href="admin/order/customerExcelExportlist" <?php if($currentPage=='customerExcelExportlist'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export Finance Listing  List</a></li>

						</ul>
						</li>
						
						
					   
						
						
						<?php } if ((isset($List) && is_array($List)) && in_array('0', $List) || $allPrev == '1'){ 	?>
						<li><a href="admin/attribute/display_attribute_list" <?php if($currentUrl=='attribute'){ echo 'style="active"';} ?>><span class="nav_icon cog_3"></span> List<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='attribute'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/attribute/display_attribute_list" <?php if($currentPage=='display_attribute_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Lists</a></li>
							<li><a href="admin/attribute/display_list_values" <?php if($currentPage=='display_list_values'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List Values</a></li>
							<!--<li><a href="admin/attribute/display_sub_list_values" <?php if($currentPage=='display_sub_list_values'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sub List Values</a></li>-->
							<?php if ($allPrev == '1' || in_array('1', $List)){?>
							<li><a href="admin/attribute/add_attribute_form" <?php if($currentPage=='add_attribute_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New List</a></li>
							<li><a href="admin/attribute/add_list_value_form" <?php if($currentPage=='add_list_value_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add List Value</a></li>
							<!--<li><a href="admin/attribute/add_sub_list_value_form" <?php if($currentPage=='add_sub_list_value_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Sub List Value</a></li>-->
							<?php }?>
						</ul>
						</li>
						
						
						<!-- payable menu -->
						<?php } if ((isset($Accounts) && is_array($Accounts)) && in_array('0', $Accounts) || $allPrev == '1'){ 	?>
						<li><a href="javascript:void(0);" <?php if($currentUrl=='bookingpayment'){ echo 'style="active"';} ?>><span class="nav_icon cog_3"></span> Accounts<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='bookingpayment'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							
							<li><a href="admin/bookingpayment/display_receivable" <?php if($currentPage=='display_receivable'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Receivable & Payable</a></li>					
							<?php if ($allPrev == '1' || in_array('1', $Accounts)){?>
							<!--<li><a href="admin/bookingpayment/display_payable" <?php if($currentPage=='display_payable'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Payable</a></li>-->
							<li><a href="admin/bookingpayment/customerExcelExportReceivable" <?php if($currentPage=='customerExcelExportReceivable'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Exp Receivable & Payable</a></li>
							<!--<li><a href="admin/bookingpayment/customerExcelExportPayable" <?php if($currentPage=='customerExcelExportPayable'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export Payable</a></li>-->
							<?php }?>
						</ul>
						</li>
						<!-- payable menu end -->
						
						<?php } if ((isset($BookingStatus) && is_array($BookingStatus)) && in_array('0', $BookingStatus) || $allPrev == '1'){ 	?>
						<li><a href="admin/account/display_newbooking" <?php if($currentUrl=='account'){ echo 'style="active"';} ?>><span class="nav_icon cog_3"></span> Booking Status<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='account'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<?php if ($allPrev == '1' || in_array('1', $BookingStatus)){?>
							<li><a href="admin/account/display_newbooking" <?php if($currentPage=='display_newbooking'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>New Booking</a></li>					
							<li><a href="admin/account/display_book_confirmed" <?php if($currentPage=='display_book_confirmed'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Completed Booking</a></li>
							<li><a href="admin/account/display_book_expired" <?php if($currentPage=='display_book_expired'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Expired Booking</a></li>
							<li><a href="admin/account/customerExcelExportNewBooking/enquiry" <?php if($currentPage=='customerExcelExportNewBooking'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Export New Booking</a></li>
							<li><a href="admin/account/customerExcelExportNewBooking/booked" <?php if($currentPage=='customerExcelExportNewBooking'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Exp Completed Booking</a></li>
							<li><a href="admin/account/customerExcelExportExpired" <?php if($currentPage=='customerExcelExportExpired'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Exp Expired Booking</a></li>
							<?php }?>
						</ul>
						</li>
						
						<?php } if ((isset($ListSpace) && is_array($ListSpace)) && in_array('0', $ListSpace) || $allPrev == '1'){ 	?>
						<li><a href="admin/listattribute/display_attribute_listspace" <?php if($currentUrl=='listattribute'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>List Space<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='listattribute'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/listattribute/display_attribute_listspace" <?php if($currentPage=='display_attribute_listspace'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List Space</a></li>
							<li><a href="admin/listattribute/display_listspace_values" <?php if($currentPage=='display_listspace_values'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List Space Values</a></li>
							<!--<li><a href="admin/attribute/display_sub_list_values" <?php if($currentPage=='display_sub_list_values'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sub List Values</a></li>-->
							<?php if ($allPrev == '1' || in_array('1', $ListSpace)){?>
							<li style="display:none"><a href="admin/listattribute/add_attribute_listform" <?php if($currentPage=='add_attribute_listform'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New List Space</a></li>
							<li><a href="admin/listattribute/add_listspace_value_form" <?php if($currentPage=='add_listspace_value_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add List Value Space</a></li>
							<!--<li><a href="admin/attribute/add_sub_list_value_form" <?php if($currentPage=='add_sub_list_value_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Sub List Value</a></li>-->
							<?php }?>
						</ul>
						</li>
						
						
						<?php } if ((isset($Listing) && is_array($Listing)) && in_array('0', $Listing) || $allPrev == '1'){ ?>
						<li>
							<a href="admin/listings/display_attribute_list" <?php if($currentUrl=='listings'){ echo 'class="active"';} ?>>
								<span class="nav_icon folder"></span>Listing 
								<span class="up_down_arrow">&nbsp;</span>
							</a>
							<ul class="acitem" <?php if($currentUrl=='listings'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
								<?php if ($allPrev == '1' || in_array('1', $Listing)){?>
								<li>
									<a href="admin/listings/rooms_and_beds" <?php if($currentPage=='rooms_and_beds'){ echo 'class="active"';} ?>>
										<span class="list-icon">&nbsp;</span>Listing Values
									</a>
								</li>
								<li>
									<a href="admin/listings/attribute_values" <?php if($currentPage=='attribute_values'){ echo 'class="active"';} ?>>
										<span class="list-icon">&nbsp;</span>Listing Types
									</a>
								</li>
								 <li>
									<a href="admin/listings/add_new_attribute" <?php if($currentPage=='add_new_attribute'){ echo 'class="active"';} ?>>
										<span class="list-icon">&nbsp;</span>Add New Listing Type
									</a>
								</li>						
								<?php } ?>
							</ul>
						</li>
						
						
						<?php  } if ((isset($Couponcode) && is_array($Couponcode)) && in_array('0', $Couponcode) || $allPrev == '1'){ ?>
						<li><a href="admin/couponcards/display_couponcards" <?php if($currentUrl=='couponcards'){ echo 'class="active"';} ?>><span class="nav_icon record"></span> Coupon Codes<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='couponcards'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/couponcards/display_couponcards" <?php if($currentPage=='display_couponcards'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Coupon code List</a></li>
							<?php if ($allPrev == '1' || in_array('1', $Couponcode)){?>
							<li><a href="admin/couponcards/add_couponcard_form" <?php if($currentPage=='add_couponcard_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Coupon code</a></li>
							<?php }?>
						</ul>
						</li>
						
						<?php } if ((isset($Newsletter) && is_array($Newsletter)) && in_array('0', $Newsletter) || $allPrev == '1'){  ?>
						<li><a href="admin/newsletter/display_newsletter" <?php if($currentUrl=='newsletter'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span> Newsletter Template<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='newsletter'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<?php if(1 == 0){?>
							<li><a href="admin/newsletter/display_subscribers_list" <?php if($currentPage=='display_subscribers_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscription List</a></li>
							<?php } ?>
							<?php if ($allPrev == '1' || in_array('0', $Newsletter)){?>
							<li><a href="admin/newsletter/display_newsletter" <?php if($currentPage=='display_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Email Template List</a></li>
							<?php } if ($allPrev == '1' || in_array('1', $Newsletter)){?>
							<li><a href="admin/newsletter/add_newsletter" <?php if($currentPage=='add_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Email Template</a></li>
							<?php } if ($allPrev == '1' || in_array('0', $Newsletter)){?>
							<li><a href="admin/newsletter/mass_email" <?php if($currentPage=='mass_email'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Mass E-Mail Campaigns</a></li>
							<?php }?>
						</ul>
						</li>
						
						<?php } if ((isset($ManageCountry) && is_array($ManageCountry)) && in_array('0', $ManageCountry) || $allPrev == '1'){ ?>
						<!--<li><a href="admin/location/display_location_list" <?php if($currentUrl=='location'){ echo 'class="active"';} ?>><span class="nav_icon globe"></span> Manage Country<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='location'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/location/display_location_list" <?php if($currentPage=='display_location_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Country List</a></li> -->
							<?php if ($allPrev == '1' || in_array('1', $ManageCountry)){?>
						   <!-- <li><a href="admin/location/add_location_form" <?php if($currentPage=='add_location_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Location</a></li>-->
							<?php }?>
							<!--<li><a href="admin/state/display_location_list" <?php if($currentUrl=='state'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> Country Management</a></li>-->
							<!-- <li><a href="admin/location/display_country_list" <?php if($currentPage=='display_country_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Country List</a></li>
							
						   
						   --> <!--<li><a href="admin/location/add_tax_form" <?php if($currentPage=='add_tax_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add State</a></li>
						</ul> 
						</li>-->
						
						<?php } if ((isset($Pages) && is_array($Pages)) && in_array('0', $Pages) || $allPrev == '1'){ ?>
						<li><a href="admin/cms/display_cms" <?php if($currentUrl=='cms'){ echo 'class="active"';} ?>><span class="nav_icon documents"></span> Manage Static Pages<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='cms'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
						 <li><a href="admin/cms/display_cms" <?php if($currentPage=='display_cms'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List of pages</a></li>
							<?php if ($allPrev == '1' || in_array('1', $Pages)){?>
						 <li><a href="admin/cms/add_cms_form" <?php if($currentPage=='add_cms_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Main Page</a></li>
						<li><a href="admin/cms/add_lang_page" <?php if($currentPage=='add_lang_page'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Language Page</a></li>
							<?php }?>
						</ul>
						</li>
						<?php  } if ((isset($City) && is_array($City)) && in_array('0', $City) || $allPrev == '1'){ ?>
						<li><a href="admin/city/display_city_list" <?php if($currentUrl=='city'){ echo 'class="active"';} ?>><span class="nav_icon record"></span> Manage City<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='city'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/city/display_city_list" <?php if($currentPage=='display_city_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>City List</a></li>
							<li><a href="admin/city/display_featured_cities" <?php if($currentPage=='display_featured_cities'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Featured City List</a></li>
						</ul>
						</li>
						<?php  } if ((isset($neighborhood) && is_array($neighborhood)) && in_array('0', $neighborhood) || $allPrev == '1'){ ?>
						<!--<li><a href="admin/neighborhood/display_neighborhood_list" <?php if($currentUrl=='neighborhood'){ echo 'class="active"';} ?>><span class="nav_icon record"></span> Neighborhood Management<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='neighborhood'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/neighborhood/display_neighborhood_list" <?php if($currentPage=='display_neighborhood_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Neighborhood List</a></li>
							<?php if ($allPrev == '1' || in_array('1', $neighborhood)){?>
							<li><a href="admin/neighborhood/add_neighborhood_form" <?php if($currentPage=='add_neighborhood_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Neighborhood</a></li>
							<?php }?>
						</ul>
						</li>-->
						 <?php } if ((isset($productattribute) && is_array($productattribute)) && in_array('0', $productattribute) || $allPrev == '1'){ 	?>
						<!--<li><a href="#" <?php if($currentUrl=='productattribute'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span> Neighborhood Category<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='productattribute'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/productattribute/display_product_attribute_list" <?php if($currentPage=='display_product_attribute_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Neighborhood Category</a></li>
							<?php if ($allPrev == '1' || in_array('1', $productattribute)){?>
							<li><a href="admin/productattribute/add_product_attribute_form" <?php if($currentPage=='add_product_attribute_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Neighborhood Category</a></li>
							<?php }?>
						</ul>
						</li>-->
						<?php } if ((isset($Commission) && is_array($Commission)) && in_array('0', $Commission) || $allPrev == '1'){?>
						<li><a href="#" <?php if($currentUrl=='commission'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>Commissions<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='commission'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/commission/display_commission_list" <?php if($currentPage=='display_commission_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Commission List</a></li>
							<li><a href="admin/commission/display_commission_tracking_lists" <?php if($currentPage=='display_commission_tracking_lists'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Commission Tracking</a></li>
						</ul>
						</li>
						<?php }

					 if ((isset($earnings) && is_array($earnings)) && in_array('0', $earnings) || $allPrev == '1'){?>
						<li><a href="#" <?php if($currentUrl=='earnings'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>Earnings<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='earnings'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/earnings/display_earning_list" <?php if($currentPage=='display_commission_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Earning List</a></li>
						</ul>
						</li>
						<?php }
						if ((isset($PaymentGateway) && is_array($PaymentGateway)) && in_array('0', $PaymentGateway) || $allPrev == '1'){ ?>
						<li><a href="admin/paygateway/display_gateway" <?php if($currentUrl=='paygateway'){ echo 'class="active"';} ?>><span class="nav_icon shopping_cart_2"></span> Payment Gateway</a></li>
						<?php 
						}if ((isset($Language) && is_array($Language)) && in_array('0', $Language) || $allPrev == '1'){ ?>
						 
						<li><a href="admin/multilanguage" <?php if($currentUrl=='multilanguage'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> Manage Language</a>
						<ul class="acitem" <?php if($currentUrl=='multilanguage'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/multilanguage/display_language_list" <?php if($currentPage=='display_language_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Site Language</a></li>
							<li><a href="admin/multilanguage/display_user_language" <?php if($currentPage=='display_user_language'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>User Language</a></li>
						</ul>
						</li>
						
						<?php } if ((isset($Slider) && is_array($Slider)) && in_array('0', $Slider) || $allPrev == '1'){ ?>
						<li><a href="#" <?php if($currentUrl=='slider' || $currentUrl=='comments'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Slider<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='slider' || $currentUrl=='comments'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/slider/display_slider_list" <?php if($currentPage=='display_slider_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Slider List</a></li>
							<?php if ($allPrev == '1' || in_array('1', $Slider)){?>
							<li><a href="admin/slider/add_slider_form" <?php if($currentPage=='add_slider_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Slider</a></li>
							<?php } ?>
						</ul>
						</li>
						<?php } if ((isset($Prefooter) && is_array($Prefooter)) && in_array('0', $Prefooter) || $allPrev == '1'){ ?>
						
						<li><a href="#" <?php if($currentUrl=='prefooter' || $currentUrl=='comments'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>Prefooter<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='prefooter' || $currentUrl=='comments'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/prefooter/display_prefooter_list" <?php if($currentPage=='display_prefooter_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Prefooter List</a></li>
							<!-- <li><a href="admin/prefooter/add_prefooter_form" <?php if($currentPage=='add_prefooter_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Prefooter</a></li> -->
						</ul>
						</li>
						<?php } if ((isset($Backup) && is_array($Backup)) && in_array('0', $Backup) || $allPrev == '1'){ ?>
						
						<li><a href="#" <?php if($currentUrl=='dropbox'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>Backup<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='dropbox'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<?php if (1 == 1){ ?>
								<li><a href="admin/backup/dbBackup" <?php if($currentPage=='add_prefooter_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Database Backup</a></li>
							<?php } else { ?>
								<li><a href="javascript:alert('Sorry! Due to secutiry purpose, this feature was disabled.')" <?php if($currentPage=='add_prefooter_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Database Backup</a></li>
							<?php } ?>

						</ul>
						</li>
					<?php } if ((isset($Review) && is_array($Review)) && in_array('0', $Review) || $allPrev == '1'){ ?>
					
						<li><a href="admin/review/display_review_list" <?php if($currentUrl=='testimonials' || $this->uri->segment(1,0)=='testimonials-review'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Review <span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='testimonials' || $this->uri->segment(1,0)=='testimonials-review'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					   
							<li><a href="admin/review/display_review_list" <?php if($currentPage=='display_testimonials_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Review List </a></li>
						  
						</ul>
						</li> 
						<?php } if ((isset($Currency) && is_array($Currency)) && in_array('0', $Currency) || $allPrev == '1'){ ?>
						<li><a href="admin/currency/display_currency_list" <?php if($currentUrl=='currency'){ echo 'class="active"';} ?>><span class="nav_icon globe"></span> Currency<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='currency'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/currency/display_currency_list" <?php if($currentPage=='display_currency_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Currency List</a></li>
							<?php if ($allPrev == '1' || in_array('1', $currency)){?>
							<li><a href="admin/currency/add_currency_form" <?php if($currentPage=='add_currency_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Currency</a></li>
							<?php }?>
						</ul>
						</li>
						
						
						
						<?php } if ((isset($ContactUs) && is_array($ContactUs)) && in_array('0', $ContactUs) || $allPrev == '1'){ ?>
						<li><a href="admin/contact_us/display_contactus" ><span class="nav_icon globe"></span> Contact Us</a></li>
						<?php } ?>
						<!--
				<li><a href="#" <?php if($currentUrl=='help' || $currentUrl=='help'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>Help Management<span class="up_down_arrow">&nbsp;</span></a>
						<ul class="acitem" <?php if($currentUrl=='help' || $currentUrl=='help'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
							<li><a href="admin/help/display_main_menu" <?php if($currentPage=='display_main_menu'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>MainMenu</a></li>
							
							<li><a href="admin/help/display_sub_menu" <?php if($currentPage=='display_sub_menu'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Submenu</a></li>
							
							<li><a href="admin/help/question_and_ans" <?php if($currentPage=='question_and_ans'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Question & Answer</a></li>
						</ul>
						</li>
						-->
					</ul>
				</div>
			</div>
		</div>
		<?php 
		extract($privileges);
		?>
		<div class="header_right">
			<div id="user_nav" <?php if ($allPrev != '1'){?>style="width: 250px;"<?php }?>>
				<ul>
					<li class="user_thumb"><span class="icon"><img src="images/user_thumb.png" width="30" height="30" alt="User"></span></li>
					<li class="user_info">
						<span class="user_name">Administrator</span>
						<?php if ($allPrev == '1'){?>
						<span>
							<a href="<?php echo base_url();?>" target="_blank" class="tipBot" title="View Site">Visit Site</a> &#124; 
							<a href="admin/adminlogin/admin_global_settings_form" class="tipBot" title="Edit account details">Settings</a>
						</span>
						<?php }else {?>
						<span>
							<a href="<?php echo base_url();?>" target="_blank" class="tipBot" title="View Site">Visit Site</a> &#124; 
							<a href="admin/adminlogin/change_admin_password_form" class="tipBot" title="Click to change your password">Change Password</a> 
						</span>
						<?php }?>
					</li>
					<li class="logout"><a href="admin/adminlogin/admin_logout" class="tipBot" title="Logout"><span class="icon"></span>Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="page_title">
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3><?php echo $heading;?></h3>
		<!-- 
		<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>
		 -->
	</div>
<?php if (validation_errors() != ''){?>
<div id="validationErr" style="float:right">
	<script>setTimeout("hideErrDiv('validationErr')", 3000);</script>
	<p><?php echo validation_errors();?></p>
</div>
<?php } ?>
<?php if($flash_data != '') { ?>
		<div  class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
<?php } ?>
<!-- Preloader -->
<script type="text/javascript">// <![CDATA[
$(window).load(function() { 
$("#spinner").fadeOut("slow");
//$('#rate').spinner("disable");
 })
// ]]></script>
 <!-- Preloader -->
<div id="spinner"></div>