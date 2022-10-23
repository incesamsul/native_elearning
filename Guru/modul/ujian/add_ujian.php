<div class="content-wrapper">
  <h4>
  Ujian <small class="text-muted">/ Tambah</small>
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
                <input type="hidden" name="id_guru" value="<?=$sesi; ?>">

                <div class="form-group">
                  <label for="jenis">Jenis Ujian *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option value=''>-- Pilih --</option>
                  <?php
                  $sqlJenis=mysqli_query($con, "SELECT * FROM tb_jenisujian ORDER BY id_jenis DESC");
                  while($jenis=mysqli_fetch_array($sqlJenis)){
                  echo "<option value='$jenis[id_jenis]'>$jenis[jenis_ujian]</option>";
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
                  echo "<option value='$mapel[id_roleguru]'>$mapel[mapel]- $mapel[kelas] - Jurusan $mapel[jurusan] $mapel[semester]</option>";
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
                  <input type="text" name="judul" class="form-control" placeholder="Judul Perangkat ..">
                </div>
                  <div class="form-group">
                  <label>Tanggal Ujian *</label>
                  <input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d') ?>">
                </div>

                 <div class="form-group">
                  <label>Lama Ujian *</label>
                  <input type="text" name="jam" class="form-control"placeholder='Lama Ujian Jam diisi 2 digit (01)'maxlength="2" required>
                  <input type="text" name="menit" class="form-control" placeholder='Lama Ujian  Menit diisi 2 digit (00)' maxlength='2' maxlength="2" required>
                </div>
                 <div class="form-group">
                  <label>Jumlah Soal*</label>
                  <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Soal ..">
                </div>

                 <div class="form-group">
                  <!-- <label for="mapel">Mata Pelajaran *</label> -->
                  <select class="form-control" name="acak" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option value="acak">Acak Soal</option>
                  <option value="tidak">Tidak Acak</option>
                  </select>
              </div>
              <div class="form-group">
                <div class="form-radio form-radio-flat">
                <label class="form-check-label" for="Y">
                <input type="radio" class="form-check-input" name="aktif" id="Y" value="Y">
                Aktif
                </label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-radio form-radio-flat">
                <label class="form-check-label" for="N">
                <input type="radio" class="form-check-input" name="aktif" id="N" value="N">
                Tidak
                </label>
                </div>
              </div>

                <hr>
   




                <button type="submit" name="ujianSave" class="btn btn-info mr-2">Simpan</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>

         
                
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
