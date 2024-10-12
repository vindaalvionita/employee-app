<?php
require_once 'config.php';

function updatePegawai($nip, $data) {
    global $conn;
    $stmt = $conn->prepare("UPDATE pegawai SET nama = :nama, alamat = :alamat, tgl_lahir = :tgl_lahir, id_ruangan = :id_ruangan WHERE nip = :nip");
    $stmt->execute([
        'nama' => $data['nama'],
        'alamat' => $data['alamat'],
        'tgl_lahir' => $data['tgl_lahir'],
        'id_ruangan' => $data['id_ruangan'],
        'nip' => $nip
    ]);
    return $stmt->rowCount();
}
?>
