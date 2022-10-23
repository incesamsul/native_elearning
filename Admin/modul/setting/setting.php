<?php 
// data sekolah/apl
$sql = mysqli_query($con,"SELECT * FROM tb_sekolah WHERE id_sekolah=1 ");
foreach ($sql as $d) ?>
<div class="content-wrapper">
  <h4> <b>Aplikasi</b> <small class="text-muted">/Setting</small>
  </h4>
  <hr>
  <div class="row">

    <div class="col-md-10">
    <div class="col-md-12 ml-5" >
        <div class="card">
          <div class="card-body">

            <form action="?page=proses" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $d['id_sekolah'] ?>">
              <div class="form-group">
                <label for="logo">Logo</label>
                <p>
                  <img src="../vendor/images/<?php echo $d['logo'] ?>" class="img-thumbnail" style="height: 70px;width: 70px;">
                </p>
                <input type="file" id="logo" name="logo"> 
                <p class="text-danger">
                  Ukuran Logo maxsimal <em><b>54 x 45</b></em> pixel
                </p>    
                 <label for="textlogo">Text Logo</label>
                <input type="text" name="textlogo" id="textlogo" class="form-control" value="<?php echo $d['textlogo']; ?>">         
              </div>
              <div class="form-group">
                <label for="nama">Nama Sekolah</label>
                <input type="text" id="nama" name="nmsekolah" class="form-control" value="<?php echo $d['nama_sekolah']; ?>">
              </div>
               <div class="form-group">
                <label for="kepsek">Nama Kepala Sekolah</label>
                <input type="text" id="kepsek" name="kepsek" class="form-control" value="<?php echo $d['kepsek']; ?>">
              </div>
                <div class="form-group">
                <label for="copyright">Copyright</label>
                <input type="text" id="copyright" name="copyright" class="form-control" value="<?php echo $d['copyright']; ?>">
              </div>
                  <div class="form-group">
                <button type="submit" name="set" class="btn btn-light">
                  <i class="fa fa-pencil"></i> Update                  
                </button>
              </div>
            </form>
         
         </div>
      </div>                  
    </div>
  </div>
</div>
