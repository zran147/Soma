<?php
include("config.php");
if(isset($_GET['username']) ){
  
  //ambil id dari queru string
  $username = $_GET['username'];

  // buat query hapus 
  $result1 = pg_query("DELETE FROM  users where username = '$username'");
  $result2 = pg_query("DELETE from pemasukan where username='$username'");
  $result3 = pg_query("DELETE from pengeluaran where username='$username'");
  $result4 = pg_query("DELETE from target where username='$username'");
  $result5 = pg_query("DELETE from tugas where username='$username'");


  //apakah query hapus berhasil?
  if($result1 == TRUE and $result2 == TRUE and $result3 == TRUE and $result4 == TRUE and $result5 == TRUE){
    header('Location: adminpage.php');
  }else{
    die("gagal menghapus...");
  } 
  }else {
    die("akses dilarang...");
}
?>