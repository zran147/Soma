<?php include('config.php');
session_start();
if (isset($_POST['submit'])) {
  //menerima data dari tombol submit pada transaksi
  $username = $_SESSION['username'];
  $deskripsi = $_POST['deskripsi'];
  $nominal = $_POST['nominal'];
  $deadline = $_POST['deadline'];
  $link_pembelian = $_POST['link_pembelian'];

  //rewrite format date
  $new_date = date("Y-m-d", strtotime($deadline));


  //membuat query
  $result2 = pg_query($db, "INSERT INTO target(id_target, username, deskripsi , nominal, deadline, link_pembelian) VALUES(default, '$username', '$deskripsi', $nominal, '$new_date', '$link_pembelian')");

  //query memasukkan ke database
  if ($result2 == true) {
    header('Location: homepage.php?status=sukses');
  } else {
    header('locaiton: homepage.php? status=gagal');
  }
}
?>