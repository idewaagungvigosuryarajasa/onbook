<?php
$koneksi = new mysqli("localhost", "root", "", "onbook");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Home - onbook Store</title>
  <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body>
  <!-- Bootstrap -->
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="assets/style.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
      color: #3440A8;
    }

    h2 {
      color: #3440A8;
      font-weight: bold;
    }

    .headerBackground {
      width: 100%;
      height: 250px;
      background: url(img/background.jpg);
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #header {
      background: #212529;
      width: 100%;
      height: 250px;
    }

    .logo {
      width: 600px;
      height: auto;
    }

    .container {
      border-radius: 10px;
      background-color: #f2f2f2;
      padding: 20px;
      margin-bottom: 20px;
      width: 80%;
      margin-left: 0;
      margin-right: auto;
    }

    .section {
      margin-bottom: 20px;
    }

    .section h3 {
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

    .btn-warning,
    .btn-danger {
      border-color: #FABA26;
    }

    .btn-warning:hover,
    .btn-danger:hover {
      background-color: #FABA26;
      border-color: #FABA26;
      color: #3440A8;
    }
  </style>



  <div class="container">
    <h2>Selamat Datang <strong><?php echo $_SESSION['admin']['nama_lengkap']; ?></strong></h2>
    <div id="header">
      <div class="headerBackground">
        <h1>
          <img src="../img/onbook1.png" alt="Grabook Store" class="logo">
        </h1>
      </div>
    </div>
  </div>
</body>

</html>