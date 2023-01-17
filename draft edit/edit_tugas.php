<?php include("config.php"); 
	$id_pemasukan = $_GET['id_pemasukan'];
	$ambildata =pg_query("SELECT * from pemasukan where id_pemasukan = '$id_pemasukan'");
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
  <title>SOMA | Pemasukan</title>
</head>

<body>
  <form action="<?php "proses-edit-pemasukan.php=".$_GET['id_pemasukan'] ?>" method="POST">
  <section class="container">
    <h4>Pemasukan</h4>

      <label for="pemasukan">Kategori Pemasukan</label>
      <br>
      <select name="kategori_pemasukan" id="kategori_pemasukan">
        <option value=""> ---- Pilih ----</option>
        <option value="uang_bulanan">Uang Bulanan</option>
        <option value="penghasilan">Penghasilan</option>
        <option value="lainnya">Lainnya</option>
      </select>
      <br>
      <!-- <label for="tanggal_pemasukan">Tanggal Pemasukan</label>
      <input type="date" name="tanggal_pemasukkan"> -->
      <div class="row">
        <div class="col-lg-7">
          <div class="form-group"><br>
            <form>
              <label for="tanggal_pemasukan">Tanggal Pemasukan</label>
              <div class="col-sm-4">
                <div class="input-group date" id="datepicker">
                  <input type="text" class="form-control" name="tanggal_pemasukan" placeholder="Tanggal Transaksi" value ="<?php echo $hasil['tanggal_pemasukan'] ?>">
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
    <label for="nominal">Jumlah Nominal</label><br>
    <input type="number" name="nominal"  placeholder="Masukkan nominal" value="<?php echo $hasil['nominal'] ?>"/>
  </p>
  <label for="deskripsi">Deskripsi</label><br>
  <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" placeholder="Masukkan Keterangan"  value="<?php echo $hasil['deskripsi'] ?>">

  </textarea>
  <br><br>
  <p>
    <input type="submit" value="simpah" name="simpan" />
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



