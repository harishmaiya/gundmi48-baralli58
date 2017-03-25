<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<?php 
	$active_users = $inactive_users = 0;
	if ($usersList->num_rows()>0){
		foreach ($usersList->result() as $row){
			$status = strtolower($row->status);
			if ($status == 'active'){
				$active_users++;
			}else {
				$inactive_users++;
			}
		}
	}
?>
<script type="text/javascript">
/*=================
CHART 5
===================*/
$(function(){
  plot2 = jQuery.jqplot('chart_new_new',
    [[['Active',<?php echo $active_users; ?>],['Inactive', <?php echo $inactive_users; ?>]]],
    {
      title: ' ',
      seriesDefaults: {
        shadow: false,
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          startAngle: 180,
          sliceMargin: 4,
          showDataLabels: true }
      },
		grid: {
         borderColor: '#ccc',     // CSS color spec for border around grid.
        borderWidth: 2.0,           // pixel width of border around grid.
        shadow: false               // draw a shadow for grid.
    },
      legend: { show:true, location: 'w' }
    }
  );
});

</script>

	<script type="text/javascript">
		// google chart
		// google.charts.load('current', {'packages':['corechart']});
		// google.charts.setOnLoadCallback(drawChart);
		// function drawChart() {

		//   var data = google.visualization.arrayToDataTable([
		//     ['Task', 'Hours per Day'],
		//     ['Active',<?php echo $active_users; ?>],
		//     ['Inactive',<?php echo $inactive_users; ?>]
		//   ]);

		//   var options = {
		//     title: ''
		//   };

		//   var chart = new google.visualization.PieChart(document.getElementById('chart_new'));

		//   chart.draw(data, options);
		// }
    </script>


<div id="content">
		<div class="grid_container">
			
            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Member Dashboard</h6>
					</div>
					<div class="widget_content">
					<h4><?php echo $usersList->num_rows();?> users registered in this site</h4>	
						<!--<p>
							 <?php echo $usersList->num_rows();?> users registered in this site
						</p>-->
						<!-- <div id="chart5" class="chart_block"> -->
						<div id="chart_new_new">
						<!-- <div id="chart_new" class="chart_block_new"></div>  -->
						</div>
					</div>
				</div>
			</div>
            
            
            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon image_1"></span>
						<h6>Member Users</h6>
					</div>
					<div class="widget_content">
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 Full Name
							</th>
							<th>
								 Status
							</th>
							<th>
								 Email
							</th>
							<th>
								 image
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($usersList->num_rows() > 0){
							$result = $usersList->result_array();
							for ($i=0;$i<5;$i++){
								if (isset($result[$i]) && is_array($result[$i])){
						?>
						<tr class="tr_even">
							<td>
								 <?php echo ucfirst($result[$i]['firstname']).' '.ucfirst($result[$i]['lastname']);?>
							</td>
							<td>
								 <?php echo $result[$i]['status'];?>
							</td>
							<td>
								 <?php echo $result[$i]['email'];?>
							</td>
							<td>
								<div class="widget_thumb">
									<?php if ($result[$i]['loginUserType'] == 'google'){?>
									<img width="40px" height="40px" src="<?php echo $result[$i]['image'];?>" />
									<?php } else if ($result[$i]['image'] != ''){?>
										<img width="40px" height="40px" src="<?php echo base_url();?>images/users/<?php echo $result[$i]['image'];?>" />
									<?php }else {?>
										 <img width="40px" height="40px" src="<?php echo base_url();?>images/users/user-thumb1.png" />
									<?php }?>
								</div>
							</td>
						</tr>
						<?php 
								}
							}
						}else {
						?>
						<tr>
							<td colspan="5" align="center">No Users Available</td>
						</tr>
						<?php }?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>