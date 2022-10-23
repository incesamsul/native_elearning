<div class="content-wrapper">
<h4>
 <b>EVALUASI</b>
<small class="text-muted">/
UJIAN
</small>
</h4>
   <div class="row purchace-popup">
                <div class="col-md-12 col-xs-12">
                  <span class="d-flex alifn-items-center">
                 <a class="btn btn-dark" data-toggle="modal" data-target="#addUjian"> <i class="fa fa-plus"></i> Add Ujian</a>
                  </span>
                </div>
              </div>
<div class="row">

	<div class="col-md-12 col-xs-12">

  <div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Petunjuk!</strong> <br> Klik <b>Bank Soal</b> Untuk Menambahkan Soal.<br>
   Klik <b>Status Ujian</b> Untuk Membuka dan Menutup Ujian. <br>
   Ujian Akan aktif di halaman Siswa, Apabila anda mengatur <b>tanggal</b> pada hari dimanana ujian akan dilaksanakan dan status ujian <b>Aktif</b>
  </div>

               <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Ujian</h4>
                   <p class="card-description">
                   <!--  <div class="row">
                    <div class="col-md-6">
                      <form action="" method="post">
                      <table class="table">
                    <thead>
                      <tr>
                        <td>
                          <select name="jenis" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                            <option value="">- Pilih Jenis Ujian -</option>
                            <?php $jenis = mysqli_query($con,"SELECT * FROM tb_jenisujian ORDER BY id_jenis ASC"); foreach ($jenis as $j) {
                              echo "<option value='$j[id_jenis]'>$j[jenis_ujian]</option>"; 
                            }
                             ?> 
                          </select>
                        </td>
                        <td>
                      <select name="semester" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                        <option value="">- Pilih Semester -</option>
                        <?php $jenis = mysqli_query($con,"SELECT * FROM tb_master_semester ORDER BY id_semester ASC"); foreach ($jenis as $j) {
                          echo "<option value='$j[id_semester]'>$j[semester]</option>"; 
                        }
                         ?> 
                      </select>
                        </td>
                        <td>
                          <button type="submit" name="filter" class="btn btn-info"><i class="fa fa-search"></i> Filter</button>
                        </td>
                      </tr>
                    </thead>
                  </table> 
             
                  </form>
                    </div>                    
                    </div> -->
                  </p>
                    
                  <div class="table-responsive">
                  <table class="table table-striped table-hover table-condensed" id="data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th>Jenis Soal</th>
                        <th>Type Soal</th>
                        <th>Tgl Ujian</th>
                        <th>Bank Soal</th>
                        <th>Status Ujian</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    $sqlrole = mysqli_query($con,"SELECT * FROM ujian
                    INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis
                    INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
                    INNER JOIN tb_master_semester ON ujian.id_semester=tb_master_semester.id_semester
                    WHERE ujian.id_guru='$sesi' ORDER BY id_ujian DESC");
                    foreach ($sqlrole as $row) { ?>       

                      <tr>
                      
                        <td><?=$no++; ?>.</td>
                        <td><?=$row['mapel']; ?> </td>
                        <td><a href="?page=ujian&act=soal&id=<?=$row['id_ujian']; ?>"><b class="text-primary"> <em>OBJEKTIF</em></b></a></td>
                        <td><?=$row['acak']; ?></td>
                        <td><b><?=date('d-F-Y',strtotime($row['tanggal'])); ?></b></td>
                        <td> 
                          <?php $jmlSoal = mysqli_num_rows(mysqli_query($con,"SELECT * FROM soal WHERE id_ujian='$row[id_ujian]' ")) ?>
                          <a href="?page=ujian&act=soal&id=<?=$row['id_ujian']; ?>" class="btn btn-primary btn-sm text-white">Jumlah Soal  ( <b><?=$jmlSoal; ?></b> )</a>
                      </td>
                           <td>
                  
                            <!-- cek ujian ini di kelas ujian -->
                            <?php 
                                $klsu= mysqli_query($con,"SELECT * FROM kelas_ujian WHERE id_ujian='$row[id_ujian]' AND aktif='Y' ");
                                 $jml = mysqli_num_rows($klsu);
                                // foreach ($klsu as $u)
                                  if ($jml >0) {
                                    ?>
                                    <!-- <a class="badge badge-pill badge-primary"> Aktif</a> -->
                                    <a data-toggle="modal" data-target="#tutup<?=$row['id_ujian']; ?>" class="btn btn-success btn-sm text-white"><i class="fa fa-check-square-o"></i> Aktif </a>
                                    <!-- MODAL TUTUP UJIAN -->
                                    <div class="modal fade" id="tutup<?=$row['id_ujian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">
                                            <center>
                                              Apakah Anda Ingin <b>Non Aktifkan</b> Ujian Ini <br> Sekarang ?
                                            </center>
                                          </h4>
                                        </div>
                                        <div class="modal-body">                                    
                                           <center>
                                             <a href="?page=ujian&act=close&ujian=<?php echo $row['id_ujian']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                           </center>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>

                                    <?php
                                  }else{
                                    ?>
                                    <!-- <a class="badge badge-pill badge-warning">Tidak Aktif</a> -->
                                    <a data-toggle="modal" data-target="#Aktif<?=$row['id_ujian']; ?>" class="btn btn-danger btn-sm text-white"><i class="fa fa-window-close-o"></i> Tutup </a> 
                                           <!-- Modal Aktifkan ujian -->
                                  <div class="modal fade" id="Aktif<?=$row['id_ujian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">
                                            <center>
                                              Apakah Anda Ingin <b>Mengaktifkan</b> Ujian Ini Sekarang ?
                                            </center>
                                          </h4>
                                        </div>
                                        <div class="modal-body">                                    
                                           <center>
                                             <a href="?page=ujian&act=active&ujian=<?php echo $row['id_ujian']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                           </center>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                                    <?php
                                  }                              
                                 
                             ?> 

                        </td>
                        <td>
                          <a data-toggle="modal" data-target="#kelasUjian<?=$row['id_ujian']; ?>" class="btn btn-dark btn-sm text-warning"><i class="fa fa-graduation-cap"></i>Kelas </a>

                           <!-- Modal -->
                            <div class="modal fade" id="kelasUjian<?=$row['id_ujian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Kelas Ujian</h4>
                                  </div>
                                   <form  method=POST enctype='multipart/form-data' action=?page=proses>
                                  <div class="modal-body">                                       
                                <input type="hidden" name="id" value="<?=$row[id_ujian]; ?>">
                                  <table  class='table'>
                                  <thead>
                                  <tr>
                                    <th>Nama Kelas</th>
                                  </tr>
                                  </thead>
                                    <tbody>
                                    <?php
                                    $edit = mysqli_query($con, "SELECT * FROM ujian WHERE id_ujian='$row[id_ujian]'");
                                    $r = mysqli_fetch_array($edit);
                                    foreach ($edit as $jml) { ?>
                                    <tr>
                                    <td>  
                                    <?php 
                                    $kelas = mysqli_query($con, "SELECT * FROM tb_roleguru
                                    INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                                    INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                                    WHERE tb_roleguru.id_guru='$sesi' GROUP BY tb_roleguru.id_kelas ");
                                    while($t = mysqli_fetch_array($kelas)){

                                    $jml  = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM kelas_ujian WHERE id_ujian=$row[id_ujian] "));
                                    ?>
                                    <?php
                                    if ($t['id_kelas'] == $jml['id_kelas']) {
                                    ?>          
                                    <label class="form-check-label">
                                    <input type="checkbox" value="<?=$t['id_kelas']; ?>" name="kelas[]" checked>
                                    KELAS <?=$t['kelas']; ?>
                                    </label>
                                    <label class="form-check-label">
                                    <input type="checkbox" value="<?=$t['id_jurusan']; ?>" name="jurusan[]" checked>
                                    <?=$t['jurusan']; ?>
                                    </label>
                                    <hr>
                                    <?php
                                    }else{
                                    ?>
                                    <br>
                                    <label class="form-check-label">
                                    <input type="checkbox" value="<?=$t['id_kelas']; ?>" name="kelas[]">
                                    KELAS <?=$t['kelas']; ?>
                                    </label>
                                    <label class="form-check-label">
                                    <input type="checkbox" value="<?=$t['id_jurusan']; ?>" name="jurusan[]">
                                    <?=$t['jurusan']; ?>
                                    </label>
                                    <hr>
                                    <?php
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                  </table>

                                  <table class="table">
                                    <tr>
                                      <td>Kelas</td>
                                      <td>Action</td>
                                    </tr>
                                    <tr>
                                      <td>
                                        xii
                                      </td>
                                      <td>
                                        edit
                                      </td>
                                    </tr>
                                  </table>


<!-- 
  <p class='stdformbutton'>
  <button name="kelasujianSave" type="submit" class='btn btn-primary'>Simpan</button>
  <input type=button value=Batal onclick=self.history.back() class='btn btn-warning btn-rounded'>

  </p> -->



                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button name="kelasujianSave" type="submit" class="btn btn-primary">Save changes</button>
                                  </div>
                                    </form>
                                </div>
                              </div>
                            </div>










                          <a href="?page=ujian&act=ujianedit&id=<?=$row['id_ujian']; ?>" class="btn btn-dark btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                          <a href="?page=ujian&act=ujiandel&id=<?=$row['id_ujian']; ?>" onclick="return confirm('Yakin Hapus Data ?')" class="btn btn-dark btn-sm text-danger"><i class="fa fa-trash"></i> Del </a>
                        </td>

                      </tr>
                    <?php } ?>

                   </tbody>
                   <?php 
                      $sqlessay = mysqli_query($con,"SELECT * FROM ujian_essay
                      INNER JOIN tb_jenisujian ON ujian_essay.id_jenis=tb_jenisujian.id_jenis
                      INNER JOIN tb_master_mapel ON ujian_essay.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON ujian_essay.id_semester=tb_master_semester.id_semester
                       WHERE ujian_essay.id_guru='$sesi' ORDER BY id_ujianessay DESC");
                       foreach ($sqlessay as $e) { ?>
                   <tr>
                     <td><?=$no++; ?>.</td>
                     <td><?=$e['mapel']; ?></td>
                     <td>
                        <b class="text-warning"> ESSAY </b>
                     </td>
                     <td></td>
                     <td><b><?=date('d-F-Y',strtotime($e['tanggal'])); ?></b></td>
                     <td><a  data-toggle="modal" data-target="#essay<?=$e['id_ujianessay']; ?>" class="btn btn-primary btn-sm text-white">Jumlah Soal  ( <b><?=$e['jml_soal']; ?></b> )</a>
                      <!-- modal lihat soal esai -->

                        <div class="modal fade bs-example-modal-lg" id="essay<?=$e['id_ujianessay']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                       <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Soal Essay</h4>
                          </div>
                          <form action="" method="post">
                          <div class="modal-body">
                              <div class="form-group">
                              <label for="ckeditor">Soal Essay</label>
                              <input type="hidden" name="ide" value="<?=$e['id_ujianessay'] ?>">
                              <textarea name="essay" id="ckeditor"><?=$e['soal_essay'] ?></textarea>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="updateEssay" class="btn btn-primary">Update</button>
                          </div>
                          </form>
                          <?php 
                          if (isset($_POST['updateEssay'])) {
                           $edit = mysqli_query($con,"UPDATE ujian_essay SET soal_essay='$_POST[essay]' WHERE id_ujianessay='$_POST[ide]' ");
                           if ($edit) {
                              echo "
                                <script type='text/javascript'>
                                setTimeout(function () {
                                swal({
                                title: 'Sukses',
                                text:  'Data Tersimpan !',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: true
                                });     
                                },10);  
                                window.setTimeout(function(){ 
                                window.location.replace('?page=ujian');
                                } ,3000);   
                              </script>";
                           }
                          }


                           ?>
                        </div>
                      </div>
                    </div>




                     </td>
                     <td>
                       <!-- cek ujian ini di kelas ujian -->
                            <?php 
                                $klesy= mysqli_query($con,"SELECT * FROM kelas_ujianessay WHERE id_ujianessay='$e[id_ujianessay]' AND aktif='Y' ");
                                foreach ($klesy as $esy);
                                 $jmlesy = mysqli_num_rows($klesy);
                                  if ($jmlesy >0) {
                                    ?>
                                    <a data-toggle="modal" data-target="#tutupEssay<?=$e['id_ujianessay']; ?>" class="btn btn-success btn-sm text-white"><i class="fa fa-check-square-o"></i>  Aktif </a>
                                    <!-- MODAL TUTUP UJIAN -->
                                    <div class="modal fade" id="tutupEssay<?=$e['id_ujianessay']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">
                                            <center>
                                              Apakah Anda Ingin <b>Non Aktifkan</b> Ujian Ini <br> Sekarang ?
                                            </center>
                                          </h4>
                                        </div>
                                        <div class="modal-body">                                    
                                           <center>
                                             <a href="?page=ujian&act=closeessay&essayid=<?php echo $e['id_ujianessay']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                           </center>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>

                                    <?php
                                  }else{
                                    ?>
                                    <a data-toggle="modal" data-target="#AktifEssay<?=$e['id_ujianessay']; ?>" class="btn btn-danger btn-sm text-white">

                                      <i class="fa fa-window-close-o"></i>Tutup </a> 
                                           <!-- Modal Aktifkan ujian -->
                                  <div class="modal fade" id="AktifEssay<?=$e['id_ujianessay']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">
                                            <center>
                                              Apakah Anda Ingin <b>Mengaktifkan</b> Ujian Ini Sekarang ?
                                            </center>
                                          </h4>
                                        </div>
                                        <div class="modal-body">                                    
                                           <center>
                                             <a href="?page=ujian&act=aktifessay&essayid=<?php echo $e['id_ujianessay']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                           </center>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                                    <?php
                                  }                              
                                 
                             ?> 

 
                     </td>
                     <td>

                        <a href="?page=ujian&act=editessay&id=<?=$e['id_ujianessay']; ?>" class="btn btn-dark btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                          <a href="?page=ujian&act=delessay&id=<?=$e['id_ujianessay']; ?>" onclick="return confirm('Yakin Hapus Data ?')" class="btn btn-dark btn-sm text-danger"><i class="fa fa-trash"></i> Del </a>

                       

                     </td>
                   </tr>
                 <?php } ?>

                 </table>
                  </div>


               </div>
             </div>
	


</div>

</div>
</div>



<!-- Modal -->
<div class="modal fade" id="addUjian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <center>
            Silahkan Pilih Jenis Soal Berikut ini !
          </center>
        </h4>
      </div>
      <div class="modal-body">
       <center>
         <a href="?page=ujian&act=add" class="btn btn-dark btn-lg"><i class="fa fa-check-square-o"></i> OBJEKTIF</a>
       <a href="?page=ujian&act=addessay" class="btn btn-primary btn-lg"><i class="fa fa-pencil"></i> ESSAY</a>
       </center>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>