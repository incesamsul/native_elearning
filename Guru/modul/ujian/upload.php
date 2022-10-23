     <?php
  // load excel
  $file = $_FILES['excel']['tmp_name'];
  $load = PHPExcel_IOFactory::load($file);
  $sheets = $load->getActiveSheet()->toArray(null,true,true,true,true,true,true,true);

  $i = 1;
  foreach ($sheets as $sheet) {

    // karena data yang di excel di mulai dari baris ke 2
    // maka jika $i lebih dari 1 data akan di masukan ke database
    if ($i > 2) {
       mysqli_query($con,"INSERT INTO soal VALUES (NULL,'$_POST[ujian]','$sheet[B]','$sheet[C]','$sheet[D]','$sheet[E]','$sheet[F]','$sheet[G]','$sheet[H]','Y') ");
    }

    $i++;
  }

  if($i >= 2) {
    // pesan jika data berhasil di input
    $total = $i-3;
    echo "<h1><script>
alert(' ($total) Soal Berhasil di Import Ke Database !');
  window.location='?page=ujian&act=soal&id=$_POST[ujian]'
</script></h1>";

  }


