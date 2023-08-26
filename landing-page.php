<?php
include 'actions/koneksi.php';
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- leaflet css -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
  <!-- custom css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway&display=swap" rel="stylesheet">
  <!-- fontawesome icon -->
  <script src="https://kit.fontawesome.com/9afba118d6.js" crossorigin="anonymous"></script>
  <title>TIGA PUTRI | Landing Page</title>
</head>

<body>
  <!-- navbar -->
  <header id="header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#">KOSAN TIGA PUTRI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-item btn btn-light tombol tombol-nav" href="pages/sign-up.php" tabindex="-1" aria-disabled="true">Daftar</a>
            <a class="nav-item btn btn-light tombol tombol-nav" href="pages/sign-in.php" tabindex="-1" aria-disabled="true">Masuk</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- navbar end -->
  <main>
    <?php
    $query = "SELECT * FROM info_kost";
    $result = mysqli_query($conn, $query);
    while ($data = mysqli_fetch_array($result)) {
    ?>
      <!-- jumbotron -->
      <div class="jumbotron jumbotron-atas jumbotron-fluid" id="jumbotron">
        <div class="container banner-tittle">
          <h3>WELCOME</h3>
          <h1 class="display-4 text-uppercase">RUMAH <?php echo $data['nama_kost']; ?></h1>
          <p class="lead"><?php echo $data['deskripsi_kost']; ?></p>
          <a href="pages/kamar-tersedia.php" class="btn up-1 btn-gradient">Cek Ketersediaan Kamar</a>
        </div>
      </div>
      <!-- jumbotron -->
    <?php } ?>
    <!-- footer -->
    <footer>
      <!-- footer atas -->
      <div class="row footer-bawah pt-3 pl-3 mt-3">
        <p class="text-muted">Powered by TeknoTirta</p>
      </div>
      <!-- akhir footer atas -->
    </footer>
    <div class="button-up">
      <i class="fas fa-arrow-circle-up"></i>
    </div>
  </main>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

</body>

</html>