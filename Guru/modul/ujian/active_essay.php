<?php 

$aktif = mysqli_query($con,"UPDATE kelas_ujianessay SET aktif='Y' WHERE id_ujianessay='$_GET[essayid]' ");

    if ($aktif) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'UJIAN TELAH AKTIF',
			text:  '',
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