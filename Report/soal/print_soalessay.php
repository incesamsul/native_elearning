<?php 
   include '../../config/db.php';
        $noe=1;
        $soal= mysqli_query($con,"SELECT * FROM ujian_essay
        INNER JOIN tb_master_mapel ON ujian_essay.id_mapel=tb_master_mapel.id_mapel
        INNER JOIN tb_master_semester ON ujian_essay.id_semester=tb_master_semester.id_semester
        INNER JOIN kelas_ujianessay ON ujian_essay.id_ujianessay=kelas_ujianessay.id_ujianessay WHERE kelas_ujianessay.id_ujianessay='$_GET[ID]'
          ");
             foreach ($soal as $s)
$time = time();
header("Content-Type: application/vnd.msword");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=SOAL_ESSAY-$s[mapel]-$time.doc");

 ?>
<table cellpadding="4">
      <tbody>
          
     

              <table>
                  <tr>
                    <td>SOAL ESSAY </td>
                  </tr>
                   <tr>
                    <td>MATA PELAJARAN</td>
                    <td>:</td>
                    <td><b><?php echo $s['mapel']; ?></b> </td>
                  </tr>
                   <tr>
                    <td>SEMESTER</td>
                    <td>:</td>
                    <td><b><?php echo $s['semester']; ?></b> </td>
                  </tr>
              </table>


          </td>
        </tr>
       
      </tbody>
    </table> 
    <hr>
    <?php echo $s['soal_essay']; ?>