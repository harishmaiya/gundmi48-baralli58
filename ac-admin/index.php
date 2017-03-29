<?php
@session_start();
error_reporting(0);
//	general config

$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'ac-admin/';
define("CALPATH",$actual_link);	
  $_REQUEST["page"] = 'bookings'; 
$the_file="ac-config.inc.php";
if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
else		require_once($the_file);

//	db connection

 $the_file=AC_INLCUDES_ROOT."db_connect.inc.php"; 
if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
else		require_once($the_file);


//	common vars (db and lang)
$the_file=AC_INLCUDES_ROOT."common.inc.php";
if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
else		require_once($the_file);
	
	
//	calendar functions
$the_file=AC_INLCUDES_ROOT."functions.inc.php";
if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
else		require_once($the_file);

//	admin functions
$the_file=AC_INLCUDES_ROOT."functions-admin.inc.php";
if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
else		require_once($the_file);

//	define language
if(isset($_SESSION["admin_lang"]))	define("AC_LANG", $_SESSION["admin_lang"]);
else 								define("AC_LANG", AC_DEFAULT_AC_LANG);


//	include lang file
$the_file=AC_DIR_AC_LANG.AC_LANG.".lang.php";
if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
else		require_once($the_file);
//echo $_SESSION["admin_id"] ;die;
//	define page to show
if(!isset($_SESSION["admin_id"]))	$_REQUEST["page"]="admin-login";
elseif(!isset($_REQUEST["page"])) 	$_REQUEST["page"]="items";
define("ADMIN_PAGE", $_REQUEST["page"]);

$page_title=$lang["admin_".ADMIN_PAGE.""];


if(ADMIN_PAGE=="admin-login"){
	$this_title="";
	$admin_menu="";
	$the_file=AC_DIR_ADMIN."admin-login.admin.php";
	if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
	else		require_once($the_file);
}else{
	//	include menu file
	$the_file=AC_DIR_ADMIN."admin-menu.inc.php";
	if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
	else		require_once($the_file);
		
	
	//	define condition for users
	$sql_condition="";
	if($_SESSION["admin_level"]>1)	$sql_condition=" AND b.id_user=".$_SESSION["admin_id"];
	
	//echo $sql_condition; die;
	//	check user is allowed to see this page
	if(!multi_array_key_exists($_REQUEST["page"],$menu[$_SESSION["admin_level"]])){
		$the_file=AC_DIR_ADMIN."forbidden.admin.php";
	}else{
		$the_file=AC_DIR_ADMIN.ADMIN_PAGE.".admin.php";
	}
	//	now inlcude the page defined
	if(!file_exists($the_file)) die("<b>".$the_file."</b> not found");
	else		require_once($the_file);
	
	$this_title='
	<div id="title">
		<div class="float_l" ><h1>>> '.$page_title.' '.$page_title_add.'</h1></div>
		<div class="float_r">'.$bt_add.'</div>
		<div class="clear"></div>
	</div>
	';
}


if(isset($_REQUEST["msg"])) $warning.=$lang["msg_".$_REQUEST["msg"].""];
if(isset($warning)){
	$xtra_moo.="roar.alert('Information','".$warning."');";
}
// echo AC_DIR_CSS; die;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Rentals</title>
		
		<link rel="stylesheet" href="<?php echo AC_DIR_CSS; ?>reset.css">
		<link rel="stylesheet" href="<?php echo CALPATH?>css/admin-calendar.css">
		<link rel="stylesheet" href="<?php echo CALPATH?>css/admin.css">
		<link rel="stylesheet" href="<?php echo CALPATH?>css/mootools-roar.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CALPATH?>js/formcheck/theme/classic/formcheck.css"  />
		
		<script type="text/javascript" src="<?php echo AC_DIR_JS; ?>mootools-core-1.3.2-full-compat-yc.js"></script>
		<script type="text/javascript" src="<?php echo AC_DIR_JS; ?>mootools-more-1.3.2.1.js"></script>
		<script type="text/javascript" src="<?php echo CALPATH?>js/formcheck/lang/<?php echo AC_LANG; ?>.js"></script>
		<script type="text/javascript" src="<?php echo CALPATH?>js/mootools-formcheck.js"></script>
		<script type="text/javascript" src="<?php echo CALPATH?>js/mootools-roar.js"></script>
		<?php echo $xtra_js_files; ?>
		
		<script type="text/javascript">
		<?php echo $xtra_js; ?>
		var txtWarning = '<?php echo $lang["msg_warning"]; ?>';
		var txtOrderUpdateOK = '<?php echo $lang["msg_order_update_OK"]; ?>';
		var txtOrderUpdateKO = '<?php echo $lang["msg_order_update_KO"]; ?>';
		var txtStateModOK = '<?php echo $lang["msg_state_mod_OK"]; ?>';
		var txtStateModKO = '<?php echo $lang["msg_state_mod_KO"]; ?>';
		window.addEvent('domready', function() {
			var the_menu=$$('#menu li').setStyle("cursor","pointer");
			the_menu.addEvents({
			    'mouseover': function(){
			        var bg_color=this.getStyle("backgroundColor");
					this.highlight('#99ccff',bg_color); 
			    },
			    'click': function(){
			       	document.location.href=this.getChildren().get('href');
			    }
			});
			//	roar alerts
			var roar = new Roar({position: 'lowerRight',duration:'5000'});
			
			//	zebra
			$$('tbody tr:odd').addClass('odd');
		
			//	create sortables
			//	sortables
			if(document.id('sortable')){
				// row handles
				$$('.handles').setStyle('cursor','pointer').addEvent('mouseover',function(event){
					this.getParent().highlight();
				});
				
				
				var tblSortable=document.id('sortable');
				var sb = new Sortables('.list tbody', {
					handle: '.handles',
					clone: false,
					revert: true,
					constrain:true,
					onStart: function(el) { 
						el.setStyle('background','#99ccff');
					},
					onComplete: function(el) {
						el.setStyle('background','#99CCFF');
						var sort_order = '';
						$$('.list tbody tr').each(function(tr) { sort_order = sort_order +  tr.get('alt')  + '|'; });
						$('sort_order').value = sort_order;
						var order_field=tblSortable.get('field');
						var order_table=tblSortable.get('table');
						var req = new Request({
							url:'<?php echo AC_DIR_AJAX; ?>list_order.ajax.php',
							method:'get',
							autoCancel:true,
							data: {'sort_order':sort_order,'type':order_table,'order_field':order_field},
							onRequest: function() {
								//roar.alert('Order','Updating the sort order in the database.');
							},
							onSuccess: function() {
								roar.alert(''+txtWarning+' ',''+txtOrderUpdateOK+'');
							}
						}).send();
					}
				});
			}
			//update states
			var states=$$('.update_state').setStyle('cursor','pointer').addEvent('click',function(){
				//	define vars
				var el=$(this.id);
				var icon_states=new Array('<img src="icons/icon_cross.png">','<img src="icons/icon_tick.png">');
				var txtWarningOK=txtStateModOK;
				var txtWarningKO=txtStateModKO;
				var imgLoading='<img src=\"icons/ajax-loader.gif\">';
				//	ajax call to change state
				var myHTMLRequest = new Request({
					url:'../ac-includes/ajax/update-state.ajax.php',
					method:'post',
					async:false,
					data: {
						'type':this.get('rel'),
						'cur_state':this.get('state'),
						'id_item':this.id.replace('state_',''),
						'field':this.get('field')
						},
					onRequest: function() {
						el.set('html',imgLoading);
					},
					onComplete: function(responseText) {
						var newState=responseText;
						if(newState=='KO'){
							Sexy.alert(txtWarningKO);
						}else{
							el.set('state',newState);
							el.set('html',icon_states[newState]);
							roar.alert('State',txtWarningOK);
						}
					}
				}).send();
			});
			<?php
			echo $xtra_moo;
			?>
		});
		</script>
	</head>
	<body id="page_<?php echo ADMIN_PAGE; ?>">
	<div id="wrapper">
		<!--<div id="header">
			<?php echo LOGO_CALENDAR_ADMIN; ?>
			<div id="version"><?php echo CAL_VERSION; ?></div>
		</div>-->
		<?php echo $admin_menu; ?>
		<?php //echo $this_title; ?>
		<div id="title">
		<!--<div class="float_l"><h1>&gt;&gt; Booking Calendar </h1></div>-->
		<div class="float_r"></div>
		<div class="clear"></div>
	</div>
		<div id="contents">
			<?php echo $contents; ?>
		</div>
		<div class="clear"></div>
		<!--<a href="<?php echo base_url();?>admin/product/display_product_list">back to rental list</a>-->
	</div>
	</body>
</html>