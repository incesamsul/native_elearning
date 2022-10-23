<div class="content-wrapper">
    <h4> <b>User</b> <small class="text-muted">/ Guru</small>
    </h4>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <p class="card-description">
                <a href="?page=guru&act=add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Add</a> <br>
                </p>
                <h4 class="card-title">Data Guru</h4>
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-hover" id="data">
                        <thead>
                        <tr>
                        <th>No.</th> 
                        <th>Nip/Nuptk</th> 
                        <th>Nama Guru</th> 
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Opsi</th>                     
                        </tr>                        
                        </thead>  
                        <tbody>
                        <?php 
                        $no=1;
                        $sql = mysqli_query($con,"SELECT * FROM tb_guru ORDER BY id_guru ASC");
                        foreach ($sql as $d) { ?>
                        <tr>
                            <td width="50"><b><?=$no++; ?>.</b> </td>
                            <td><?=$d['nik']?> </td>
                            <td><?=$d['nama_guru']?> </td>
                            <td><?=$d['email']?> </td>
							 <?php if ($d['foto'] == '') { ?>
							 <td><img src="../vendor/images/img_Guru/512x512.png" class="img-thumbnail" style="width:50px;height:50px;"> </td>
							 <?php } else {?>
                            <td><img src="../vendor/images/img_Guru/<?=$d['foto']?>" class="img-thumbnail" style="width:50px;height:50px;"> </td>
							<?php } ?>
                            <td><?php
                            if ($d['status']=='Y') {
                                echo "<a href=''><b class='badge badge-success'>Aktif</b></a>";
                            }else{
                                echo "<a href=''><b class='badge badge-danger'>Bloked</b></a>";
                            }


                            ?> </td>
                            <td>
                                <a href="?page=guru&act=edit&id=<?=$d['id_guru']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                           <a href="?page=guru&act=del&id=<?=$d['id_guru']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Del</a>


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
