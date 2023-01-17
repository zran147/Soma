<?php
include("config.php");
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['simpan'])){
	$id_pemasukan = $_GET['id_pemasukan'];
	// ambil data dari formulir
	$kategori_pemasukan = $_POST['kategori_pemasukan'];
	$tanggal_pemasukan = $_POST['tanggal_pemasukan'];
	$nominal = $_POST['nominal'];
	$deskripsi = $_POST['deskripsi'];

	// buat query
		$sql =  "UPDATE pemasukan SET kategori_pemasukan = '$kategori_pemasukan', tanggal_pemasukan = $tanggal_pemasukan, nominal = '$nominal', deskripsi = '$deskripsi' WHERE id_pemasukan='$id_pemasukan'";
		$query = pg_query($sql);
	// apakah query simpan berhasil?
	if( $query==TRUE ) {
		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: homepage.php?status=sukses');
	} else {
		// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
		header('Location: edit_pemasukan.php?status=gagal');
		
	}


} 
?>
