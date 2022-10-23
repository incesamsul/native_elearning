<div class="content-wrapper">
<h4> <b>Tugas Siswa</b> <small class="text-muted">/</small>
</h4>
<hr>

<div class="row">
  	<div class="col-md-12">
      	<div class="card">
	      <div class="card-body">

                  <h4 class="card-title">Data Tugas</h4>
                  <p class="card-description">
                    <a href="?page=tugas&act=add" class="btn btn-dark text-white"><i class="fa fa-plus"></i>Tambah Tugas</a>
                  </p> 
				  <div class="table-responsive"> 
                  <table class="table table-dark" id="data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
						<th>Judul</th>
                        <th>Jenis Tugas</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody style="color: black;">
                    	<?php 
                    	$no=1;
                    	$sql = mysqli_query($con,"SELECT * FROM tb_tugas
                    		INNER JOIN tb_jenistugas ON tb_tugas.id_jenistugas=tb_jenistugas.id_jenistugas
                    		INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
                    		INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
                    	 WHERE tb_tugas.id_guru='$sesi' ");
                    	foreach ($sql as $d) {?>
                      <tr>
                        <td><?=$no++; ?>. </td>
                        <td> <?=$d['mapel'] ?></td>
						<td> <?=$d['judul_tugas'] ?></td>
                        <td><?=$d['jenis_tugas'] ?></td>
                        <td>
                        <a data-toggle="modal" data-target="#kelasTugas<?=$d['id_tugas']; ?>" class="btn btn-dark btn-sm text-warning"><i class="fa fa-graduation-cap"></i> Kelas </a>

                           <!-- Modal -->
                            <div class="modal fade" id="kelasTugas<?=$d['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">PENGATURAN KELAS TUGAS</h4>
                                  </div>
                                   <form  method=POST enctype='multipart/form-data' action=?page=proses>
                                  <div class="modal-body">                                       
                                <input type="hidden" name="id" value="<?=$d[id_tugas]; ?>">
                                <p>
                                      <h4><b>KELAS TERSEDIA</b></h4>
                                    </p>
                                  <table class='table'>
                                  <thead>
                                  <tr>
                                    <th>Nama Kelas</th>
                                    <th></th>
                                  </tr>
                                  </thead>
                                <tbody>
                                  <?php
                                  // kelas yg dimiliki oleh guru
                                  $kelasguru = mysqli_query($con,"SELECT * FROM tb_roleguru
                                  INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                                  INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                                  WHERE tb_roleguru.id_guru='$sesi' GROUP BY tb_roleguru.id_jurusan,tb_roleguru.id_kelas");
                                  foreach ($kelasguru as $kg) { ?>
                                  <tr>
                                    <td>

                                      <label class="form-check-label">
                                    <input type="checkbox" value="<?=$kg['id_kelas']; ?>" name="kelas[]">
                                    KELAS <?=$kg['kelas']; ?>
                                    </label>
                                    <label class="form-check-label">
                                    <input type="checkbox" value="<?=$kg['id_jurusan']; ?>" name="jurusan[]">
                                    <?=$kg['jurusan']; ?>
                                    </label>
                                    </td>
                                    <td>
                                      <a href="?page=tugas&act=addkelastugas&tugas=<?=$d['id_tugas']; ?>&kelas=<?=$kg['id_kelas']; ?>&jurusan=<?=$kg['id_jurusan']; ?>" class="btn btn-info btn-xs">Pilih</a>
                                    </td>
                                  </tr>
                                  <?php } ?>
                                </tbody>
                                <tr>
                                  <td colspan="2">
                                  <button name="kelastugasSave" type="submit" class="btn btn-primary btn-xs">Save</button>
                                  </td>
                                </tr> 
                                  </table>

                                    <p>
                                      <h4><b>KELAS TERPILIH</b></h4>
                                    </p>
                                  <table class="table">
                                  <thead>
                                  <tr>
                                    <th>Nama Kelas</th>
                                    <th></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                    // tampilkan kelas yg telah terpilih
                                    $klsujian = mysqli_query($con,"SELECT * FROM kelas_tugas
                                    INNER JOIN tb_master_kelas ON kelas_tugas.id_kelas=tb_master_kelas.id_kelas
                                    INNER JOIN tb_master_jurusan ON kelas_tugas.id_jurusan=tb_master_jurusan.id_jurusan
                                    WHERE id_tugas='$d[id_tugas]' ");
                                    foreach ($klsujian as $ku) { ?>
                                    <tr>
                                      <td> <?=$ku['kelas']; ?>-<?=$ku['jurusan']; ?> </td>
                                      <td> 
                                        <a href="?page=tugas&act=delkelas&id=<?=$ku['id_klstugas']; ?>" class="btn btn-danger btn-xs">Batal</a>

                                      </td>
                                    </tr>
                                    <?php }?>
                                    </tbody>

                                  </table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   
                                  </div>
                                    </form>
                                </div>
                              </div>
                            </div>
						</div>
                        </td>
                        <td>
                        	           <!-- cek ujian ini di kelas tugas -->
                            <?php 
                                $klsu= mysqli_query($con,"SELECT * FROM kelas_tugas WHERE id_tugas='$d[id_tugas]' AND aktif='Y' ");
                                 $jml = mysqli_num_rows($klsu);
                                // foreach ($klsu as $u)
                                  if ($jml >0) {
                                    ?>
                                    <!-- <a class="badge badge-pill badge-primary"> Aktif</a> -->
                                    <a data-toggle="modal" data-target="#tutup<?=$d['id_tugas']; ?>" class="btn btn-success btn-sm text-white"><i class="fa fa-check-square-o"></i> Aktif </a>
                                    <!-- MODAL TUTUP UJIAN -->
                                    <div class="modal fade" id="tutup<?=$d['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">
                                            <center>
                                              Apakah Anda Ingin <b>Non Aktifkan</b> TUGAS Ini <br> Sekarang ?
                                            </center>
                                          </h4>
                                        </div>
                                        <div class="modal-body">                                    
                                           <center>
                                             <a href="?page=tugas&act=close&tugas=<?php echo $d['id_tugas']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                           </center>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>

                                    <?php
                                  }else{
                                    ?>
                                    <!-- <a class="badge badge-pill badge-warning">Tidak Aktif</a> -->
                                    <a data-toggle="modal" data-target="#Aktif<?=$d['id_tugas']; ?>" class="btn btn-danger btn-sm text-white"><i class="fa fa-window-close-o"></i> Tutup </a> 
                                           <!-- Modal Aktifkan ujian -->
                                  <div class="modal fade" id="Aktif<?=$d['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">
                                            <center>
                                              Apakah Anda Ingin <b>Mengaktifkan</b> TUGAS Ini Sekarang ?
                                            </center>
                                          </h4>
                                        </div>
                                        <div class="modal-body">                                    
                                           <center>
                                             <a href="?page=tugas&act=active&tugas=<?php echo $d['id_tugas']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                           </center>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                                    <?php
                                  }                              
                                 
                             ?> 
                        	
                        </td>
                        <td>
                        	<a href="?page=tugas&act=edit&ID=<?=$d['id_tugas']; ?>" class="btn btn-dark text-warning btn-xs"><i class="fa fa-pencil"></i> </a>
                        	<a href="?page=tugas&act=del&idt=<?=$d['id_tugas']; ?>" class="btn btn-dark text-danger btn-xs" onclick="return confirm('Yakin Akan Hapus data ??')"><i class="fa fa-trash"></i> </a>
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
