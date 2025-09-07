<?php
include_once('templates/header.php');
require_once('connection.php');
require_once('function.php');
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data User</h1>

    <div class="card shadow-mb-4">
        <div class="card-header py-3">
            <h4>Data User</h4>
        </div>

        <?php

        // jika ada tombol simpan
        if (isset($_POST['simpan'])) {
            global $koneksi;
            if (ubah_user($_POST) > 0) {
                ?>
                <div class="alert alert-success" role="alert">
                    Data berhasil diubah!
                </div>
                <?php
                echo "<meta http-equiv='refresh' content='1; url=users.php'>";
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Data gagal diubah!
                </div>
                <?php
            }
        }
        // jia ada dari url
        if (isset($_GET['id'])) {
            global $koneksi;
            $id_user = $_GET['id'];
            $result = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
            $data = mysqli_fetch_assoc($result); // <-- ini yang harus ada
        }

        ?>

       

         <div class="modal-body">
                        <form method="post" action="">
                            <input type="hidden" name="id_user" id="id_user" value="<?= $data['id_user'] ?>">

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">User Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="<?= $data['username'] ?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="bertemu" class="col-sm-3 col-form-label">User Role</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="user_role" id="user_role">
                                        <option value="admin" <?= $data['user_role'] == 'admin' ? 'selected' : '' ?>>
                                            Administrator</option>
                                        <option value="operator" <?= $data['user_role'] == 'operator' ? 'selected' : '' ?>>
                                            Operator</option>
                                    </select>
                                </div>
                            </div>
                                                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="users.php"
                                class="btn btn-secondary">Keluar</a></button>
                        <button type="submit" name="simpan" class="btn btn-primary"><a
                                class="btn btn-primary" >Simpan</a></button>
                    </div>
                    </form>
                    </div>
    </div>

</div>

<?php
include_once('templates/footer.php');
?>