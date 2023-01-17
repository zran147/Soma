<?php include('config.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SOMA</title>
</head>
<body>
  <h3>Welcome Admin to<br></b></h3>
  <h1>SOMA | Solusi Mahasiswa</h1>
  <h2>List User</h2>
  <table border="1">
	<thead>
		<tr>
			<!-- <th>ID User</th> -->
			<th>Username</th>
			<th>Nama</th>
			<th>Password</th>
			<th>Tindakan</th>
		</tr>
	</thead>
	<tbody>

  <?php
		$query = pg_query($db,"SELECT * FROM users Order BY nama asc ");
		// $query = pg_query($db, $sql);


		while($siswa = pg_fetch_array($query)){
			echo "<tr>";

			// echo "<td>".$siswa['id_user']."</td>";
			echo "<td>".$siswa['username']."</td>";
			echo "<td>".$siswa['nama']."</td>";
			echo "<td>".$siswa['password']."</td>";
			echo "<td>";
			echo "<a href='proseshapus.php?nama=".$siswa['nama']."'>Hapus</a>";  
			echo "</td>";
			
			echo "</tr>";

			}


		?>

	</tbody>
	</table>

	<p>Total: <?php echo pg_num_rows($query) ?></p>


 <a href="index.php">Log Out</a>
 </p>

</body>
</html>
