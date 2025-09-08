<?php
// panngil file koneksi.php
require_once('koneksi.php');
?>


<?php
// membuat query ke / dari database
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


// function tambah data
function tambah_tamu($data)
{
    global $koneksi;

    $kode           = htmlspecialchars($data["id_tamu"]);
    $tanggal        = date("Y-m-d");
    $nama_tamu      = htmlspecialchars($data["nama_tamu"]);
    $alamat         = htmlspecialchars($data["alamat"]);
    $no_hp          = htmlspecialchars($data["no_hp"]);
    $bertemu        = htmlspecialchars($data["bertemu"]);
    $kepentingan    = htmlspecialchars($data["kepentingan"]);

    // upload gambar
    $gambar = uploadGambar();
    if(!$gambar){
        return false;
    }

    $query = "INSERT INTO buku_tamu VALUES ('$kode','$tanggal','$nama_tamu','$alamat','$no_hp',
                '$bertemu','$kepentingan')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
// function ubah data tamu
function ubah_tamu($data)
{
    global $koneksi;

    $kode        = htmlspecialchars($data["id_tamu"]);
    $nama_tamu   = htmlspecialchars($data["nama_tamu"]);
    $alamat      = htmlspecialchars($data["alamat"]);
    $no_hp       = htmlspecialchars($data["no_hp"]);
    $bertemu     = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "UPDATE buku_tamu SET 
                nama_tamu = '$nama_tamu',
                alamat = '$alamat',
                no_hp = '$no_hp',
                bertemu = '$bertemu',
                kepentingan = '$kepentingan'
              WHERE id_tamu = '$kode'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
// function hapus data
function hapus_tamu($id){
    global $koneksi;
    $query= "DELETE FROM buku_tamu WHERE id_tamu = '$id'";

    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}
// function tambah user
function tambah_user($data) {
    global $koneksi;

    // Ambil data dari form
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $user_role = htmlspecialchars($data["user_role"]);

    // Enkripsi password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert ke tabel users (tanpa id_user, karena auto_increment)
    $query = "INSERT INTO users (username, password, user_role) 
              VALUES ('$username', '$password_hash', '$user_role')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
// function ubah user
function ubah_user($data)
{
    global $koneksi;

    $kode      = htmlspecialchars($data["id_user"]);
    $username  = htmlspecialchars($data["username"]);
    $user_role = htmlspecialchars($data["user_role"]);

    $query = "UPDATE users SET 
                username = '$username',
                user_role = '$user_role'
              WHERE id_user = '$kode'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
// function hapus data user
function hapus_user($id){
    global $koneksi;
    $query= "DELETE FROM users WHERE id_user = '$id'";

    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}
// function ganti password
function ganti_password($data){
    global $koneksi;
    $kode = htmlspecialchars($data['id_user']);
    $password = htmlspecialchars($data['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET
                password = '$password_hash'
                WHERE id_user = '$kode'";
    mysqli_query($koneksi, $query);
    
    return mysqli_affected_rows($koneksi);
}
function uploadGambar() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'assets/upload_gambar/' . $namaFileBaru);

    return $namaFileBaru;
}
?>



