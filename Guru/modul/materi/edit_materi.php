
    <?php
    $edit = mysqli_query($con,"SELECT * FROM tb_materi WHERE id_materi='$_GET[ID]' ") or die(mysqli_error($con));
    $d=mysqli_fetch_array($edit);
    ?>
    
<div class="content-wrapper">
  <h4>
  Materi <small class="text-muted">/ Ubah</small>
  </h4>
  <hr>
  <div class="row">

    <div class="col-md-10 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Materi Pembelajaran</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <form class="forms-sample" action="?page=proses" method="post">
                <input type="hidden" name="ID" value="<?=$d['id_materi']; ?>">
                <div class="form-group">
                  <label for="mapel">Mata Pelajaran</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="width: 400px;font-weight: bold;background-color: #212121;color: #fff;" required>
                  <option>-- Pilih --</option>
                  <?php
                  $sqlMapel=mysqli_query($con, "SELECT * FROM tb_roleguru
                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                          INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                          INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                          WHERE tb_roleguru.id_guru='$sesi'");
                  while($mapel=mysqli_fetch_array($sqlMapel)){
				    if($mapel['id_roleguru'] == $d['id_roleguru']){
                          $selected = "selected";
                          }else{
                          $selected = "";
                          }
                  //echo "<option value='$jur[id_jurusan]' $selected>$jur[jurusan]</option>";
                  echo "<option value='$mapel[id_roleguru]' $selected>$mapel[mapel] - $mapel[kelas]- Jurusan $mapel[jurusan] - $mapel[semester]</option>";
                  }
                  ?>
                  </select>
                  
                 
                  <input type="hidden" name="id_kelas" id="id_kelas">
                   <input type="hidden" name="id_mapel" id="id_mapel">
                  <input type="hidden" name="id_semester" id="id_semester">
                   <input type="hidden" name="id_jurusan" id="id_jurusan">
                </div>
                  <div class="form-group">
                  <label for="judul">Judul Materi</label>
                  <input type="text" id="judul" name="judul" class="form-control" value="<?=$d['judul_materi']; ?>">
                </div>
                <div class="form-group">
                  <label for="ckeditor">Materi</label>
                  <textarea name="materi" id="ckeditor"><?=$d['materi']; ?></textarea>
                </div>



                <button type="submit" name="materiUpdate" class="btn btn-info mr-2">Update</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
