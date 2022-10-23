<?php 

if ($_GET['status']=='Y') {
	$sql = mysqli_query($con,"UPDATE tb_materi SET public='N' WHERE id_materi='$_GET[id]' ");
	echo " <script>
 	window.location='?page=materi';
 </script>";
}else{
	$sql = mysqli_query($con,"UPDATE tb_materi SET public='Y' WHERE id_materi='$_GET[id]' ");
	echo " <script>
 	window.location='?page=materi';
 </script>";

}
 ?>

