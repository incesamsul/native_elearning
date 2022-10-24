<?php
session_start();
include '../config/db.php';
// memanggil class PHPExcel
include '../assets/PHPExcel/Classes/PHPExcel.php';
include '../assets/PHPExcel/Classes/PHPExcel/IOFactory.php';
if (@$_SESSION['Guru']) {
?>
  <?php
  if (@$_SESSION['Guru']) {
    $sesi = @$_SESSION['Guru'];
  }

  $sql = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
  $data = mysqli_fetch_array($sql);

  // Tampilkan Role Guru
  $roleGuru = mysqli_query($con, "SELECT * FROM tb_roleguru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
  $role = mysqli_fetch_array($roleGuru);

  // Tampilkan Perangkat Pembelajaran
  $sqlPerangkat = mysqli_query($con, "SELECT * FROM tb_perangkat
  INNER JOIN tb_roleguru ON tb_perangkat.id_roleguru=tb_roleguru.id_roleguru
 WHERE tb_roleguru.id_guru='$sesi' ");
  $prkt = mysqli_fetch_array($sqlPerangkat);

  // Tampilkan Materi
  $sqlMateri = mysqli_query($con, "SELECT * FROM tb_materi
  INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_materi.id_roleguru
  WHERE tb_roleguru.id_guru='$sesi' ");
  $materi = mysqli_fetch_array($sqlMateri);
  // data seklah.apl
  $sekolah = mysqli_query($con, "SELECT * FROM tb_sekolah WHERE id_sekolah=1 ");
  $apl = mysqli_fetch_array($sekolah);

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-learning | <?= $data['nama_guru']; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendor/node_modules/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="../vendor/node_modules/font-awesome/css/font-awesome.min.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../vendor/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../vendor/images/favicon.png" />
    <link href="../vendor/sweetalert/sweetalert.css" rel="stylesheet" />
    <script type="text/javascript" src="../vendor/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="../vendor/css/jquery.dataTables.css">
    <style>
      .wrap {
        margin: 10px auto;
        color: #212121;
        /*background: #35a9db;*/
        text-align: justify;
      }

      ::-webkit-scrollbar {
        width: 12px;
        object-position: left;
      }

      ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0, 3);
        background: #666;
      }

      ::-webkit-scrollbar-thumb {
        background: #232323;
      }
    </style>
  </head>

  <body>


    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background-color: #242424;">
          <a class="navbar-brand brand-logo" href="index.php" style="font-family:Aegyptus;font-weight: bold;font-size: 30px;">
            <img src="../vendor/images/<?= $apl['logo']; ?>" alt="logo" style="height: 45px;width: 45px;border-radius: 10px;"> <b><?= $apl['textlogo']; ?></b>
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.php">
            <!-- <img src="../vendor/images/logo.png" alt="logo"/> -->
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">

            <li class="nav-item" style="width: 400px;">
              <a href="#" style="color: #fff;text-decoration: none;">
                <!-- <img src="../vendor/images/smk.png" style="height: 40px;border-radius:10px;"> &nbsp; -->
                <b><?= $apl['nama_sekolah']; ?></b>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right" style="border-top-left-radius:50px;color: black;border-bottom-left-radius:50px;color: #fff; ">
            <?php          // tampilakan notifikasi ujian 
            $ujian = mysqli_query($con, "SELECT * FROM ujian
          INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
          INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis
          INNER JOIN kelas_ujian ON ujian.id_ujian=kelas_ujian.id_ujian
           WHERE ujian.id_guru='$data[id_guru]' AND kelas_ujian.aktif='Y' GROUP BY kelas_ujian.id_ujian    ");
            $jm = mysqli_num_rows($ujian);
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-ring"></i>
                <span class="count"><?= $jm; ?> </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <a class="dropdown-item">
                  <p class="mb-0 font-weight-normal float-left"> Pemberitahuan Ujian Aktif
                  </p>
                  <!-- <span class="badge badge-pill badge-warning float-right">View all</span> -->
                </a>
                <?php
                foreach ($ujian as $uj) { ?>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="?page=ujian&act=status&id=<?= $uj['id_ujian'] ?>">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="fa fa-pencil"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-medium"><?= $uj['mapel'] ?> </h6>
                      <p class="font-weight-light small-text">
                        <?= $uj['jenis_ujian'] ?>
                      </p>
                    </div>
                  </a>
                <?php } ?>



              </div>
            </li>
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link" href="?page=profil">
                <b>My Profile</b>
                <img class="img-xs rounded-circle" src="../vendor/images/img_Guru/<?= $data['foto']; ?>" alt="">
              </a>
            </li>
            <div>
              <li class="nav-item purchase-button ">

                <a href="logout.php" class="btn btn-dark ">Logout</a>

              </li>
            </div>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image"> <img src="../vendor/images/img_Guru/<?= $data['foto']; ?>" alt="image" style="border:3px solid black;" /> <span class="online-status online"></span> </div>
                <div class="profile-name">
                  <p class="name"><?= $data['nama_guru']; ?></p>
                  <p class="designation">Guru</p>
                  <div class="badge badge-teal mx-auto mt-3">Online</div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php"><img class="menu-icon" src="../vendor/images/menu_icons/01.png" alt="menu icon"><span class="menu-title">DASHBOARD</span></a>
            </li>

            <!--   <li class="nav-item">
          	<a class="nav-link" href="?page=profil"><img class="menu-icon" src="../vendor/images/menu_icons/10.png" alt="menu icon"> <span class="menu-title">PROFILE</span></a>
          </li> -->
            <li class="nav-item">
              <a class="nav-link" href="?page=mapel"><img class="menu-icon" src="../vendor/images/menu_icons/02.png" alt="menu icon"> <span class="menu-title">MATA PELAJARAN</span></a>
            </li>


            <!-- Perangkat -->

            <?php
            if (empty($prkt['id_guru'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="?page=perangkat"><img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">PERANGKAT</span></a>
              </li>
            <?php
            } else {
            ?>

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pr" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">PERANGKAT</span><i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pr">
                  <ul class="nav flex-column sub-menu">

                    <?php
                    $menupr = mysqli_query($con, "SELECT * FROM tb_roleguru
          INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
          WHERE tb_roleguru.id_guru='$sesi' GROUP BY tb_roleguru.id_jurusan ");
                    foreach ($menupr as $pr) { ?>
                      <li class="nav-item">
                        <a class="nav-link" href="?page=perangkat&act=view&ID=<?php echo $pr['id_jurusan']; ?>&jurusan=<?php echo $pr['jurusan']; ?>"> <i class="fa fa-file-archive-o"></i>&nbsp; <?php echo $pr['jurusan']; ?></a>
                      </li>
                    <?php } ?>
                    <li class="nav-item">
                      <a class="nav-link" href="?page=perangkat"> <i class="fa fa-file-archive-o"></i>&nbsp; SEMUA PERANGKAT</a>
                    </li>

                  </ul>
                </div>
              </li>

            <?php

            }
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#materi" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">MATERI</span><i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="materi">
                <ul class="nav flex-column sub-menu">
                  <?php
                  $mtri = mysqli_query($con, "SELECT * FROM tb_roleguru
                INNER JOIN tb_master_jurusan ON tb_roleguru.id_jurusan=tb_master_jurusan.id_jurusan
                WHERE tb_roleguru.id_guru='$sesi' GROUP BY tb_roleguru.id_jurusan ");
                  foreach ($mtri as $mt) { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="?page=materi&act=view&ID=<?php echo $mt['id_jurusan']; ?>&jurusan=<?php echo $mt['jurusan']; ?>">
                        <i class="fa fa-file-text">&nbsp;&nbsp;JURUSAN</i> &nbsp;&nbsp; <?= $mt['jurusan']; ?></a>
                    </li>
                  <?php } ?>

                  <li class="nav-item">
                    <a class="nav-link" href="?page=materi">
                      <i class="fa fa-file-text"></i> &nbsp;&nbsp;SEMUA MATERI</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#tugas" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">TUGAS SISWA</span><i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="tugas">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="?page=tugas"><i class="fa fa-gear"></i> &nbsp;&nbsp; ATUR TUGAS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=tugas&act=view"><i class="fa fa-pencil"></i> &nbsp;&nbsp; DATA TUGAS</a>
                  </li>
            </li>
          </ul>
      </div>
      </li>






      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#evaluasi" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">UJIAN KUIS</span><i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="evaluasi">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="?page=ujian"><img class="menu-icon" src="../vendor/images/menu_icons/06.png" alt="menu icon"> <span class="menu-title">UJIAN</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=nilai"><img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">NILAI</span></a>
            </li>
      </li>
      </ul>
    </div>
    </li>
    <hr>
    </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">

      <!-- Konten -->
      <?php
      error_reporting();
      $page = @$_GET['page'];
      $act = @$_GET['act'];
      if ($page == 'perangkat') {
        if ($act == '') {
          include 'modul/perangkat/data_perangkat.php';
        } elseif ($act == 'add') {
          include 'modul/perangkat/add_perangkat.php';
        } elseif ($act == 'edit') {
          include 'modul/perangkat/edit_perangkat.php';
        } elseif ($act == 'del') {
          include 'modul/perangkat/del_perangkat.php';
        } elseif ($act == 'view') {
          include 'modul/perangkat/view.php';
        }
      } elseif ($page == 'mapel') {
        if ($act == '') {
          include 'modul/role/data_role.php';
        } elseif ($act == 'add') {
          include 'modul/role/add_role.php';
        } elseif ($act == 'edit') {
          include 'modul/role/edit_role.php';
        } elseif ($act == 'del') {
          include 'modul/role/del_role.php';
        }
      } elseif ($page == 'materi') {
        if ($act == '') {
          include 'modul/materi/data_materi.php';
        } elseif ($act == 'add') {
          include 'modul/materi/add_materi.php';
        } elseif ($act == 'edit') {
          include 'modul/materi/edit_materi.php';
        } elseif ($act == 'del') {
          include 'modul/materi/del_materi.php';
        } elseif ($act == 'view') {
          include 'modul/materi/view_materi.php';
        } elseif ($act == 'activate') {
          include 'modul/materi/activate.php';
        }
      } elseif ($page == 'ujian') {
        if ($act == '') {
          include 'modul/ujian/data_ujian.php';
        } elseif ($act == 'add') {
          include 'modul/ujian/add_ujian.php';
        } elseif ($act == 'addkelas') {
          include 'modul/ujian/add_kelas.php';
        } elseif ($act == 'soal') {
          include 'modul/ujian/soal.php';
        } elseif ($act == 'soaladd') {
          include 'modul/ujian/add_soal.php';
        } elseif ($act == 'soaledit') {
          include 'modul/ujian/edit_soal.php';
        } elseif ($act == 'soaldel') {
          include 'modul/ujian/del_soal.php';
        } elseif ($act == 'upSoal') {
          include 'modul/ujian/upload.php';
        } elseif ($act == 'addessay') {
          include 'modul/ujian/add_essay.php';
        } elseif ($act == 'active') {
          include 'modul/ujian/active.php';
        } elseif ($act == 'close') {
          include 'modul/ujian/close.php';
        } elseif ($act == 'ujianedit') {
          include 'modul/ujian/ujian_edit.php';
        } elseif ($act == 'ujiandel') {
          include 'modul/ujian/ujian_del.php';
        } elseif ($act == 'aktifessay') {
          include 'modul/ujian/active_essay.php';
        } elseif ($act == 'closeessay') {
          include 'modul/ujian/close_essay.php';
        } elseif ($act == 'editessay') {
          include 'modul/ujian/edit_essay.php';
        } elseif ($act == 'delessay') {
          include 'modul/ujian/del_essay.php';
        } elseif ($act == 'status') {
          include 'modul/ujian/view_statusujian.php';
        } elseif ($act == 'delkelas') {
          include 'modul/ujian/del_kelasujian.php';
        } elseif ($act == 'addkelasujian') {
          include 'modul/ujian/add_kelasujian.php';
        } elseif ($act == 'addkelasujiane') {
          include 'modul/ujian/essay/add_kelasujian.php';
        } elseif ($act == 'delkelase') {
          include 'modul/ujian/essay/del_kelasujian.php';
        }
      } elseif ($page == 'nilai') {
        if ($act == '') {
          include 'modul/nilai/data_nilai.php';
        } elseif ($act == 'view') {
          include 'modul/nilai/view_nilaikelas.php';
        }
      } elseif ($page == 'profil') {
        if ($act == '') {
          include 'modul/profil/data_profil.php';
        }
      } elseif ($page == 'chat') {
        if ($act == 'del') {
          include 'modul/chat/del.php';
        }
      } elseif ($page == 'tugas') {
        if ($act == '') {
          include 'modul/tugas/v_tugas.php';
        } elseif ($act == 'add') {
          include 'modul/tugas/add_tugas.php';
        } elseif ($act == 'addkelastugas') {
          include 'modul/tugas/add_kelastugas.php';
        } elseif ($act == 'delkelas') {
          include 'modul/tugas/del_kelastugas.php';
        } elseif ($act == 'close') {
          include 'modul/tugas/close.php';
        } elseif ($act == 'active') {
          include 'modul/tugas/active.php';
        } elseif ($act == 'edit') {
          include 'modul/tugas/edit_tugas.php';
        } elseif ($act == 'del') {
          include 'modul/tugas/del_tugas.php';
        } elseif ($act == 'view') {
          include 'modul/tugas/data_tugas.php';
        } elseif ($act == 'viewkelas') {
          include 'modul/tugas/view_tugaskelas.php';
        }
      } elseif ($page == 'proses') {
        include 'modul/models.php';
      } elseif ($page == 'berinilai') {
        include 'modul/berinilai/index.php';
      } elseif ($page == '') {
        include 'Home.php';
      } else {
        echo "<b>4014!</b> Tidak ada halaman !";
      }

      ?>
      <!-- End-kontent -->

      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      <footer class="footer">
        <div class="container-fluid clearfix">
          <span class="text-info d-block text-center text-sm-left d-sm-inline-block"><?= $apl['copyright']; ?></span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?= $apl['nama_sekolah']; ?> <i class="fa fa-graduation-cap text-danger"></i></span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../vendor/js/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->


    <script src="../vendor/js/jquery.dataTables.js"></script>
    <script src="../vendor/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendor/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendor/sweetalert/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../vendor/js/off-canvas.js"></script>
    <script src="../vendor/js/misc.js"></script>
    <script src="../vendor/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->




    <script>
      CKEDITOR.replace('ckeditor', {
        filebrowserImageBrowseUrl: '../vendor/kcfinder',

        // uiColor:'#1991eb'
      });
      CKEDITOR.replace('ckeditor1', {

        filebrowserImageBrowseUrl: '../vendor/kcfinder',
        // uiColor:'#1991eb'
      });
      CKEDITOR.replace('ckeditor2', {

        filebrowserImageBrowseUrl: '../vendor/kcfinder',
        // uiColor:'#1991eb'
      });
      CKEDITOR.replace('ckeditor3', {

        filebrowserImageBrowseUrl: '../vendor/kcfinder',
        // uiColor:'#1991eb'
      });
      CKEDITOR.replace('ckeditor4', {

        filebrowserImageBrowseUrl: '../vendor/kcfinder',
        // uiColor:'#1991eb'
      });
      CKEDITOR.replace('ckeditor5', {

        filebrowserImageBrowseUrl: '../vendor/kcfinder',
        // uiColor:'#1991eb'
      });
      CKEDITOR.replace('ckeditor6', {

        filebrowserImageBrowseUrl: '../vendor/kcfinder',
        // uiColor:'#1991eb'
      });
    </script>
    <script>
      $(document).ready(function() {
        $('#data').DataTable();
      });
    </script>







  </body>

  </html>


<?php
} else {

  include 'modul/500.html';

  // echo "<script>
  // window.location='../index.php';</script>";

}
