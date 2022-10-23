
<?php 
session_start();
include 'config/db.php';
$oke = mysqli_query($con,"select * from tb_sekolah where id_sekolah='1'");
$oke1 = mysqli_fetch_array($oke);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Aplikasi</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendor/node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="vendor/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="vendor/images/favicon.png" />
   <link href="vendor/sweetalert/sweetalert.css" rel="stylesheet" />
</head>

<body style="background-image: url(vendor/images/bg.jpg); ">
  <div class="container-scroller" style="border-radius: 50px;">
    <div class="container-fluid page-body-wrapper full-page-wrapper"  >
      <div class="content-wrapper d-flex align-items-center auth login-full-bg" >
        <div class="row w-100">
        	
          <div class="col-lg-3 mx-auto">
            
             <div class="auth-form-dark text-left p-5">
              <center><img src="vendor/images/logoadmin.png" alt=""> <br>
              <b> <?php echo $oke1['nama_sekolah'];?></b>
              </center>
              <hr>
              <h4 class="font-weight-light">
             </h4>
              
                <form  method="post" action="">
                  <div class="form-group">
                    <label for="nis">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <i class="mdi mdi-account"></i>
                  </div>
                  <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <i class="mdi mdi-eye"></i>
                  </div>
                     <div class="form-group">
                            <!-- <label for="level">Level User*</label> -->
                            <select name="level" class="form-control" required style="background-color: #212121;border-radius: 7px;color: #fff;font-weight: bold;">
                              <option value="">-- Pilih Level --</option>
                              <option value="1"> Guru </option>
                              <option value="2"> Siswa </option>
                               <option value="3"> Admin </option>
                            </select>
                          </div>

                  <div class="mt-5">
                  	<input value="LOGIN" name="Login" type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium">
                    <hr>
                    <center>
                      <!-- <p><a href="Home/Registrasion.php" style="color: #fff;"><b> Registrasi ?</b></a></p> -->
                    </center>
                  </div>
                </form>

                                     <?php

  if($_SERVER['REQUEST_METHOD']=='POST'){
   $email = trim(mysqli_real_escape_string($con, $_POST['username']));
   $pass = sha1($_POST['password']); 
   $level = $_POST['level'];

  if ($level =='1') {
      $sql = mysqli_query($con,"SELECT * FROM tb_guru WHERE email='$email' AND password='$pass' AND status='Y' ") or die(mysqli_error($con)) ;
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
          title: 'Error',
           text:  'User ID / Password Salah Atau Belum Dikonfirmasi Oleh Admin !',
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
    $sql = mysqli_query($con,"SELECT * FROM tb_siswa WHERE nis='$email' AND password='$pass' AND aktif='Y' ") or die(mysqli_error($con)) ;
      $data = mysqli_fetch_array($sql);
      $id = $data [0];
      $cek = mysqli_num_rows($sql);

      if ($cek >0 ){

      $_SESSION['Siswa'] = $id;
      $_SESSION['username']     = $data['nis'];
      $_SESSION['namalengkap']  = $data['nama_siswa'];
      $_SESSION['password']     = $data['password'];
      $_SESSION['nis']          = $data['nis'];
      $_SESSION['id_siswa']          = $data['id_siswa'];
      $_SESSION['kelas']        = $data['id_kelas'];
      $_SESSION['jurusan']        = $data['id_jurusan'];
       $_SESSION['tingkat']        = $data['tingkat'];
      mysqli_query($con,"UPDATE tb_siswa SET status='Online' WHERE id_siswa='$data[id_siswa]'");
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
          title: 'MAAF !',
          text:  'User ID / Password Salah Atau Belum Dikonfirmasi Oleh Admin !',
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



}elseif ($level =='3') {
  $sql = mysqli_query($con,"SELECT * FROM tb_admin WHERE username='$email' AND password='$pass' AND aktif='Y' ") or die(mysqli_error($con)) ;
  $data = mysqli_fetch_array($sql);
  $id = $data [0];
  $cek = mysqli_num_rows($sql);

  if ($cek >0 ){
  $_SESSION['Admin'] = $id;
  $_SESSION['upload_gambar']= TRUE;
  
          echo "
          <script type='text/javascript'>
          setTimeout(function () {
          swal({
          title: 'Admin',
          text:  'Login Berhasil..',
          type: 'success',
          timer: 3000,
          showConfirmButton: true
          });     
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('Admin/index.php');
          } ,3000);   
          </script>";
         
  }else{
      echo "
      <script type='text/javascript'>
      setTimeout(function () {
      swal({
      title: 'Gagal',
       text:  'User ID / Password Salah Atau Belum Dikonfirmasi Oleh Admin !',
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
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendor/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="vendor/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="vendor/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="vendor/sweetalert/sweetalert.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../vendor/js/off-canvas.js"></script>
  <script src="../vendor/js/misc.js"></script>
  <!-- endinject -->
</body>

