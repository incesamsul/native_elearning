<div class="content-wrapper">
  <h4>
  Perangkat <small class="text-muted">/ Ubah</small>
  </h4>
  <hr>
  <div class="row">

    <div class="col-md-10 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Perangkat Pembelajaran</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <form class="forms-sample" action="?page=proses" method="post">

    <?php
    $edit = mysqli_query($con,"SELECT * FROM tb_perangkat WHERE id_perangkat='$_GET[ID]' ") or die(mysqli_error($con));
    $d=mysqli_fetch_array($edit);
    ?>
    
                <input type="hidden" name="ID" value="<?=$d['id_perangkat']; ?>">

                <div class="form-group">
                  <label for="jenis">Jenis Perangkat</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="width: 400px;font-weight: bold;background-color: #212121;color: #fff;">
                  <option>-- Pilih --</option>
                  <?php
                  $sqlJenis=mysqli_query($con, "SELECT * FROM tb_jenisperangkat ORDER BY id_jenisperangkat DESC");
                  while($jenis=mysqli_fetch_array($sqlJenis)){
                    if($jenis['id_jenisperangkat'] == $d['id_jenisperangkat']){
                    $selected = "selected";
                    }else{
                    $selected = "";
                    }
                  echo "<option value='$jenis[id_jenisperangkat]' $selected>$jenis[jenis_perangkat]</option>";
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="mapel">Mata Pelajaran</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="width: 400px;font-weight: bold;background-color: #212121;color: #fff;">
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
                  <label for="ckeditor">Judul Perangkat</label>
                  <input type="text" name="judul" class="form-control" value="<?=$d['judul'] ?>">
                </div>
                <div class="form-group">
                  <label for="ckeditor">ISI PERANGKAT</label>
                  <textarea name="isi_perangkat" id="ckeditor">
                    <?=$d['isi_perangkat'] ?>
                  </textarea>
                </div>



                <button type="submit" name="perangkatUpdate" class="btn btn-info mr-2">Update</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
