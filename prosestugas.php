<?php include('config.php');
session_start();
if (isset($_POST['submit'])) {
  //menerima data dari tombol submit pada transaksi
  $username = $_SESSION['username'];
  $nama_tugas = $_POST['nama_tugas'];
  $mata_kuliah = $_POST['mata_kuliah'];
  $deadline = $_POST['deadline'];
  $link_pengumpulan = $_POST['link_pengumpulan'];

  //rewrite format date
  $deadline = date("Y-m-d", strtotime($deadline));


  //membuat query
  $result2 = pg_query($db, "INSERT INTO tugas(id_tugas, username, nama_tugas, mata_kuliah, deadline, link_pengumpulan) VALUES(default, '$username', '$nama_tugas', '$mata_kuliah', '$deadline', '$link_pengumpulan')");

  //query memasukkan ke database
  if ($result2 == true) {
    header('Location: homepage.php?status=sukses');
  } else {
    header('locaiton: homepage.php? status=gagal');
  }
}
?>