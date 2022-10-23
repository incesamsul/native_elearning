<?php 

$close = mysqli_query($con,"UPDATE kelas_ujian SET aktif='N' WHERE id_ujian='$_GET[ujian]'  ");

    if ($close) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'UJIAN TELAH DITUTUP',
			text:  'Terimakasih',
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