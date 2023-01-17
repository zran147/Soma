<?php include('config.php');
session_start();
$username = $_SESSION['username'];
$tugas = pg_query($db, "SELECT * FROM tugas WHERE username='$username' and deadline - CURRENT_DATE >= 0 ORDER BY deadline ASC LIMIT 1");
$target = pg_query($db, "SELECT * FROM target WHERE username='$username' and deadline - CURRENT_DATE >= 0 ORDER BY deadline ASC LIMIT 1");
$histori = pg_query($db, "SELECT * FROM (SELECT * FROM pemasukan WHERE username='$username' UNION SELECT * FROM pengeluaran WHERE username='$username') AS gabungan ORDER BY tanggal_pemasukan desc");
$pemasukan = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pemasukan WHERE username='$username'"));
$pengeluaran = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username'"));
$_SESSION['saldo'] = $pemasukan[0] - $pengeluaran[0];
$saldo = $_SESSION['saldo'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SOMA</title>
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
            <span><a href="" class="opsi-selected">Home</a></span><span style="margin: 10px;"><a href="pemasukan.php" class="opsi">Pemasukan</a></span><span><a href="pengeluaran.php" class="opsi">Pengeluaran</a></span><span style="margin: 10px;"><a href="tugas.php" class="opsi">Tugas</a></span><span><a href="target.php" class="opsi">Target</a></span><span style="margin: 10px;"><a href="index.php" class="opsi">Logout</a></span>
          </div>
        </div>
        <div class="p flex-fill align-items-center justify-content-end" style="display: flex;">
          <div class="ijo" id="welcome"><?php echo $_SESSION['nama']; ?></div>
        </div>
      </div>
    </div>

    <!-- <div class="mx-auto paragraf ijo" style="position: relative; top: 30px; font-size: 30px">Welcome, <?php echo $_SESSION['nama']; ?></div> -->

    <div class="row" style="position: relative; top: 30px;">
      <div class="col-6">
        <div class="row">
          <div class="col-10 label ijo inter">Dompetmu</div>
          <div class="col-2" style="text-align: right;"><a href="pemasukan.php" class="plus kuning inter">+</a></div>
        </div>
        <div class="grey-bar saldo">
          Rp <?php echo number_format($saldo, 0, ',', '.'); ?>
        </div>
      </div>

      <div class="col-6">
        <div class="row">
          <div class="col-10 label ijo inter">Pengeluaran total</div>
          <div class="col-2" style="text-align: right;"><a href="pengeluaran.php" class="plus kuning inter">+</a></div>
        </div>
        <div class="grey-bar saldo">
          Rp <?php echo number_format($pengeluaran[0], 0, ',', '.'); ?>
        </div>
      </div>
    </div>

    <div class="row" style="position: relative; top: 39px;">
      <div class="col-6">
        <div class="row">
          <div class="col-10 label ijo inter">Reminder</div>
        </div>

        <div class="grey-bar" style="padding: 18px 20px 20px 20px; height: 274px; align-items: center;">
          <div class="col">

            <div class="row">
              <div class="col-8 teks putih" style="margin-bottom: 7px;">Tugas Kuliah</div>
              <div class="col-4 teks putih" style="text-align: right;"><a href="tugas.php" class="show-all" style="text-decoration: none;">show all</a></div>
            </div>

            <?php
            while ($row = pg_fetch_row($tugas)) {
              $matkul = '';
              switch ($row[3]) {
                case 'ALINKOM':
                  $matkul = 'Aljabar Linear';
                  break;
                case 'ALPROG':
                  $matkul = 'Algoritme dan DP';
                  break;
                case 'BASDAT':
                  $matkul = 'Basis Data';
                  break;
                case 'RADIG':
                  $matkul = 'Rangkaian Digital';
                  break;
                case 'STRUKDIS':
                  $matkul = 'Struktur Diskret';
                  break;
                case 'TP':
                  $matkul = 'Teori Peluang';
                  break;
                default:
                  $matkul = $row[3];
              }
              echo
              '<div class="row" style="margin-bottom: 15px;">
                <div class="col">
                  <div class="green-bar1 teks putih">
                    <div class="row">
                      <div class="col-8">' . $matkul . '</div><div class="col-4" style="text-align: right;">' . date("Y/m/d", strtotime($row[4])) . '</div>
                    </div>
                    <div class="row teks2" style="margin-top: 5px;">
                      <div class="col-4">' . $row[2] . '</div><div class="col-8" style="text-align: right;">' . $row[5] . '</div>
                    </div>
                  </div>
                </div>
              </div>';
            }
            ?>

            <div class="row" style="margin-top: 15px; margin-bottom: 7px;">
              <div class="col-8 teks putih">Wishlist</div>
              <div class="col-4" style="text-align: right;"><a href="target.php" class="show-all" style="text-decoration: none;">show all</a></div>
            </div>

            <?php
            while ($row = pg_fetch_row($target)) {
              echo
              '<div class="row" style="margin-bottom: 15px;">
                <div class="col">
                  <div class="green-bar1 teks putih">
                    <div class="row">
                      <div class="col-8">' . $row[3] . '</div><div class="col-4" style="text-align: right;">' . date("Y/m/d", strtotime($row[4])) . '</div>
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

      <div class="col-6">
        <div class="row">
          <div class="col-10 label ijo inter">Keuangan</div>
        </div>
        <div class="grey-bar" style="padding: 20px 20px 20px 20px; height: 274px;">
          <div class="col" style="height: 100%; overflow-x: hidden; overflow-y: auto;">
            <?php
            while ($row = pg_fetch_row($histori)) {
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
                case 'harian':
                  $jenis = 'Harian';
                  break;
                case 'mingguan':
                  $jenis = 'Mingguan';
                  break;
                case 'bulanan':
                  $jenis = 'Bulanan';
                  break;
                case 'makan':
                  $jenis = 'Makan';
                  break;
                case 'keperluan_kuliah':
                  $jenis = 'Keperluan Kuliah';
                  break;
                case 'transportasi':
                  $jenis = 'Transportasi';
                  break;
								default:
									$jenis = $row[5];
							}
              $uang = '';
              switch ($row[5]) {
                case 'harian':
                  $uang = '- Rp ' . number_format($row[3], 0, '', '.');
                  break;
                case 'mingguan':
                  $uang = '- Rp ' . number_format($row[3], 0, '', '.');
                  break;
                case 'bulanan':
                  $uang = '- Rp ' . number_format($row[3], 0, '', '.');
                  break;
                case 'makan':
                  $uang = '- Rp ' . number_format($row[3], 0, '', '.');
                  break;
                case 'keperluan_kuliah':
                  $uang = '- Rp ' . number_format($row[3], 0, '', '.');
                  break;
                case 'transportasi':
                  $uang = '- Rp ' . number_format($row[3], 0, '', '.');
                  break;
                default:
                  $uang = '+ Rp ' . number_format($row[3], 0, '', '.');
              }
              echo
              '<div class="row" style="margin-bottom: 15px;">
									<div class="col">
										<div class="green-bar1 teks putih">
										<div class="row">
											<div class="col-8">' . $uang . '</div><div class="col-4" style="text-align: right;">' . date("Y/m/d", strtotime($row[4])) . '</div>
										</div>
										<div class="row teks2" style="margin-top: 5px;">
											<div class="col-4">' . $row[2] . '</div><div class="col-8" style="text-align: right;">' . $jenis . '</div>
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

  <!-- <php
  $saldo = pg_query($db,"SELECT saldo From users where ");
  $saldo = pg_fetch_row($db);
  ?> -->
  <!-- <br><br><br><br><br><br><br>
  <h3>Welcome to<br></b></h3>
  <h1>SOMA | Solusi Mahasiswa</h1>
  <h2>Saldo<br>Rp </br></h2>
  <h3>Menu</h3>
      <a href="homepage.php">Home</a><br>
      <a href="pemasukan.php">Pemasukan</a><br>
      <a href="pengeluaran.php">Pengeluaran</a><br>
      <a href="tugas.php">Tugas</a><br>
      <a href="target.php">Target</a><br>
 
 <p>
 <a href="index.php">Log Out</a>
 </p> -->
</body>

</html>

<?php if (isset($_GET['status'])) : ?>
  <!-- <p> -->
    <?php
    // if ($_GET['status'] == 'sukses') {
    //   echo "proses berhasil!";
    // } else {
    //   echo "proses gagal!";
    // }
    // return false;
    ?>
  <!-- </p> -->
<?php endif; ?>