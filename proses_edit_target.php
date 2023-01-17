<?php
include("config.php");
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit'])){
	session_start();
	$id_target = $_SESSION['id_target'];
	$username = $_SESSION['username'];
	// ambil data dari formulir
	$deadline = $_POST['deadline'];
	$link_pembelian = $_POST['link$link_pembelian'];
	$nominal = $_POST['nominal'];
	$deskripsi = $_POST['deskripsi'];

	// buat query
		$sql =  "UPDATE target SET username ='$username' deskripsi='$deskripsi' nominal='$nominal' deadline ='$deadline' link_pembelian='$link_pembelian' where id_target ='$id_target' ";
		$query = pg_query($sql);
	// apakah query simpan berhasil?
	if( $query==TRUE ) {
		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: homepage.php?status=sukses');
	} else {
		// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
		header('Location: homepage.php?status=gagal');
		
	}


} 
?>
