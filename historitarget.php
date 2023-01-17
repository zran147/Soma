<?php
include('config.php');
session_start();
$username = $_SESSION['username'];
$targetterdekat = pg_query($db, "SELECT * FROM target WHERE username='$username' and deadline - CURRENT_DATE >= 0 ORDER BY deadline asc");
$target = pg_query($db, "SELECT * FROM target WHERE username='$username' ORDER BY deadline desc");
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
						<span><a href="homepage.php" class="opsi">Home</a></span><span style="margin: 10px;"><a href="pemasukan.php" class="opsi">Pemasukan</a></span><span><a href="pengeluaran.php" class="opsi">Pengeluaran</a></span><span style="margin: 10px;"><a href="tugas.php" class="opsi">Tugas</a></span><span><a href="" class="opsi-selected">Target</a></span><span style="margin: 10px;"><a href="index.php" class="opsi">Logout</a></span>
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
					<div class="col">
						<div class="row">
							<div class="col-10 label ijo inter">Target Terdekat</div>
						</div>

						<div class="grey-bar" style="padding: 20px 20px 20px 20px; height: 389px;">
							<div class="col" style="height: 349px; overflow-x: hidden; overflow-y: auto;">

								<?php
								while ($row = pg_fetch_row($targetterdekat)) {
									echo
									'<div class="row" style="margin-bottom: 15px;">
									<div class="col">
										<div class="green-bar1 teks putih">
										<div class="row">
											<div class="col-8">Rp ' . number_format($row[3], 0, ',', '.') . '</div><div class="col-4" style="text-align: right;">' . date("Y/m/d", strtotime($row[4])) . '</div>
										</div>
										<div class="row teks2" style="margin-top: 5px;">
											<div class="col-4">' . $row[2] . '</div><div class="col-8" style="text-align: right;">' . $row[5] . '</div>
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

			<div class="col-6">

				<div class="row">
					<div class="col-8"><a href="javascript:history.back()" class="label ijo inter" style="text-decoration: none;">Target Baru</a></div>
					<div class="col-4 label ijo inter" style="text-align: right; text-decoration-line: underline;">Riwayat</div>
				</div>

				<div class="grey-bar" style="padding: 18px 20px 20px 20px;">
					<div class="col" style="height: 349px; overflow-x: hidden; overflow-y: auto;">

						<?php
						while ($row = pg_fetch_row($target)) {
							echo
							'<div class="row" style="margin-bottom: 15px;">
								<div class="col">
									<div class="green-bar1 teks putih">
										<div class="row">
											<div class="col-8">Rp ' . number_format($row[3], 0, ',', '.') . '</div><div class="col-4" style="text-align: right;">' . date("Y/m/d", strtotime($row[4])) . '</div>
										</div>
										<div class="row teks2" style="margin-top: 5px;">
											<div class="col-4">' . $row[2] . '</div><div class="col-8" style="text-align: right;">' . $row[5] . '</div>
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
	<h2>Riwayat Target</h2>
	<table border="1">
		<thead>
			<tr>
				<th>ID User</th>
				<th>ID Target</th>
				<th>Deskripsi</th>
				<th>Nominal</th>
				<th>Deadline</th>
				<th>Link Pembelian</th>
				<th>Tindakan</th>
			</tr>
		</thead>
		<tbody> -->

	<?php
	// $query = pg_query($db, "SELECT * FROM target where username = '$username' Order BY deadline asc ");
	// // $query = pg_query($db, $sql);


	// while ($siswa = pg_fetch_array($query)) {
	// 	echo "<tr>";

	// 	// echo "<td>".$siswa['id_user']."</td>";

	// 	echo "<td>" . $siswa['id_target'] . "</td>";
	// 	echo "<td>" . $siswa['deskripsi'] . "</td>";
	// 	echo "<td>" . $siswa['nominal'] . "</td>";
	// 	echo "<td>" . $siswa['deadline'] . "</td>";
	// 	echo "<td>" . $siswa['link_pembelian'] . "</td>";
	// 	echo "<td>";
	// 	echo "<a href='hapus_target.php?id_target=" . $siswa['id_target'] . "'><p>Hapus </a>";
	// 	echo "<a href='edit_target.php?id_target=" . $siswa['id_target'] . "'><p>Edit</a>";
	// 	echo "</td>";
	// 	echo "</tr>";
	// }


	// 		
	?>

	<!-- </tbody>
	</table>

	<p>
		Total: <?php echo pg_num_rows($query) ?></p>
	</p> -->

</body>

</html>