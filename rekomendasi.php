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


<!-- Awal dari Slide Show -->

 
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>

            </ol>




<!-- deklarasi carousel -->
<div class="carousel-inner" role="listbox">
    <div class="item active">
        <img src="img/bannertoko2.png" class="img-responsive center-block" alt="Banner 1">
        <div class="carousel-caption"></div>
    </div>
    <div class="item">
        <img src="img/ss1.png" class="img-responsive center-block" alt="Banner 2">
        <div class="carousel-caption">
            <h3>Toko Buku Terlengkap</h3>
            <p>Lebih dari 100 Penerbit Internasional dan Lokal</p>
        </div>
    </div>
    <div class="item">
        <img src="img/ss2.png" class="img-responsive center-block" alt="Banner 3">
        <div class="carousel-caption">
            <h3>Buku Terbaru</h3>
            <p>Pilih sendiri di Katalog Buku.</p>
        </div>
    </div>              
</div>

            <!-- membuat panah next dan previous -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
   </div>

   <!-- Akhir dari Slide Show -->




<section class="myCarousel" id="myCarousel">
        <div class="myCarousel">
            <div class="row">
                <div class="col-sm-12 text-center">
                <img src="img/grabook.png" width="500" height="109" alt="Grabook Carousel">
                <hr>
                </div>
            </div>



        <!-- Images -->
        <div class="row">
          <div class="col-sm-3 text-center">
            <a href="index.php" class="thumbnail">
              <img src="img/tb1.jpg">
              <h5>Mary Higgins C : Daddy Little Girl</h5>

            </a>
          </div>

        <div class="col-sm-3 text-center">
            <a href="index.php" class="thumbnail">
              <img src="img/tb2.jpg">
               <h5>Auguste Dupin : Detektif Prancis</h5>
            </a>
          </div>

          <div class="col-sm-3 text-center">
            <a href="index.php" class="thumbnail">
              <img src="img/tb3.jpg">
               <h5>Harry Potter and the Half Blood Prince1</h5>
            </a>
          </div>

          <div class="col-sm-3 text-center">
            <a href="index.php" class="thumbnail">
              <img src="img/tb4.jpg">
               <h5>The Hobbit : There and Back Again</h5>
            </a>
          </div>

          <div class="col-sm-3 text-center">
            <a href="index.php" class="thumbnail">
              <img src="img/tb5.jpg">
               <h5>Andrea Hirata : Laskar Pelangi</h5>
            </a>
          </div>

          <div class="col-sm-3 text-center">
            <a href="index.php" class="thumbnail">
              <img src="img/tb6.jpg">
               <h5>Agatha Christie : The Pale House</h5>
            </a>
          </div>

          <div class="col-sm-3 text-center">
            <a href="index.php" class="thumbnail">
              <img src="img/tb8.jpg">
               <h5>And Then There Were None</h5>
            </a>
          </div>  


          

        </div>
      </div>
    </section>
    <!-- End of New Book -->

<!-- Footer -->
<div class="footer">
	<div class="row">
		<nav class="footer">
				<footer class="copyright text-center" style="color: white;">
    			<p>&copy; Copyright Grabook Store 2024</p>
			</footer>
			</footer>
		</nav>
	</div>
</div>

</body>

</html>
