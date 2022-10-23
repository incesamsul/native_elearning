<?php 
$intriksi = mysqli_query($con,"SELECT * FROM tb_tugas WHERE id_tugas='$_GET[tugas]' ");
foreach ($intriksi as $d)?>
<div class="content-wrapper">
	<h4> <b>TUGAS</b> <small class="text-muted">/<?php echo $_GET['jenis']; ?></small>
	</h4>
	<hr>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title" style="font-weight: bold;">
						<br>						
						</h6> 
						<table class="table">
							<tr>
								<th>JENIS TUGAS</th>
								<th>:</th>
								<th><?php echo $_GET['jenis']; ?> </th>
							</tr>
							<tr>
								<th>JUDUL TUGAS</th>
								<th>:</th>
								<th><?php echo $d['judul_tugas']; ?></th>
							</tr>
						</table>
						<p></p>
					<div class="alert alert-success alert-dismissible" role="alert">
						<b>INTRUKSI TUGAS</b>
						<p>
							<?php echo $d['isi_tugas']; ?>
						</p>
					</div>
				<?php 
				if ($_GET['id']==1) {
				echo "<h5>FORM UPLOAD TUGAS</h5> ";
				?>
				<p></p>
				<form action="?page=proses" method="post" enctype="multipart/form-data">
					<input name="id_siswa" type="hidden" value="<?php echo $_SESSION['Siswa'] ?>">
					<input name="id_tugas" type="hidden" value="<?php echo $_GET['tugas'] ?>">
					<div class="form-group">
						<label for="subjek">Subjek Tugas *</label>
						<textarea name="subjek" class="form-control" rows="4"> Subjek</textarea>			
					</div>
					<div class="form-group">
						<label for="subjek">Upload File Tugas *</label> <br>
						<input type="file" name="file">
					</div>
				<div class="form-group">
					<p class="text-danger">Harap Centang <b>Selesai</b> Untuk Memberitahu Guru Kamu ! </p>
	                <div class="form-radio form-radio-flat">
	                <label class="form-check-label" for="Y">
	                <input type="radio" class="form-check-input" name="ket" id="Y" value="Selesai">
	                Selesai
	                </label>
	                </div>
	              </div>

                <hr>

                <button type="submit" name="individuUpload" class="btn btn-info mr-2">Upload</button>
                <a href="?page=tugas" class="btn btn-danger">Batal</a>
					
				</form>
				<?php

				}else{
					echo "<h5>FORM UPLOAD TUGAS KELOMPOK</h5> ";
				?>
				<p></p>
				<form action="?page=proses" method="post" enctype="multipart/form-data">
					<input name="id_siswa" type="hidden" value="<?php echo $_SESSION['Siswa'] ?>">
					<input name="id_tugas" type="hidden" value="<?php echo $_GET['tugas'] ?>">
					<div class="form-group">
						<label for="subjek">Subjek Tugas *</label>
						<textarea name="subjek" class="form-control" rows="4"> Subjek</textarea>			
					</div>
					<div class="form-group">
						<label for="subjek">Anggota Kelompok*</label>
							<hr>
							<textarea name="anggota" id="ckeditor" rows="10">
								<center>ANGGOTA KELOMPOK</center>
							<?php
								$jumlah= $d['jml_anggota'];
								for ($i=1; $i <=$jumlah ; $i++) { ?>
								<?php echo $i; ?>.<br />
									
								<?php } ?>
						</table>

					
						</textarea>
						<!-- 	<table class="table">
							<tr>
								<th>NO.</th>
								<th>NAMA ANGGOTA</th>
							</tr>
								<?php
								$jumlah= $d['jml_anggota'];
								for ($i=1; $i <=$jumlah ; $i++) { ?>
								<tr>
									<td width="10"><?php echo $i; ?>.</td>
									<td>
										<select name="anggota" class="form-control" style="font-weight: bold;">
										<?php 
										// tampilkan teman sekelas
										$sekelas = mysqli_query($con,"SELECT * FROM tb_siswa WHERE id_kelas='$_SESSION[kelas]' AND id_jurusan='$_SESSION[jurusan]' ");
										foreach ($sekelas as $s) {
											echo "<option value='$s[nis]-$s[nama_siswa]'>NIS ($s[nis]) - $s[nama_siswa]</option>";
										}
										 ?>
										</select>

									</td>
								</tr>
								<?php } ?>
						
						</table> -->
					</div>
					<div class="form-group">
						<label for="subjek">Upload File Tugas *</label> <br>
						<input type="file" name="file">
					</div>
				<div class="form-group">
					<p class="text-danger">Harap Centang <b>Selesai</b> Untuk Memberitahu Guru Kamu ! </p>
	                <div class="form-radio form-radio-flat">
	                <label class="form-check-label" for="Y">
	                <input type="radio" class="form-check-input" name="ket" id="Y" value="Selesai">
	                Selesai
	                </label>
	                </div>
	              </div>

                <hr>

                <button type="submit" name="kelompokUpload" class="btn btn-info mr-2">Upload</button>
                <a href="?page=tugas" class="btn btn-danger">Batal</a>
					
				</form>
				<?php






				}

				?>

				</div>
			</div>
		</div>
	</div>
</div>
