<div class="content-wrapper">
    <h4> <b>User</b> <small class="text-muted">/ Siswa</small>
    </h4>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <p class="card-description">
                <a href="?page=siswa&act=add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Add</a> <br>
                </p>
                <h4 class="card-title">Data Siswa</h4>
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-hover" id="data">
                        <thead>
                        <tr>
                        <th>No.</th> 
                        <th>Nis</th> 
                        <th>Nama Siswa</th> 
                        <th>Kelas</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Opsi</th>                     
                        </tr>                        
                        </thead>  
                        <tbody>
                        <?php 
                        $no=1;
                        $sql = mysqli_query($con,"SELECT * FROM tb_siswa
                            INNER JOIN tb_master_kelas ON tb_siswa.id_kelas=tb_master_kelas.id_kelas
                            INNER JOIN tb_master_jurusan ON tb_siswa.id_jurusan=tb_master_jurusan.id_jurusan
                         ORDER BY id_siswa ASC");
                        foreach ($sql as $d) { ?>
                        <tr>
                            <td width="50"><b><?=$no++; ?>.</b> </td>
                            <td><?=$d['nis']?> </td>
                            <td><?=$d['nama_siswa']?> </td>
                            <td><?=$d['kelas']?>-<?=$d['jurusan']?> </td>
							<?php if ($d['foto'] == '') { ?>
							<td><img src="../vendor/images/img_Siswa/default.png" class="img-thumbnail" style="width:50px;height:50px;"> </td>
							 <?php } else {?>
                            <td><img src="../vendor/images/img_Siswa/<?=$d['foto']?>" class="img-thumbnail" style="width:50px;height:50px;"> </td>
							<?php } ?>
                            <td><?php
                            if ($d['aktif']=='Y') {
                                echo "<a href=''><b class='badge badge-success'>Aktif</b></a>";
                            }else{
                                echo "<a href=''><b class='badge badge-danger'>Bloked</b></a>";
                            }


                            ?> </td>
                            <td>
                                    <a href="?page=siswa&act=edit&id=<?=$d['id_siswa']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                           <a href="?page=siswa&act=del&id=<?=$d['id_siswa']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Del</a>


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
</div>
