
        <div class="content-wrapper">
             <h4> <b>User</b> <small class="text-muted">/ Tambah Guru</small>
    </h4>
    <hr>
          <div class="row">
            <div class="col-md-10 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-md-12 ml-5">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Form Tambah Guru</h4>
                      <p class="card-description">
                        
                      </p>
                      <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Nip</label>
                          <input name="nip" type="text" class="form-control" placeholder="Nip/Nuptk">
                        </div>
                        <div class="form-group">
                          <label>Nama Lengkap & Gelar</label>
                          <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap">
                        </div>

                        <div class="form-group">
                          <label>Email</label>
                          <input name="email" type="text" class="form-control" placeholder="Email">
                        </div>

                   <!--      <div class="form-group">
                          <label>Password</label>
                          <p>
                            <em class="text-danger">Pasword Default guru adalah NIP</em>
                          </p>
                          <input name="password" type="password" class="form-control" placeholder="Password">
                        </div> -->

                        <div class="form-group">
                          <label>Foto</label>
                          <input name="foto" type="file" class="form-control">
                        </div>

                        <button name="saveGuru" type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>

                      <?php 

                      if (isset($_POST['saveGuru'])) {

                    $pass= sha1($_POST['nip']);
                    $sumber = @$_FILES['foto']['tmp_name'];
                    $target = '../vendor/images/img_Guru/';
                    $nama_gambar = time()."-".@$_FILES['foto']['name'];
                    $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
                    $date = date('Y-m-d');

                    if ($pindah) {
                    $save= mysqli_query($con,"INSERT INTO tb_guru VALUES(NULL,'$_POST[nip]','$_POST[nama]','$_POST[email]','$pass','$nama_gambar','Y','$date','Yes')");
                    if ($save) {
                    echo " <script>
                    alert('Data Berhasil disimpan !');
                    window.location='?page=guru';
                    </script>";
                    }
                    }
					else{
					$savee= mysqli_query($con,"INSERT INTO tb_guru VALUES(NULL,'$_POST[nip]','$_POST[nama]','$_POST[email]','$pass',NULL,'Y','$date','Yes')");
                    if ($savee) {
                    echo " <script>
                    alert('Data Berhasil disimpan !');
                    window.location='?page=guru';
                    </script>";
                    }
					}


                    }

                       ?> 

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
