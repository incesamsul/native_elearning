<?php
session_start();
include "../config/koneksi.php";

if(empty($_SESSION['username']) or empty($_SESSION['password']) ){
   header('location: ../index.php');
}

$kelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tb_siswa
 INNER JOIN tb_master_kelas ON tb_siswa.id_kelas=tb_master_kelas.id_kelas
 INNER JOIN tb_master_jurusan ON tb_siswa.id_jurusan=tb_master_jurusan.id_jurusan
 WHERE tb_siswa.id_kelas='$_SESSION[kelas]' AND tb_siswa.id_jurusan='$_SESSION[jurusan]' "));

$ujian = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM ujian
INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
 WHERE ujian.id_ujian='$_GET[ujian]'"));
?>
<div class="row">
  <div class="col-md-8">
    <div class="list-group-item top-heading">
<h3 class="list-group-item-heading page-label">Informasi Ujian</h3></div>
      <table class="table table-striped table-condensed">
        <thead>
        <tr>
        <th>Nomor</th>
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
          <td><b><?= $kelas['kelas']; ?> - <?= $kelas['jurusan']; ?></b></td>
          </tr><tr>
          <td>Pelajaran</td>
          <td><b><?= $ujian['mapel']; ?></b></td>
          </tr><tr>
          <td>Jml. Soal</td>
          <td><b><?= $ujian['jml_soal']; ?></b></td>
          </tr><tr>
          <td>Waktu</td>
          <td><b><?= $ujian['waktu']; ?> </b></td>
        </tr>
        </tbody>
        </table>
    </div>  
     <div class="col-md-4">
      
  <div id="myerror" class="alert alert-warning" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">
    <i class="glyphicon glyphicon-warning-sign"></i>  
    <font size="3px">Ini akan memakan waktu sedikit, Harap Bersabar * jika kamu belum menyelesaikan ujian dan waktu sudah habis maka nilai kami kosong</font>
    </div>


<?php 
//Jika nilai sudah ada tampilkan tombol Sudah Mengerjakan, jika belum ada tampilkan tombol Masuk Ujian
$qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_ujian='$_GET[ujian]' AND id_siswa='$_SESSION[id_siswa]'");
$tnilai = mysqli_num_rows($qnilai);
$rnilai = mysqli_fetch_array($qnilai);

if($tnilai>0 and $rnilai['nilai'] != "")  echo '<a class=""btn btn-danger btn-block doblockui"> Lihat Nilai </a>';
else echo '<center> <a type=button" onclick="show_ujian('.$_GET['ujian'].')">
<button type="submit" class="btn btn-danger btn-lg doblockui"><i class="fa fa-edit"></i> Kerjakan Soal</button></a></center>';
?>
    </div>  
</div>


<!-- <div class="grup" style="width:95%; margin:0 auto; margin-top:25px">
<div class="kiri">
<div class="list-group-item top-heading">
<h3 class="list-group-item-heading page-label">Informasi Ujian</h3></div>
<div class="list-group-item">


</div>
</div><div class="kanan">


</div></div> -->