<?php
$del = mysqli_query($con,"UPDATE tb_siswa SET aktif='N',confirm='Yes' WHERE id_siswa='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {	

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'Akun ditolak',
	type: 'success',
	timer: 3000,
	showConfirmButton: true
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('index.php');
	} ,3000);   
	</script>";
}

 ?>
