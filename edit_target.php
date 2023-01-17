<?php include("config.php"); 
	$id_target = $_GET['id_target'];
	$ambildata =pg_query("SELECT * from target where id_target = '$id_target'");
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
  <title>SOMA | Target</title>
</head>

<body>
<form action=<?php "prosestarget.php"?> method="POST">
    <section class="container">
      <h4>Target</h4>

      
      <label for="deskripsi">Deskripsi</label><br>
      <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" placeholder="Masukkan Keterangan" required> <?php echo $hasil['deskripsi'] ?></textarea><br><br>

      <label for="nominal">Nominal</label><br>
      <input type="number" name="nominal" id="nominal" placeholder="nominal" required value="<?php echo $hasil['nominal']?>"></input>
 
      <div class="row">
        <div class="col-lg-7">
          <div class="form-group"><br>
            <form>
              <label for="deadline">Deadline</label>
              <div class="col-sm-4">
                <div class="input-group date" id="datepicker">
                  <input type="text" class="form-control" name="deadline" placeholder="Deadline" required value="<?php echo $hasil['deadline'] ?>">
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
    <label for="link_pembelian">Link Pembelian</label><br>
    <input type="text" name="link_pembelian" placeholder="Link Pembelian" required value="<?php echo $hasil['link_pembelian'] ?>">

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



