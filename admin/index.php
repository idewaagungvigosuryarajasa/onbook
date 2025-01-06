<?php
// Account dimasukkan ke dalam session
session_start();

$koneksi = new mysqli("localhost", "root", "", "onbook");

// Harus login
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda Belum Login, Silahkan Tekan Ok Untuk Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES (CDN)-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            color: #3440A8;
        }

        .navbar {
            background-color: ##212529;
            color: white;
            border-radius: 20px;
        }

        .navbar-brand {
            background: none;
            color: white;
            font-size: 20px;
            padding: 15px;
        }

        .navbar-brand:hover {
            color: #FABA26;
        }

        .navbar-nav>li>a {
            color: white;
            font-size: 16px;
            border-radius: 20px;
        }

        .navbar-nav>li>a:hover {
            background-color: #FABA26;
            color: #3440A8;
        }

        .navbar-toggle {
            background-color: #FABA26;
        }

        .navbar-toggle:hover {
            background-color: #FABA26;
        }

        .navbar-toggle .icon-bar {
            background-color: #3440A8;
        }

        .sidebar-collapse {
            background: #3440A8;
            color: white;
            border-radius: 0px;
        }

        .nav>li>a:hover,
        .nav>li>a:focus {
            background-color: #FABA26;
        }

        .user-image {
            border-radius: 50%;
        }

        .sidebar-collapse .nav>li>a {
            color: white;
            font-size: 16px;
            border-radius: 25px;
            /* Pastikan sudut tidak membulat */
            font-family: 'Poppins', sans-serif;
            /* Tambahkan font-family */
            font-weight: normal;
            /* Pastikan semua teks memiliki font-weight yang sama */
        }

        .sidebar-collapse .nav>li>a:hover,
        .sidebar-collapse .nav>li>a:focus,
        .sidebar-collapse .nav>li.active>a {
            background-color: #FABA26;
            color: #3440A8;
            border-radius: 25px;
            /* Pastikan sudut tidak membulat */
            font-family: 'Poppins', sans-serif;
            /* Tambahkan font-family */
            font-weight: normal;
            /* Pastikan semua teks memiliki font-weight yang sama */
        }


        #page-inner {
            border-radius: 20px;
            background-color: white;
            padding: 20px;
            margin-top: 20px;
        }

        .btn-danger.square-btn-adjust {
            background-color: #FABA26;
            color: #3440A8;
            border-radius: 20px;
            font-size: 16px;
        }

        .btn-danger.square-btn-adjust:hover {
            background-color: #FABA26;
            color: #3440A8;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="background: #212529;">
                    <img src="../img/onbookoriginal.png" alt="onbook logo" style="width: 30px; height: auto;">
                </a>
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                <a href="index.php?hal=logout" class="btn btn-danger square-btn-adjust">Logout</a>
            </div>

        </nav>

        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side " role="navigation">
            <div class="sidebar-collapse" style="background: #3440A8; color: white">
                <ul class="nav" id="main-menu">
                    <li class="text-center">

                    </li>
                    <li><a href="index.php"><i class="fa fa-home"></i> Admin</a></li>
                    <li><a href="index.php?hal=produk"><i class="fa fa-book"></i> Buku</a></li>
                    <li><a href="index.php?hal=pembeli"><i class="fa fa-shopping-cart"></i> Pembeli</a></li>
                    <li><a href="index.php?hal=pelanggan"><i class="fa fa-user"></i> Pelanggan</a></li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                if (isset($_GET['hal'])) {
                    if ($_GET['hal'] == "produk") {
                        include 'produk.php';
                    } elseif ($_GET['hal'] == "pembeli") {
                        include 'pembeli.php';
                    } elseif ($_GET['hal'] == "pelanggan") {
                        include 'pelanggan.php';
                    } elseif ($_GET['hal'] == "hapuspelanggan") {
                        include 'hapuspelanggan.php';
                    } elseif ($_GET['hal'] == "ubahpelanggan") {
                        include 'ubahpelanggan.php';
                    } elseif ($_GET['hal'] == "detail") {
                        include 'detail.php';
                    } elseif ($_GET['hal'] == "tambahproduk") {
                        include 'tambahproduk.php';
                    } elseif ($_GET['hal'] == "hapusproduk") {
                        include 'hapusproduk.php';
                    } elseif ($_GET['hal'] == "ubahproduk") {
                        include 'ubahproduk.php';
                    } elseif ($_GET['hal'] == "logout") {
                        include 'logout.php';
                    } elseif ($_GET['hal'] == "pembayaran") {
                        include 'pembayaran.php';
                    } elseif ($_GET['hal'] == "laporan_pembelian") {
                        include 'laporan_pembelian.php';
                    }
                } else {
                    include 'home.php';
                }
                ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>

</html>