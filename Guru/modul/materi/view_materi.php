<div class="content-wrapper">
<h4>
 <b>Materi</b>
<small class="text-muted">/
<?=$_GET['jurusan']?>
</small>
</h4>
<hr>
      
              <?php 
          if (empty($materi['id_guru'])) {
            ?>
              <div class="row purchace-popup">
                <div class="col-md-12 col-xs-12">
                  <span class="d-flex alifn-items-center">
                  <p>Saat ini Anda belum mempunyai Materi Apapun. Tambah Untuk Membuat Materi</p>
                  <a data-toggle="modal" data-target="#addMateri" href="?page=materi&act=add" class="btn ml-auto purchase-button"> <i class="fa fa-plus"></i> Add Materi</a>
                  <i class="mdi mdi-close popup-dismiss"></i>
                  </span>
                </div>
              </div>
          
            <?php
          }else{
            ?>
                  <div class="row purchace-popup">
                <div class="col-md-12 col-xs-12">
                  <span class="d-flex alifn-items-center">
                  <!-- <h4><b>Home</b> > Perangkat Pembelajaran</h4> -->

                  <a data-toggle="modal" data-target="#addMateri" href="?page=materi&act=add" class="btn btn-dark"> <i class="fa fa-plus"></i> Add Materi</a>
                  </span>
                </div>
              </div>

          <div class="row">
           <div class="col-md-12 col-xs-12">


                <div class="card">
                <div class="card-body">
                  <h4 class="card-title">MATERI JURUSAN <b><?=$_GET['jurusan']?></b></h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">                 
                  <table class="table table-condensed table-hover" id="data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Judul Materi</th>
                        <th>Materi</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Publik</th>
                        <th></th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php 
                          $no=1;
                        $sqlrole = mysqli_query($con,"SELECT * FROM tb_materi

                      INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_roleguru.id_roleguru

                      INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas

                      INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel

                      INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                      INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan WHERE tb_roleguru.id_guru='$sesi' AND tb_roleguru.id_jurusan='$_GET[ID]' ORDER BY id_materi DESC ");
                        foreach ($sqlrole as $row) { ?>       

                      <tr>
                       <td><?=$no++; ?>.</td>
                        <td><b class="text-info"><?=$row['judul_materi']; ?></b></td>
                        <td>
                          <a data-toggle="modal" data-target="#<?=$row['id_materi']; ?>" class="btn btn-light"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> View Materi</a>
                                    <!-- Modal Detail-->
                   <div class="modal fade bs-example-modal-lg" id="<?=$row['id_materi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">

                            <h4 class="modal-title">
                              MATERI PEMBELAJARAN <br>
                              <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <b> <?=$row['judul_materi']; ?></b> | <?=$row['mapel']; ?> KELAS <?=$row['kelas']; ?>-<?=$row['jurusan']; ?> </h4>
                              <hr>
                          </div>
                          <div class="modal-body" style="overflow:scroll;height:450px;">

                            <?php 
                            if ($row['tipe_file']=='text') {
                                echo "$row[materi]";
                            }else{

                              ?>
                              <br>
                              <br>
                            
                               
                                <div class="card">
                                <div class="card-body">
                                  <center><h1> <i class="fa fa-file-code-o"></i> </h1></center>
                                  <table class="table">
                                   <thead>
                                     <tr>
                                       <td><h4><b> Tipe File</b></h4></td>
                                       <td>:</td>
                                        <td> 
                                          <?php echo "<h4><b> <i class='fa fa-file-word-o'></i> $row[tipe_file] </b></h4> "; ?></td>
                                     </tr>
                                      <tr>
                                       <td><h4><b> Ukuran File</b></h4></td>
                                       <td>:</td>
                                        <td> <h4><b><?=$row['ukuran_file']; ?>.KB </b></h4></td>
                                     </tr>
                                      <tr>
                                       <td colspan="3" align="center"> <a href="<?=$row['file']; ?>" target="_blank" class="btn btn-danger btn-md text-white"><i class="fa fa-download"></i> Download</a></td>
                                     </tr>
                                  </table>                                 
                                </div>
                              </div>                          
                          
                              <?php

                              // echo "<a href='$row[file]'> Download</a>";

                            }

                             ?>
                          </div>
                          <div class="modal-footer" style="float: left;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       <?php
                              if ($row['tipe_file']=='text') {
                                ?>
                                <a href="../Report/materi/materi-word.php?ID=<?php echo $row['id_materi'] ?>" target="_blank" class="btn btn-primary btn-md text-white"><i class="fa fa-file-word-o"></i> Export To Ms.WORD</a>
                                <?php
                              }
                             ?>

                          </div>
                        </div>
                      </div>
                    </div> 

                        </td>
                        <td><?=$row['mapel']; ?>  <em><b><?=$row['semester']; ?></b></em> </td>
                        <td><b><?=$row['kelas']; ?> - <?=$row['jurusan']; ?></b> </td>
                        <td><?php
                        if ($row['public']=='Y') {
                          echo "<b class='badge badge-success'>Yes</b>";
                        }else{
                           echo "<b class='badge badge-danger'>No</b>";
                        }

                       ?></td>
                       <td>
                         <?php
                        if ($row['public']=='Y') {
                          echo "<a href='?page=materi&act=activate&id=$row[id_materi]&status=$row[public]' class='btn btn-danger btn-xs text-white'><i class='fa fa-spin fa-lock'></i></a>";
                        }else{
                           echo "<a href='?page=materi&act=activate&id=$row[id_materi]&status=$row[public]' class='btn btn-success btn-xs text-white'><i class='fa fa-spin fa-unlock'></i></a>";
                        }

                       ?>
                       </td>
                        <td>
                          <a href="?page=materi&act=edit&ID=<?=$row['id_materi'] ?>" class="btn btn-dark btn-xs"><i class="fa fa-edit"></i> </a>
                          <a href="?page=materi&act=del&ID=<?=$row['id_materi'] ?>" onclick="return confirm('Yakin Hapus Data ?')" class="btn btn-dark text-danger btn-xs"><i class="fa fa-trash"></i> </a>
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
<div class="modal fade" id="addMateri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title" id="myModalLabel">Model Perangkat</h4> -->
      </div>
      <div class="modal-body">
        <center>

           <a href="?page=materi&act=add&TYPE=Manual" class="btn btn-dark btn-lg">
            <!-- <img src="../vendor/images/ck.png" width="300"> -->
            <i class="fa fa-file-text-o"></i>BY CKEDITOR</a>
         <a href="?page=materi&act=add&TYPE=Upload" class="btn btn-success btn-lg"><i class="fa fa-upload"></i>UPLOAD FILE</a>
        </center>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->

      </div>
    </div>
  </div>
</div>