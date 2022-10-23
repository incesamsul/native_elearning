<?php 

$sql=mysqli_query($con,"DELETE FROM tb_tugas WHERE id_tugas='$_GET[idt]' ");
	if ($sql) {
	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'Sukses',
	text:  'Data Telah Terhapus !',
	type: 'success',
	timer: 3000,
	showConfirmButton: true
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=tugas');
	} ,3000);   
	</script>";
	}

 ?>