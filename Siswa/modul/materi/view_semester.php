<div class="content-wrapper">
<h4>
<!-- <img class="menu-icon" src="../vendor/images/menu_icons/01.png" width="20"> -->
 <b>MATERI</b>
<small class="text-muted">/
<?= $_GET['semester']; ?>
</small>
</h4>
<hr>

<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">DAFTAR MATERI <b><?= $_GET['semester']; ?></b></h4>
                  <p class="card-description">
                    <!-- Add class <code>.table-hover</code> -->
                  </p>
          
<div class="table-responsive"> 
              <table class="table table-condensed table-striped table-hover">
                 <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                       
                      </tr>
                    </thead>
                    <tbody>
                          <?php 
                          $no=1;
                        $sqlmtr = mysqli_query($con,"SELECT * FROM tb_materi

                      INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_roleguru.id_roleguru

                      INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                      INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                      INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                       WHERE tb_roleguru.id_kelas='$data[id_kelas]' AND tb_roleguru.id_jurusan='$data[id_jurusan]' AND tb_roleguru.id_semester='$_GET[id]' ");
                        $jml = mysqli_num_rows($sqlmtr);
                        foreach ($sqlmtr as $row) { ?> 
                      <tr style="border-top: 2px solid black;">
                        <td><b><?=$no++; ?>.</b></td>

                        <td><b><?=$row['mapel']; ?></b></td>
                        <td>
                         <a class="badge badge-pill badge-warning" data-toggle="modal" data-target="#<?=$row['id_materi']; ?>"> <em><?=$row['judul_materi']; ?></em></a>


                        </td>
                        <td><b><?=$row['semester']; ?></b></td>
                        <td>
                          <a data-toggle="modal" data-target="#<?=$row['id_materi']; ?>" class="btn btn-info btn-rounded btn-fw" style="color: #fff;"> <i class="fa fa-eye"></i>View</a> 
                          <?php if ($row['tipe_file']=='text') {
                           ?>
                           <a href="../Report/materi/materi-words.php?ID=<?php echo $row['id_materi'];?>" target="_blank" class="btn btn-light btn-rounded btn-fw text-info"><i class="fa fa-download"></i> Unduh.<?php echo $row['tipe_file']; ?> </a>
                           <?php
                          } else{
                            ?>
                            <a href="<?=$row['file']; ?>" target="_blank" class="btn btn-light btn-rounded btn-fw text-info"><i class="fa fa-download"></i> Unduh.<?php echo $row['tipe_file']; ?> </a>
                            <?php
                          }

                          ?>
</div>
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
                                <a href="../Report/materi/materi-words.php?ID=<?php echo $row['id_materi'];?>" target="_blank" class="btn btn-primary btn-md text-white"><i class="fa fa-file-word-o"></i> Export To Ms.WORD</a>
                                <?php
                              }
                             ?>


                              

                          </div>
                        </div>
                      </div>
                    </div> 





                      </td>
                     
                      </tr>
                        <?php } ?>
                    </tbody>
            
                    <tr style="background-color: #fff; font-weight: bold;height: 40px;border-top: 2px solid black;">
                      <td>Jumlah</td>
                      <td colspan="4">( <?=$jml;?> )</td>
                    </tr>
                  </table>













          </div>
      </div>
  </div>
</div>


</div>