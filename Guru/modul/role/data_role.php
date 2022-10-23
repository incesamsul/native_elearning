  <div class="content-wrapper">
      <h4>
  Mata Pelajaran
  </h4>
  <hr>
              <?php 
          if (empty($role['id_guru'])) {
            ?>
              <div class="row purchace-popup">
                <div class="col-md-12">
                  <span class="d-flex alifn-items-center">
                  <p>Saat ini Anda belum memilih Mata Pelajaran, Silahkan Tambahkan Mata Pelajaran Untuk Memulai .</p>
                  <a href="?page=mapel&act=add" class="btn ml-auto purchase-button"> <i class="fa fa-plus"></i> Tambah Mata Pelajaran</a>
                  <i class="mdi mdi-close popup-dismiss"></i>
                  </span>
                </div>
              </div>
          
            <?php
          }else{
            ?>
              <div class="row purchace-popup">
                <div class="col-md-12">
                  <span class="d-flex alifn-items-center">
                 <a href="?page=mapel&act=add" class="btn btn-dark"> <i class="fa fa-plus"></i> Add Mata Pelajaran</a>
                  </span>
                </div>
              </div>




          <div class="row">
           <div class="col-md-12">

               <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mata Pelajaran</h4>
                  <p class="card-description">
                    <!-- Add class <code>.table</code> -->
                  </p>
                  <div class="table-responsive">   
                  <table class="table table-striped table-hover table-condensed">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Semester</th>
                        <th>Jurusan</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php 
                          $no=1;
                        $sqlrole = mysqli_query($con,"SELECT * FROM tb_roleguru
                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                          INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                          INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                          WHERE tb_roleguru.id_guru='$sesi' ");
                        foreach ($sqlrole as $row) { ?>       

                      <tr>
                        <td><?=$no++; ?>.</td>
                        <td><?=$row['mapel']; ?></td>
                        <td><?=$row['kelas']; ?></td>
                        <td><?=$row['semester']; ?></td>
                        <td><?=$row['jurusan']; ?></td>
                        <td>
                          <a href="?page=mapel&act=edit&ID=<?=$row['id_roleguru']; ?>" class="btn btn-dark btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                          <a href="?page=mapel&act=del&ID=<?=$row['id_roleguru']; ?>" onclick="return confirm('Yakin Hapus Data ?')" class="btn btn-dark btn-sm text-danger"><i class="fa fa-trash"></i> Del </a>
                        </td>

                      </tr>
                    <?php } ?>

                   </tbody>
                 </table>
               </div>
               </div>
             </div>


           </div>
          </div>
      

            <?php
           
          }
          ?>

  </div>