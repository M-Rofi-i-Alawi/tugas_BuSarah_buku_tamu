
<?php
include_once('templates/header.php');
require_once('koneksi.php');
require_once('function.php');
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Tamu</h1>

    <div class="card shadow-mb-4">
        <div class="card-header py-3">
            <h4>Data Tamu</h4>
        </div>

        <?php

        // jika ada tombol simpan
        if (isset($_POST['simpan'])) {
            global $koneksi;
            if (ubah_tamu($_POST) > 0) {
                ?>
                <div class="alert alert-success" role="alert">
                    Data berhasil diubah!
                </div>
                <?php
                echo "<meta http-equiv='refresh' content='1; url=buku-tamu.php'>";
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
            $id_tamu = $_GET['id'];
            $result = mysqli_query($koneksi, "SELECT * FROM buku_tamu WHERE id_tamu = '$id_tamu'");
            $data = mysqli_fetch_assoc($result); // <-- ini yang harus ada
        }

        ?>

        <div class="modal-body">
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id_tamu" id="id_tamu" value="<?= $data['id_tamu'] ?>">
                <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $data['gambar'] ?>">

                <div class="form-group row">
                    <label for="nama_tamu" class="col-sm-3 col-form-label">Nama Tamu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_tamu" value="<?= $data['nama_tamu'] ?>"
                            name="nama_tamu">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="alamat" name="alamat"><?= $data['alamat'] ?></textarea>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_hp" value="<?= $data['no_hp'] ?>" name="no_hp">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bertemu" class="col-sm-3 col-form-label">Bertemu dg.</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bertemu" value="<?= $data['bertemu'] ?>"
                            name="bertemu">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kepentingan" class="col-sm-3 col-form-label">Kepentingan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kepentingan" value="<?= $data['kepentingan'] ?>"
                            name="kepentingan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gambar" class="col-sm-3 col-form-label">Gambar Foto</label>
                    <div class="col-sm-8">
                        <img src="assets/upload_gambar/<?= $data['gambar']?>" alt="" width="20%">
                        <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <a href="buku-tamu.php" class="btn btn-secondary">Keluar</a>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>

        </div>
        </form>
    </div>

</div>

<?php
include_once('templates/footer.php');
?>
