<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div>
<br />
<br />

<span>Download Sitebackup</span><span style="margin-left:50px;margin-bottom:50px"><a href="<?php echo base_url();?>backup/staynext.zip" />Sitebackup Download</a></span>

<br />
<br />
<?php 
 //header("Content-type: application/sql"); 

?>

<span>Download Sitebackup</span><span style="margin-left:50px;margin-bottom:50px"><a download href="<?php echo base_url();?>backup/backupdb.sql" />Database Backup Download</a></span>

</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>