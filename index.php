<?php
	session_start();
	$koneksi = new mysqli("localhost","root","","onbook");
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
            background-color: #ffffff;                       #ffffff #3440A8 #FABA26 #34A853
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
            height: 560px; /* Set a fixed height for all thumbnails */
        }

        .logo-big {
            width: 60px; /* Atur lebar sesuai kebutuhan */
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
                <img class="me-2 logo-big" src="img/onbookoriginal.png" alt="onbook logo">
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

<!-- Carousel -->
<section class="myCarousel" id="myCarousel">
    <div class="myCarousel">
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="img/onbook2.png" width="300" height="150" alt="onbook Carousel">
                <hr>
            </div>
        </div>
    </div>
</section>

    <!-- Content -->
    <section class="konten">
        <div class="container">
            <h2 class="title-post">Buku Terbaru</h2>
            <div class="meta-post">
                <span><em class="glyphicon glyphicon-th-list"></em> Belanja Buku</span>&nbsp;&nbsp;
                <span><em class="glyphicon glyphicon-calendar"></em> 7 Januari 2025</span>
                <br> <br>
            </div>
            <div class="row">
                <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
                <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="Product Image">
                            <div class="caption">
                                <h3><?php echo $perproduk['nama_produk']; ?></h3>
                                <h5>Stok
                                    <?php echo ($perproduk['stok_produk'] >= 1) ? $perproduk['stok_produk'] : "<strong>Habis</strong>"; ?>
                                </h5>
                                <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
                                <?php if ($perproduk['stok_produk'] >= 1) : ?>
                                    <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
                                    <a href="detail.php?id=<?php echo $perproduk
								['id_produk']; ?>" class="btn btn-warning">Detail</a>
								<a href="keranjang.php" class="btn btn-success">Keranjang</a>
							<?php else : ?>
								<button class="btn btn-danger">Habis</button>
							<?php endif ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<!-- Footer -->
<div class="footer">
	<div class="row">
		<nav class="footer">
				<footer class="copyright text-center" style="color: white;">
    			<p>&copy; Copyright onbook Store 2025</p>
			</footer>
			</footer>
		</nav>
	</div>
</div>

</body>

</html>
