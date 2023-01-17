<?php
include("config.php");
if(isset($_GET['id_tugas']) ){
  
  //ambil id dari queru string
  $id_tugas = $_GET['id_tugas'];

  // buat query hapus 
  $result1 = pg_query("DELETE FROM  tugas where id_tugas = '$id_tugas'");
  // $result2 = pg_query("DELETE from pemasukan where id_target='$id_target'");
  // $result3 = pg_query("DELETE from pengeluaran where id_target='$id_target'");
  // $result4 = pg_query("DELETE from target where id_target='$id_target'");
  // $result5 = pg_query("DELETE from tugas where id_target='$id_target'");


  //apakah query hapus berhasil?
  if($result1 == TRUE ){
    header('Location: homepage.php');
  }else{
    die("gagal menghapus...");
  } 
  }else {
    die("akses dilarang...");
}
?>