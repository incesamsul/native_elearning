<div class="content-wrapper">
  <h4>
  Mata Pelajaran <small class="text-muted">/ Tambah</small>
  </h4>
  <hr>
  <div class="row">

    <div class="col-md-6 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Mata Pelajaran</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <hr>
              <form class="forms-sample" action="?page=proses" method="post">
                <input type="hidden" name="id_guru" value="<?=$data['id_guru']; ?>">

            <div class="form-group">
              <label for="mapel">Mata Pelajaran</label>
            <div class="input-group">
              <select class="form-control" id="mapel" name="mapel"style="font-weight: bold;background-color: #212121;color: #fff;">
              <option>-- Pilih --</option>
              <?php
              $sqlMapel=mysqli_query($con, "SELECT * FROM tb_master_mapel ORDER BY id_mapel DESC");
              while($mapel=mysqli_fetch_array($sqlMapel)){
              echo "<option value='$mapel[id_mapel]'>$mapel[mapel]</option>";
              }
              ?>
              </select>
            <div class="input-group-append bg-success border-success">
           <!--  <a data-toggle="modal" data-target="#mapelAdd" class="input-group-text bg-transparent"><i class="fa fa-plus text-white"></i></a> -->
            </div>
            </div>
            </div>



                <div class="form-group">
                  <label for="kelas">Kelas Mata Pelajaran</label>
                  <select class="form-control" id="kelas" name="kelas"style="font-weight: bold;background-color: #212121;color: #fff;">
                  <option>-- Pilih --</option>
                  <?php
                  $sqlKelas=mysqli_query($con, "SELECT * FROM tb_master_kelas ORDER BY id_kelas DESC");
                  while($kelas=mysqli_fetch_array($sqlKelas)){
                  echo "<option value='$kelas[id_kelas]'>$kelas[kelas]</option>";
                  }
                  ?>
                  </select>
                </div>

                  <div class="form-group">
                  <label for="semester">Semester Mata Pelajaran</label>
                  <select class="form-control" id="semester" name="semester"style="font-weight: bold;background-color: #212121;color: #fff;">
                  <option>-- Pilih --</option>
                  <?php
                  $sqlSemester=mysqli_query($con, "SELECT * FROM tb_master_semester ORDER BY id_semester DESC");
                  while($smt=mysqli_fetch_array($sqlSemester)){
                  echo "<option value='$smt[id_semester]'>$smt[semester]</option>";
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jurusan">Jurusan Mata Pelajaran</label>
                  <select class="form-control" id="jurusan" name="jurusan"style="font-weight: bold;background-color: #212121;color: #fff;">
                  <option>-- Pilih --</option>
                  <?php
                  $sqlJurusan=mysqli_query($con, "SELECT * FROM tb_master_jurusan ORDER BY id_jurusan DESC");
                  while($jur=mysqli_fetch_array($sqlJurusan)){
                  echo "<option value='$jur[id_jurusan]'>$jur[jurusan]</option>";
                  }
                  ?>
                  </select>
                </div>



                <button type="submit" name="mapelSave" class="btn btn-info mr-2">Simpan</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
        <!-- Mapel-->
            <div class="modal fade bs-example" id="mapelAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Mata pelajaran</h4>
                  </div>
                   <form method="post" action="">
                  <div class="modal-body"><label>Mata Pelajaran</label>
                    <input type="text" name="mapel" class="form-control" />  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="mapelSave" id="insert" value="Insert" class="btn btn-success" />
                  </div>
                  </form>    
                  <?php 
                  if (isset($_POST['mapelSave'])) {
                    mysqli_query($con,"INSERT INTO tb_master_mapel VALUES('null','$_POST[mapel]') ");
                    echo "<script>
                   window.location='?page=mapel&act=add';
                    </script>";
                  }
                   ?>
              
                </div>
              </div>
            </div>