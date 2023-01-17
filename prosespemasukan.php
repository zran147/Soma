<?php include('config.php');
session_start();

if (isset($_POST['submit'])) {
  //menerima data dari tombol submit pada transaksi
  $username = $_SESSION['username'];
  $saldo = $_SESSION['saldo'];
  $nominal = $_POST['nominal'];
  $tanggal_pemasukan = $_POST['tanggal_pemasukan'];
  $deskripsi = $_POST['deskripsi'];
  $kategori_pemasukan = $_POST['kategori_pemasukan'];

  //rewrite format date
  $tanggal_pemasukan = date("Y-m-d", strtotime($tanggal_pemasukan));


  //membuat query
  $result2 = pg_query($db, "INSERT INTO pemasukan(id_pemasukan, username, deskripsi, nominal, tanggal_pemasukan, kategori_pemasukan) VALUES(default, '$username', '$deskripsi', $nominal, '$tanggal_pemasukan', '$kategori_pemasukan')");

  //  //menambah saldo
  //  $saldo = $saldo + $nominal;
  //  $result1 = pg_query($db,"UPDATE users SET saldo =$saldo where username='$username'");

  //query memasukkan ke database
  // if( $result2 == true){
  // header('Location: Homepage.php?status=sukses');
  // }else{
  // header('locaiton: homepage.php? status=gagal');
  // }

  // if($result1 == true and $result2 == true){
  if ($result2 == true) {
    header('location: homepage.php?status=sukses');
  } else {
    header('location: homepage.php?status=gagal');
  }
}
?>