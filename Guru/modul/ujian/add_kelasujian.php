<?php

$sql = mysqli_query($con,"INSERT INTO kelas_ujian VALUES('null','$_GET[ujian]','$_GET[kelas]','$_GET[jurusan]','Y') ");
if ($sql) {
    echo "
    <script>
    window.location='?page=ujian';
    </script>
    
    ";
}

?>
