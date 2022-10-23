<?php 

$sql=mysqli_query($con,"DELETE FROM soal_essay WHERE id_soal='$_GET[ids]' ");
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
				window.location.replace('?page=ujian');
				} ,3000);   
				</script>";
				
	}
