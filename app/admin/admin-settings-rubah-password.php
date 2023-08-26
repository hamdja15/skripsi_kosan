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
        <div class="card col-12">
          <div class="card-body">
            <h4 class="card-title">Rubah Password</h4>
            <p class="card-text">Isi form ini untuk mengubah password akun anda</p>
            <form action="../../actions/process-update.php" class="needs-validation" method="POST" novalidate>
              <input type="hidden" name="id" value="<?php echo $_SESSION['akun_id']; ?>">
              <div class="form-group">
                <label for="passLama">Password Lama</label>
                <input type="password" class="form-control" id="passLama" name="passLama" aria-describedby="Password Lama" placeholder="Masukkan password lama" required>
                <div class="invalid-feedback">
                  Masukkan Password Lama Anda
                </div>
              </div>
              <div class="form-group">
                <label for="passBaru">Password Baru</label>
                <input type="password" class="form-control" id="passBaru" name="passBaru" aria-describedby="Password Baru" placeholder="Masukkan password baru" required>
                <div class="invalid-feedback">
                  Masukkan Password Baru Anda
                </div>
              </div>
              <div class="form-group">
                <label for="passBaruVerifikasi">Verifikasi Password Baru</label>
                <input type="password" class="form-control" id="passBaruVerifikasi" name="passBaruVerifikasi" aria-describedby="Verifikasi Password Baru" placeholder="Verifikasi password baru" required>
                <div class="invalid-feedback">
                  Verifikasi Password Baru Anda
                </div>
              </div>
              <button type="submit" name="rubah_password" class="btn btn-primary btn-block" onclick="return confirm('Anda yakin ingin merubah password?');">Rubah password</button>
            </form>
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
<!-- update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Edit Info Kost</h5>
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
<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="../../vendor/chart.js/Chart.min.js"></script>
<script>
  $(document).ready(function() {
    // untuk view data
    $('.edit_data').on('click', function() {
      var id_kost = $(this).attr('id');
      console.log(id_kost);
      $.ajax({
        url: "ajax/edit_data_kost.php",
        method: "post",
        data: {
          id_kost: id_kost
        },
        success: function(data) {
          $('#detail_edit').html(data);
          $('#updateModal').modal();
        }
      });
    });
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    // // edit data
    // $('.edit_data').on('click', function () {
    //   var $tr = $(this).closest('tr');
    //   var data = $tr.children("td").map(function () {
    //     return $(this).text();
    //   }).get();
    //   var id_pengguna = data[1];
    //   $.ajax({
    //     url: "ajax/edit_data_penghuni.php",
    //     method: "post",
    //     data: {
    //       id_pengguna: id_pengguna
    //     },
    //     success: function (data) {
    //       $('#detail_edit').html(data);
    //       $('#updateModal').modal();
    //     }
    //   });
    // });
  });
</script>
</body>

</html>