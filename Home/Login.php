   <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
       <!--      <div class="error-page">
              <h3><a rel="nofollow" href="">
             Registrasi Akun
            </a>
              </h3>
            </div> -->

                <div class="panel panel-info" style="border-radius: 20px;border:3px solid #4FC3F7;">
                  <div class="panel-body">
                        <b style="font-size: 22px;color: black;">
                        Login User
                        </b>
                        <hr>
                      <form action="" method="post">
                          <div class="form-group">
                            <!-- <label for="email">User ID</label> -->
                              <input type="text" name="email" class="form-control" placeholder="User ID">
                          </div>

                          <div class="form-group">
                            <!-- <label for="password">Password*</label> -->
                              <input type="password" name="password" class="form-control" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <!-- <label for="level">Level User*</label> -->
                            <select name="level" class="form-control" required style="background-color: #212121;border-radius: 7px;color: #fff;font-weight: bold;">
                              <option value="">-- Pilih Level --</option>
                              <option value="1"> Guru </option>
                              <option value="2"> Siswa </option>
                            </select>
                          </div>
                          <hr>
                          <div class="form-group">
                            <button type="submit" name="Login" class="btn btn-info"><i class="fa fa-edit"></i> Login</button>
                              <a href="?pages=registration"> Belum Punya Akun ?</a>

                            <!-- <a href="" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a> -->
                          </div>
                      </form>

                      <?php

if (isset($_POST['Login'])) {
   $email = trim(mysqli_real_escape_string($con, $_POST['email']));
   $pass = sha1($_POST['password']);
   $level = $_POST['level'];

  if ($level =='1') {
      $sql = mysqli_query($con,"SELECT * FROM tb_guru WHERE email='$email' AND password='$pass' ") or die(mysqli_error($con)) ;
      $data = mysqli_fetch_array($sql);
      $id = $data [0];
      $cek = mysqli_num_rows($sql);

      if ($cek >0 ){
      $_SESSION['Guru'] = $id;
      $_SESSION['upload_gambar']= TRUE;
      
              echo "
              <script type='text/javascript'>
              setTimeout(function () {
              swal({
              title: 'Sukses',
              text:  'Login Berhasil..',
              type: 'success',
              timer: 3000,
              showConfirmButton: true
              });     
              },10);  
              window.setTimeout(function(){ 
              window.location.replace('Guru/index.php');
              } ,3000);   
              </script>";
             
      }else{
          echo "
          <script type='text/javascript'>
          setTimeout(function () {
          swal({
          title: 'Gagal',
          text:  'User ID / Password Salah ..',
          type: 'error',
          timer: 3000,
          showConfirmButton: true
          });     
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('?pages=login');
          } ,3000);   
          </script>";


      }

  } elseif ($level =='2') { 
    $sql = mysqli_query($con,"SELECT * FROM tb_siswa WHERE nis ='$email' AND password='$pass' ") or die(mysqli_error($con)) ;
      $data = mysqli_fetch_array($sql);
      $id = $data [0];
      $cek = mysqli_num_rows($sql);

      if ($cek >0 ){

      $_SESSION['Siswa'] = $id;
      mysqli_query($con,"UPDATE tb_siswa SET status='Online' WHERE nis='$data[nis]'");
          echo "
          <script type='text/javascript'>
          setTimeout(function () {
          swal({
          title: 'Sukses',
          text:  'Login Berhasil..',
          type: 'success',
          timer: 3000,
          showConfirmButton: true
          });     
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('Siswa/index.php');
          } ,3000);   
          </script>";            
      }else{
               echo "
          <script type='text/javascript'>
          setTimeout(function () {
          swal({
          title: 'Gagal',
          text:  'User ID / Password Salah ..',
          type: 'error',
          timer: 3000,
          showConfirmButton: true
          });     
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('?pages=login');
          } ,3000);   
          </script>";


      }



}

}
?>

  <!-- end: CODING LOGIN -->






                  </div>
                </div>
            
          </div>
        </div>
      </div>