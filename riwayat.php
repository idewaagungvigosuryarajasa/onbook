<?php session_start(); ?>
<?php $koneksi = new mysqli("localhost","root","","onbook"); ?>
<?php 
//jika tidak ada session pelanggan maka tidak bisa diakses
if (!isset($_SESSION['pelanggan'])) {
	echo "<script> alert('Silahkan Login Terlebih Dahulu'); </script>";
	echo "<script> location='login.php' </script>";
	exit();
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
		<!-- section -->
		<section class="riwayat">
			<div class="container">
			<h3><span> Riwayat Pembelian <?php echo $_SESSION['pelanggan']['nama_pelanggan'];?></span>&nbsp;&nbsp;</h3>

			<span><em class="glyphicon glyphicon-folder-open"></em>&nbsp; Riwayat Belanja</span>&nbsp;&nbsp;
                  <span><em class="glyphicon glyphicon-calendar"></em> 7 Juni 2020</span>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pembelian</th>
							<th>Status Pembelian</th>
							<th>Total</th>
							<th>Keterangan</th>
						</tr>
					</thead>

					<tbody>
						<?php $nomor=1; ?>
						<?php 
						//mendapatkan id yang login
						$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
						//ambil dan pecahkan
						$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
						while($pecah = $ambil->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['tanggal_pembelian']; ?></td>
							<td><?php echo $pecah['status_pembelian']; ?>
								<br>
								<?php if(!empty($pecah['resi_pengiriman'])): ?>
								No.Resi <?php echo $pecah['resi_pengiriman']; ?>
								<?php endif  ?>
							</td>
							<td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
							<td>
								<a href="nota.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-warning">Nota</a>
								
								<?php if($pecah['status_pembelian']=='Tertunda'): ?>
									<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-success">Pembayaran</a>
									<?php else: ?>
										<!-- <a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-warning">Lihat</a> -->
								<?php endif ?>
							</td>
						</tr>
						<?php $nomor++ ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</section>

</body>
</html>
