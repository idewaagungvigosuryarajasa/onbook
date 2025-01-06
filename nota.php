<?php 
	session_start();
?>
<?php
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

	<section class="konten">
		<div class="container">
			<h2>Detail Pembelian</h2>
			<?php  
				$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail=$ambil->fetch_assoc();
			?>

			<?php 
			//mendapatkan id yang beli
			$idpelangganyangbeli = $detail['id_pelanggan'];

			//mendapatkan id pelanggan yang login
			$idpelangganyanglogin = $_SESSION['pelanggan']['id_pelanggan'];

			if ($idpelangganyangbeli!==$idpelangganyanglogin) {
				echo "<script> alert('Gagal');</script>";
				echo "<script> location='riwayat .php'; </script>";
			}
			?>


			<p>
				Kode Pembelian : <strong>H-<?php echo $detail['id_pembelian']; ?>-S</strong><br>
				Tanggal Pembelian : <?php echo $detail['tanggal_pembelian']; ?> <br>
				Harga Pembelian : Rp. <?php echo number_format($detail['total_pembelian'])?>
			</p>
			<div class="row">
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong><?php echo $detail['nama_pelanggan']?></strong>
					<p>Nomor Telepon :  <?php echo $detail['telepon_pelanggan']?><br>Gmail : <?php echo $detail['gmail_pelanggan']; ?>
					</p>	
				</div>
				<div class="col-md-4">
					<h3>Pengirim</h3>
					<strong><?php echo $detail['nama_kurir']; ?></strong>
					<p>Tarif : Rp. <?php echo number_format($detail['tarif']); ?></p>
				</div>
				<div class="col-md-4">
					<h3>Alamat Pengiriman</h3>
					<strong><?php echo $detail['alamat_pengiriman']; ?></strong>
				</div>
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
				</thead>

				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja=0;?>
					<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
					<?php while($pecah=$ambil->fetch_assoc()) { ?>
						<?php $subharga =  $pecah['harga_produk']*$pecah['jumlah_pembelian']; ?>
					<tr>
						<td> <?php echo $nomor; ?></td>
						<td> <?php echo $pecah['nama_produk']; ?></td>
						<td> Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
						<td> <?php echo $pecah['jumlah_pembelian']; ?></td>
						<td> Rp. <?php echo number_format($subharga); ?></td>
					</tr>
					<?php $nomor++ ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php } ?>
				</tbody>


				<tfoot>
					<tr>
						<th colspan="4">Tarif</th>
						<td>Rp. <?php echo number_format($detail['tarif']); ?></td>
					</tr>
					<tr>
						<th colspan="4">TOTAL</th>
						<th>Rp. <?php echo number_format($totalbelanja+$detail['tarif']); ?></th>
					</tr>
				</tfoot>

			</table>

			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-info">
						<p>
							Silahkan melakukan Pembayaran <strong>Rp. <?php echo number_format($detail['total_pembelian'])?></strong>
							Ke <br>
							<strong>BANK BCA 71-231-000 AN. NATA YORDAN</strong>
							
						</p>
					</div>
				</div>
			</div>

		</div>
	</section>

</body>
</html>