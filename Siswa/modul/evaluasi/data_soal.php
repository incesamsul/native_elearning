<div class="content-wrapper">
    <h4> <b>Evaluasi</b> <small class="text-muted">/Soal</small>
    </h4>
    <hr>
    <div class="row">
      <div class="col-md-12">
         <!--  <div class="card">
          <div class="card-body"> -->
               <!-- <h4 class="card-title">Kumpulan Soal</h4> -->
               <div class="row">
                <div class="col-md-12">
                  <p><b>KUMPULAN SOAL OBJEKTIF</b></p>
                  <table class="table">
                    <tbody>
                          <?php 
						  $tgl = date('Y-m-d');
                      $nomor = 1;
                      $soal= mysqli_query($con,"SELECT * FROM ujian
                      INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON ujian.id_semester=tb_master_semester.id_semester
                      INNER JOIN kelas_ujian ON ujian.id_ujian=kelas_ujian.id_ujian WHERE tanggal='$tgl' AND kelas_ujian.id_kelas='$_SESSION[kelas]' AND kelas_ujian.id_jurusan='$_SESSION[jurusan]'
                        ");
                        foreach ($soal as $s) {  ?> 
                      <tr>
                       <td width="50">
                         <b><?php echo $nomor++;?> .</b>
                       </td>
                        <td>
                          <?php
						  $qnilai = mysqli_query($con, "SELECT * FROM nilai WHERE id_ujian='$s[id_ujian]' AND id_siswa='$_SESSION[id_siswa]' ");
    $tnilai = mysqli_num_rows($qnilai);
    $rnilai = mysqli_fetch_array($qnilai);?>
	 <?php if($tnilai>0 and $rnilai['nilai'] != ""){?>
                          <a data-toggle="modal" data-target="#myModal<?php echo $s['id_ujian'] ?>" href="<?php echo $s['id_ujian'] ?>" class="badge badge-pill badge-info" style="font-size: 14px;">
                            <i class="fa fa-pencil"></i>
                          <?=$s['judul'] ?> - <?=$s['mapel'] ?> - <?=$s['semester'] ?>                          
                          </a> <?php }?>
                                                       <!-- Modal -->
                      <div class="modal fade bs-example-modal-lg" id="myModal<?php echo $s['id_ujian'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header" style="margin-left: 25px;">
                            <table style="font-weight:bold;font-family: consolas;font-size: 23px;">
                                <tr>
                                  <td>SOAL PILIHAN GANDA </td>
                                </tr>
                                 <tr>
                                  <td>MATA PELAJARAN</td>
                                  <td>:</td>
                                  <td><b><?php echo $s['mapel']; ?></b> </td>
                                </tr>
                                 <tr>
                                  <td>SEMESTER</td>
                                  <td>:</td>
                                  <td><b><?php echo $s['semester']; ?></b> </td>
                                </tr>
                            </table>
                            </div>
                            <div class="modal-body" style="overflow: scroll;height: 500px;background-color: #fff;margin-left: 50px;">
                            <?php 
                            $no = 1;
                            $tampil = mysqli_query($con, "SELECT * FROM soal WHERE id_ujian='$s[id_ujian]' ORDER BY id_soal DESC");
                            while($r=mysqli_fetch_array($tampil)){ ?>

                            <p><b><?=$no++; ?> .<?=$r['soal']; ?></b></p>
                            <ol type="A" style='font-size: 13px;'>    
                            <?php 
                            for($i=1; $i<=5; $i++){ 
                            $kolom = "pilihan_$i";
                            if($r['kunci']==$i){
                            echo "<li style='font-size: 13px;'>$r[$kolom]</li>";
                            }else{ 
                            echo "<li style='font-size: 13px;'>$r[$kolom]</li>";
                            }

                            }

                            ?>
                            </ol>
                            <?php } ?>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <a href="../Report/soal/print_soal.php?ID=<?=$s[id_ujian]; ?>" target="_blank" class="btn btn-primary"> <i class="fa fa-download text-white"></i> Download Soal</a>
                            </div>
                          </div>
                        </div>
                      </div>


                        </td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>
                  <hr>
                 <!-- <p><b>KUMPULAN SOAL ESSAY</b></p>-->

                   <table class="table">
                    <tbody>
                          <?php 
                          $noe=1;
                      $soal= mysqli_query($con,"SELECT * FROM ujian_essay
                      INNER JOIN tb_master_mapel ON ujian_essay.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON ujian_essay.id_semester=tb_master_semester.id_semester
                      INNER JOIN kelas_ujianessay ON ujian_essay.id_ujianessay=kelas_ujianessay.id_ujianessay WHERE kelas_ujianessay.id_kelas='$_SESSION[kelas]' AND kelas_ujianessay.id_jurusan='$_SESSION[jurusan]'
                        ");
                        foreach ($soal as $s) {  ?> 
                      <tr>
                        <td width="50"><b><?=$noe++; ?>.</b></td>
                        <td><a data-toggle="modal" data-target="#soalEssay<?php echo $s['id_ujianessay'] ?>" href="<?php echo $s['id_ujianessay'] ?>" class="badge badge-pill badge-primary" style="font-size: 14px;"> <i class="fa fa-pencil"></i>
                          <?=$s['mapel'] ?> - <?=$s['semester'] ?>                          
                          </a> 
                                                       <!-- Modal -->
                      <div class="modal fade bs-example-modal-lg" id="soalEssay<?php echo $s['id_ujianessay'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header" style="margin-left: 25px;">
                            <table style="font-weight:bold;font-family: consolas;font-size: 23px;">
                                <tr>
                                  <td>SOAL ESSAY </td>
                                </tr>
                                 <tr>
                                  <td>MATA PELAJARAN</td>
                                  <td>:</td>
                                  <td><b><?php echo $s['mapel']; ?></b> </td>
                                </tr>
                                 <tr>
                                  <td>SEMESTER</td>
                                  <td>:</td>
                                  <td><b><?php echo $s['semester']; ?></b> </td>
                                </tr>
                            </table>
                            </div>
                            <div class="modal-body" style="overflow: scroll;height: 500px;background-color: #fff;margin-left: 50px;">
                              <?php echo $s['soal_essay']; ?>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <a href="../Report/soal/print_soalessay.php?ID=<?=$s[id_ujianessay]; ?>" target="_blank" class="btn btn-primary"> <i class="fa fa-download text-white"></i> Download Soal</a>
                            </div>
                          </div>
                        </div>
                      </div>


                        </td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>                  

                </div>                
               </div>        
    
                      
            <!-- </div>
            </div>   -->                
      </div>
    </div>
    </div>