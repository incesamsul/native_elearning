<div class="content-wrapper">
  <h4>
  Perangkat <small class="text-muted">/ Tambah</small>
  </h4>
  <hr>
  <div class="row">

    <!-- <?php echo $_GET['TYPE']; ?> -->

    <div class="col-md-10 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Perangkat Pembelajaran</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>

                       <?php 

                if ($_GET['TYPE']=='Upload') {
                 ?>
                  <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_guru" value="<?=$sesi; ?>">

                <div class="form-group">
                  <label for="jenis">Jenis Perangkat *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlJenis=mysqli_query($con, "SELECT * FROM tb_jenisperangkat ORDER BY id_jenisperangkat DESC");
                  while($jenis=mysqli_fetch_array($sqlJenis)){
                  echo "<option value='$jenis[id_jenisperangkat]'>$jenis[jenis_perangkat]</option>";
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="mapel">Mata Pelajaran *</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlMapel=mysqli_query($con, "SELECT * FROM tb_roleguru
                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                          INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                          INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                          WHERE tb_roleguru.id_guru='$sesi'");
                  while($mapel=mysqli_fetch_array($sqlMapel)){
                  echo "<option value='$mapel[id_roleguru]'>$mapel[mapel] - $mapel[kelas]-$mapel[jurusan]</option>";
                  }
                  ?>
                  </select>
                
                 
                  <input type="hidden" name="id_kelas" id="id_kelas">
                   <input type="hidden" name="id_mapel" id="id_mapel">
                  <input type="hidden" name="id_semester" id="id_semester">
                   <input type="hidden" name="id_jurusan" id="id_jurusan">
                </div>
                   <div class="form-group">
                  <label>Judul Perangkat *</label>
                  <input type="text" name="judul" class="form-control" placeholder="Judul Perangkat ..">
                </div>
                <div class="form-group">
                  <label>File Perangkat</label>
                  <p>
                  File yang bisa di Upload hanya file dengan ekstensi .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .rar, .exe, .zip dan besar file (file size) maksimal hanya <b>2 MB</b>.
                  </p>
                  <input type="file" name="file" class="form-control" style="background-color: #212121;color: #fff;font-weight: bold;">
                  </div>
                  <hr>




                <button type="submit" name="perangkatUpload" class="btn btn-info mr-2">Simpan</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
                 <?php
                }else{
                  ?>
                  <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_guru" value="<?=$sesi; ?>">

                <div class="form-group">
                  <label for="jenis">Jenis Perangkat *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlJenis=mysqli_query($con, "SELECT * FROM tb_jenisperangkat ORDER BY id_jenisperangkat DESC");
                  while($jenis=mysqli_fetch_array($sqlJenis)){
                  echo "<option value='$jenis[id_jenisperangkat]'>$jenis[jenis_perangkat]</option>";
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="mapel">Mata Pelajaran *</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlMapel=mysqli_query($con, "SELECT * FROM tb_roleguru
                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                          INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                          INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                          WHERE tb_roleguru.id_guru='$sesi'");
                  while($mapel=mysqli_fetch_array($sqlMapel)){
                  echo "<option value='$mapel[id_roleguru]'>$mapel[mapel] - $mapel[kelas]-$mapel[jurusan]</option>";
                  }
                  ?>
                  </select>
                
                 
                  <input type="hidden" name="id_kelas" id="id_kelas">
                   <input type="hidden" name="id_mapel" id="id_mapel">
                  <input type="hidden" name="id_semester" id="id_semester">
                   <input type="hidden" name="id_jurusan" id="id_jurusan">
                </div>
                   <div class="form-group">
                  <label>Judul Perangkat *</label>
                  <input type="text" name="judul" class="form-control" placeholder="Judul Perangkat ..">
                </div>
                <div class="form-group">
                  <label for="ckeditor">ISI PERANGKAT</label>
                  <textarea name="isi_perangkat" id="ckeditor"></textarea>
                </div>
                <hr>
       
<!-- 
                     <div class="form-group">
                  <label>File Perangkat</label>
                  <p>
                  File yang bisa di Upload hanya file dengan ekstensi .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .rar, .exe, .zip dan besar file (file size) maksimal hanya <b>2 MB</b>.
                  </p>
                  <input type="file" name="file" class="form-control" style="width: 300px;background-color: #212121;color: #fff;font-weight: bold;">
                  </div>
                  <hr> -->




                <button type="submit" name="perangkatSave" class="btn btn-info mr-2">Simpan</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
                  <?php
                }

                 ?>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
