<?php include('config.php');
session_start();

if (isset($_POST['submit'])) {
  //menerima data dari tombol submit pada transaksi
  $username = $_SESSION['username'];
  $saldo = $_SESSION['saldo'];
  $nominal = $_POST['nominal'];
  $tanggal_pengeluaran = $_POST['tanggal_pengeluaran'];
  $deskripsi = $_POST['deskripsi'];
  $kategori_pengeluaran = $_POST['kategori_pengeluaran'];

  //rewrite format date
  $tanggal_pengeluaran = date("Y-m-d", strtotime($tanggal_pengeluaran));

  // menambah saldo
  //  $saldo = $saldo - $nominal;
  // var_dump(($saldo));
  //  $result1 = pg_query($db,"UPDATE users SET saldo  where username = '$username'");

  //membuat query
  $result2 = pg_query($db, "INSERT INTO pengeluaran(id_pengeluaran,username, deskripsi, nominal, tanggal_pengeluaran, kategori_pengeluaran) VALUES(default,'$username', '$deskripsi', $nominal, '$tanggal_pengeluaran', '$kategori_pengeluaran')");

  // query memasukkan ke database
  if ($result2 == true) {
    header('Location: Homepage.php?status=sukses');
  } else {
    header('locaiton: homepage.php? status=gagal');
  }


  // if($result1 == true and $result2 == true){
  //   header('Location: Homepage.php?status=sukses');
  // }else{
  //   header('locaiton: homepage.php? status=gagal');
  // }





}
?>