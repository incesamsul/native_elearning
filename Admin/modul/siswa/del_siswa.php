<?php
$id=$_GET['id'];
$select=mysqli_query($con,"select foto from tb_siswa where id_siswa='$id'");
$imagee=mysqli_fetch_array($select);
unlink('../vendor/images/img_Siswa/'.$imagee['foto']);
$del = mysqli_query($con,"DELETE FROM tb_siswa WHERE id_siswa='$id' ") or die(mysqli_error($con));
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
	window.location.replace('?page=siswa');
	} ,3000);   
	</script>";
}

 ?>