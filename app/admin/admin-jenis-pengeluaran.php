<?php

include '../../actions/koneksi.php';
ob_start();
session_start();

if (!isset($_SESSION['akun_id'])) {
  header("location: ../../landing-page.php");
} elseif (isset($_SESSION['akun_id'])) {
  if ($_SESSION['hak_akses'] == 2) {
    header("location: ../penghuni/penghuni-dashboard.php");
  } elseif ($_SESSION['hak_akses'] == 3) {
    header("location: ../calon-penghuni/calon-dashboard.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Master Jenis Pengeluaran</title>

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Indiekost</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="admin-dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengelolaan
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="admin-penghuni.php">
          <i class="fas fa-fw fa-user-friends"></i>
          <span>Penghuni</span></a>
      </li>

      <!-- Nav Item - Kamar Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKamar" aria-expanded="true" aria-controls="collapseKamar">
          <i class="fas fa-fw fa-bed"></i>
          <span>Kamar</span>
        </a>
        <div id="collapseKamar" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="admin-booking.php">Booking Kamar</a>
            <a class="collapse-item" href="admin-kamar.php">Data Kamar</a>
            <a class="collapse-item" href="admin-kamar-menghuni.php">Menghuni</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-money-bill"></i>
          <span>Pembayaran</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="admin-pemasukan.php">Pemasukan</a>
            <a class="collapse-item" href="admin-pengeluaran.php">Pengeluaran</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-book"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="admin-laba-rugi.php">Laporan Laba/Rugi</a>
            <a class="collapse-item" href="admin-tagihan.php">Laporan Pengeluaran</a>
            <!-- <a class="collapse-item" href="admin-status-kamar.php">Laporan Status Kamar</a> -->
          </div>
        </div>
      </li>

      <!-- Nav Item - masteData Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-box"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseMaster" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="admin-data-layanan.php">Data Layanan</a>
            <a class="collapse-item active" href="#">Data Jenis Pengeluaran</a>
            <a class="collapse-item" href="admin-tipe-kamar.php">Data Tipe Kamar</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php print_r($_SESSION['akun_nama']);  ?></span>

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
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Jenis Pengeluaran</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <span class="m-0 font-weight-bold text-primary">Master Data Jenis Pengeluaran</span>

              <!-- button tambah -->
              <button class="btn btn-sm btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#tambahJenisPengeluaran">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Jenis Pengeluaran</span>
              </button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th class="d-none">ID Pengeluaran</th>
                      <th>Kode Pengeluaran</th>
                      <th>Kategori</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th class="d-none">ID Pengeluaran</th>
                      <th>Kode Pengeluaran</th>
                      <th>Kategori</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM `jenis_pengeluaran`";
                    $hasil = mysqli_query($conn, $query);
                    $no = 1;

                    while ($data_jenis_pengeluaran = mysqli_fetch_array($hasil)) {

                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td class="d-none"><?php echo $data_jenis_pengeluaran['id_jenis_pengeluaran']; ?></td>
                        <td><?php echo $data_jenis_pengeluaran['kode_pengeluaran']; ?></td>
                        <td><?php echo $data_jenis_pengeluaran['kategori_pengeluaran']; ?></td>
                        <td><?php echo $data_jenis_pengeluaran['nama_pengeluaran']; ?></td>
                        <td>
                          <button id="<?php echo $data_jenis_pengeluaran['id_jenis_pengeluaran']; ?>" class="btn btn-success btn-circle btn-sm view_data" data-toggle="tooltip" data-placement="top" title="Edit Record">
                            <i class="fas fa-pen"></i>
                          </button>
                          <a href="../../actions/process-delete.php?id_hapus_jenis_pengeluaran=<?php echo $data_jenis_pengeluaran['id_jenis_pengeluaran']; ?>" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Layanan Ini" onclick="return confirm('Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan!');">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
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

    <!-- insert Modal -->
    <div class="modal fade" id="tambahJenisPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Tambah Jenis Pengeluaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>


          <div class="modal-body">

            <!-- form dalam modal -->
            <form action="../../actions/process-insert.php" method="POST">
              <div class="form-group">
                <label for="inputKode">Kode Pengeluaran</label>
                <input name="inputKode" pe="text" class="form-control" id="inputKode" aria-describedby="emailHelp" placeholder="Masukkan kode untuk jenis pengeluaran baru anda" required>
              </div>

              <div class="form-group">
                <label for="inputKategori">Kategori</label>
                <select name="inputKategori" type="text" class="form-control" id="inputKategori" placeholder="Masukkan kategori pengeluaran anda" required>
                  <option value="">Pilih Kategori</option>
                  <option value="Biaya Operasional">Biaya Operasional</option>
                  <option value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
                  <option value="Biaya Makanan">Biaya Makanan</option>
                  <option value="Biaya Marketing">Biaya Marketing</option>
                  <option value="Biaya Lainnya">Biaya Lainnya</option>
                  <option value="Pajak">Pajak</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputNama">Nama Pengeluaran</label>
                <input name="inputNama" type="text" class="form-control" id="inputNama" placeholder="Nama jenis pengeluaran" required>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submitJenisPengeluaran" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Edit Jenis Pengeluaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="detail_jenis_pengeluaran">

          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>



    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>

    <script>
      $(document).ready(function() {
        // untuk view data
        $('#dataTable').on('click', '.view_data', function() {
          var id_jenis_pengeluaran = $(this).attr('id');

          $.ajax({
            url: "ajax/edit_data_jenis_pengeluaran.php",
            method: "post",
            data: {
              id_jenis_pengeluaran: id_jenis_pengeluaran
            },
            success: function(data) {
              $('#detail_jenis_pengeluaran').html(data);
              $('#updateModal').modal();
            }
          });
        });
      });
    </script>
</body>

</html>