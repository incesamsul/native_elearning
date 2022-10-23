<?php
include '../../config/db.php';

session_start();
if (@$_SESSION['Guru']) {
?>
<?php
if (@$_SESSION['Guru']) {
$sesi = @$_SESSION['Guru'];
}
// SESION GURU
$sql = mysqli_query($con,"SELECT * FROM tb_guru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);

// IDENTITAS SEKOLAH
$sqSkl = mysqli_query($con,"SELECT * FROM tb_sekolah WHERE id_sekolah=1 ");
$skl = mysqli_fetch_array( $sqSkl);

// Tampilkan Perangkat Pembelajaran
$sqlPerangkat = mysqli_query($con,"SELECT * FROM tb_materi

                      INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_roleguru.id_roleguru

                      INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas

                      INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel

                      INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                      INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan WHERE tb_materi.id_materi='$_GET[ID]'");
$d = mysqli_fetch_array( $sqlPerangkat);
 $time = time();
      header("Content-Type: application/vnd.msword");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("content-disposition: attachment;filename=MATERI_$time.doc");
?>

<!DOCTYPE html>
<html>
<head>
	<style>
		body{
			font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
         @page{
        size: A4;
        margin: 0;
      }

		}		

	</style>
</head>
<body>
	<center>
		<h3>MATERI PEMBELAJARAN <?=$d['mapel']; ?></h3>
	</center>

<table cellpadding="3">
		<tr>
			<td>NAMA SEKOLAH</td>
			<td>:</td>
			<td> <?=$skl['nama_sekolah'] ?></td>
		</tr>
		<tr>
			<td>MATA PELAJARAN</td>
			<td>:</td>
			<td><?=$d['mapel']; ?> </td>
		</tr>
		<tr>
			<td>KELAS / SEMESTER</td>
			<td>:</td>
			<td><?=$d['kelas']; ?> / <?=$d['semester']; ?></td>
		</tr>
		<tr>
			<td>JURUSAN</td>
			<td>:</td>
			<td><?=$d['jurusan']; ?></td>
		</tr>
</table>
<hr>

<?=$d['materi']; ?>

<table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td>Diketahui</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Kepala SMKN 1 Ampek Angkek </td>
    <td>&nbsp;</td>
    <td>Guru Mata Pelajaran </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=$skl['kepsek']; ?></td>
    <td>&nbsp;</td>
    <td><?=$data['nama_guru']; ?></td>
  </tr>
</table>

</body>
</html>


<?php
} else{



echo "<script>
alert('Anda tidak berhak Akses File Ini !!');
window.location='../../index.php';</script>";

}