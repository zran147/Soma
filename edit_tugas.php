<?php include("config.php"); 
	$id_tugas = $_GET['id_tugas'];
	$ambildata =pg_query("SELECT * from tugas where id_tugas = '$id_tugas'");
  $hasil = pg_fetch_array($ambildata);

  
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <title>SOMA | Tugas</title>
</head>

<body>
  <form action="prosestugas.php" method="POST">
    <section class="container">
      <h4>Tugas</h4>
      
      </p>
      <label for="nama_tugas">Nama Tugas</label><br>
      <textarea name="nama_tugas" id="nama_tugas" cols="30" rows="3" placeholder="Masukkan Keterangan" required> <?php echo $hasil['nama_tugas'] ?></textarea><br>
        <label for="mata_kuliah">Mata Kuliah</label><br>
        <select name="mata_kuliah" id="mata_kuliah" required>
          <option value=""> -- Pilih --</option>
          <option value="ALINKOM">ALINKOM</option>
          <option value="ALPROG">ALPROG</option>
          <option value="BASDAT">BASDAT</option>
          <option value="PMK">PMK</option>
          <option value="RADIG">RADIG</option>
          <option value="STRUKDIS">STRUKDIS</option>
          <option value="TP">TP</option>
        </select> 
      <div class="row">
        <div class="col-lg-7">
          <div class="form-group"><br>
            <form>
              <label for="deadline">Deadline</label>
              <div class="col-sm-4">
                <div class="input-group date" id="datepicker">
                  <input type="text" class="form-control" name="deadline" placeholder="Deadline" reuqired value="<?php echo $hasil['deadline'] ?>">
                  <span class="input-group-append">
                    <span class="input-group-text bg-white d-block">
                      <i class="fa fa-calendar"></i>
                    </span>
                  </span>
                </div>
              </div>
          </div>
  </form>
  <script type="text/javascript">
    $(function() {
      $('#datepicker').datepicker();
    });
  </script>
  <br>
  <p>
    <label for="link_pengumpulan">Link Pengumpulan</label><br>
    <input type="text" name="link_pengumpulan" placeholder="Link Pengumpulan" required value="<?php echo $hasil['link_pengumpulan'] ?>">

    <br><br>
    <input type="submit" value="submit" name="submit" />
  </p>
  </section>
  </form>

</body>

</html>
<?php if (isset($_GET['status'])): ?>
  <p>
    <?php
    if ($_GET['status'] == 'gagal') {
      echo "proses gagal!";
    } 
    ?>
  </p>
<?php endif; ?>



