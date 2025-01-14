<?php
	session_start();
	$koneksi = new mysqli("localhost","root","","onbook");

//jika belum masuk/login
	if (!isset($_SESSION['pelanggan'])) {
		echo "<script> alert('Login Terlebih Dahulu, Klik Ok Untuk Melanjutkan Login'); </script>";
		echo "<script> location='login.php' </script>";
	}

//keranjang kosong
	if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
		echo "<script> alert('Keranjang Belanja Kosong, Silahkan Berbelanja'); </script>";
		echo "<script> location='index.php'; </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <style>
        /* Tambahkan CSS kustom di sini */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #3440A8;
        }
        h1, h2, h3, h4, h5, h6 {
            color: #3440A8;
        }
        .navbar, .footer {
            background-color: #3440A8;
            padding: 15px 0;
            border-radius: 10px; /* Rounded corners */
        }
        .navbar-nav > li > a {
            color: white !important;
            font-size: 15px;
        }
        .navbar-nav > li > a:hover {
            color: #FABA26 !important;
        }
        .btn-primary {
            background-color: #3440A8;
            border-color: #3440A8;
            color: white;
        }
        .btn-warning {
            background-color: #FABA26;
            border-color: #FABA26;
            color: #3440A8;
        }
        .btn-success {
            background-color: #34A853;
            border-color: #34A853;
            color: white;
        }
        .btn-danger {
            background-color: #EA4335;
            border-color: #EA4335;
            color: white;
        }
        .thumbnail {
            height: 420px; /* Set a fixed height for all thumbnails */
        }
        .logo-big {
            width: 250px; /* Atur lebar sesuai kebutuhan */
            height: auto; /* Menjaga rasio aspek gambar */
            margin-bottom: 0; /* Mengatur margin bawah jika perlu */
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: #212529;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img class="me-2 logo-big" src="img/grab.png" alt="">
            </a>
        </div>
        <ul class="nav navbar-nav">
            <!-- Jika Sudah Login -->
            <?php if (isset($_SESSION['pelanggan'])): ?>
                <li><a href="logout.php" onclick="return confirm('Apakah Anda Yakin ?')" style="color: white;">Logout</a></li>
                <li><a href="riwayat.php" style="color: white;">Riwayat</a></li>
            <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if (!isset($_SESSION['pelanggan'])): ?>
                <li>
                    <a href="login.php" class="btn btn-primary custom-button">Login</a>
                </li>
                <li><a href="daftar.php" style="color: white;">Daftar</a></li>
            <?php endif; ?>	
            <li><a href="index.php" style="color:white;">Belanja</a></li>
            <?php if(!isset($_SESSION["keranjang"])) : ?>
                <li><a href="keranjang.php" style="color:white;">Keranjang<strong>(0)</strong></a></li>
            <?php else : ?>
                <hide>
                    <?php $jml=0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                        <!-- Menampilkan Produk Perulangan Berdasarkan id_produk-->
                        <?php $ambildata = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
                        <?php $pecah = $ambildata->fetch_assoc(); ?>
                        <tr>
                            <td><?php $jumlah ?></td>
                        </tr>
                        <?php $jml += $jumlah; ?>
                    <?php endforeach ?>
                </hide>
                <li><a href="rekomendasi.php" style="color: white;">Rekomendasi</a></li>
                <li><a href="keranjang.php" style="color: white;">Keranjang<strong>(<?php echo $jml ?>)</strong></a></li>
            <?php endif ?>
            <li><a href="bayar.php" style="color:white;" >Pembayaran</a></li>
        </ul>
        <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <input type="text" name="keyword" class="form-control" placeholder="Pencarian">
            <button class="btn btn-primary custom-button">Cari</button>
        </form>
    </div>
</nav>

		<!-- konten -->
	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered ">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total Belanja</th>
					</tr>
				</thead>

				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja=0; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
					<!-- Menampilkan Produk Perulangan Berdasarkan id_produk-->
					<?php $ambildata = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
					<?php $pecah = $ambildata->fetch_assoc(); ?>
					<?php $subharga = $pecah['harga_produk']*$jumlah; ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
						<td><?php echo $jumlah ?></td>
						<td>Rp. <?php echo number_format($subharga); ?></td>
					</tr>
					<?php $nomor++; ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php endforeach ?>
				</tbody>

				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja); ?></th>
					</tr>
				</tfoot>
			</table>

			<form method="post">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Gmail</label>
							<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['gmail_pelanggan']; ?>" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Nomor Telepon</label>
							<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jasa Pengiriman</label>
							<select class="form-control" name="id_kurir" required="">
								<option value="">Pilih Jasa Antar</option>
								<?php 
									$ambil = $koneksi->query("SELECT * FROM kurir");
									while($kurir = $ambil->fetch_assoc()) {
								?>
								<option value="<?php echo $kurir['id_kurir']; ?>">
									<?php echo $kurir['nama_kurir'] ?> - 
									Rp. <?php echo number_format($kurir['tarif']) ?>	
								</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Total</label>
							<input type="text" readonly="" value="Rp. <?php echo number_format($totalbelanja+$kurir); ?>" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea class="form-control" rows="5" placeholder="Masukkan Alamat Lengkap Anda" name="alamat_pengiriman" required=""></textarea>
				</div>

				<button class="btn btn-primary" name="bayar">Bayar</button>
			</form>

			<?php 
				if (isset($_POST['bayar'])) {
					$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
					$id_kurir = $_POST['id_kurir'];
					$tanggal_pembelian = date('Y-m-d');
					$alamat_pengiriman = $_POST['alamat_pengiriman'];

					$ambil = $koneksi->query("SELECT * FROM kurir WHERE id_kurir='$id_kurir'");
					$arraykurir = $ambil->fetch_assoc();
					$nama_kurir = $arraykurir['nama_kurir'];
					$kurir = $arraykurir['tarif'];

					$total_pembelian = $totalbelanja+$kurir;

					//1. Menyimpan data ke tabel pembelian
					$koneksi->query("INSERT INTO pembelian (id_pelanggan,id_kurir,tanggal_pembelian,total_pembelian, nama_kurir,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_kurir', '$tanggal_pembelian',
						'$total_pembelian','$nama_kurir','$kurir','$alamat_pengiriman')");

					//2. Menyimpan data pembelian ke tabel pembelian produk
					//mendapatkan id pembelian barusan terjadi
					$id_pembelian_barusan = $koneksi->insert_id;

					//menyimpan 
					foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
						$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah_pembelian) VALUES ('$id_pembelian_barusan','$id_produk', '$jumlah') ");

						//mengurangi stok yang dibeli
						$koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk = '$id_produk'");
					}

					//mengkosongkan keranjang belanjaan
					unset($_SESSION['keranjang']);

					//tampilan dialihkan kehalaman nota, nota pembelian barusan
					echo "<script> alert('Pembelian Sukses'); </script>";
					echo "<script> location='nota.php?id=$id_pembelian_barusan'; </script>";

				}

			?>

		</div>
	</section>

<script type="text/javascript" src="admin/assets/js/jquery-3.3.1.min.js"></script>

</body>
</html>
