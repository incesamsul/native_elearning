<?php 
$edit = mysqli_query($con,"SELECT * FROM ujian WHERE id_ujian='$_GET[id]' ");
foreach ($edit as $d) ?>
<div class="content-wrapper">
  <h4>
  Ujian <small class="text-muted">/ Edit</small>
  </h4>
  <hr>
  <div class="row">

    <!-- <?php echo $_GET['TYPE']; ?> -->

    <div class="col-md-5 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Pengaturan Ujian</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
               <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$d['id_ujian']; ?>">
                <div class="form-group">
                  <label for="jenis">Jenis Ujian *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlJenis=mysqli_query($con, "SELECT * FROM tb_jenisujian ORDER BY id_jenis DESC");
                  while($jenis=mysqli_fetch_array($sqlJenis)){

                      if($jenis['id_jenis'] == $d['id_jenis']){
                          $selected = "selected";
                          }else{
                          $selected = "";
                          }
                  echo "<option value='$jenis[id_jenis]' $selected>$jenis[jenis_ujian]</option>";
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="mapel">Mata Pelajaran *</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option value=''>-- Pilih --</option>
                  <?php
                  $sqlMapel=mysqli_query($con, "SELECT * FROM tb_roleguru
                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                          INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                          INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                          WHERE tb_roleguru.id_guru='$sesi'");
                  while($mapel=mysqli_fetch_array($sqlMapel)){
				  
                  echo "<option value='$mapel[id_roleguru]'>$mapel[mapel]- $mapel[kelas]- Jurusan $mapel[jurusan] -$mapel[semester]</option>";
                  }
                  ?>
                  </select>
                
                 
                  <input type="hidden" name="id_kelas" id="id_kelas">
                   <input type="hidden" name="id_mapel" id="id_mapel">
                  <input type="hidden" name="id_semester" id="id_semester">
                   <input type="hidden" name="id_jurusan" id="id_jurusan">
                </div>
                  <div class="form-group">
                  <label>Judul Ujian *</label>
                  <input type="text" name="judul" class="form-control" value="<?=$d['judul'] ?>">
                </div>
                  <div class="form-group">
                  <label>Tanggal Ujian *</label>
                  <input type="date" name="tgl" class="form-control" value="<?=$d['tanggal'] ?>">
                </div>

                 <div class="form-group">
                  <label>Waktu Ujian *</label>
                  <input type="text" name="waktu" class="form-control" value="<?=$d['waktu'] ?>" required>
                </div>
                 <div class="form-group">
                  <label>Jumlah Soal*</label>
                  <input type="number" name="jumlah" class="form-control" value="<?=$d['jml_soal'] ?>" required>
                </div>

                 <div class="form-group">
                  <!-- <label for="mapel">Mata Pelajaran *</label> -->
                  <select class="form-control" name="acak" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option value="">--pilih tipe soal--</option>
				  <option value="acak">Acak Soal</option>
                  <option value="tidak">Tidak Acak</option>
                  </select>
              </div>

                <hr>
   




                <button type="submit" name="ujianEdit" class="btn btn-info mr-2">Ubah</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>

         
                
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
