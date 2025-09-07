<?php
require_once('function.php');
include_once('templates/header.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buku User</h1>
    <?php
    // jika ada tombol simpan
    if (isset($_POST['simpan'])) {
        if (tambah_user($_POST) > 0) {
            ?>
            <div class="alert alert-success" role="alert">Data berhasil disimpan!</div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">Data gagal disimpan!</div>
            <?php
        }
    } elseif (isset($_POST['ganti_password'])) {
        if (ganti_password($_POST) > 0) {
            ?>
            <div class="alert alert-success" role="alert">Password berhasil diubah!</div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">Password gagal diubah!</div>
            <?php
        }
    }
?>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Data User</span>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>User Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $users = query("SELECT * FROM users");
                        foreach ($users as $user) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['user_role']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#gantiPassword" data-id="<?= $user['id_user']?>">
                                        <span class="text">Ganti Password</span>
                                    </button> 
                                    <a href="edit-user.php?id=<?= $user['id_user']; ?>" class="btn btn-success btn-sm">Ubah</a>
                                    <a href="hapus-user.php?id=<?= $user['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Ganti Password -->
<div class="modal fade" id="gantiPassword" tabindex="-1" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gantiPasswordLabel">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <input type="hidden" name="id_user" id="id_user">
          <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Password Baru</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="password" name="password">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" name="ganti_password" class="btn btn-primary">Simpan</button>
      </div>
        </form>
    </div>
  </div>
</div>



<?php include_once('templates/footer.php'); ?>
