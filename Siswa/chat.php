<?php 
if (isset($_POST['sendMassage'])) {

$tanggal = date('Y-m-d');
$send = mysqli_query($con, "INSERT INTO pesan VALUES('null','$_POST[pengirim]','$_POST[penerima]','$tanggal','Re: $_POST[isi_pesan]','belum','$_POST[kelas]','$_POST[jurusan]')");
if ($send) {
	$ubah= mysqli_query($con,"UPDATE pesan SET sudah_dibaca='sudah' WHERE id_pesan='$_POST[status]' ");
	if ($ubah) {
		echo "
<script> 
alert('Terkirim !');
window.location='index.php';
</script>"; 
	}
                       
}                   
}elseif (isset($_POST['sendMassageMassal'])) {
                  $tanggal = date('Y-m-d');
                  $send = mysqli_query($con, "INSERT INTO pesan 
                  VALUES('null','$_POST[idpengirim]','$_POST[penerima]','$tanggal','$_POST[pesan]','belum','$_POST[idkelas]','$_POST[idjurusan]')");
                  if ($send) {
                  echo "
                  <script> 
                  alert('Terkirim !');
                  window.location='index.php';
                  </script>";                        
                  }                   
                  }  


?>