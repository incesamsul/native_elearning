
  <div class="content-wrapper">
<h4>
Perangkat
</h4>
<hr>
              <?php 
          if (empty($prkt['id_guru'])) {
            ?>
              <div class="row purchace-popup">
                <div class="col-md-12">
                  <span class="d-flex alifn-items-center">
                  <p>Saat ini Anda belum mempunyai Perangkat Apapun. Tambah Untuk Menampilkan Perangkat</p>
                  <!-- href="?page=perangkat&act=add" -->
                  <a  data-toggle="modal" data-target="#myModal" class="btn ml-auto purchase-button"> <i class="fa fa-plus"></i> Tambah Perangkat</a>
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
                  <!-- <h4><b>Home</b> > Perangkat Pembelajaran</h4> -->

                  <a data-toggle="modal" data-target="#myModal" class="btn btn-dark"> <i class="fa fa-plus"></i> Add Perangkat</a>
                  </span>
                </div>
              </div>

          <div class="row">
           <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Perangkat Pembelajaran</h4>
                  <p class="card-description">
      
                  </p>
                  <div class="table-responsive">                 
                  <table class="table table-condensed table-hover" id="data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Jenis</th>
                        <th>Perangkat</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php 
                          $no=1;

                        $sqlrole = mysqli_query($con,"SELECT * FROM tb_perangkat
                      INNER JOIN tb_jenisperangkat ON tb_perangkat.id_jenisperangkat=tb_jenisperangkat.id_jenisperangkat
                      INNER JOIN tb_master_kelas ON tb_perangkat.id_kelas=tb_master_kelas.id_kelas
                      INNER JOIN tb_master_mapel ON tb_perangkat.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON tb_perangkat.id_semester=tb_master_semester.id_semester
                      INNER JOIN tb_master_jurusan ON tb_perangkat.id_jurusan=tb_master_jurusan.id_jurusan WHERE tb_perangkat.id_guru='$sesi' ORDER BY id_perangkat DESC ");
                        
                        foreach ($sqlrole as $row) { ?>       

                      <tr>
                       <td><?=$no++; ?>.</td>
                        <td><?=$row['mapel']; ?></td>
                        <td><?=$row['kelas']; ?> - <?=$row['jurusan']; ?>  </td>
                        <td><?=$row['jenis_perangkat']; ?></td>
                        <td>
                          <a data-toggle="modal" data-target="#<?=$row['id_perangkat']; ?>" class="btn btn-light"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> View Perangkat</a>
                                    <!-- Modal Detail-->
                    <div class="modal fade bs-example-modal-lg" id="<?=$row['id_perangkat']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">
                              PERANGKAT PEMBELAJARAN <br>
                              <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <b> <?=$row['jenis_perangkat']; ?></b> | <?=$row['mapel']; ?> KELAS <?=$row['kelas']; ?>-<?=$row['jurusan']; ?> </h4>
                              <hr>
                          </div>
                          <div class="modal-body" style="overflow:scroll;height:450px;">
                            <?=$row['isi_perangkat']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <a href="../Report/perangkat/perangkat-word.php?ID=<?=$row['id_perangkat'];?>" target="_blank" class="btn btn-primary btn-md text-white"><i class="fa fa-file-word-o"></i> Export To Ms.WORD</a>
                               <a href="" target="_blank" class="btn btn-danger btn-md text-white"><i class="fa fa-file-pdf-o"></i> Export To PDF</a>
                                <a href="" target="_blank" class="btn btn-dark btn-md text-white"><i class="fa fa-print"></i> Print Out</a>
                            <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download</button>
                          </div>
                        </div>
                      </div>

                    



                    </div>

   

                    



                    </div>
                        </td>
                       
                        <td>
                          <a href="?page=perangkat&act=edit&ID=<?=$row['id_perangkat'] ?>" class="btn btn-dark"><i class="fa fa-edit"></i> Edit </a>
                          <a href="?page=perangkat&act=del&ID=<?=$row['id_perangkat'] ?>" onclick="return confirm('Yakin Hapus Data ?')" class="btn btn-dark text-danger"><i class="fa fa-trash"></i> Del </a>
                        </td>

                      </tr>
                    <?php } ?>

                   </tbody>
                 </table>
                  </div>
               </div>
             </div>

           </div>
     <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Perangkat Pembelajaran</h4>
                  <p class="card-description">
      
                  </p>
                  <div class="table-responsive">                 
                  <table class="table table-condensed table-hover" id="data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Jenis</th>
                        <th>Perangkat</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php 
                          $no=1;

                        $sqlrole = mysqli_query($con,"SELECT * FROM tb_perangkat
                      INNER JOIN tb_jenisperangkat ON tb_perangkat.id_jenisperangkat=tb_jenisperangkat.id_jenisperangkat
                      INNER JOIN tb_master_kelas ON tb_perangkat.id_kelas=tb_master_kelas.id_kelas
                      INNER JOIN tb_master_mapel ON tb_perangkat.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON tb_perangkat.id_semester=tb_master_semester.id_semester
                      INNER JOIN tb_master_jurusan ON tb_perangkat.id_jurusan=tb_master_jurusan.id_jurusan WHERE tb_perangkat.id_guru='$sesi' ORDER BY id_perangkat DESC ");
                        
                        foreach ($sqlrole as $row) { ?>       

                      <tr>
                       <td><?=$no++; ?>.</td>
                        <td><?=$row['mapel']; ?></td>
                        <td><?=$row['kelas']; ?> - <?=$row['jurusan']; ?>  </td>
                        <td><?=$row['jenis_perangkat']; ?></td>
                        <td>
                          <a data-toggle="modal" data-target="#<?=$row['id_perangkat']; ?>" class="btn btn-light"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> View Perangkat</a>
                                    <!-- Modal Detail-->
                    <div class="modal fade bs-example-modal-lg" id="<?=$row['id_perangkat']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">
                              PERANGKAT PEMBELAJARAN <br>
                              <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <b> <?=$row['jenis_perangkat']; ?></b> | <?=$row['mapel']; ?> KELAS <?=$row['kelas']; ?>-<?=$row['jurusan']; ?> </h4>
                              <hr>
                          </div>
                          <div class="modal-body" style="overflow:scroll;height:450px;">
                            <?=$row['isi_perangkat']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <a href="../Report/perangkat/perangkat-word.php?ID=<?=$row['id_perangkat'];?>" target="_blank" class="btn btn-primary btn-md text-white"><i class="fa fa-file-word-o"></i> Export To Ms.WORD</a>
                               <a href="" target="_blank" class="btn btn-danger btn-md text-white"><i class="fa fa-file-pdf-o"></i> Export To PDF</a>
                                <a href="" target="_blank" class="btn btn-dark btn-md text-white"><i class="fa fa-print"></i> Print Out</a>
                            <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download</button>
                          </div>
                        </div>
                      </div>

                    



                    </div>

   

                    



                    </div>
                        </td>
                       
                        <td>
                          <a href="?page=perangkat&act=edit&ID=<?=$row['id_perangkat'] ?>" class="btn btn-dark"><i class="fa fa-edit"></i> Edit </a>
                          <a href="?page=perangkat&act=del&ID=<?=$row['id_perangkat'] ?>" onclick="return confirm('Yakin Hapus Data ?')" class="btn btn-dark text-danger"><i class="fa fa-trash"></i> Del </a>
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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title" id="myModalLabel">Model Perangkat</h4> -->
      </div>
      <div class="modal-body">
        <center>

           <a href="?page=perangkat&act=add&TYPE=Manual" class="btn btn-primary">
            <!-- <img src="../vendor/images/ck.png" width="300"> -->
            <i class="fa fa-file-text-o"></i>BY CKEDITOR</a>
         <a href="?page=perangkat&act=add&TYPE=Upload" class="btn btn-success"><i class="fa fa-upload"></i>UPLOAD FILE</a>
        </center>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->

      </div>
    </div>
  </div>
</div>