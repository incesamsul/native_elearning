<div class="content-wrapper">
<h4> <b>Evaluasi</b> <small class="text-muted">/Informasi Ujian</small>
</h4>
<hr>
<div class="row">
<div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="text-heading"> DAFTAR UJIAN </h4>
        <p></p>
        <hr>
<!-- Informasi ujian objektif -->


<?php
session_start();
include "../config/db.php";
//Cek jumlah ujian pada tanggal sekarang
$tgl = date('Y-m-d');
$qujian = mysqli_query($con, "SELECT * FROM ujian t1, kelas_ujian t2 WHERE t1.tanggal='$tgl' AND t1.id_ujian=t2.id_ujian AND t2.id_kelas='$_SESSION[kelas]' AND t2.aktif='Y'");
$tujian = mysqli_num_rows($qujian);
$rujian = mysqli_fetch_array($qujian);

//Jika tidak ada ujian aktif tampilkan pesan
if($tujian < 1){
   echo '
   <div class="alert alert-info">Belum ada ujian Pada Tanggal Sekarang Untuk Kelas Kamu. Jika ada kesalahan hubungi Guru Mata Pelajaran! perbaiki tanggal ujian atau kelas ujian</div>';
}

//Jika ada dua atau lebih ujian aktif tampilkan pada tabel
else{
   echo '<div class="table-responsive">
           <table class="table table-striped" id="data">
            <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Pelajaran</th>
              <th>Jenis Ujian</th>
              <th>Info</th>
            </tr>
            </thead>
          <tbody>';
	
    $qujian = mysqli_query($con, "SELECT * FROM kelas_ujian 
      INNER JOIN tb_master_kelas ON kelas_ujian.id_kelas=tb_master_kelas.id_kelas
      INNER JOIN tb_master_jurusan ON kelas_ujian.id_jurusan=tb_master_jurusan.id_jurusan
      INNER JOIN ujian ON kelas_ujian.id_ujian=ujian.id_ujian
      INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel

    WHERE ujian.tanggal='$tgl' AND ujian.id_ujian=kelas_ujian.id_ujian AND kelas_ujian.id_kelas='$_SESSION[kelas]' AND kelas_ujian.id_jurusan='$_SESSION[jurusan]' AND kelas_ujian.aktif='Y'
    ");
   $no = 1;
   while($r = mysqli_fetch_array($qujian)){
      
      $kelas_ujian = array();
      $qkelas_ujian = mysqli_query($con, "SELECT * FROM tb_master_kelas t1, kelas_ujian t2

       WHERE  t1.id_kelas=t2.id_kelas AND t2.id_ujian='$r[id_ujian]'");
      while($rku = mysqli_fetch_array($qkelas_ujian)){
         $kelas_ujian[] = $rku['kelas'];
      }

    echo'
    <tr>
    <td><b>'.$no.' .</b></td>
    <td><b>'.$r['judul'].'</b></td>
    <td><b>'.$r['mapel'].'</b></td>
    '; 
       $jenis = mysqli_query($con, "SELECT * FROM tb_jenisujian WHERE id_jenis='$r[id_jenis]'");
       $ju = mysqli_fetch_array($jenis);
       echo '<td><b>'.$ju['jenis_ujian'].'</b></td>';

    //Jika nilai sudah ada tampilkan tombol Sudah Mengerjakan, jika belum ada tampilkan tombol Kerjakan
    $qnilai = mysqli_query($con, "SELECT * FROM nilai WHERE id_ujian='$r[id_ujian]' AND id_siswa='$_SESSION[id_siswa]' ");
    $tnilai = mysqli_num_rows($qnilai);
    $rnilai = mysqli_fetch_array($qnilai);

    if($tnilai>0 and $rnilai['nilai'] != "")
    echo '<td bgcolor= bordercolordark="#00FF33" >
    <a href="index.php?page=evaluasi&act=nilai"><i class="fa fa-file-text"></i><b> Lihat Nilai</b> </a>';

    elseif($tnilai>0 and $rnilai['sisa_waktu'] != "")
    echo '<td bgcolor="#FF3300">
    <a href="index.php"> <i class="btn btn-block"><i class="fa fa-check-circle-o"></i> Lanjutkan</a>';

    else echo '
    <td bgcolor="#FFFF00">
    <a href="index.php"><i class="fa fa-home"></i> Klik tombol <b>Kerjakan</b> pada ujian yg aktif di Halaman Utama </a>';
    echo '</td>
    </tr>';

    $no++;
    }

    echo '</tbody>
    </table>
    </div>

    ';
}
?>


<hr>

<!-- tanpilkan ujian Essay -->
<?php
//Cek jumlah ujian pada tanggal sekarang
$tgl = date('Y-m-d');
$qujianEssay = mysqli_query($con, "SELECT * FROM ujian_essay t1, kelas_ujianessay t2 WHERE t1.tanggal='$tgl' AND t1.id_ujianessay=t2.id_ujianessay AND t2.id_kelas='$_SESSION[kelas]' AND t2.aktif='Y'");
$ujessay = mysqli_num_rows($qujianEssay);
$ujessay = mysqli_fetch_array($qujianEssay);

//Jika tidak ada ujian aktif tampilkan pesan
if($ujessay < 1){
   echo '
   <div class="alert alert-info">Belum ada ujian Essay Pada Tanggal Sekarang Untuk Kelas Kamu. Jika ada kesalahan hubungi Guru Mata Pelajaran! perbaiki tanggal ujian atau kelas ujian</div>';
}

//Jika ada dua atau lebih ujian aktif tampilkan pada tabel
else{

?>

<h4 class="card-title">Ujian Essay</h4>
<table class="table table-striped">     
  <tbody>

    <?php 
    $essayUjian = mysqli_query($con, "SELECT * FROM kelas_ujianessay 
    INNER JOIN tb_master_kelas ON kelas_ujianessay.id_kelas=tb_master_kelas.id_kelas
    INNER JOIN tb_master_jurusan ON kelas_ujianessay.id_jurusan=tb_master_jurusan.id_jurusan
    INNER JOIN ujian_essay ON kelas_ujianessay.id_ujianessay=ujian_essay.id_ujianessay
    INNER JOIN tb_master_mapel ON ujian_essay.id_mapel=tb_master_mapel.id_mapel
    INNER JOIN tb_master_semester ON ujian_essay.id_semester=tb_master_semester.id_semester

    WHERE ujian_essay.tanggal='$tgl' AND ujian_essay.id_ujianessay=kelas_ujianessay.id_ujianessay AND kelas_ujianessay.id_kelas='$_SESSION[kelas]' AND kelas_ujianessay.id_jurusan='$_SESSION[jurusan]' AND kelas_ujianessay.aktif='Y'
    ");
    $no = 1;
    while($e = mysqli_fetch_array($essayUjian)){ ?>
    <tr>
    <td><?=$no++; ?></td>
    <td><?=$e['judul'] ?></td>
    <td><?=$e['mapel'] ?></td>  
     <td><?=$e['jenis_ujian'] ?></td>   
     <td>
       <?php
         $jenis = mysqli_query($con, "SELECT * FROM tb_jenisujian WHERE id_jenis='$e[id_jenis]'");
       $ju = mysqli_fetch_array($jenis);
        ?>
        <?=$ju['jenis_ujian'] ?>
     </td>   
   <td bgcolor=bordercolordark="#00FF33">
    <a href="" data-toggle="modal" data-target="#soalEssay<?php echo $e['id_ujianessay'] ?>"><i class="fa fa-edit"></i> Lihat Soal</a>

<!-- Modal -->
  <div class="modal fade bs-example-modal-lg" id="soalEssay<?php echo $e['id_ujianessay'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-left: 25px;">
        <table style="font-weight:bold;font-family: consolas;font-size: 23px;">
            <tr>
              <td>SOAL ESSAY </td>
            </tr>
             <tr>
              <td>MATA PELAJARAN</td>
              <td>:</td>
              <td><b><?php echo $e['mapel']; ?></b> </td>
            </tr>
             <tr>
              <td>SEMESTER</td>
              <td>:</td>
              <td><b><?php echo $e['semester']; ?></b> </td>
            </tr>
        </table>
        </div>
        <div class="modal-body" style="overflow: scroll;height: 500px;background-color: #fff;margin-left: 50px;">
          <?php echo $e['soal_essay']; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="../Report/soal/print_soalessay.php?ID=<?=$e[id_ujianessay]; ?>" target="_blank" class="btn btn-primary"> <i class="fa fa-download text-white"></i> Download Soal</a>
        </div>
      </div>
    </div>
  </div>














  </td>
    </tr>
  <?php } ?>
</tbody>
</table>

<?php
}

 ?>


</div>
</div>
</div>
</div>
</div>
