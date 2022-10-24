<div class="content-wrapper">
  <h4>
    <b>Kerjakan ujian</b>
    <small class="text-muted">/
      Ujian
    </small>
  </h4>

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Soal Objektif</h4>
          <div class="table-responsive">
            <table class='table table-striped'>
              <thead>

              </thead>
              <tbody>
                <?php
                $nomor = 1;
                $tampil = mysqli_query($con, "SELECT * FROM soal WHERE id_ujian='$_GET[id]' ORDER BY id_soal ASC");
                while ($r = mysqli_fetch_array($tampil)) { ?>

                  <form class="forms-sample" action="?page=proses" method="post">
                    <p><?= $r['soal']; ?></p>
                    <input type="hidden" value="<?= $_GET['id']; ?>" name="id_ujian">
                    <div class="form-group">
                      <ol type="A">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                          <?php
                          $kolom = "pilihan_$i";
                          $pilihan = strip_tags($r[$kolom]);
                          ?>

                          <div class="form-group">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="pg_<?= $r['id_soal']; ?>" id="<?= $i; ?>" value="<?= $pilihan; ?>">
                                <?= $pilihan; ?>
                                <i class="input-helper"></i></label>
                            </div>
                          </div>


                        <?php endfor; ?>
                      </ol>


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

            <?php
            $nomor = 1;
            $tampil = mysqli_query($con, "SELECT * FROM soal_essay WHERE id_ujian='$_GET[id]' ORDER BY id_soal ASC");
            while ($r = mysqli_fetch_array($tampil)) { ?>
              <p><?= $nomor . '.) ' . strip_tags($r['soal']); ?></p>
              <div class="form-group">
                <textarea name="essay_<?= $r['id_soal']; ?>" id="ckeditor"></textarea>
              </div>
            <?php
              $i++;
            }
            ?>



            <div class="form-group">
              <button type="submit" name="saveJawaban" class="btn btn-info mr-2">Simpan</button>
              </form>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>
</div>
</div>


</div>