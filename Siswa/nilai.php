<?php
session_start();
include "../config/koneksi.php";

$kelas = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tb_master_kelas WHERE id_kelas='$_SESSION[kelas]'"));
$jur = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tb_master_jurusan WHERE id_jurusan='$_SESSION[jurusan]'"));
$mapel = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM ujian
  INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
 WHERE id_ujian='$_GET[ujian]'"));
$soal = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM soal WHERE id_ujian='$_GET[ujian]'"));
$nilai = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM nilai WHERE id_ujian='$_GET[ujian]' AND id_siswa='$_SESSION[id_siswa]'"));

?>
<div class="grup" style="width:95%; margin:0 auto; margin-top:25px">
<div class="kiri">
 <div class="list-group-item top-heading">
<h4 class="list-group-item-heading page-label">Nilai Kamu</h4></div>

<div class="alert alert-info">
<table class="table table-striped">
  <thead>   
    <tr>
        <th>NIS</th>
        <th><b><?= $_SESSION['nis']; ?> </b></th>       
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Nama</td>
        <td><b><?= $_SESSION['namalengkap']; ?> </b></td>
       </tr>
    <tr>
        <td>Kelas</td>
        <td><b><?= $kelas['kelas']; ?> - <?= $jur['jurusan']; ?></b></td>
       </tr><tr>
        <td>Pelajaran</td>
        <td><b><?= $mapel['mapel']; ?></b></td>
       </tr><tr>
        <td>Jml. Soal</td>
        <td><b><?= $mapel['jml_soal']; ?></b></td>
       </tr><tr>
        <td>Jawaban Benar</td>
        <td><b><?= $nilai['jml_benar']; ?> </b></td>
       </tr>
       <tr>
        <td>Jawaban  Salah</td>
        <td><b><?= $nilai['jml_salah']; ?> </b></td>
       </tr>
       <tr>
        <td>Jawaban Kosong</td>
        <td><b><?= $nilai['jml_kosong']; ?> </b></td>
       </tr>
       
    </tbody>
</table>
<Center><p> Nilai :</p>
	 <font size="50px" color="#FF0000"><?= $nilai['nilai']; ?> </font>
     <a href="index.php"><button class="btn btn-info btn-block doblockui">kembali</button></a>
 </Center>   
    </div>
  </div> 
   <div class="kanan">

	<div id="myerror" class="alert alert-info" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">

<font size="3px">Rengking 10 Besar </font>
	</div>
    
    
    <div id="myerror" class="alert alert-info" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">
      
  <?php

echo"<table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>";
                 
$tampil=mysqli_query($mysqli, "SELECT * FROM nilai 
                           WHERE  id_ujian='$_GET[ujian]' ORDER BY jml_benar  DESC LIMIT 10");
$no = 1;
   while($r=mysqli_fetch_array($tampil)){
  $siswa = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tb_siswa WHERE id_siswa='$r[id_siswa]'"));			
echo "<tr>
        <td>$no</td>
        <td>$siswa[nama_siswa]</td>
		<td>$r[nilai]</td>
	</tr>";

$no ++;
							 }
                echo "</tbody>
                <tfoot>
                <tr>
				<th>No</th>
                  <th>Nama</th>
                  <th>Nilai</th>
				
				 </tr>
                </tfoot>
              </table>";





							 
?>
    
    </div>
    
</div>
   
 
   
 </div>