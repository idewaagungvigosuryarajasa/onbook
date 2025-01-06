<?php 
	session_start();
	$koneksi = new mysqli("localhost","root","","onbook");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<style>
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
                    <a href="login.php" class="btn btn-primary custom-button" style="padding:6px; margin-top : 7px">Login</a>
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

</div>
<br><br><br>
<div class="container" 
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border-radius: 15px;">
                <div class="panel-heading" style="background-color: #FABA26; border-radius: 15px 15px 0 0;">
                    <h2 class="panel-title" style="color: #3440A8; font-size: 24px; padding: 15px;">Login</h2>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label style="color: #3440A8;">Email</label>
                            <input type="email" name="gmail" class="form-control">
                        </div>
                        <div class="form-group">
                            <label style="color: #3440A8;">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button class="btn btn-primary" name="login">Login</button>
                        <a href="daftar.php" class="btn btn-warning" name="daftar">Daftar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
	if (isset($_POST["login"])) {
		$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE gmail_pelanggan='$_POST[gmail]' AND password_pelanggan='$_POST[password]'");
		$akunyangcocok = $ambil->num_rows;
		if ($akunyangcocok==1) {
			$_SESSION['pelanggan'] = $ambil->fetch_assoc();
			echo "<script> alert('Login Berhasil'); </script>";
			echo "<script> location='index.php'; </script>";
		} else {
			echo "<script> alert('Login Gagal, Tekan Ok Untuk Coba Lagi'); </script>";
			echo "<script> location='login.php'; </script>";
		}
	}
?>