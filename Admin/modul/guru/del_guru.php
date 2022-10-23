<?php
$id=$_GET['id'];
$select=mysqli_query($con,"select foto from tb_guru where id_guru='$id'");
$imagee=mysqli_fetch_array($select);
unlink('../vendor/images/img_Guru/'.$imagee['foto']);
$del = mysqli_query($con,"DELETE FROM tb_guru WHERE id_guru='$id' ") or die(mysqli_error($con));
if ($del) {	

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'Data Telah dihapus !!',
	type: 'success',
	timer: 3000,
	showConfirmButton: true
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=guru');
	} ,3000);   
	</script>";
}

 ?>