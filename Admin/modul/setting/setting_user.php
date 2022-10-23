<!-- <style>
.row {
  display: flex;  
  flex-wrap: wrap;
  margin-right: -434px;
  margin-left: 42px; }
</style> -->
  <div class="content-wrapper">
 <div class="row">
            <div class="col-md-10 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-md-12 ml-5" >
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title text-center">My Profile</h4>
                      <p class="card-description text-center">
                        
                          <img src="../vendor/images/img_Guru/<?=$data['foto']; ?>" style="border:3px solid black;width: 100px;height: 100px;border-radius: 7px;"/>
                      </p>

                      <form class="forms-sample" method="post" action="" enctype="multipart/form-data">
                      <input type="hidden"  name="ID" value="<?=$data['id_admin'] ?>">
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control" name="nama" value="<?=$data['nama_lengkap'] ?>">
                    </div>
                      <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" value="<?=$data['username'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Password Lama</label>
                      <input type="password" name="pass1" class="form-control" required>
                      
                    </div>
                        <div class="form-group">
                      <label>Password Baru</label>
                      <input type="text" name="password" class="form-control" required>
                      
                    </div>
                    <div class="form-group">
                      <label>Foto</label>
                      <input id="file" type="file" name="foto" class="form-control">                      
                    </div>
          
                    <button type="submit" name="update" class="btn btn-info mr-2">Update</button>
                    <a href="javascript:history.back()" class="btn btn-light mr-2 ">Batal</a>
                    <!-- <a href="logout.php" class="btn btn-dark">Logout</a> -->
                     
                  </form>
                      <?php 
                      	if (isset($_POST['update'])) {
                      		$pass= $data['password'];

						$password = sha1($_POST['pass1']);
						$password2 = sha1($_POST['password']);

						if ($pass == $password) {

						$gambar = @$_FILES['foto']['name'];
						if (!empty($_FILES['foto']['name'])) {
						$select=mysqli_query($con,"select foto from tb_admin where id_admin='$_POST[ID]'");
$imagee=mysqli_fetch_array($select);
unlink('../vendor/images/img_Guru/'.$imagee['foto']);
						move_uploaded_file($_FILES['foto']['tmp_name'],"../vendor/images/img_Guru/$gambar");
						$sql= mysqli_query($con,"UPDATE tb_admin SET nama_lengkap='$_POST[nama]',username='$_POST[username]',password='$password2',foto='$gambar' WHERE id_admin='$_POST[ID]' ") or die(mysqli_error($con));
						if ($sql) {
						echo "
						<script type='text/javascript'>
						alert('Profil di perbarui');
						window.location.replace('?page=setting&act=user');
						</script>";
						}
						}else{  	

						$sql= mysqli_query($con,"UPDATE tb_admin SET nama_lengkap='$_POST[nama]',username='$_POST[username]',password='$password2' WHERE id_admin='$_POST[ID]' ") or die(mysqli_error($con));
						if ($sql) {
						echo "
						<script type='text/javascript'>
						alert('Profil di perbarui');
						window.location.replace('?page=setting&act=user');
						</script>";
						}
}
							
							
						}else{
							echo "<script type='text/javascript'>
						alert('Password Lama tidak cocok');
						window.location.replace('?page=setting&act=user');
						</script>";
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
