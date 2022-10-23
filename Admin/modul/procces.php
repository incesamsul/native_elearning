<?php 
if (isset($_POST['set'])) {

$gambar = @$_FILES['logo']['name'];
if (!empty($gambar)) {
move_uploaded_file($_FILES['logo']['tmp_name'],"../vendor/images/$gambar");
$ganti = mysqli_query($con,"UPDATE tb_sekolah SET logo='$gambar' WHERE id_sekolah='$_POST[id]' ");
}
mysqli_query($con,"UPDATE tb_sekolah SET nama_sekolah='$_POST[nmsekolah]',kepsek='$_POST[kepsek]',textlogo='$_POST[textlogo]',copyright='$_POST[copyright]' WHERE id_sekolah='$_POST[id]' ") or die (mysqli_error($con));
?>
<script type='text/javascript'>
setTimeout(function () {
swal({
title: 'DATA DIPERBARUI',
text:  'Berhasil Memperbarui !',
type: 'success',
timer: 3000,
showConfirmButton: true
});     
},10);  
window.setTimeout(function(){ 
window.location.replace('?page=setting');
} ,3000);   
</script>
<?php
	}
 ?>