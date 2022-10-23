<?php 

$sql=mysqli_query($con,"DELETE FROM kelas_ujianessay WHERE id_klsessay='$_GET[id]' ");
	if ($sql) {
        echo "
        <script>
        window.location='?page=ujian';
        </script>
        
        ";
	}

 ?>

