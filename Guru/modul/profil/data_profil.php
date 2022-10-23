  <div class="content-wrapper">
 <div class="row">
            <div class="col-md-6 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title text-center">My Profile</h4>
                      <p class="card-description text-center">
                        
                          <img src="../vendor/images/img_Guru/<?=$data['foto']; ?>" style="border:3px solid black;width: 100px;height: 100px;border-radius: 7px;"/>

                      </p>

                      <form class="forms-sample" method="post" action="?page=proses" enctype="multipart/form-data">
                         <div class="form-group">
                      <label>Nip</label>
                      <input type="hidden"  name="ID" value="<?=$data['id_guru'] ?>">
                      <input type="text" class="form-control" name="nik" value="<?=$data['nik'] ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control" name="nama" value="<?=$data['nama_guru'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Email address</label>
                      <input type="text" name="email" class="form-control" value="<?=$data['email'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" id="myInput" required>
                      <input type="checkbox" onclick="myFunction()"><sup>   Show Password</sup>
                    </div>
                    <div class="form-group">
                      <label>Foto</label>
                      <input id="file" type="file" name="foto" class="form-control">                      
                    </div>
          
                    <button type="submit" name="porifilUpdate" class="btn btn-info mr-2">Update</button>
                    <a href="javascript:history.back()" class="btn btn-light">Batal</a>
                  </form>
                      
                    </div>
                  </div>
                </div>
                </div>
                </div>
                 <div class="col-md-4"> 
                  <ul class="list-group">  
                  <b>BIDANG STUDI YANG DI AJARKAN</b> 
                  <br>                   
                        <?php
                        $no=1;
                        $sqlrole = mysqli_query($con,"SELECT * FROM tb_roleguru
                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                          INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                          INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                          WHERE tb_roleguru.id_guru='$sesi' ");
                        foreach ($sqlrole as $row) { ?>
                        <li class="list-group-item">
                          <b><?=$no++; ?>.</b> <?=$row['mapel'] ?> - <?=$row['kelas'] ?>-<?=$row['jurusan'] ?>
                        </li>
                        <?php } ?>
                  </ul>
                  <hr>

            
                 </div>

              </div>
            </div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>