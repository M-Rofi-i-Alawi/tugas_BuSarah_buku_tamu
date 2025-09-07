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
            echo '<div class="alert alert-success">Data berhasil disimpan!</div>';
        } else {
            echo '<div class="alert alert-danger">Data gagal disimpan!</div>';
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="user_role" name="user_role" required>
                                <option value="admin">Administrator</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once('templates/footer.php'); ?>
