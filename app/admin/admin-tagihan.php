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
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo '(' . ($_SESSION['nama_akses']) . ') ' . ($_SESSION['akun_nama']);  ?></span>
            <!-- foto profil -->
            <?php
            $id = $_SESSION['akun_id'];
            $query = "SELECT * FROM pengguna WHERE id_pengguna = $id";
            $result = mysqli_query($conn, $query);
            while ($data = mysqli_fetch_array($result)) {
              if ($data['foto_pengguna'] == NULL) {
            ?>
                <img class="img-profile rounded-circle" src="../../img/none.png">
              <?php } else { ?>
                <img class="img-profile rounded-circle" src="../../img/<?php print_r($data['foto_pengguna']);  ?>">
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
      <div class="row">
        <div class="card col-12 mb-3">
          <div class="card-body">
            <h4 class="card-title">Cetak Laporan Pengeluaran</h4>
            <p class="card-text">Berisi pengeluaran yang telah terbayar (pajak, listrik, dll) yang tercatat, dan total pengeluaran</p>
            <div class="row">
              <div class="col-md-6 col-sm-12 mt-3">
                <form action="laporan/cetak-tagihan.php" target="_blank" method="POST">
                  <div class="form-row">
                    <div class="col">
                      <select name="tahun" id="tahun" required>
                        <option value="">Pilih Tahun</option>
                        <?php
                        $query = "SELECT YEAR(pembayaran.tanggal_pembayaran) AS tahun FROM pembayaran
                                    GROUP BY YEAR(pembayaran.tanggal_pembayaran)";
                        $result = mysqli_query($conn, $query);
                        while ($tahun = mysqli_fetch_array($result)) {
                        ?>
                          <option value="<?php echo $tahun['tahun']; ?>"><?php echo $tahun['tahun']; ?></option>
                        <?php } ?>
                      </select>
                      <select name="bulan" id="bulan" required>
                        <option value="">Pilih Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                    <div class="col">
                    </div>
                  </div>
                  <button class="btn btn-primary mt-2" name="cetakBulan" type="submit"><i class="fas fa-print"></i> Cetak Berdasarkan Bulan</button>
                </form>
              </div>
              <div class="col-md-6 col-sm-12 mt-3">
                <form action="laporan/cetak-tagihan.php" target="_blank" method="POST">
                  <div class="form-row">
                    <div class="col">
                      <select name="tahun" id="tahun" required>
                        <option value="">Pilih Tahun</option>
                        <?php
                        $query = "SELECT YEAR(pembayaran.tanggal_pembayaran) AS tahun FROM pembayaran
                                    GROUP BY YEAR(pembayaran.tanggal_pembayaran)";
                        $result = mysqli_query($conn, $query);
                        while ($tahun = mysqli_fetch_array($result)) {
                        ?>
                          <option value="<?php echo $tahun['tahun']; ?>"><?php echo $tahun['tahun']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <button class="btn btn-primary mt-2" name="cetakTahun" type="submit"><i class="fas fa-print"></i> Cetak Berdasarkan Tahun</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
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
                  HAVING SUM(pembayaran.nilai_pembayaran)";
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
                    HAVING SUM(pembayaran.nilai_pembayaran)";
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
            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
          }
        }
      }
    }
  });
</script>
</body>

</html>