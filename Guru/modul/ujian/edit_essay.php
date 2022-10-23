<div class="content-wrapper">
  <h4>
    SOAL <small class="text-muted">/ Edit Soal</small>
  </h4>
  <hr>
  <div class="row">
    <?php
    $edit = mysqli_query($con, "SELECT * FROM soal_essay WHERE id_soal='$_GET[ids]' ");
    foreach ($edit as $d)

    ?>
    <div class="col-md-10 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Soal Essay</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <form class="forms-sample" action="?page=proses" method="post">
                <input type="hidden" name="id" value="<?= $_GET['ujian']; ?>">

                <div class="form-group">
                  <label for="ckeditor">Soal Essay</label>
                  <textarea name="soal" id="ckeditor"><?= $d['soal'] ?></textarea>
                </div>






                <button type="submit" name="essayEdit" class="btn btn-info mr-2">Ubah</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>


                <?php include 'moudul/ujian/modalinput.php'; ?>













              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>