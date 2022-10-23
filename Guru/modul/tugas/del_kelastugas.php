<?php 

$sql=mysqli_query($con,"DELETE FROM kelas_tugas WHERE id_klstugas='$_GET[id]' ");
	if ($sql) {
        echo "
        <script>
        window.location='?page=tugas';
        </script>
        
        ";
	}

 ?>

