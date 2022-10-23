 <?php
$edit = mysqli_query($con, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'");
$r = mysqli_fetch_array($edit);
?>
<div class="content-wrapper">
  <h4>
  Kelas Ujian <small class="text-muted">/ Tambah</small>
  </h4>
  <hr>
  <div class="row">

    <div class="col-md-10 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Pengaturan Ujian</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>

                      <!-- Input addon -->
			<form  method=POST enctype='multipart/form-data' action=?page=proses>
			<input type="hidden" name="id" value="<?=$r[id_ujian]; ?>">
			<input type="hidden" name="jurusan" value="<?=$_GET[jur]; ?>">
			<table  class='table'>
			<thead>
			<tr>

			<th>Tingkat</th>	
			<th>Nama Kelas</th>
			</tr>
			</thead>
			<tbody> 
					<?php foreach ($edit as $jml) { ?>
					<tr>
					<td width='20'>Kelas</td>
					<td>	
						<?php 
						$kelas = mysqli_query($con, "SELECT * FROM tb_roleguru
						INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
						INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
						WHERE tb_roleguru.id_guru='$sesi' GROUP BY tb_roleguru.id_kelas ");
						while($t = mysqli_fetch_array($kelas)){

						$jml  = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM kelas_ujian WHERE id_ujian=$_GET[id] "));
						?>
						<?php 


					if ($t['id_kelas'] == $jml['id_kelas']) {
					?>					
					<label class="form-check-label">
					<input type="checkbox" value="<?=$t['id_kelas']; ?>" name="kelas[]"  checked>
					KELAS <?=$t['kelas']; ?>
					</label>
					<hr>
					<?php

					}else{
					?>
					<br>
						<label class="form-check-label">
						<input type="checkbox" value="<?=$t['id_kelas']; ?>" name="kelas[]">
						KELAS <?=$t['kelas']; ?>
						</label>
						<hr>
					  

					<?php
					}



						 ?>
						<?php } ?>


					</td>
					</tr>
					<?php } ?>
</tbody>
</table>



	<p class='stdformbutton'>
	<button name="kelasujianSave" type="submit" class='btn btn-primary'>Simpan</button>
	<input type=button value=Batal onclick=self.history.back() class='btn btn-warning btn-rounded'>

	</p>


	</form>





          </div>
      </div>
         </div>
      </div>
         </div>
      </div>
  </div>
 

<!--  -->

