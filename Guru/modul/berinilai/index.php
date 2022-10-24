<div class="content-wrapper">
    <h4>
        <b>Beri nilai</b>
        <small class="text-muted">/
            Berinilai
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
                                $tampil = mysqli_query($con, "SELECT * FROM soal WHERE id_ujian='$_GET[ujian]' ORDER BY id_soal ASC");
                                while ($r = mysqli_fetch_array($tampil)) { ?>


                                    <p><?= $r['soal']; ?></p>
                                    <input type="hidden" value="<?= $_GET['id']; ?>" name="id_ujian">
                                    <div class="form-group">
                                        <?php
                                        $jawabanQuery = mysqli_query($con, "SELECT * FROM jawaban_pg WHERE id_soal='$r[id_soal]' AND id_siswa='$_GET[siswa]' ORDER BY id_soal ASC");
                                        $jawaban = mysqli_fetch_array($jawabanQuery);
                                        ?>
                                        <ol type="A">
                                            <?php

                                            for ($i = 1; $i <= 5; $i++) {
                                                $kolom = "pilihan_$i";
                                                $value = strip_tags($r[$kolom]);
                                                if ($jawaban['jawaban'] == $value) {
                                                    echo "<li style='font-weight: bold; color:red;'>$r[$kolom]</li>";
                                                } else {
                                                    echo "<li>$r[$kolom]</li>";
                                                }
                                            }
                                            ?>

                                        </ol>


                                        <p style='font-weight: bold; color:red;'>Jawaban siswa : <?= $jawaban['jawaban']; ?></p>


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
                        $tampil = mysqli_query($con, "SELECT * FROM soal_essay WHERE id_ujian='$_GET[ujian]' ORDER BY id_soal ASC");
                        while ($r = mysqli_fetch_array($tampil)) { ?>
                            <p><?= $nomor . '.) ' . strip_tags($r['soal']); ?></p>
                            <?php
                            $jawabanQuery = mysqli_query($con, "SELECT * FROM jawaban_essay WHERE id_soal='$r[id_soal]' AND id_siswa='$_GET[siswa]' ORDER BY id_soal ASC");
                            $jawaban = mysqli_fetch_array($jawabanQuery);
                            ?>

                            <p>jawaban : <?= $jawaban['jawaban']; ?></p>
                        <?php
                            $i++;
                        }
                        ?>


                        <hr>
                        <form action="index.php?page=proses" method="POST">
                            <?php

                            $idUjian = $_GET['ujian'];
                            $idSiswa = $_GET['siswa'];

                            $jawabanQuery = mysqli_query($con, "SELECT * FROM nilai_ujian WHERE id_ujian='$idUjian' AND id_siswa='$idSiswa'");
                            $jawaban = mysqli_fetch_array($jawabanQuery);

                            ?>
                            <div class="form-group">
                                <label for="nilai">nilai</label>
                                <input type="text" class="form-control" name="nilai" value="<?= $jawaban['nilai']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" value="<?= $_GET['ujian']; ?>" name="id_ujian">
                                <input type="hidden" value="<?= $_GET['siswa']; ?>" name="id_siswa">
                                <button type="submit" name="saveNilai" class="btn btn-info mr-2">Simpan</button>
                            </div>
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