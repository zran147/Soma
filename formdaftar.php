<?php
include('config.php');

$username ="";
$nama ="";
$password ="";
$err = "";
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

	// menerima data yang dikirim dari formdaftar
	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	
	if($username == ''  or $nama == ''or $password == ''){
    $err .= header('Location: index.php?status=gagal');
  }

	//cek konfirmasi password apakah sudah sama atau belum
	else if($password !== $password2){
		$err .= '<h2 style="color:red">Password salah!</h2>';
	}

	else if(empty($err)){
		//cek username ganda
	$result = pg_query($db,"SELECT username from users where username = '$username'");

		if(pg_fetch_assoc($result) ){
			header('location: formdaftar.php?status=sukses');		
			return true;
		}

	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	// var_dump($password); die;
	
	// buat query
  //$query = pg_query("INSERT INTO user VALUES ('$username', '$nama', '$password')");
	$query =pg_query($db, "INSERT INTO users(username, nama, password, saldo) VALUES('$username', '$nama', '$password','0')");

	//apakah query simpan berhasil?
		if( $query == TRUE ) {
			// kalau berhasil alihkan ke halaman index.php dengan status=sukses
			header('Location: index.php?status=sukses');
			} else {
			// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
			header('Location: index.php?status=gagal');
			}
	}

	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SOMA | Sign Up</title>
  	<link href="style.css" rel="stylesheet" />
	<!-- <style> label{
		display: block;
	}
	</style> -->

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
	<div class="mx-auto gambar-logo" style="position: relative; top: 60px;"><img src="./logo_soma.png" /></div>
	<div class="mx-auto logo kuning"><span class="soma">soma</span><span class="col-2 inter solusi"> | Solusi Mahasiswa</span></div>

	<div class="mx-auto paragraf ijo" style="position: relative; top: 70px;">Buat Akun Baru</div>
	<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == 'sukses'){
				echo '<h2 style="color:red">Username sudah ada!</h2>';
			}
		?>
	</p>
	<?php endif; ?>
	<p>
	<?php
    //kondisi jika tidak memenuhi username atau password
    if($err){
      echo "<ul>$err</ul><b></b>";
    }
    ?>
	</p>

	<form action="formdaftar.php" method="POST" style="position: relative; top: 60px;">

		<div class="row align-items-between" style="height: 190px;">
			<div class="col-6 offset-3 form-outline">
				<input type="text" name="nama" class="form-control pendaftaran green-bar" placeholder="Nama" required/>
			</div>
			<div class="col-6 offset-3 form-outline">
				<input type="text" name="username" class="form-control pendaftaran green-bar" placeholder="Username" required/>
			</div>
			<div class="col-6 offset-3 form-outline">
				<input type="password" name="password" class="form-control pendaftaran green-bar" placeholder="Password" required/>
			</div>
			<div class="col-6 offset-3 form-outline">
				<input type="password" name="password2" class="form-control pendaftaran green-bar" placeholder="Confirm Password" required/>
			</div>
		</div>
		<div class="d-flex mx-auto justify-contents-center" style="position: relative; top: 20px; width: 200px;">
			<button class="tombol inter ijo white-bar" name="daftar">Daftar</button>
		</div>
		
	</form>

	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>