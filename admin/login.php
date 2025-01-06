<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "onbook");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Admin</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #3440A8;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #3440A8;
        }

        .navbar,
        .footer {
            background-color: #3440A8;
            padding: 15px 0;
            border-radius: 10px;
        }

        .navbar-nav>li>a {
            color: white !important;
            font-size: 15px;
        }

        .navbar-nav>li>a:hover {
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
            height: 420px;
        }

        .logo-big {
            width: 45px;
            /* Adjust the width to make the logo bigger */
            height: auto;
            margin-bottom: 0;
        }

        .navbar-header {
            width: 100%;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #212529;">
        <div class="container-fluid">
            <div class="navbar-header">
                <img class="logo-big" src="../img/onbookoriginal.png" alt="Logo">
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="border-radius: 15px;">
                    <div class="panel-heading" style="background-color: #FABA26; border-radius: 15px 15px 0 0;">
                        <h2 class="panel-title" style="color: #3440A8; font-size: 24px; padding: 15px;">Login Admin</h2>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["login"])) {
        $gmail = $_POST['gmail'];
        $password = $_POST['password'];

        $query = "SELECT * FROM admin WHERE username='$gmail' AND password='$password'";
        $result = $koneksi->query($query);

        if ($result->num_rows == 1) {
            $_SESSION['admin'] = $result->fetch_assoc();
            echo "<script> alert('Login Berhasil'); </script>";
            header("Location: index.php"); // Redirect to index.php
            exit(); // Ensure no more output is sent
        } else {
            echo "<script> alert('Login Gagal, Tekan Ok Untuk Coba Lagi'); </script>";
        }
    }
    ?>
</body>

</html>