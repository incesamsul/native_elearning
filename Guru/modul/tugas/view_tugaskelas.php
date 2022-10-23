<?php 
// tampilkan kelas tugas
$kelasTugas= mysqli_query($con,"SELECT * FROM kelas_tugas
INNER JOIN tb_master_kelas ON kelas_tugas.id_kelas=tb_master_kelas.id_kelas
INNER JOIN tb_master_jurusan ON kelas_tugas.id_jurusan=tb_master_jurusan.id_jurusan
WHERE kelas_tugas.id_tugas='$_GET[tugas]' AND kelas_tugas.id_kelas='$_GET[kelas]' AND kelas_tugas.id_jurusan='$_GET[jurusan]'
");
foreach ($kelasTugas as $k)
// tampilkan dat identitas tugas
$sqldataTugas = mysqli_query($con,"SELECT * FROM tb_tugas
INNER JOIN tb_jenistugas ON tb_tugas.id_jenistugas=tb_jenistugas.id_jenistugas
INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
WHERE tb_tugas.id_guru='$sesi' AND tb_tugas.id_tugas='$_GET[tugas]' ");
foreach ($sqldataTugas as $t)
?>
<div class="content-wrapper">
<h4> <b>TUGAS</b> <small class="text-muted">/ KELAS <b><?php echo $k['kelas']; ?>-<?php echo $k['jurusan']; ?></b></small>
</h4>
<hr>
<div class="row purchace-popup">
            <div class="col-8">
              <span class="d-flex alifn-items-center">
              <table class="table">
              <tr>
	              <th colspan="2">DETAIL TUGAS <b><?=$t['jenis_tugas'] ?></b></th>
	              <th>TANGGAL <b class="text-danger"><?=date('d-F-Y',strtotime($t['tanggal'])) ?></b></th>
              </tr>
              <tr>
	              <th>Judul Tugas</th>
	              <th>:</th>
	              <th><?=$t['judul_tugas'] ?></th>
              </tr>  
              <tr>
	              <th>Mata Pelajaran</th>
	              <th>:</th>
	              <th><?=$t['mapel'] ?></th>
              </tr>  
              <tr>
	              <th>Kelas/Jurusan</th>
	              <th>:</th>
	              <th>
	                <?=$k['kelas'] ?> - <?=$k['jurusan'] ?>
	              </th>
              </tr> 
              <tr>
	              <th>Semester</th>
	              <th>:</th>
	              <th>
	                 <?=$t['semester'] ?> 
	              </th>
              </tr>                 

              </table>
              </span>
              
            </div>
          </div>


<!-- <div class="alert alert-warning alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>Info!</strong> Ada <b>10</b> Siswa yang belum mengerjakan Tugas pada kelas dan jurusan ini .
</div> -->

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
				 <h4 class="card-title">Daftar Siswa</h4>

<!-- 
					<table class="table" id="data">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Kirim</th>
								<th>Nis</th>
								<th>Nama Siswa</th>
								<th>File Tugas</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							// data siswa yg mengumpulkan tugas
							$nomor=1;
							$siswa = mysqli_query($con,"SELECT * FROM tugas_siswa
								INNER JOIN tb_siswa ON tugas_siswa.id_siswa=tb_siswa.id_siswa
								WHERE tugas_siswa.id_tugas='$_GET[tugas]' 
								AND tb_siswa.id_kelas='$_GET[kelas]' AND tb_siswa.id_jurusan='$_GET[jurusan]'
								");
								foreach ($siswa as $s) { ?>
							<tr>
								<td><b><?=$nomor++; ?> .</b></td>
								<td><?=date('d-F-Y',strtotime($s['tgl_upload']));?></td>
								<td><?=$s['nis'];?></td>
								<td><?=$s['nama_siswa'];?></td>
								<td><a href="<?=$s['file'];?>" class="badge badge-pill badge-success"><i class="fa fa-download"></i> Download</a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table> -->
<hr>
<div class="table-responsive">
					<table class="table" id="data">
						<thead>
							<tr>
								<th>No</th>
								<th>Nis</th>
								<th>Nama Siswa</th>
								<th>Status & File Tugas</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							// data siswa yg mengumpulkan tugas
							$nomor=1;
							$siswaKelasa = mysqli_query($con,"SELECT * FROM tb_siswa
								WHERE id_kelas='$_GET[kelas]' AND id_jurusan='$_GET[jurusan]'
								");
								foreach ($siswaKelasa as $sk) { ?>
							<tr>
								<td><b><?=$nomor++; ?> .</b></td>
								<td><?=$sk['nis'];?></td>
								<td><?=$sk['nama_siswa'];?></td>
								<td>
									<!-- tampilkan data di tabel tugas -->
									<?php 
									$tgs = mysqli_query($con,"SELECT * FROM tugas_siswa WHERE id_siswa='$sk[id_siswa]' AND id_tugas='$_GET[tugas]' ");
									$cek = mysqli_num_rows($tgs);
									$dt=mysqli_fetch_array($tgs);
										
										if ($cek > 0) {

											echo '<span" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Selesai</span> | Dikirim Tanggal ';

											echo date('d-F-Y',strtotime($s['tgl_upload']));
											
											echo '<br />';
											echo '<br />';
											echo $dt['kelompok'];

											echo ' <a href='. $dt['file']. ' class="badge badge-pill badge-success" target="_blank"><i class="fa fa-download"></i> Download</a>';
									

										}else{
											echo '<span" class="badge badge-pill badge-danger"><i class="fa fa-times-circle"></i> Belum Ngirim Tugas</span>';
										}


										
									
									?>

								<!-- 	<a href="<?=$s['file'];?>" class="badge badge-pill badge-success"><i class="fa fa-download"></i> Download</a> -->
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

