  <div class="content-wrapper">
                <h4> <b>Evaluasi</b> <small class="text-muted">/Nilai</small>
                </h4>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                      <div class="card-body">
                      	<div class="table-responsive">
<?php
session_start();
include "../config/koneksi.php";
?>


<?php
//Cek jumlah ujian pada tanggal sekarang
$tgl = date('Y-m-d');
$qujian = mysqli_query($mysqli, "SELECT * FROM ujian t1, kelas_ujian t2 WHERE t1.id_ujian=t2.id_ujian AND t2.id_kelas='$_SESSION[kelas]' AND t2.id_jurusan='$_SESSION[jurusan]' AND t2.aktif='Y'");
$tujian = mysqli_num_rows($qujian);
$rujian = mysqli_fetch_array($qujian);

//Jika tidak ada ujian aktif tampilkan pesan
if($tujian < 1){
   echo '
   <div class="alert alert-info">Belum ada ujian Pada Tanggal Sekarang Untuk Kelas Kamu. Jika ada kesalahan hubungi Operator! perbaiki tanggal ujian atau kelas ujian</div>';
}
  ?>
  
<h4>DAFTAR NILAI</h4>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Pelajaran</th>
        <th>Jenis Ujian</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php 
       $qujian = mysqli_query($mysqli, "SELECT * FROM kelas_ujian 
      INNER JOIN tb_master_kelas ON kelas_ujian.id_kelas=tb_master_kelas.id_kelas
      INNER JOIN tb_master_jurusan ON kelas_ujian.id_jurusan=tb_master_jurusan.id_jurusan
      INNER JOIN ujian ON kelas_ujian.id_ujian=ujian.id_ujian
      INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel

    WHERE ujian.tanggal='$tgl' AND ujian.id_ujian=kelas_ujian.id_ujian AND kelas_ujian.id_kelas='$_SESSION[kelas]' AND kelas_ujian.id_jurusan='$_SESSION[jurusan]' AND kelas_ujian.aktif='Y'
    ");
   $no = 1;
   while($r = mysqli_fetch_array($qujian)){ ?>
       <tr>
        <td> <?=$no++; ?>. </td> 
        <td><?=$r['judul'] ?></td> 
        <td>
        <?php 
        // tampilkan mapel ujian
        $mapel = mysqli_query($mysqli,"SELECT * FROM ujian INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel WHERE id_ujian='$r[id_ujian]'  ");
        foreach ($mapel as $m)
        ?>
        <?=$m['mapel'] ?>            
          </td> 
        <td>
            <?php 
        // tampilkan jenis ujian
        $jenis = mysqli_query($mysqli,"SELECT * FROM ujian INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis WHERE id_ujian='$r[id_ujian]'  ");
        foreach ($jenis as $j)
        ?>
        <?=$j['jenis_ujian'] ?> 
        </td> 
      <td bgcolor="#00BCD4" style="color:#fff;">
      	<a data-toggle="modal" data-target="#viewNilai<?=$m['id_ujian'] ?>" class="btn btn-block" style="font-weight:bold;"><i class="fa fa-search"></i> Lihat Nilai</a>
				<!-- Modal -->
				<div class="modal fade" id="viewNilai<?=$m['id_ujian'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
				      </div>
				      <div class="modal-body">
				        <div class="alert alert-info">
								<?php 
								// tampilkan niali
								$nilai = mysqli_query($mysqli,"SELECT * FROM nilai WHERE id_siswa='$_SESSION[id_siswa]' ");
								foreach ($nilai as $n)
								?>
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
							        <td>Pelajaran</td>
							        <td><b><?= $m['mapel']; ?></b></td>
							       </tr><tr>
							        <td>Jml. Soal</td>
							        <td><b><?= $r['jml_soal']; ?></b></td>
							       </tr><tr>
							        <td>Jawaban Benar</td>
							        <td><b><?= $n['jml_benar']; ?> </b></td>
							       </tr>
							       <tr>
							        <td>Jawaban  Salah</td>
							        <td><b><?= $n['jml_salah']; ?> </b></td>
							       </tr>
							       <tr>
							        <td>Jawaban Kosong</td>
							        <td><b><?= $n['jml_kosong']; ?> </b></td>
							       </tr>
							       
							    </tbody>
							</table>
							<hr>
							<Center><p> Nilai :</p>
								 <font size="50px" color="#FF0000"><?= $n['nilai']; ?> </font>
							 </Center>   
							    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
			</div>
		</div>


	</td>
	
     </tr>
    <?php
     }
     ?>
    </tbody>
  </table>


</div>
    </div>
    </div>                  
</div>
</div>
</div>