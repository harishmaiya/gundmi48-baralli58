<?php 
$this->load->view('site/templates/header',$this->data);
?>
<div class="container">
			<div>
			Edit Wish List: 
			</div>
			
			<form action="" method="post">
			<label>Title</label>
			<input type="text" name="title">
			<label>Who can see this?</label>
			<select type="select" >
			
			</select>
			</form>
		
		 </div>
<?php 
$this->load->view('site/templates/footer',$this->data);
?>