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
      <h1 class="h3 mb-2 text-gray-800">Penghuni</h1>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Penghuni</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th class="d-none">ID Penghuni</th>
                  <th>Nama</th>
                  <th>Kamar</th>
                  <th>Tanggal Masuk</th>
                  <th>Telepon</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th class="d-none">ID Penghuni</th>
                  <th>Nama</th>
                  <th>Kamar</th>
                  <th>Tanggal Masuk</th>
                  <th>Telepon</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                $query = "SELECT pengguna.id_pengguna, pengguna.nama_pengguna, menghuni.id_kamar, menghuni.tanggal_masuk, pengguna.telepon_pengguna, kamar.nomor_kamar
                    FROM pengguna
                      INNER JOIN menghuni ON pengguna.id_pengguna = menghuni.id_pengguna 
                      INNER JOIN kamar ON kamar.id_kamar = menghuni.id_kamar
                      ORDER BY kamar.nomor_kamar ASC";
                $hasil = mysqli_query($conn, $query);
                $no = 1;

                while ($data_penghuni = mysqli_fetch_array($hasil)) {

                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td class="d-none"><?php echo $data_penghuni['id_pengguna']; ?></td>
                    <td><?php echo $data_penghuni['nama_pengguna']; ?></td>
                    <td><?php echo $data_penghuni['nomor_kamar']; ?></td>
                    <td><?php echo $data_penghuni['tanggal_masuk']; ?></td>
                    <td><?php echo $data_penghuni['telepon_pengguna']; ?></td>
                    <td>
                      <!-- view btn -->
                      <button name="view" type="button" value="view" id="<?php echo $data_penghuni['id_pengguna']; ?>" class="btn btn-primary btn-circle btn-sm view_data m-1" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                      </button>
                      <!-- edit btn -->
                      <button type="button" class="btn btn-success btn-circle btn-sm m-1 edit_data" title="Edit Data Pengguna" name="edit" value="edit" id="edit">
                        <i class="fas fa-pen"></i>
                      </button>
                      <!-- delete btn -->
                      <a href="../../actions/process-delete.php?id_hapus_penghuni=<?php echo $data_penghuni['id_pengguna']; ?>" class="btn btn-danger btn-circle btn-sm m-1" onclick="return confirm('Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan!');">
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

<!-- view modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Rincian Data Penghuni
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail_pengguna">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Edit Data Penghuni</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail_edit">

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

<!-- lightbox -->
<script src="../../js/lightbox.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin-2.min.js"></script>

<!-- lightbiox css -->
<link href="../../css/lightbox.css" rel="stylesheet">

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
      var id_pengguna = $(this).attr('id');

      $.ajax({
        url: "ajax/select_data_penghuni.php",
        method: "post",
        data: {
          id_pengguna: id_pengguna
        },
        success: function(data) {
          $('#detail_pengguna').html(data);
          $('#viewModal').modal();
        }
      });
    });

    // edit data
    $('#dataTable').on('click', '.edit_data', function() {
      var $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      var id_pengguna = data[1];

      $.ajax({
        url: "ajax/edit_data_penghuni.php",
        method: "post",
        data: {
          id_pengguna: id_pengguna
        },
        success: function(data) {
          $('#detail_edit').html(data);
          $('#updateModal').modal();
        }
      });
    });
  });
</script>
</body>

</html>