<div class="content-wrapper">
<h4> <b>Tugas</b> <small class="text-muted">/Informasi Tugas</small>
</h4>
<hr>
<div class="row">
<div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="text-heading"> DAFTAR TUGAS </h4>
        <p></p>
        <hr>


          <div class="row">
            <?php 
            // cek tabel tugas
            $kelas = mysqli_query($con,"SELECT * FROM kelas_tugas WHERE id_kelas='$_SESSION[kelas]' AND id_jurusan='$_SESSION[jurusan]' ORDER BY id_tugas DESC ");
             $jumlah = mysqli_num_rows($kelas);
           
            foreach ($kelas as $d) { ?>
           <?php 
           if ($d['aktif']=='N') {
               echo '
               <div class="alert alert-danger">
               <b>Tidak ada Tugas Untuk Kelas Kamu !</b>
               </div>

               ';
           }else{
            ?>
                            <?php 
                // tampilkan dat ujian
                $ujian = mysqli_query($con,"SELECT *,DATE_ADD(tanggal,INTERVAL waktu DAY)AS jatuh_tempo
 ,DATEDIFF(DATE_ADD(tanggal,INTERVAL waktu DAY),CURDATE()) AS selisih FROM tb_tugas
 INNER JOIN tb_jenistugas ON tb_tugas.id_jenistugas=tb_jenistugas.id_jenistugas
 INNER JOIN tb_guru ON tb_tugas.id_guru=tb_guru.id_guru
  INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
   INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
   WHERE tb_tugas.id_tugas='$d[id_tugas]' ORDER BY tb_tugas.id_tugas DESC ");
   foreach ($ujian as $t) { ?>
                 <div class="col-md-6 col-xs-12"> 
                  <div class="alert alert-dark alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    TUGAS <strong><?=$t['mapel'] ?> </strong>
                    <p>
                      <p>
                        OLEH : <b><?=$t['nama_guru'] ?></b>
                      </p>

                      <table class="table table-striped">
                        <tr>
                          <th>Jenis Tugas</th>
                          <th>:</th>
                          <th> <?=$t['jenis_tugas'] ?></th>
                        </tr>
                   <!--      <tr>
                          <th>Tanggal Posting</th>
                          <th>:</th>
                          <th> <?= date('d-F-Y',strtotime($t['tanggal'])) ?> </th>
                        </tr> -->
                          <tr>
                          <th>Batas Pengumpulan Tugas</th>
                          <th>:</th>
                          <th> <?= date('d-F-Y',strtotime($t['jatuh_tempo'])) ?></th>
                        </tr>
                          <tr>
                          <th>Sisa Waktu</th>
                          <th>:</th>
                          <th> <?=$t['selisih'] ?> Hari Lagi </th>
                        </tr>
                      </table>

                     </p>
                     <hr>
                     <p>
                      <?php 

                      if ($t['selisih']==0) {
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Waktu Habis!</strong> Anda tidak dapat menegrjakan tugas ini karena Sudah mencapai waktu maksimum ,Jika ada kesalahan,hubungi Guru Mata pelajaran
                        </div>
                        <?php


                      }else{
                        $cektugas = mysqli_query($con,"SELECT * FROM tugas_siswa WHERE id_tugas='$d[id_tugas]' AND id_siswa='$_SESSION[Siswa]' ");
                        $jml= mysqli_num_rows($cektugas);
                        if ($jml < 1) {
                         echo "<b class='badge badge-pill badge-danger'>Belum dikerjakan</b> ";
                            ?>
                         <p></p>
                          <a href="?page=tugas&act=upload&tugas=<?php echo $t[id_tugas];?>&id=<?php echo $t[id_jenistugas];?>&jenis=<?php echo $t[jenis_tugas];?>" class="btn btn-light"><i class="fa fa-pencil"></i> Kerjakan</a>
                       <a href="../Report/tugas/download_tugas.php?tugas=<?php echo $t[id_tugas] ?>&kelas=<?php echo $_SESSION[kelas] ?>&jurusan=<?php echo $_SESSION[jurusan] ?> " class="btn btn-light" target="_blank"><i class="fa fa-download"></i> Download</a> 
                        
                        <?php
                        }else{
                          echo "<b class='badge badge-pill badge-success'>Sudah dikerjakan</b>";
                        }

                       
                      }


                       ?>


                     </p>
                  </div>
                </div> 
              <?php } ?>

                <?php

           }

            ?>           
         

            <?php } ?>
              
 


            
                   
          </div>

          <div class="row">
            
          </div>


        </div>
      </div>                  
</div>
</div>
</div>

