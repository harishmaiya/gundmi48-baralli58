<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/admin/jquery.dop.BackendBookingCalendarPRO.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<script type="text/JavaScript" src="<?php echo base_url();?>js/jquery-latest.js"></script>
<script type="text/JavaScript" src="<?php echo base_url();?>js/admin/jquery.dop.BackendBookingCalendarPRO.js"></script>

<script type="text/JavaScript">
            $(function(){
                $('#backend').DOPBackendBookingCalendarPRO({
   'ID': <?php echo $ViewList['rental_id']; ?>,
	'DataURL': '<?php echo base_url();?>dopbcp/php-database/load.php',
    'SaveURL': '<?php echo base_url();?>dopbcp/php-database/save.php'
});


// Get data from the database example.
                $('#backend').DOPBackendBookingCalendarPRO({'DataURL': 'dopbcp/php-database/load.php',
                                                            'SaveURL': 'dopbcp/php-database/save.php'});

                $('#backend-refresh').click(function(){
                    $('#backend').DOPBackendBookingCalendarPRO({'Reinitialize': true});

// Get data from the database example.                    
                    $('#backend').DOPBackendBookingCalendarPRO({'Reinitialize': true,
                                                                'DataURL': 'dopbcp/php-database/load.php',
                                                                'SaveURL': 'dopbcp/php-database/save.php'});
                });
            });
        </script>
        <input type="hidden" value="<?php echo $ViewList['price']; ?>" name="comprice" id="comprice">	
</head>
<body>
<div id="wrapper">
  <div id="backend-container">
    <!-- <input type="button" name="backend-refresh" id="backend-refresh" class="reload-btn" value="Refresh Back End Calendar" />-->
    <div id="backend"></div>
  </div>
</div>
</body>
