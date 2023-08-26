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
    <div class="container-fluid">

      <!-- Page Heading -->

      <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="h3 mb-0 text-gray-800">Kamar</span>

        <!-- button tambah -->

        <button class="btn btn-sm btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#tambah-layanan">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Tambah Kamar</span>
        </button>
      </div>

      <div class="row">
        <!-- QUERY UNTUK MENAMPILKAN DATA KAMAR -->
        <?php
        $query = "SELECT kamar.nomor_kamar, kamar.harga_bulanan, kamar.deskripsi_kamar, kamar.foto_kamar, kamar.id_kamar, 
            CASE
                WHEN kamar.id_kamar = (SELECT menghuni.id_kamar FROM menghuni WHERE menghuni.id_kamar = kamar.id_kamar)
              THEN
                (SELECT pengguna.nama_pengguna FROM pengguna, menghuni WHERE pengguna.id_pengguna = menghuni.id_pengguna AND  menghuni.id_kamar = kamar.id_kamar)
              ELSE
                'Belum dihuni'
              END AS Penghuni
              
            FROM kamar";

        $result = mysqli_query($conn, $query);

        while ($data_kamar = mysqli_fetch_array($result)) {

        ?>
          <div class="col col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card">

              <div class="no-kamar"><span class="font-weight-bold"><?php echo $data_kamar['nomor_kamar']; ?></span></div>

              <img src="../../img/<?php echo $data_kamar['foto_kamar']; ?>" height="200px" class="card-img-top" alt="...">

              <div class="card-body">
                <h6 class="card-title "><span class="font-weight-bold">Dihuni:</span>
                  <?php echo $data_kamar['Penghuni']; ?></h6>

                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                  card's content.</p>

                <p class="card-text"><span class="font-weight-bold">Harga:</span>
                  <?php echo number_format($data_kamar['harga_bulanan']);  ?></p>

                <a href="#" class="btn btn-outline-primary btn-block">EDIT</a>
                <a href="#" class="btn btn-outline-danger btn-block">HAPUS</a>
              </div>
            </div>
          </div>
        <?php } ?>

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
<?php
require '1footer.php';
?>