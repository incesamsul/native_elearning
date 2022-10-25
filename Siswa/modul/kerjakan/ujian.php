<?php

$ujianQ = mysqli_query($con, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'");
$ujian = mysqli_fetch_array($ujianQ);




?>
<script>
  var waktunya;
  waktunya = <?= strtotime($ujian['waktu']) - strtotime('TODAY'); ?>;
  var waktu;
  var jalan = 0;
  var habis = 0;

  function init() {
    checkCookie()
    mulai();
  }

  function keluar() {
    if (habis == 0) {
      setCookie('waktux', waktu, 365);
    } else {
      setCookie('waktux', 0, -1);
    }
  }

  function mulai() {
    jam = Math.floor(waktu / 3600);
    sisa = waktu % 3600;
    menit = Math.floor(sisa / 60);
    sisa2 = sisa % 60
    detik = sisa2 % 60;
    if (detik < 10) {
      detikx = "0" + detik;
    } else {
      detikx = detik;
    }
    if (menit < 10) {
      menitx = "0" + menit;
    } else {
      menitx = menit;
    }
    if (jam < 10) {
      jamx = "0" + jam;
    } else {
      jamx = jam;
    }
    document.getElementById("divwaktu").innerHTML = jamx + " H : " + menitx + " M : " + detikx + " S";
    waktu--;
    if (waktu > 0) {
      t = setTimeout("mulai()", 1000);
      jalan = 1;
    } else {
      if (jalan == 1) {
        clearTimeout(t);
      }
      habis = 1;
      document.getElementById("formulir").submit();
    }
  }

  function selesai() {
    if (jalan == 1) {
      clearTimeout(t);
    }
    habis = 1;
    document.getElementById("formulir").submit();
  }

  function getCookie(c_name) {
    if (document.cookie.length > 0) {
      c_start = document.cookie.indexOf(c_name + "=");
      if (c_start != -1) {
        c_start = c_start + c_name.length + 1;
        c_end = document.cookie.indexOf(";", c_start);
        if (c_end == -1) c_end = document.cookie.length;
        return unescape(document.cookie.substring(c_start, c_end));
      }
    }
    return "";
  }

  function setCookie(c_name, value, expiredays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString());
  }

  function checkCookie() {
    waktuy = getCookie('waktux');
    if (waktuy != null && waktuy != "") {
      waktu = waktuy;
    } else {
      waktu = waktunya;
      setCookie('waktux', waktunya, 7);
    }
  }
</script>
<script type="text/javascript">
  window.history.forward();

  function noBack() {
    window.history.forward();
  }
</script>
<script type="text/javascript">
  function tombol() {
    document.getElementById("tombol").innerHTML = "<input type=button class='btn btn-success' value=Simpan onclick=selesai()>";
  }
</script>

<div class="content-wrapper">
  <h4>
    <b>Kerjakan ujian</b>
    <small class="text-muted">/
      Ujian <br>
      Sisa Waktu
      <small><button class='btn btn-info'>
          <div id='divwaktu'></div>
        </button></small>
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

                  <form id="formulir" class="forms-sample" action="?page=proses" method="post">
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
              <input type="hidden" name="saveJawaban">
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