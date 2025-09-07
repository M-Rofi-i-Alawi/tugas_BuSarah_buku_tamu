<?php
// panggil file function.php
require_once 'function.php';

// jika ada id
if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(hapus_user($id)>0){
        // jika data berhasil di hapus maka akan muncul alert
        echo "<script>alert('Data Berhasil dihapus'!)</script>";
        // redirect ke halaman users.php
        echo "<script>window.location.href='users.php'</script>";
    }else{
        // jika gagal di hapus
        echo "<script>alert('Data Gagal dihapus'!)</script>";
        echo "<script>window.location.href='users.php'</script>";
        
    }
}
?>