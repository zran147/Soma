<?php include 'config.php?';
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == 'admin' and $password == 'admin') {
    header('location:adminpage.php?');
    exit;
  }
  //mengecek apakah username sudah diisi atau belum
  else if (empty($err)) {

    //jika terisi maka akan mengecek  username apakah sama dengan database
    $result  = pg_query($db, "SELECT * from users where username = '$username'");
    $row = pg_fetch_array($result);


    // if (pg_num_rows($result) > 0) {

    //   $row = pg_fetch_array($result);
    //   $_SESSION['username'] = $row['username'];
    //   $_SESSION['nama'] = $row['nama'];
    //   $_SESSION['saldo'] = $row['saldo'];

    //   //cek password
    //   if (password_verify($password, $row['password'])) { //kebalikan dari password_hesh
    //     header('Location:homepage.php?');
    //     exit;
    //   } else {
    //     //mengecek jika diisi salah dan tidak diisi
    //     $err = '<h2 style="color:red">Username dan Password salah!</h2>';
    //   }
    // }

    if(pg_num_rows($result)>0){
      
      $_SESSION['username'] = $row['username'];
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['saldo'] = $row['saldo'];
      password_verify($password, $row['password']);
      header('Location:homepage.php?');
    }else {
      //mengecek jika diisi salah 
      $err = '<h2 style="color:red">Username dan Password salah!</h2>';
    }
  }
}
?>