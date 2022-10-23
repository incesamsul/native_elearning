<?php 

$sql=mysqli_query($con,"DELETE FROM ujian WHERE id_ujian='$_GET[id]' ");
	if ($sql) {

		$sql1=mysqli_query($con,"DELETE FROM kelas_ujian WHERE id_ujian='$_GET[id]' ");
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
				window.location.replace('?page=ujian');
				} ,3000);   
				</script>";
	}

 ?>