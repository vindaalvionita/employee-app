<?php
require_once 'config.php';

function createPegawai($data) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO pegawai (nama, alamat, tgl_lahir, id_ruangan) VALUES (:nama, :alamat, :tgl_lahir, :id_ruangan)");
    $stmt->execute([
        'nama' => $data['nama'],
        'alamat' => $data['alamat'],
        'tgl_lahir' => $data['tgl_lahir'],
        'id_ruangan' => $data['id_ruangan']
    ]);
    return $conn->lastInsertId();
}
?>
