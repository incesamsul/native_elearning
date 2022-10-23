<?php
$con = mysqli_query($con,"UPDATE tb_guru SET status='Y',confirm='Yes' WHERE id_guru='$_GET[id]' ") or die(mysqli_error($con));
if ($con) {	

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'CONFIRMASI SUKSES',
	text:  'Akun telah Aktif !',
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