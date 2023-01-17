<?php include 'config.php';
// $err='';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SOMA | Solusi Mahasiswa </title>
  <link href="style.css" rel="stylesheet" />

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="mx-auto gambar-logo" style="position: relative; top: 60px;"><img src="./logo_soma.png" /></div>
  <div class="mx-auto logo kuning"><span class="soma">soma</span><span class="inter solusi"> | Solusi Mahasiswa</span></div>
  <div class="mx-auto paragraf ijo" style="position: relative; top: 70px; height: 144px;">Manage Your Finances,<br>Schedule Your Task, And<br>Make Your Dream List</div>
  <div class="d-flex mx-auto justify-contents-center" style="position: relative; top: 90px; width: 478px">
    <form action="formdaftar.php">
      <button class="tombol inter putih green-bar">Daftar</button>
    </form>
    <form action="login.php">
      <button class="tombol inter ijo white-bar" style="position: relative; left: 17%">Masuk</button>
    </form>

  </div>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
<?php if (isset($_GET['status'])) : ?>
  <?php
  if ($_GET['status'] == 'sukses') {
    $err = 'Pendaftaran Berhasil!';
  } else {
    $err = 'Pendaftaran gagal!';
  }
  return false;
  ?>

<?php endif; ?>