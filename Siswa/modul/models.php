<?php


var_dump($_POST);
if (isset($_POST['porifilUpdate'])) {
	$password = sha1($_POST['password']);

	$gambar = time() . "-" . @$_FILES['foto']['name'];
	if (!empty($_FILES['foto']['name'])) {
		$select = mysqli_query($con, "select foto from tb_siswa where id_siswa='$_POST[ID]'");
		$imagee = mysqli_fetch_array($select);
		unlink('../vendor/images/img_Siswa/' . $imagee['foto']);
		move_uploaded_file($_FILES['foto']['tmp_name'], "../vendor/images/img_Siswa/$gambar");
		$sql = mysqli_query($con, "UPDATE tb_siswa SET nama_siswa='$_POST[nama]',password='$password',foto='$gambar',id_kelas='$_POST[kelas]',id_jurusan='$_POST[jurusan]' WHERE id_siswa='$_POST[ID]' ") or die(mysqli_error($con));
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
			window.location.replace('?page=profil');
			} ,3000);   
		</script>";
		}
	} else {

		$sql = mysqli_query($con, "UPDATE tb_siswa SET nama_siswa='$_POST[nama]',password='$password',id_kelas='$_POST[kelas]',id_jurusan='$_POST[jurusan]' WHERE id_siswa='$_POST[ID]' ") or die(mysqli_error($con));
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
			window.location.replace('?page=profil');
			} ,3000);   
		</script>";
		}
	}
} elseif (isset($_POST['individuUpload'])) {
	$allowed_ext  = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip', 'png', 'jpg', 'mp4', 'avi');
	$file_name    = $_FILES['file']['name'];
	@$file_ext     = strtolower(end(explode('.', $file_name)));
	$file_size    = $_FILES['file']['size'];
	$file_tmp     = $_FILES['file']['tmp_name'];
	$subjek = $_POST['subjek'];
	$nama     = time();
	$date = date('Y-m-d');
	if (in_array($file_ext, $allowed_ext) === true) {
		if ($file_size < 30440700) {
			$lokasi = '../vendor/file/tugas' . 'TUGAS-INDIVIDU_' . $nama . '.' . $file_ext;
			move_uploaded_file($file_tmp, $lokasi);
			$in = mysqli_query($con, "INSERT INTO tugas_siswa VALUES ('NULL','$_POST[id_tugas]','$subjek',$_POST[id_siswa],'','$nama','$file_ext','$file_size','$lokasi','$date','$_POST[ket]')");

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
			window.location.replace('?page=tugas');
			} ,3000);   
		</script>";
			} else {
				echo '<div class="error">ERROR: Gagal upload file!</div>';
			}
		} else {
			echo '<div class="error">ERROR: Besar ukuran file (file size) maksimal 2 Mb!</div>';
		}
	} else {

		echo '<div class="error">ERROR: Tipe file tidak di izinkan!</div>';
	}
} elseif (isset($_POST['kelompokUpload'])) {
	$allowed_ext  = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip', 'png', 'jpg', 'mp4', 'avi');
	$file_name    = $_FILES['file']['name'];
	@$file_ext     = strtolower(end(explode('.', $file_name)));
	$file_size    = $_FILES['file']['size'];
	$file_tmp     = $_FILES['file']['tmp_name'];
	$subjek = $_POST['subjek'];
	$nama     = time();
	$date = date('Y-m-d');
	if (in_array($file_ext, $allowed_ext) === true) {
		if ($file_size < 30440700) {
			$lokasi = '../vendor/file/tugas' . 'TUGAS-KELOMPOK_' . $nama . '.' . $file_ext;
			move_uploaded_file($file_tmp, $lokasi);
			$in = mysqli_query($con, "INSERT INTO tugas_siswa VALUES ('NULL','$_POST[id_tugas]','$subjek',$_POST[id_siswa],'$_POST[anggota]','$nama','$file_ext','$file_size','$lokasi','$date','$_POST[ket]')");

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
			window.location.replace('?page=tugas');
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
} elseif (isset($_POST['saveJawaban'])) {


	// var_dump($_POST);

	$id_pg = [];
	$jawaban_pg = [];
	$id_essay = [];
	$jawaban_essay = [];
	foreach ($_POST as $key => $value) {
		if (explode('_', $key)[0] == 'pg') {
			$id_pg[] = explode('_', $key)[1];
			$jawaban_pg[] = $value;
		} else if (explode('_', $key)[0] == 'essay') {
			$id_essay[] = explode('_', $key)[1];
			$jawaban_essay[] = $value;
		}
	}


	for ($x = 0; $x < count($jawaban_essay); $x++) {

		$s = mysqli_query($con, "INSERT INTO jawaban_essay(id_soal, id_siswa, jawaban) 
		VALUES('$id_essay[$x]', '$_SESSION[id_siswa]', '$jawaban_essay[$x]')") or die(mysqli_error($con));
	}

	for ($x = 0; $x < count($jawaban_pg); $x++) {

		$s = mysqli_query($con, "INSERT INTO jawaban_pg(id_soal, id_siswa, jawaban) 
		VALUES('$id_pg[$x]', '$_SESSION[id_siswa]', '$jawaban_pg[$x]')") or die(mysqli_error($con));
	}


	$s = mysqli_query($con, "INSERT INTO siswa_sudah_mengerjakan(id_ujian,id_siswa) 
		VALUES('$_POST[id_ujian]','$_SESSION[id_siswa]')") or die(mysqli_error($con));

	echo "
			<script>
			window.location='?page=ujian';
			</script>
			
			";
}
