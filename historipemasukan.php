<?php include('config.php');
session_start();
$username = $_SESSION['username'];
$saldo  = $_SESSION['saldo'];
$total = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pemasukan WHERE username='$username'"));
$uang_bulanan = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pemasukan WHERE username='$username' and kategori_pemasukan='uang_bulanan'"));
$penghasilan = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pemasukan WHERE username='$username' and kategori_pemasukan='penghasilan'"));
$lainnya = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pemasukan WHERE username='$username' and kategori_pemasukan='lainnya'"));
$pemasukan = pg_query($db, "SELECT * FROM pemasukan WHERE username='$username'");
if ($total[0] == 0) {
	$total[0] = 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>SOMA|Target</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet" />
</head>

<body>

	<div class="container" style="position: relative; top: 50px;">
		<div class="row">
			<div class="d-flex">
				<div class="p">
					<img src="./logo_soma.png" class="gambar-logo1" />
				</div>
				<div class="p">
					<div class="kuning" style="position: relative; left: 3%;"><span class="soma1">soma</span><span class="inter solusi1"> | Solusi Mahasiswa</span></div>
					<div class="align-items-center" style="position: relative; left: 3%; top: 2px; width: 473px;">
						<span><a href="homepage.php" class="opsi">Home</a></span><span style="margin: 10px;"><a href="" class="opsi-selected">Pemasukan</a></span><span><a href="pengeluaran.php" class="opsi">Pengeluaran</a></span><span style="margin: 10px;"><a href="tugas.php" class="opsi">Tugas</a></span><span><a href="target.php" class="opsi">Target</a></span><span style="margin: 10px;"><a href="index.php" class="opsi">Logout</a></span>
					</div>
				</div>
				<div class="p flex-fill align-items-center justify-content-end" style="display: flex;">
					<div class="ijo" id="welcome"><?php echo $_SESSION['nama']; ?></div>
				</div>
			</div>
		</div>

		<!-- <div class="mx-auto paragraf ijo" style="position: relative; top: 30px; font-size: 30px">Welcome,</div> -->

		<div class="row" style="position: relative; top: 30px;">
			<div class="col-6">
				<div class="row">
					<div class="col label ijo inter">Dompetmu</div>
				</div>

				<div class="grey-bar saldo">
					Rp <?php echo number_format($saldo, 0, ',', '.'); ?>
				</div>

				<div class="row" style="position: relative; top: 9px;">
					<div class="col">
						<div class="row">
							<div class="col-10 label ijo inter">Analisis</div>
						</div>

						<div class="grey-bar" style="padding: 8px 20px 20px 20px; height: 274px; align-items: center;">
							<div class="col">

								<div class="row" style="margin-bottom: 7px;">
									<div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Uang Bulanan</span><span class="teks1">Rp <?php echo number_format($uang_bulanan[0], 0, '', '.'); ?></span></div>
								</div>
								<div class="row">
									<div class="col">
										<div class="white-bar1 teks ijo" style="height: 30px;">
											<?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($uang_bulanan[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
										</div>
									</div>
								</div>

								<div class="row" style="margin-top: 10px; margin-bottom: 7px;">
									<div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Penghasilan Pribadi</span><span class="teks1">Rp <?php echo number_format($penghasilan[0], 0, '', '.'); ?></span></div>
								</div>
								<div class="row">
									<div class="col">
										<div class="white-bar1 teks ijo" style="height: 30px;">
											<?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($penghasilan[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
										</div>
									</div>
								</div>

								<div class="row" style="margin-top: 10px; margin-bottom: 7px;">
									<div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Lainnya</span><span class="teks1">Rp <?php echo number_format($lainnya[0], 0, '', '.'); ?></span></div>
								</div>
								<div class="row">
									<div class="col">
										<div class="white-bar1 teks ijo" style="height: 30px;">
											<?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($lainnya[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
										</div>
									</div>
								</div>

							</div>
						</div>


					</div>
				</div>
			</div>

			<div class="col-6">

				<div class="row">
					<div class="col-8"><a href="javascript:history.back()" class="label ijo inter" style="text-decoration: none;">Pemasukan Baru</a></div>
					<div class="col-4 label ijo inter" style="text-align: right; text-decoration-line: underline;">Riwayat</div>
				</div>

				<div class="grey-bar" style="padding: 20px 20px 20px 20px;">
					<div class="col" style="height: 349px; overflow-x: hidden; overflow-y: auto;">

						<?php
						while ($row = pg_fetch_row($pemasukan)) {
							$jenis = '';
							switch ($row[5]) {
								case 'lainnya':
									$jenis = 'Lainnya';
									break;
								case 'uang_bulanan':
									$jenis = 'Uang Bulanan';
									break;
								case 'penghasilan':
									$jenis = 'Penghasilan Pribadi';
									break;
								default:
									$jenis = $row[5];
							}
							echo
							'<div class="row" style="margin-bottom: 15px;">
								<div class="col">
									<div class="green-bar1 teks putih">
										<div class="row">
											<div class="col-6">' . $jenis . '</div><div class="col-6" style="text-align: right;">Rp ' . number_format($row[3], 0, ',', '.') . '</div>
										</div>
										<div class="row teks2" style="margin-top: 5px;">
											<div class="col-4">' . $row[2] . '</div><div class="col-8" style="text-align: right;">' . date("d/m/Y", strtotime($row[4])) . '</div>
										</div>
									</div>
								</div>
							</div>';
						}
						?>

					</div>
				</div>

			</div>
		</div>

	</div>

	<!-- <h1>SOMA | Solusi Mahasiswa</h1>
	<h2>Riwayat Pemasukan</h2>
	<table border="1">
		<thead>
			<tr>
				<th>ID User</th>
				<th>ID Pemasukan</th>
				<th>Kategori Pemasukan</th>
				<th>Tanggal Pemasukan</th>
				<th>Nominal</th>
				<th>Deskripsi</th>

			</tr>
		</thead>
		<tbody> -->

	<?php
	// $query = pg_query($db, "SELECT * FROM pemasukan where username = '$username' Order BY tanggal_pemasukan asc ");
	// // $query = pg_query($db, $sql);


	// while ($siswa = pg_fetch_array($query)) {
	// 	echo "<tr>";

	// 	// echo "<td>".$siswa['id_user']."</td>";

	// 	echo "<td>" . $siswa['id_pemasukan'] . "</td>";
	// 	echo "<td>" . $siswa['kategori_pemasukan'] . "</td>";
	// 	echo "<td>" . $siswa['tanggal_pemasukan'] . "</td>";
	// 	echo "<td>" . $siswa['nominal'] . "</td>";
	// 	echo "<td>" . $siswa['deskripsi'] . "</td>";
	// 	echo "</tr>";
	// }


	?>

	<!-- </tbody>
	</table>

	<p>
		Total: <?php echo pg_num_rows($query) ?></p>
	</p> -->

</body>

</html>