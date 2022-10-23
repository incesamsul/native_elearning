<!DOCTYPE html>
<html>
<head>
	<style>
		body{
			font-family: arial;
			font-size: 14px;
		}
	</style>
</head>
<body>

             <?php 
             include '../../config/db.php';
            // cek tabel tugas
            $kelas = mysqli_query($con,"SELECT * FROM kelas_tugas WHERE id_kelas='$_GET[kelas]' AND id_jurusan='$_GET[jurusan]' AND id_tugas='$_GET[tugas]' AND aktif='Y' ");
             $jumlah = mysqli_num_rows($kelas);
           
            foreach ($kelas as $d) { ?>
           <?php 

               if ($jumlah<0) {
               echo "tidak ada tugas untuk kamu !";
              }else{
                // tampilkan jika ada tugas
                ?>
                <?php 
                // tampilkan dat ujian
                $ujian = mysqli_query($con,"SELECT *,DATE_ADD(tanggal,INTERVAL waktu DAY)AS jatuh_tempo
 ,DATEDIFF(DATE_ADD(tanggal,INTERVAL waktu DAY),CURDATE()) AS selisih FROM tb_tugas
 INNER JOIN tb_jenistugas ON tb_tugas.id_jenistugas=tb_jenistugas.id_jenistugas
 INNER JOIN tb_guru ON tb_tugas.id_guru=tb_guru.id_guru
  INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
   INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
   WHERE tb_tugas.id_tugas='$d[id_tugas]' ORDER BY tb_tugas.id_tugas DESC ");
   foreach ($ujian as $t) { ?>
                    <!-- TUGAS <strong><?=$t['mapel'] ?> </strong> -->
                    <p>
                      <p>
                        OLEH : <b><?=$t['nama_guru'] ?></b>
                      </p>

                      <table widtd="40%" style="font-weight: bold;" cellpadding="4">
                        <tr>
                          <td>Jenis Tugas</td>
                          <td>:</td>
                          <td> <?=$t['jenis_tugas'] ?></td>
                        </tr>
                        <tr>
                          <td>Tanggal Posting</td>
                          <td>:</td>
                          <td> <?= date('d-F-Y',strtotime($t['tanggal'])) ?> </td>
                        </tr>
                          <tr>
                          <td>Tanggal Pengumpulan Tugas</td>
                          <td>:</td>
                          <td> <?= date('d-F-Y',strtotime($t['jatuh_tempo'])) ?></td>
                        </tr>
                          <tr>
                          <td>Sisa Waktu</td>
                          <td>:</td>
                          <td> <?=$t['selisih'] ?> Hari Lagi </td>
                        </tr>
                        <tr>
                         <td>Mata Pelaran</td>
                          <td>:</td>
                          <td> <?=$t['mapel'] ?></td>
                        </tr>
                        <tr>
                         <td>Semester</td>
                          <td>:</td>
                          <td> <?=$t['semester'] ?></td>
                        </tr>
                      </table>

                     </p>
                     <hr>
                     <p>INTRUKSI TUGAS</p>
                     <p><?php echo $t['isi_tugas']?></p>
                  </div>
                </div> 
              <?php } ?>

                <?php


                
              }

            ?>           
         

            <?php } ?>
              
 
<script>
	window.print();
</script>
	
</body>
</html>