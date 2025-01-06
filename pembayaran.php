<?php 
	session_start();
	$koneksi = new mysqli("localhost","root","","onbook");

	//jika tidak ada session pelanggan maka tidak bisa diakses
	if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
	echo "<script> alert('Silahkan Login Terlebih Dahulu'); </script>";
	echo "<script> location='login.php' </script>";
	exit();
	}

	//mendapatkan id dari url
	$id_pem = $_GET['id'];
	$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pem'");
	$detpem = $ambil->fetch_assoc();

	//mendapatkan id pelanggan yang beli
	$id_pelanggan_beli = $detpem['id_pelanggan'];
	//mendapatkan id pelanggan yang login
	$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

	if ($id_pelanggan_login !== $id_pelanggan_beli) {
		echo "<script> alert('Tidak Dapat Mengakses'); </script>";
		echo "<script> location='riwayat.php' </script>";
		exit();

	}

		// echo "<pre>";
		// print_r($detpem);
		// print_r($_SESSION);
		// echo "</pre>";
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

		<div class="container">
			<h2>Konfirmasi Pembayaran</h2>
			<p>Kirim Bukti Pembayaran Anda Disini</p>
			<div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem['total_pembelian']); ?></strong></div>

			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama Penyetor</label>
					<input type="text" name="nama" class="form-control" required="" placeholder="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>">
				</div>
				<div class="form-group">
					<label>Bank</label>
					<input type="text" name="bank" class="form-control" required="">
				</div>
				<div class="form-group">
					<label>Jumlah (Rp.)</label>
					<input type="number" name="jumlah" class="form-control" min="1" required="" placeholder="<?php echo $detpem['total_pembelian']; ?>">
				</div>
				<div class="form-group">
					<label>Foto Bukti</label>
					<input type="file" name="bukti" class="form-control" required="">
					<p class="text-danger">Format Foto Bukti JPG Maksimal 2MB</p>
				</div>
				<button class="btn btn-primary" name="kirim">Kirim</button>
			</form>
		</div>

		<?php 
		if (isset($_POST['kirim'])) {
			
			//upload foto bukti
			$namabukti = $_FILES['bukti']['name'];
			$lokasibukti = $_FILES['bukti']['tmp_name'];
			//agar tidak sama fotonya
			$namafiks = date('YmdHis').$namabukti;
			//lokasi foto
			move_uploaded_file($lokasibukti, "bukti_pembayaran/".$namafiks);

			$tanggal = date('Y-m-d');

			$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
				VALUES ('$id_pem','$_POST[nama]','$_POST[bank]','$_POST[jumlah]','$tanggal','$namafiks') ");

			//update data pembelian dari pending menjadi sudah kirim pembayaran
			$koneksi->query("UPDATE pembelian SET status_pembelian = 'Proses' WHERE id_pembelian='$id_pem'");
			echo "<script> alert('Terima Kasih Sudah Memberikan Bukti Pembayaran'); </script>";
			echo "<script> location='riwayat.php' </script>";
			exit();
		}
		?>

</body>
</html>

