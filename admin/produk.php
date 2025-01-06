<!DOCTYPE html>
<html>

<head>
	<title>Data Buku</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
		rel="stylesheet">
	<style>
		body {
			font-family: 'Poppins', sans-serif;
			background-color: #ffffff;
			color: #3440A8;
		}

		h2 {
			color: #3440A8;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		th,
		td {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		th {
			background-color: #3440A8;
			color: #ffffff;
		}

		td {
			background-color: #ffffff;
		}

		.btn-primary {
			background-color: #3440A8;
			border-color: #3440A8;
			color: #ffffff;
		}

		.btn-primary:hover {
			background-color: #FABA26;
			border-color: #FABA26;
			color: #3440A8;
		}

		.btn-warning {
			background-color: #FABA26;
			border-color: #FABA26;
			color: #ffffff;
		}

		.btn-danger {
			background-color: #F8192E;
			border-color: #F8192E;
			color: #ffffff;
		}

		.btn-warning:hover,
		.btn-danger:hover {
			background-color: #FABA26;
			border-color: #FABA26;
			color: #3440A8;
		}

		#container {
			border-radius: 10px;
			background-color: #f2f2f2;
			padding: 20px;
			margin-bottom: 20px;
		}
	</style>
</head>

<body>
	<div id="container">
		<h2>Data Buku</h2>
		<div style="color: white; padding: 15px 10px 5px 50px; float: right; font-size: 16px;">
			<a href="index.php?hal=tambahproduk" class="btn btn-primary">Tambah Data</a>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Harga (Rp)</th>
					<th>Berat (Gr)</th>
					<th>Foto</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor = 1; ?>
				<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
				<?php while ($pecah = $ambil->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td><?php echo $pecah['harga_produk']; ?></td>
						<td><?php echo $pecah['berat_produk']; ?></td>
						<td><img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100"></td>
						<td>
							<a href="index.php?hal=ubahproduk&id=<?php echo $pecah['id_produk']; ?>"
								class="btn-warning btn">Ubah</a>
							<a href="index.php?hal=hapusproduk&id=<?php echo $pecah['id_produk']; ?>"
								class="btn-danger btn">Hapus</a>
						</td>
					</tr>
					<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>

</html>