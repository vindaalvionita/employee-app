<?php
session_start();
//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "employee");
//Menambah pegawai baru
if(isset($_POST['addnewpegawai'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $id_ruangan = $_POST['id_ruangan'];

    $addtotable = mysqli_query($conn,"insert into pegawai (nama, alamat, tgl_lahir, id_ruangan) values ('$nama', '$alamat', '$tgl_lahir', '$id_ruangan')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Update data pegawai
if(isset($_POST['updatedatapegawai'])){
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $id_ruangan = $_POST['id_ruangan'];
    
    $update = mysqli_query($conn,"update pegawai set nama='$nama', alamat='$alamat', tgl_lahir='$tgl_lahir', id_ruangan='$id_ruangan' where nip='$nip'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Menghapus data pegawai
if(isset($_POST['hapusdatapegawai'])){
    $nip = $_POST['nip'];

    $hapus = mysqli_query($conn,"delete from pegawai where nip='$nip'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};


?>