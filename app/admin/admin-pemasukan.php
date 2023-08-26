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
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <span class="h3 mb-0 text-gray-800">Pemasukan</span>

        <!-- button tambah -->
        <button class="btn btn-sm btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#tambah-pengeluaran">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Pemasukan</span>
        </button>
      </div>




      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Pemasukan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th class="d-none">id pembayaran</th>
                  <th>Kamar</th>
                  <th>Penghuni</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Nominal</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th class="d-none">id pembayaran</th>
                  <th>Kamar</th>
                  <th>Penghuni</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Nominal</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                $query = "SELECT pembayaran.id_pembayaran, kamar.nomor_kamar, pengguna.nama_pengguna, pembayaran.tanggal_pembayaran, pembayaran.nilai_pembayaran, pembayaran.keterangan, jenis_status_pembayaran.nama_status_pembayaran
                    FROM pembayaran, kamar, pengguna, menghuni, jenis_status_pembayaran
                      WHERE
                        pembayaran.id_menghuni = menghuni.id_menghuni AND
                          menghuni.id_kamar = kamar.id_kamar AND
                          menghuni.id_pengguna = pengguna.id_pengguna AND
                          pembayaran.id_status = jenis_status_pembayaran.id_status
                          
                          ORDER BY pembayaran.id_status DESC, pembayaran.tanggal_pembayaran DESC";

                $hasil = mysqli_query($conn, $query);
                $no = 1;

                while ($dataPembayaran = mysqli_fetch_array($hasil)) {

                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td class="d-none"><?php echo $dataPembayaran['id_pembayaran']; ?></td>
                    <td><?php echo 'No. ' . $dataPembayaran['nomor_kamar']; ?></td>
                    <td><?php echo $dataPembayaran['nama_pengguna']; ?></td>
                    <td><?php echo $dataPembayaran['tanggal_pembayaran']; ?></td>
                    <td><?php echo 'Rp. ' . number_format($dataPembayaran['nilai_pembayaran']); ?></td>
                    <td><?php echo strtoupper($dataPembayaran['nama_status_pembayaran']); ?></td>
                    <td>
                      <!-- view btn -->
                      <button name="view" type="button" value="view" id="<?php echo $dataPembayaran['id_pembayaran']; ?>" class="btn btn-primary btn-circle btn-sm view_data m-1" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                      </button>
                      <!-- edit btn -->
                      <button type="button" class="btn btn-success btn-circle btn-sm m-1 edit_data" title="Edit Data Pembayaran" name="edit" value="edit" id="edit">
                        <i class="fas fa-pen"></i>
                      </button>
                      <!-- delete btn -->
                      <a href="../../actions/process-delete.php?id_hapus_pembayaran=<?php echo $dataPembayaran['id_pembayaran']; ?>" class="btn btn-danger btn-circle btn-sm m-1" title="Hapus Data Kamar" onclick="return confirm('Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan!');">
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
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Rincian Pemasukan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail_pembayaran">

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
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Edit Data Pemasukan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail_edit">

      </div>
    </div>
  </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambah-pengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Tambah Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../../actions/process-insert.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="menghuni">Data Menghuni</label>
            <select name="menghuni" class="form-control" id="menghuni" required>
              <option selected disabled value="">Pilih Data Menghuni</option>

              <?php
              $query = "SELECT * FROM menghuni, kamar, pengguna WHERE menghuni.id_kamar = kamar.id_kamar AND menghuni.id_pengguna = pengguna.id_pengguna";

              $result = mysqli_query($conn, $query);

              while ($dataMenghuni = mysqli_fetch_array($result)) {
              ?>

                <option value="<?php echo $dataMenghuni['id_menghuni']; ?>">
                  <?php echo 'Kamar no. ' . $dataMenghuni['nomor_kamar'] . ' [' . $dataMenghuni['nama_pengguna'] . ']'; ?></option>

              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal Pembayaran</label>
            <input value="" type="date" class="form-control" id="tanggal" name="tanggal" aria-describedby="tanggal" placeholder="Masukkan tanggal pengeluaran" required>
          </div>
          <div class="form-group">
            <label for="nominal">Nominal Pembayaran</label>
            <input value="" type="number" class="form-control" id="nominal" name="nominal" aria-describedby="nominal" placeholder="Masukkan nominal pembayaran" required>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea value="" type="text" class="form-control" id="keterangan" name="keterangan" aria-describedby="keterangan" rows="3" placeholder="Masukkan keterangan pengeluaran" required></textarea>
          </div>
          <div class="form-group">
            <label for="status">Status Konfirmasi Pembayaran</label>
            <select name="status" class="form-control" id="status" required>
              <option selected disabled value="">Pilih Status Konfirmasi</option>

              <?php
              $query = "SELECT * FROM jenis_status_pembayaran";

              $result = mysqli_query($conn, $query);

              while ($dataStatus = mysqli_fetch_array($result)) {
              ?>

                <option value="<?php echo $dataStatus['id_status']; ?>">
                  <?php echo strtoupper($dataStatus['nama_status_pembayaran']); ?></option>

              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="profil">Bukti Pembayaran</label>
            <input value="" type="file" class="form-control-file" id="profil" name="profil" aria-describedby="profil" accept="image/*" required>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            <button type="submit" name="submitPembayaran" class="btn btn-primary" onclick="return confirm('Anda yakin ingin menambah data?');">Submit</button>
          </div>
        </form>
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
        var id_pembayaran = $(this).attr('id');
        console.log(id_pembayaran);

        $.ajax({
          url: "ajax/select_data_pemasukan.php",
          method: "post",
          data: {
            id_pembayaran: id_pembayaran
          },
          success: function(data) {
            $('#detail_pembayaran').html(data);
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

        var id_pembayaran = data[1];
        console.log(id_pembayaran);

        $.ajax({
          url: "ajax/edit_data_pembayaran.php",
          method: "post",
          data: {
            id_pembayaran: id_pembayaran
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