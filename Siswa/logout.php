<?php
include '../config/db.php';
  session_start();
  mysqli_query($con,"UPDATE tb_siswa SET status='off' WHERE id_siswa='$_GET[ID]'");
  
  session_destroy();
  

echo "<script>window.location='../index.php';</script>";
?>
