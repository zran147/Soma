<?php include('config.php');
session_start();
$username = $_SESSION['username'];
$saldo  = $_SESSION['saldo'];
$total = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username'"));
$harian = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username' and kategori_pengeluaran='harian'"));
$mingguan = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username' and kategori_pengeluaran='mingguan'"));
$bulanan = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username' and kategori_pengeluaran='bulanan'"));
$makan = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username' and kategori_pengeluaran='makan'"));
$keperluan_kuliah = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username' and kategori_pengeluaran='keperluan_kuliah'"));
$transportasi = pg_fetch_row(pg_query($db, "SELECT SUM(nominal) FROM pengeluaran WHERE username='$username' and kategori_pengeluaran='transportasi'"));
if ($total[0] == 0) {
  $total[0] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <title>SOMA | Pengeluaran</title>
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
            <span><a href="homepage.php" class="opsi">Home</a></span><span style="margin: 10px;"><a href="pemasukan.php" class="opsi">Pemasukan</a></span><span><a href="" class="opsi-selected">Pengeluaran</a></span><span style="margin: 10px;"><a href="tugas.php" class="opsi">Tugas</a></span><span><a href="target.php" class="opsi">Target</a></span><span style="margin: 10px;"><a href="index.php" class="opsi">Logout</a></span>
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
          Rp <?php echo  number_format($saldo, 0, ',', '.'); ?>
        </div>

        <div class="row" style="position: relative; top: 9px;">
          <div class="col">
            <div class="row">
              <div class="col-10 label ijo inter">Analisis</div>
            </div>

            <div class="grey-bar" style="padding: 20px 20px 20px 20px; height: 274px;">
              <div class="col" style="height: 100%; overflow-x: hidden; overflow-y: auto;">

                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Harian</span><span class="teks1">Rp <?php echo number_format($harian[0], 0, '', '.'); ?></span></div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="white-bar1 teks ijo" style="height: 30px;">
                      <?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($harian[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 10px; margin-bottom: 7px;">
                  <div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Mingguan</span><span class="teks1">Rp <?php echo number_format($mingguan[0], 0, '', '.'); ?></span></div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="white-bar1 teks ijo" style="height: 30px;">
                      <?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($mingguan[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 10px; margin-bottom: 7px;">
                  <div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Bulanan</span><span class="teks1">Rp <?php echo number_format($bulanan[0], 0, '', '.'); ?></span></div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="white-bar1 teks ijo" style="height: 30px;">
                      <?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($bulanan[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 10px; margin-bottom: 7px;">
                  <div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Makan</span><span class="teks1">Rp <?php echo number_format($makan[0], 0, '', '.'); ?></span></div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="white-bar1 teks ijo" style="height: 30px;">
                      <?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($makan[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 10px; margin-bottom: 7px;">
                  <div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Keperluan Kuliah</span><span class="teks1">Rp <?php echo number_format($keperluan_kuliah[0], 0, '', '.'); ?></span></div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="white-bar1 teks ijo" style="height: 30px;">
                      <?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($keperluan_kuliah[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 10px; margin-bottom: 7px;">
                  <div class="col-12 teks putih justify-content-between align-items-center" style="display: flex;"><span>Transportasi</span><span class="teks1">Rp <?php echo number_format($transportasi[0], 0, '', '.'); ?></span></div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="white-bar1 teks ijo" style="height: 30px;">
                      <?php echo '<span class="progress teks1 putih" style="width: ' . number_format(floatval($transportasi[0]) / $total[0] * 100, 2, '.', '') . '%"></span>' ?>
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
          <div class="col-8 label ijo inter" style="text-decoration-line: underline;">Pengeluaran Baru</div>
          <div class="col-4 label ijo inter" style="text-align: right;"><a href="historipengeluaran.php" class="label ijo inter" style="text-decoration: none;">Riwayat</a></div>
        </div>

        <form action="prosespengeluaran.php?" method="POST" class="grey-bar" style="padding: 20px 20px 20px 20px;">
          <div class="col" style="height: 349px; overflow: hidden;">

            <div class="row" style="margin-bottom: 5px;">
              <div class="col teks putih">Jenis</div>
            </div>
            <div class="row">
              <div class="col">
                <select type="text" name="kategori_pengeluaran" class="form-control shadow-none green-bar1 teks1 putih" required>
                  <option>---- Pilih ----</option>
                  <option value="harian">Harian</option>
                  <option value="mingguan">Mingguan</option>
                  <option value="bulanan">Bulanan</option>
                  <option value="makan">Makan</option>
                  <option value="keperluan_kuliah">Keperluan Kuliah</option>
                  <option value="transportasi">Transportasi</option>
                </select>
              </div>
            </div>

            <div class="row" style="margin-top: 7px; margin-bottom: 5px;">
              <div class="col teks putih">Jumlah</div>
            </div>
            <div class="row">
              <div class="col">
                <input type="number" name="nominal" class="form-control shadow-none green-bar1 teks1 putih" required />
              </div>
            </div>

            <div class="row" style="margin-top: 7px; margin-bottom: 5px;">
              <div class="col teks putih date">Tanggal</div>
            </div>
            <div class="row">
              <div class="col">
                <input type="text" name="tanggal_pengeluaran" class="form-control shadow-none date green-bar1 teks1 putih" id="datepicker" placeholder="Tanggal Transaksi" required />
              </div>
            </div>

            <div class="row" style="margin-top: 7px; margin-bottom: 5px;">
              <div class="col teks putih">Keterangan</div>
            </div>
            <div class="row">
              <div class="col">
                <input type="text" name="deskripsi" class="form-control shadow-none green-bar1 teks1 putih" required />
              </div>
            </div>

            <div class="row" style="margin-top: 11px;">
              <div class="col" style="text-align: right;">
                <input type="submit" name="submit" class="teks ijo tambahkan" style="text-decoration: none;" value="Tambahkan" />
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>

  </div>

  <!-- <form action="prosespengeluaran.php?act=pengeluaran" method="POST">
    <section class="container">
      <h4>Pengeluaran</h4>
      <a href="historipengeluaran.php">Riwayat</a><br><br>
      <label for="kategori_pengeluaran">Kategori Pengeluaran</label>
      <br>
      <select name="kategori_pengeluaran" id="kategori_pengeluaran" required>
        <option>------ Pilih -----</option>
        <option value="harian">Harian</option>
        <option value="mingguan">Mingguan</option>
        <option value="bulanan">Bulanan</option>
        <option value="makan">Makan</option>
        <option value="keperluan_kuliah">Keperluan Kuliah</option>
        <option value="transportasi">Transportasi</option>
      </select>
      <div class="row">
        <div class="col-lg-7">
          <div class="form-group"><br>
            <form>
              <label for="tanggal_Pengeluaran">Tanggal Pengeluaran</label>
              <div class="col-sm-4">
                <div class="input-group date" id="datepicker">
                  <input type="text" class="form-control" name="tanggal_pengeluaran" placeholder="Tanggal Transaksi">
                  <span class="input-group-append">
                    <span class="input-group-text bg-white d-block">
                      <i class="fa fa-calendar"></i>
                    </span>
                  </span>
                </div>
              </div>
          </div>
  </form> -->


  <script type="text/javascript">
    $(function() {
      $('#datepicker').datepicker();
    });
  </script>
  <!-- <br>
  <p>
    <label for="nominal">Jumlah Nominal</label><br>
    <input type="number" name="nominal" pattern="[0-9]" placeholder=" Masukkan nominal">
  </p>
  <label for="deskripsi">Keterangan</label><br>
  <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" placeholder=" Masukkan Keterangan"></textarea>
  <br><br>

  <p>
    <input type="submit" value="submit" name="submit" />
  </p>
  </section>
  </form> -->

</body>

</html>