<div class="content-wrapper">
  <h4>
  Tugas <small class="text-muted">/ Tambah</small>
  </h4>
  <hr>
  <div class="row">

    <!-- <?php echo $_GET['TYPE']; ?> -->

    <div class="col-md-10 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Input Tugas</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
               <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_guru" value="<?=$sesi; ?>">

                <div class="form-group">
                  <label for="jenis">Jenis Tugas *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlJenis=mysqli_query($con, "SELECT * FROM tb_jenistugas ORDER BY id_jenistugas DESC");
                  while($jenis=mysqli_fetch_array($sqlJenis)){
                  echo "<option value='$jenis[id_jenistugas]'>$jenis[jenis_tugas]</option>";
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="mapel">Mata Pelajaran *</label>
                  <select class="form-control form-control-lg" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;background-color: #212121;color: #fff;font-size: 20px;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlMapel=mysqli_query($con, "SELECT * FROM tb_roleguru
                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                          INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                          INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                          WHERE tb_roleguru.id_guru='$sesi'");
                  while($mapel=mysqli_fetch_array($sqlMapel)){
                  echo "<option value='$mapel[id_roleguru]'>$mapel[mapel]- $mapel[kelas] - Jurusan $mapel[jurusan] - $mapel[semester]</option>";
                  }
                  ?>
                  </select>
                
                 
                  <!-- <input type="hidden" name="id_kelas" id="id_kelas"> -->
                   <input type="hidden" name="id_mapel" id="id_mapel">
                  <input type="hidden" name="id_semester" id="id_semester">
                   <!-- <input type="hidden" name="id_jurusan" id="id_jurusan"> -->
                </div>

                  <div class="form-group">
                  <label>Judul Tugas *</label>
                  <input type="text" name="judul" class="form-control" placeholder="Judul Tugas ..">
                </div>

                  <div class="form-group">
                  <label>Tanggal Mulai *</label>
                  <input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d') ?>">
                </div>

                 <div class="form-group">
                  <label>Waktu *</label>
                  <p class="text-danger">Berapa waktu untuk pengerjaan tugas ?? Ex (<b>3 Hari</b>)</p>
                  <input type="number" name="waktu" class="form-control"placeholder='(1) Hari'maxlength="2" required style="width: 300px;">
                </div>
                  <div class="form-group" id="otherFieldDiv">
                  <label>Jumlah Anggota *</label>
                  <p class="text-success">Isi jumlah anggota jika tugas ini berkelompok,Kosongkan jika Tidak</p>
                  <input type="number" name="jumlahanggota" class="form-control"placeholder='5 Orang'maxlength="2" style="width: 300px;background: #212121;color: #fff;font-weight: bold;">
                </div>

                 <div class="form-group">
                  <label>Intruksi Tugas/ Isi*</label>
                  <textarea name="isi_tugas" class="form-control" id="ckeditor" cols="30" rows="10"></textarea>
                </div>


                <hr>

                <button type="submit" name="tugasSave" class="btn btn-info mr-2">Simpan</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>

         
                
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script>
$("#jenis").change(function() {
  if ($(this).val() == "2") {
    $('#otherFieldDiv').show();
  } else {
    $('#otherFieldDiv').hide();
  }
});
$("#jenis").trigger("change");

</script>