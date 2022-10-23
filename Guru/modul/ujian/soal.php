<div class="content-wrapper">
  <h4>
    <b>SOAL OBJEKTIF</b>
    <small class="text-muted">/
      Data Soal
    </small>
  </h4>
  <div class="row purchace-popup">
    <div class="col-md-12">
      <span class="d-flex alifn-items-center">
        <a href="?page=ujian&act=soaladd&ID=<?= $_GET[id]; ?>" class="btn btn-dark"> <i class="fa fa-plus text-white"></i> Add Soal</a>
        <button type='button' class='btn btn-info pull-right' data-toggle='modal' data-target='#modal_upload'> <i class='fa fa-file-excel-o text-white'></i> Upload File Excel
        </button>
        <a href="../Report/soal/print_soal.php?ID=<?= $_GET[id]; ?>" target="_blank" class="btn btn-danger"> <i class="fa fa-download text-white"></i> Download Soal</a>

      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Soal Objektif</h4>
          <div class="table-responsive">
            <table class='table table-striped'>
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>Soal</th>
                  <th>Pilihan Ganda</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor = 1;
                $tampil = mysqli_query($con, "SELECT * FROM soal WHERE id_ujian='$_GET[id]' ORDER BY id_soal ASC");
                while ($r = mysqli_fetch_array($tampil)) { ?>

                  <tr>
                    <td><?= $nomor++; ?> .</td>
                    <td><b><?= $r['soal']; ?></b></td>
                    <td>
                      <ol type='A'>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                          $kolom = "pilihan_$i";
                          if ($r['kunci'] == $i) {
                            echo "<li style='font-weight: bold'>$r[$kolom]</li>";
                          } else {
                            echo "<li>$r[$kolom]</li>";
                          }
                        }

                        ?>
                      </ol>
                    </td>
                    <td>
                      <a href="?page=ujian&act=soaledit&ids=<?= $r['id_soal']; ?>&ujian=<?= $_GET[id]; ?>" class='btn btn-dark btn-sm'><i class='fa fa-pencil'></i></a>
                      <a href="?page=ujian&act=soaldel&ids=<?= $r['id_soal']; ?>&id=<?= $_GET[id]; ?>" class='btn btn-dark btn-sm text-danger'><i class='fa fa-trash'></i></a>
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
  <div class="row">
    <div class="col-md-12 col-xs-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Soal Essay</h4>
          <div class="table-responsive">
            <table class='table table-striped'>
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>Soal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor = 1;
                $tampil = mysqli_query($con, "SELECT * FROM soal_essay WHERE id_ujian='$_GET[id]' ORDER BY id_soal ASC");
                while ($r = mysqli_fetch_array($tampil)) { ?>

                  <tr>
                    <td><?= $nomor++; ?> .</td>
                    <td><b><?= $r['soal']; ?></b></td>
                    <td>
                      <a href="?page=ujian&act=editessay&ids=<?= $r['id_soal']; ?>&ujian=<?= $_GET[id]; ?>" class='btn btn-dark btn-sm'><i class='fa fa-pencil'></i></a>
                      <a href="?page=ujian&act=delessay&ids=<?= $r['id_soal']; ?>&id=<?= $_GET[id]; ?>" class='btn btn-dark btn-sm text-danger'><i class='fa fa-trash'></i></a>
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
</div>
</div>


</div>

<!-- Modal uploa xls -->
<div class='modal modal-info fade' id="modal_upload">
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title'>Upload EXCEL</h4>
      </div>
      <form action="?page=ujian&act=upSoal" enctype="multipart/form-data" method="post">
        <input type="hidden" name="ujian" value="<?= $_GET[id]; ?>">
        <div class='modal-body'>
          <div class='form-group has-feedback'>
            <input type="file" class="file" id="file" name="excel" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <a href="../download/soal_template.xlsx" class="btn btn-success pull-left"><i class="fa fa-file-excel-o"></i> contoh excel</a>
          <button name="uploadSoal" type="submit" class="btn btn-primary btn-save"><i class="fa fa-upload"></i> Upload</button>


        </div>
      </form>
    </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->