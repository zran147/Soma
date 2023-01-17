<?php include('config.php') ;
session_start();
if (isset($_SESSION['username'])) {
}

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == 'admin' and $password == 'admin') {
    header('location:adminpage.php?');
    exit;
  } else {

    //jika terisi maka akan mengecek  username apakah sama dengan database
    $result  = pg_query($db, "SELECT * from users where username = '$username'");
    $row = pg_fetch_array($result);

    if(pg_num_rows($result)>0){
      
      $_SESSION['username'] = $row['username'];
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['saldo'] = $row['saldo'];
      $success = password_verify($password, $row['password']);
      if ($success) {
        header('Location:homepage.php?');
      } else {
        $err = "username atau password salah";
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <!--=============== BOXICONS ===============-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

 

  <title>SOMA | Login</title>
  <link href="style.css" rel="stylesheet"/>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <style>
    label {
      display: block;
    }
  </style> -->
</head>

<body>
  <div class="mx-auto gambar-logo" style="position: relative; top: 60px;"><img src="./logo_soma.png"/></div>
  <div class="mx-auto logo kuning"><span class="soma">soma</span><span class="inter solusi"> | Solusi Mahasiswa</span></div>
  <div class="mx-auto paragraf ijo" style="position: relative; top: 60px; height: 50px;">Login</div>

  <?php
  if ($err>0) {
    echo '<div class="mx-auto berhasil" style="position: relative; top: 70px; height: 50px;">Username atau Password salah</div>';
  } else {
    echo '<div class="mx-auto berhasil" style="position: relative; top: 70px; height: 50px; visibility: hidden;">Username atau Password salah</div>';
  }
  ?>

  <form action="" method="POST" class="container" style="position: relative; top: 50px;">
    <div class="row align-items-between" style="height: 100px;">
      <div class="col-6 offset-3 form-outline">
        <input type="text" name="username" class="form-control pendaftaran green-bar" placeholder="Username" required/>
      </div>
      <div class="col-6 offset-3 form-outline">
        <input type="password" name="password" class="form-control pendaftaran green-bar" placeholder="Password" required/>
      </div>
    </div>
    <div class="d-flex mx-auto justify-contents-center" style="position: relative; top: 20px; width: 200px;">
      <button class="tombol inter ijo white-bar" name="login">Masuk</button>
    </div>
  </form>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <!-- <div id="app">
    <header>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-6">
            <div class="form-group">
              <h1>SOMA | Solusi Mahasiswa</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-6">
            <div class="form-group">
            <h2>Login</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  </header>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="form-group">
          <div>
            <?php
            //kondisi jika tidak diisi
            if ($err>0) {
              echo "<ul>$err</ul><b></b>";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <form action="" , method="post">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Isikan Username" required /><br />
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="form-group">
            <div class="input">
              <div class="input__overlay" id="input_overlay"></div>
              <label for="password">Password</label>
              <input class="form-control" type="password" name="password" id="input_overlay" placeholder="Isikan Password" class="input_password" id="input_pass" required>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <br>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="form-group">
            <input type="submit" name="login" value="Login" /> <br><br>
          </div>
        </div>
      </div>
    </div>
    </div>
  </form>
  </div> -->

</body>

</html>