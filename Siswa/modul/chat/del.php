<?php 
$del = mysqli_query($con,"DELETE FROM pesan WHERE id_pesan='$_GET[id]' ");
if ($del) {
	echo " <script>
 	window.location='index.php';
 </script>";
}

 ?>
