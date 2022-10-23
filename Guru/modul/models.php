<?php
include '../config/db.php';
//fungsi untuk mengkonversi size file
function formatBytes($bytes, $precision = 2)
{
	$units = array('B', 'KB', 'MB', 'GB', 'TB');

	$bytes = max($bytes, 0);
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	$pow = min($pow, count($units) - 1);

	$bytes /= pow(1024, $pow);

	return round($bytes, $precision) . ' ' . $units[$pow];
}

if (isset($_POST['mapelSave'])) {
	$sql = mysqli_query($con, "INSERT INTO tb_roleguru VALUES (NULL,'$_POST[id_guru]','$_POST[kelas]','$_POST[mapel]','$_POST[semester]','$_POST[jurusan]') ") or die(mysqli_error($con));
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Tersimpan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=mapel');
			} ,3000);   
		</script>";
	}
} elseif (isset($_POST['mapelUpdate'])) {

	$sql = mysqli_query($con, "UPDATE tb_roleguru SET id_kelas='$_POST[kelas]',id_mapel='$_POST[mapel]',id_semester='$_POST[semester]',id_jurusan='$_POST[jurusan]' WHERE id_roleguru='$_POST[ID]' ") or die(mysqli_error($con));
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Telah Diubah !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=mapel');
			} ,3000);   
		</script>";
	}
}
// end MAPEL

// Perangkat
elseif (isset($_POST['perangkatUpload'])) {


	$allowed_ext  = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip');

	$file_name    = $_FILES['file']['name'];
	@$file_ext     = strtolower(end(explode('.', $file_name)));
	$file_size    = $_FILES['file']['size'];
	$file_tmp     = $_FILES['file']['tmp_name'];

	$judul = $_POST['judul'];

	$nama     = time();
	$date = date('Y-m-d');



	if (in_array($file_ext, $allowed_ext) === true) {
		if ($file_size < 30440700) {
			$lokasi = '../vendor/file/' . 'PERANGKAT_' . $nama . '.' . $file_ext;
			move_uploaded_file($file_tmp, $lokasi);


			$in = mysqli_query($con, "INSERT INTO tb_perangkat VALUES(NULL,'$_POST[judul]','$nama','$file_ext', '$file_size', '$lokasi','$_POST[isi_perangkat]','$_POST[id_jenis]','$date','1','$_POST[id_roleguru]')");

			if ($in) {

				echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Tersimpan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=perangkat');
			} ,3000);   
		</script>";
			} else {
				echo '<div class="error">ERROR: Gagal upload file!</div>';
			}
		} else {
			echo '<div class="error">ERROR: Besar ukuran file (file size) maksimal 1 Mb!</div>';
		}
	} else {

		echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
	}
} elseif (isset($_POST['perangkatSave'])) {
	$nama = time();

	$date = date('Y-m-d');
	$sql = mysqli_query($con, "INSERT INTO tb_perangkat VALUES (NULL,'$_POST[judul]','$nama','text','File','--','$_POST[isi_perangkat]','$_POST[id_jenis]','$date','1','$_POST[id_roleguru]') ") or die(mysqli_error($con));
	if ($sql) {

		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Tersimpan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=perangkat');
			} ,3000);   
		</script>";
	}
} elseif (isset($_POST['perangkatUpdate'])) {
	$date = date('Y-m-d');

	$sql = mysqli_query($con, "UPDATE tb_perangkat SET judul='$_POST[judul]', isi_perangkat='$_POST[isi_perangkat]',id_jenisperangkat='$_POST[id_jenis]',id_kelas='$_POST[id_kelas]',id_mapel='$_POST[id_mapel]',id_semester='$_POST[id_semester]',id_jurusan='$_POST[id_jurusan]' WHERE id_perangkat='$_POST[ID]' ") or die(mysqli_error($con));
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Telah Diubah !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=perangkat');
			} ,3000);   
		</script>";
	}
	// materi tambah
} elseif (isset($_POST['materiSave'])) {
	$date = date('Y-m-d');
	$nama = time();

	$sql = mysqli_query($con, "INSERT INTO tb_materi VALUES (NULL,'$_POST[judul]','$_POST[materi]','$nama','text','0','--','$date','$_POST[id_roleguru]','Y') ") or die(mysqli_error($con));
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Tersimpan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=materi');
			} ,3000);   
		</script>";
	}
}
// materi upload file
// Perangkat
elseif (isset($_POST['materiFile'])) {


	$allowed_ext  = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip', 'png', 'jpg', 'mp4', 'avi');

	$file_name    = $_FILES['file']['name'];
	@$file_ext     = strtolower(end(explode('.', $file_name)));
	$file_size    = $_FILES['file']['size'];
	$file_tmp     = $_FILES['file']['tmp_name'];

	$judul = $_POST['judul'];

	$nama     = time();
	$date = date('Y-m-d');



	if (in_array($file_ext, $allowed_ext) === true) {
		if ($file_size < 304407000) {
			$lokasi = '../vendor/file/' . 'PERANGKAT_' . $nama . '.' . $file_ext;
			move_uploaded_file($file_tmp, $lokasi);


			$in = mysqli_query($con, "INSERT INTO tb_materi VALUES (NULL,'$_POST[judul]','$_POST[materi]','$nama','$file_ext','$file_size','$lokasi','$date','$_POST[id_roleguru]','Y')");

			if ($in) {

				echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Tersimpan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=materi');
			} ,3000);   
		</script>";
			} else {
				echo '<div class="error">ERROR: Gagal upload file!</div>';
			}
		} else {
			echo '<div class="error">ERROR: Besar ukuran file (file size) maksimal 1 Mb!</div>';
		}
	} else {

		echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
	}
} elseif (isset($_POST['materiUpdate'])) {

	$sql = mysqli_query($con, "UPDATE tb_materi SET judul_materi='$_POST[judul]',materi='$_POST[materi]',id_roleguru='$_POST[id_roleguru]' WHERE id_materi='$_POST[ID]' ") or die(mysqli_error($con));
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Telah Diubah !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=materi');
			} ,3000);   
		</script>";
	}
} elseif (isset($_POST['porifilUpdate'])) {
	$password = sha1($_POST['password']);

	$gambar = time() . "-" . @$_FILES['foto']['name'];
	if (!empty($_FILES['foto']['name'])) {
		$select = mysqli_query($con, "select foto from tb_guru where id_guru='$_POST[ID]'");
		$imagee = mysqli_fetch_array($select);
		unlink('../vendor/images/img_Guru/' . $imagee['foto']);
		move_uploaded_file($_FILES['foto']['tmp_name'], "../vendor/images/img_Guru/$gambar");
		$sql = mysqli_query($con, "UPDATE tb_guru SET nama_guru='$_POST[nama]',email='$_POST[email]',password='$password',foto='$gambar' WHERE id_guru='$_POST[ID]' ") or die(mysqli_error($con));
		if ($sql) {
			echo "
			<script type='text/javascript'>
			alert('Profil di perbarui');
			window.location.replace('?page=profil');
		</script>";
		}
	} else {
		$sqll = mysqli_query($con, "UPDATE tb_guru SET nama_guru='$_POST[nama]',email='$_POST[email]',password='$password' WHERE id_guru='$_POST[ID]' ") or die(mysqli_error($con));
		if ($sqll) {
			echo "
			<script type='text/javascript'>
			alert('Profil di perbarui');
			window.location.replace('?page=profil');
		</script>";
		}
	}
}


// simpan ujian
elseif (isset($_POST['ujianSave'])) {
	$sql = mysqli_query($con, "INSERT INTO ujian VALUES(NULL,'$_POST[judul]','$_POST[tgl]','$_POST[jam]:$_POST[menit]:00','$_POST[jumlah]','$_POST[acak]','0','$_POST[id_jenis]','$_POST[id_guru]','$_POST[id_mapel]','$_POST[id_semester]' ) ");
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Ditambahkan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=ujian');
			} ,3000);   
		</script>";
	}
}
// Update ujian
elseif (isset($_POST['ujianEdit'])) {
	$sql = mysqli_query($con, "UPDATE ujian SET judul='$_POST[judul]',tanggal='$_POST[tgl]',waktu='$_POST[waktu]',jml_soal='$_POST[jumlah]',acak='$_POST[acak]',tipe='0',id_jenis='$_POST[id_jenis]',id_mapel='$_POST[id_mapel]',id_semester='$_POST[id_semester]' WHERE id_ujian='$_POST[id]' ");

	if ($sql) {

		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Telah Diubah !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=ujian');
			} ,3000);   
		</script>";
	}
}
// simapn kelas ujian
elseif (isset($_POST['kelasujianSave'])) {

	$kls = $_POST['kelas'];
	$jrs = $_POST['jurusan'];
	$jumlahTerpilih	= count($kls);
	for ($x = 0; $x < $jumlahTerpilih; $x++) {

		$s = mysqli_query($con, "INSERT INTO kelas_ujian(id_ujian,id_kelas,id_jurusan,aktif) 

		VALUES('$_POST[id]','$kls[$x]','$jrs[$x]','Y')") or die(mysqli_error($con));
		if ($s) {
			echo "
			<script>
			window.location='?page=ujian';
			</script>
			
			";
		}
	}
}
// simpan kelas ujian essay

elseif (isset($_POST['kelasujianEssaySave'])) {

	$kls = $_POST['kelas'];
	$jrs = $_POST['jurusan'];
	$jumlahTerpilih	= count($kls);
	for ($x = 0; $x < $jumlahTerpilih; $x++) {

		$s = mysqli_query($con, "INSERT INTO kelas_ujianessay(id_ujianessay,id_kelas,id_jurusan,aktif) 

		VALUES('$_POST[id]','$kls[$x]','$jrs[$x]','Y')") or die(mysqli_error($con));
		if ($s) {
			echo "
			<script>
			window.location='?page=ujian';
			</script>
			
			";
		}
	}
}

// simapn soal objektif
elseif (isset($_POST['objektifSave'])) {

	$sql = mysqli_query($con, "INSERT INTO soal(id_ujian, soal, pilihan_1, pilihan_2, pilihan_3, pilihan_4, pilihan_5, kunci)
VALUES('$_POST[id]', '$_POST[soal]', '$_POST[p1]', '$_POST[p2]', '$_POST[p3]', '$_POST[p4]', '$_POST[p5]', '$_POST[kunci]')");

	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Ditambahkan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=ujian');
			} ,3000);   
		</script>";
	}
}
// simapn soal essay
elseif (isset($_POST['saveSoalEssay'])) {

	$sql = mysqli_query($con, "INSERT INTO soal_essay(id_ujian, soal)
	VALUES('$_POST[id]', '$_POST[soal]')");

	if ($sql) {
		echo "
				<script type='text/javascript'>
				setTimeout(function () {
				swal({
				title: 'Sukses',
				text:  'Data Ditambahkan !',
				type: 'success',
				timer: 3000,
				showConfirmButton: true
				});     
				},10);  
				window.setTimeout(function(){ 
				window.location.replace('?page=ujian');
				} ,3000);   
			</script>";
	}
} elseif (isset($_POST['objektifEdit'])) {

	$sql = mysqli_query($con, "UPDATE soal SET soal='$_POST[soal]', pilihan_1='$_POST[p1]', pilihan_2='$_POST[p2]', pilihan_3='$_POST[p3]', pilihan_4='$_POST[p4]', pilihan_5='$_POST[p5]', kunci='$_POST[kunci]' WHERE id_soal='$_POST[ids]' ");

	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Data Telah Diubah !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=ujian&act=soal&id=$_POST[id]');
			} ,3000);   
		</script>";
	}
} elseif (isset($_POST['essaySave'])) {

	$sql = mysqli_query($con, "INSERT INTO ujian_essay VALUES(NULL,'$_POST[judul]','$_POST[tgl]','$_POST[jumlah]','$_POST[essay]','$_POST[id_jenis]','$_POST[id_guru]','$_POST[id_mapel]','$_POST[id_semester]')");
	if ($sql) {

		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Ujian Telah Ditambahkan !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=ujian');
			} ,3000);   
		</script>";
	}
} elseif (isset($_POST['essayEdit'])) {


	$sql = mysqli_query($con, "UPDATE soal_essay SET
  	 soal='$_POST[soal]' WHERE id_ujian='$_POST[id]' ");
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Ujian Telah Diubah !',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=ujian');
			} ,3000);   
		</script>";
	}
}
// simpan tugas
elseif (isset($_POST['tugasSave'])) {

	$sql = mysqli_query($con, "INSERT INTO tb_tugas VALUES(NULL,'$_POST[id_jenis]','$_POST[judul]','$_POST[isi_tugas]','$_POST[tgl]','$_POST[waktu]','$_POST[jumlahanggota]','$_POST[id_guru]','$_POST[id_mapel]','$_POST[id_semester]' ) ");
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Tugas Ditambahkan!',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=tugas');
			} ,3000);   
		</script>";
	}
}
// edit tugas
elseif (isset($_POST['tugasEdit'])) {
	$sql = mysqli_query($con, "UPDATE tb_tugas SET id_jenistugas='$_POST[id_jenis]',judul_tugas='$_POST[judul]',isi_tugas='$_POST[isi_tugas]',tanggal='$_POST[tgl]',waktu='$_POST[waktu]',id_mapel='$_POST[id_mapel]',id_semester='$_POST[id_semester]' WHERE id_tugas='$_POST[ID]' ");
	if ($sql) {
		echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'Sukses',
			text:  'Tugas Diubah!',
			type: 'success',
			timer: 3000,
			showConfirmButton: true
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=tugas');
			} ,3000);   
		</script>";
	}
}
// simapn kelas Tugas
elseif (isset($_POST['kelastugasSave'])) {

	$kls = $_POST['kelas'];
	$jrs = $_POST['jurusan'];
	$jumlahTerpilih	= count($kls);
	for ($x = 0; $x < $jumlahTerpilih; $x++) {

		$s = mysqli_query($con, "INSERT INTO kelas_tugas(id_tugas,id_kelas,id_jurusan,aktif) 

		VALUES('$_POST[id]','$kls[$x]','$jrs[$x]','Y')") or die(mysqli_error($con));
		if ($s) {
			echo "
			<script>
			window.location='?page=tugas';
			</script>
			
			";
		}
	}
}
