<?php
require '1side.php';
?>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo '(' . ($_SESSION['nama_akses']) . ') ' . ($_SESSION['akun_nama']); ?></span>
            <!-- foto profil -->
            <?php
            $id = $_SESSION['akun_id'];
            $query = "SELECT * FROM pengguna WHERE id_pengguna = $id";
            $result = mysqli_query($conn, $query);
            while ($data = mysqli_fetch_array($result)) {
              if ($data['foto_pengguna'] == null) {
            ?>
                <img class="img-profile rounded-circle" src="../../img/none.png">
              <?php } else { ?>
                <img class="img-profile rounded-circle" src="../../img/<?php print_r($data['foto_pengguna']); ?>">
            <?php
              }
            }
            ?>
            <!-- foto profil -->
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="admin-settings-profil.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="admin-settings-infokost.php">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      </div>
      <div class="row">
        <?php
        $query = "SELECT pembayaran.id_pembayaran , SUM(pembayaran.nilai_pembayaran) as pendapatan_bulan, MONTH(pembayaran.tanggal_pembayaran) bulan, DATE_FORMAT(CURRENT_DATE, '%M %Y') bulan_sekarang
                FROM pembayaran
                  WHERE
                    pembayaran.id_status = 1 AND
                      MONTH(pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE)
                      GROUP BY MONTH(pembayaran.tanggal_pembayaran)
                      HAVING SUM(pembayaran.nilai_pembayaran)
                      LIMIT 12";
        $result = mysqli_query($conn, $query);
        $data_bulan = mysqli_fetch_array($result);
        ?>
        <?php
        $query = "SELECT pembayaran.id_pembayaran , SUM(pembayaran.nilai_pembayaran) as pendapatan_tahun, YEAR(pembayaran.tanggal_pembayaran) bulan, DATE_FORMAT(CURRENT_DATE, '%Y') tahun_sekarang
                FROM pembayaran
                  WHERE
                    pembayaran.id_status = 1 AND
                      YEAR(pembayaran.tanggal_pembayaran) = YEAR(CURRENT_DATE)
                      GROUP BY YEAR(pembayaran.tanggal_pembayaran)
                      HAVING SUM(pembayaran.nilai_pembayaran)
                      LIMIT 12";
        $result = mysqli_query($conn, $query);
        $data_tahun = mysqli_fetch_array($result);
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <a href="admin-penghuni.php" class="stretched-link"></a>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penghuni</div>
                  <?php
                  $query = "SELECT COUNT(pengguna.nama_pengguna) total_penghuni FROM pengguna
                        WHERE pengguna.id_akses = 2";
                  $result = mysqli_query($conn, $query);
                  $data_penghuni = mysqli_fetch_array($result);
                  ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php echo $data_penghuni['total_penghuni']; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <a href="admin-kamar.php" class="stretched-link"></a>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Kamar</div>
                  <?php
                  $query_kamar = "SELECT COUNT(id_kamar) total_kamar FROM kamar";
                  $result_kamar = mysqli_query($conn, $query_kamar);
                  $data_kamar = mysqli_fetch_array($result_kamar);
                  ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php echo $data_kamar['total_kamar']; ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-campground fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <a href="admin-pemasukan.php" class="stretched-link"></a>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pembayaran Pending</div>
                  <?php
                  $query = "SELECT COUNT(pengguna.nama_pengguna) AS belum_dikonfirmasi
                        FROM pengguna
                          INNER JOIN menghuni ON pengguna.id_pengguna = menghuni.id_pengguna
                          INNER JOIN pembayaran ON pembayaran.id_menghuni = menghuni.id_menghuni
                          WHERE
                            pembayaran.id_status = 2";
                  $result = mysqli_query($conn, $query);
                  $data_penghuni = mysqli_fetch_array($result);
                  ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_penghuni['belum_dikonfirmasi']; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <a href="admin-booking.php" class="stretched-link"></a>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Booking Kamar</div>
                  <?php
                  $query_booking = "SELECT COUNT(id_booking) total_booking FROM booking";
                  $result_booking = mysqli_query($conn, $query_booking);
                  $data_booking = mysqli_fetch_array($result_booking);
                  ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php echo $data_booking['total_booking']; ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-key fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pending Requests Card Example -->
      </div>
      <!-- Content Row -->
      <div class="row">
        <div class="col-xl-8 col-lg-7">
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pendapatan Tiap Bulan</h6>
            </div>
            <div class="card-body">
              <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
              </div>
              <hr>
              <span class="text-danger">Data pendapatan rumah kost anda tiap bulan</span>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-5">
          <!-- Basic Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pembayaran Kamar Terbaru</h6>
            </div>
            <div class="card-body">
              <?php
              $query = "SELECT pengguna.nama_pengguna, pembayaran.nilai_pembayaran, pembayaran.tanggal_pembayaran, pengguna.foto_pengguna
                    FROM pengguna, pembayaran, menghuni
                      WHERE
                        pengguna.id_pengguna = menghuni.id_pengguna AND
                          menghuni.id_menghuni = pembayaran.id_menghuni AND
                          pembayaran.id_status = 1
                          ORDER BY pembayaran.tanggal_pembayaran DESC
                          LIMIT 5";
              $hasil = mysqli_query($conn, $query);
              while ($pembayaran_terbaru = mysqli_fetch_array($hasil)) {
              ?>
                <div class="row">
                  <div class="col-2">
                    <?php if ($pembayaran_terbaru['foto_pengguna'] == null) { ?>
                      <img class="rounded-circle mt-1" width="40px" height="40px" src="../../img/profile-img-none.png" alt="">
                    <?php } else { ?>
                      <img class="rounded-circle mt-1" width="40px" height="40px" src="../../img/<?php echo $pembayaran_terbaru['foto_pengguna']; ?>" alt="">
                    <?php } ?>
                  </div>
                  <div class="col-10">
                    <h3 class="h6 font-weight-bolder text-dark"><?php echo $pembayaran_terbaru['nama_pengguna']; ?></h3>
                    <p class="text-muted">Rp <?php echo number_format($pembayaran_terbaru['nilai_pembayaran']); ?></p>
                  </div>
                </div>
              <?php } ?>
              <a href="admin-pemasukan.php" class="btn btn-outline-primary btn-block">Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; Tiga Putri 2023</span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->
  </div>
  <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar Aplikasi?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Logout" dibawah jika anda ingin mengakhiri sesi.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="../../actions/process-logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="../../vendor/chart.js/Chart.min.js"></script>
<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito',
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }
  // Area Chart Example
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        <?php
        $query = "SELECT SUM(pembayaran.nilai_pembayaran) AS pendapatan_bulanan, DATE_FORMAT(pembayaran.tanggal_pembayaran, '%M %Y') AS bulan
            FROM pembayaran
              WHERE
                pembayaran.id_status = 1
                  GROUP BY MONTH(pembayaran.tanggal_pembayaran)
                  HAVING SUM(pembayaran.nilai_pembayaran)
                  ORDER BY pembayaran.tanggal_pembayaran ASC";
        $hasil = mysqli_query($conn, $query);
        while ($data_bulanan = mysqli_fetch_array($hasil)) {
          echo "'" . $data_bulanan['bulan'] . "'" . ", ";
        }
        ?>
      ],
      datasets: [{
        label: "Pendapatan",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [
          <?php
          $query = "SELECT SUM(pembayaran.nilai_pembayaran) AS pendapatan_bulanan, MONTH  (pembayaran.tanggal_pembayaran) AS bulan
              FROM pembayaran
                WHERE
                  pembayaran.id_status = 1
                    GROUP BY MONTH(pembayaran.tanggal_pembayaran)
                    HAVING SUM(pembayaran.nilai_pembayaran)
                    ORDER BY pembayaran.tanggal_pembayaran ASC";
          $hasil = mysqli_query($conn, $query);
          while ($data_bulanan = mysqli_fetch_array($hasil)) {
            echo $data_bulanan['pendapatan_bulanan'] . ', ';
          }
          ?>
        ],
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 7
          }
        }],
        yAxes: [{
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return 'Rp ' + number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
          }
        }
      }
    }
  });
</script>
</body>

</html>