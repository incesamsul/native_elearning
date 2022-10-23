<?php 

$sql=mysqli_query($con,"DELETE FROM kelas_ujian WHERE id_klsujian='$_GET[id]' ");
	if ($sql) {
        echo "
        <script>
        window.location='?page=ujian';
        </script>
        
        ";
	}

 ?>

