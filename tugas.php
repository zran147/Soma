<?php
include('config.php');
session_start();
$username = $_SESSION['username'];
$tugas = pg_query($db, "SELECT * FROM tugas WHERE username='$username' and deadline - CURRENT_DATE >= 0 ORDER BY deadline asc");
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
  <title>SOMA | Tugas</title>
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
            <span><a href="homepage.php" class="opsi">Home</a></span><span style="margin: 10px;"><a href="pemasukan.php" class="opsi">Pemasukan</a></span><span><a href="pengeluaran.php" class="opsi">Pengeluaran</a></span><span style="margin: 10px;"><a href="" class="opsi-selected">Tugas</a></span><span><a href="target.php" class="opsi">Target</a></span><span style="margin: 10px;"><a href="index.php" class="opsi">Logout</a></span>
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
              <div class="col-10 label ijo inter">Tugas Terdekat</div>
            </div>

            <div class="grey-bar" style="padding: 20px 20px 20px 20px; height: 389px;">
              <div class="col" style="height: 349px; overflow-x: hidden; overflow-y: auto;">

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

              </div>
            </div>


          </div>
        </div>
      </div>

      <div class="col-6">

        <div class="row">
          <div class="col-8 label ijo inter" style="text-decoration-line: underline;">Tugas Baru</div>
          <div class="col-4" style="text-align: right;"><a href="historitugas.php" class="label ijo inter" style="text-decoration: none;">Riwayat</a></div>
        </div>

        <form action="prosestugas.php?" method="POST" class="grey-bar" style="padding: 20px 20px 20px 20px;">
          <div class="col" style="height: 349px; overflow: hidden;">

            <div class="row" style="margin-bottom: 5px;">
              <div class="col teks putih">Mata Kuliah</div>
            </div>
            <div class="row">
              <div class="col">
                <select type="text" name="mata_kuliah" class="form-control shadow-none green-bar1 teks1 putih" required>
                  <option value="">---- Pilih ----</option>
                  <option value="ALINKOM">Aljabar Linear untuk Komputasi</option>
                  <option value="ALPROG">Algoritme dan Dasar Pemrograman</option>
                  <option value="BASDAT">Basis Data</option>
                  <option value="PMK">Pengantar Matematika untuk Komputasi</option>
                  <option value="RADIG">Rangkaian Digital</option>
                  <option value="STRUKDIS">Struktur Diskret</option>
                  <option value="TP">Teori Peluang</option>
                </select>
              </div>
            </div>

            <div class="row" style="margin-top: 7px; margin-bottom: 5px;">
              <div class="col teks putih">Deskripsi</div>
            </div>
            <div class="row">
              <div class="col">
                <input type="text" name="nama_tugas" maxlength="30" class="form-control shadow-none green-bar1 teks1 putih" required />
              </div>
            </div>

            <div class="row" style="margin-top: 7px; margin-bottom: 5px;">
              <div class="col teks putih date">Tanggal</div>
            </div>
            <div class="row">
              <div class="col">
                <input type="text" name="deadline" class="form-control shadow-none date green-bar1 teks1 putih" id="datepicker" placeholder="Tanggal Deadline" required />
              </div>
            </div>

            <div class="row" style="margin-top: 7px; margin-bottom: 5px;">
              <div class="col teks putih">Link Pengumpulan</div>
            </div>
            <div class="row">
              <div class="col">
                <input type="text" name="link_pengumpulan" maxlength="30" class="form-control shadow-none green-bar1 teks1 putih" />
              </div>
            </div>

            <div class="row" style="margin-top: 11px;">
              <div class="col" style="text-align: right;">
                <input type="submit" name="submit" class="teks tambahkan" style="text-decoration: none;" value="Tambahkan" />
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>

  </div>

  <!-- <form action="prosestugas.php" method="POST">
    <section class="container">
      <h4>Tugas</h4>
      <a href="historitugas.php">Riwayat</a><br>
      
      </p>
      <label for="nama_tugas">Nama Tugas</label><br>
      <textarea name="nama_tugas" id="nama_tugas" cols="30" rows="3" placeholder="Masukkan Keterangan"></textarea><br>
        <label for="mata_kuliah">Mata Kuliah</label><br>
        <select name="mata_kuliah" id="mata_kuliah" required>
          <option value=""> -- Pilih --</option>
          <option value="ALINKOM">ALINKOM</option>
          <option value="ALPROG">ALPROG</option>
          <option value="BASDAT">BASDAT</option>
          <option value="PMK">PMK</option>
          <option value="RADIG">RADIG</option>
          <option value="STRUKDIS">STRUKDIS</option>
          <option value="TP">TP</option>
        </select> 
      <div class="row">
        <div class="col-lg-7">
          <div class="form-group"><br>
            <form>
              <label for="deadline">Deadline</label>
              <div class="col-sm-4">
                <div class="input-group date" id="datepicker">
                  <input type="text" class="form-control" name="deadline" placeholder="Deadline">
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
    <label for="link_pengumpulan">Link Pengumpulan</label><br>
    <input type="text" name="link_pengumpulan" placeholder="Link Pengumpulan">

    <br><br>
    <input type="submit" value="submit" name="submit" />
  </p>
  </section>
  </form> -->

</body>

</html>