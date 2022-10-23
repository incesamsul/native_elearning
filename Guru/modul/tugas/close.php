<?php 

$close = mysqli_query($con,"UPDATE kelas_tugas SET aktif='N' WHERE id_tugas='$_GET[tugas]'  ");

    if ($close) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'KELAS TELAH DITUTUP',
			text:  'Terimakasih',
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