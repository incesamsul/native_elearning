<?php
session_start();
unset($_SESSION['Guru']); 
echo "<script>window.location='../index.php';</script>";


?>