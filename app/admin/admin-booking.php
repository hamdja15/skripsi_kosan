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
        <span class="h3 mb-0 text-gray-800">Booking Kamar</span>

        <!-- button tambah -->

        <button class="btn btn-sm btn-primary btn-icon-split float-right d-none" data-toggle="modal" data-target="#tambah-kamar">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Tambah Kamar</span>
        </button>
      </div>


      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Booking Kamar</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th class="d-none">ID booking</th>
                  <th>Kamar</th>
                  <th>Pemesan</th>
                  <th>Tanggal Booking</th>
                  <th>Pembayaran</th>
                  <th>Status Booking</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th class="d-none">ID booking</th>
                  <th>Kamar</th>
                  <th>Pemesan</th>
                  <th>Tanggal Booking</th>
                  <th>Pembayaran</th>
                  <th>Status Booking</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                $query = "SELECT * FROM booking, kamar, pengguna
                    WHERE booking.id_kamar = kamar.id_kamar AND pengguna.id_pengguna = booking.id_pengguna AND booking.status_booking = 'belum dikonfirmasi'
                      
                      ORDER BY booking.tanggal_booking ASC, kamar.nomor_kamar DESC";

                $hasil = mysqli_query($conn, $query);
                $no = 1;

                while ($data_booking = mysqli_fetch_array($hasil)) {

                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td class="d-none"><?php echo $data_booking['id_booking']; ?></td>
                    <td><?php echo 'Kamar. ' . $data_booking['nomor_kamar']; ?></td>
                    <td><?php echo $data_booking['nama_pengguna']; ?></td>
                    <td><?php echo $data_booking['tanggal_booking']; ?></td>
                    <td><?php echo 'Rp. ' . number_format($data_booking['nilai_booking']); ?></td>
                    <td><?php echo strtoupper($data_booking['status_booking']); ?></td>
                    <td>
                      <!-- view btn -->
                      <button name="view" type="button" value="view" id="<?php echo $data_booking['id_booking']; ?>" class="btn btn-primary btn-circle btn-sm view_data m-1" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                      </button>
                      <!-- edit btn -->
                      <button type="button" class="btn btn-success btn-circle btn-sm m-1 edit_data" title="Edit Data Kamar" name="edit" value="edit" id="edit">
                        <i class="fas fa-pen"></i>
                      </button>
                      <!-- delete btn -->
                      <a href="../../actions/process-delete.php?id_hapus_booking=<?php echo $data_booking['id_booking']; ?>" class="btn btn-danger btn-circle btn-sm m-1" title="Hapus Data Kamar" onclick="return confirm('Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan!');">
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

<!-- view modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Rincian Data Booking
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail_kamar">

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
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Edit Data Booking</h5>
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
<div class="modal fade" id="tambah-kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Tambah Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../../actions/process-insert.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="fotoLama" value="">
          <div class="form-group">
            <label for="nomorKamar">Nomor Kamar</label>
            <input value="" type="number" class="form-control" id="nomorKamar" name="nomorKamar" aria-describedby="Nomor Kamar" placeholder="Masukkan nomor kamar baru" required>
          </div>
          <div class="form-group">
            <label for="tipe">Tipe Kamar</label>
            <select name="tipe" class="form-control" id="tipe" required>
              <option selected disabled value="">Pilih Layanan</option>

              <?php
              $query = "SELECT * FROM tipe_kamar";

              $result = mysqli_query($conn, $query);

              while ($dataTipe = mysqli_fetch_array($result)) {
                if ($dataTipe['nama_tipe'] == $data['nama_tipe']) {
              ?>
                  <option selected value="<?php echo $dataTipe['id_tipe'] ?>"><?php echo $dataTipe['nama_tipe']; ?>
                  </option>
                <?php
                } else {
                ?>
                  <option value="<?php echo $dataTipe['id_tipe'] ?>"><?php echo $dataTipe['nama_tipe']; ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="luas">Luas Kamar</label>
            <input value="" type="text" class="form-control" id="luas" name="luas" aria-describedby="luas" placeholder="Masukkan luas kamar baru" required>
          </div>
          <div class="form-group">
            <label for="lantai">Letak Lantai</label>
            <input value="" type="number" class="form-control" id="lantai" name="lantai" aria-describedby="lantai" placeholder="Masukkan letak lantai baru" required>
          </div>
          <div class="form-group">
            <label for="kapasitas">Kapasitas Hunian</label>
            <input value="" type="number" class="form-control" id="kapasitas" name="kapasitas" aria-describedby="kapasitas" placeholder="Masukkan kapasitas baru" required>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi Kamar</label>
            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" aria-describedby="deskripsi" placeholder="Masukkan deskripsi baru" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="hargaBulanan">Harga Bulanan</label>
            <input value="" type="text" class="form-control" id="hargaBulanan" name="hargaBulanan" aria-describedby="hargaBulanan" placeholder="Masukkan harga bulanan baru" required>
          </div>
          <div class="form-group">
            <label for="layanan">Layanan</label>
            <select name="layanan" class="form-control" id="layanan" required>
              <option selected disabled value="">Pilih Layanan</option>

              <?php
              $query = "SELECT * FROM layanan";

              $result = mysqli_query($conn, $query);

              while ($dataLayanan = mysqli_fetch_array($result)) {
                if ($dataLayanan['nama_layanan'] == $data['nama_layanan']) {
              ?>
                  <option selected value="<?php echo $dataLayanan['id_layanan'] ?>">
                    <?php echo $dataLayanan['nama_layanan'] . ' (Rp ' . number_format($dataLayanan['harga_bulanan']) . ')'; ?>
                  </option>
                <?php
                } else {
                ?>
                  <option value="<?php echo $dataLayanan['id_layanan'] ?>">
                    <?php echo $dataLayanan['nama_layanan'] . ' (Rp ' . number_format($dataLayanan['harga_bulanan']) . ')'; ?>
                  </option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="denda">Denda</label>
            <input value="" type="text" class="form-control" id="denda" name="denda" aria-describedby="denda" placeholder="Masukkan denda baru" required>
          </div>
          <div class="form-group">
            <label for="profil">Foto Kamar</label>
            <input value="" type="file" class="form-control-file" id="profil" name="profil" aria-describedby="profil" accept="image/*" required>
          </div>

          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            <button type="submit" name="submitKamar" class="btn btn-primary" onclick="return confirm('Anda yakin ingin menambah data?');">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  require '1footer.php';
  ?>