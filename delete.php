<?php
require_once 'config.php';

function deletePegawai($nip) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM pegawai WHERE nip = :nip");
    $stmt->execute(['nip' => $nip]);
    return $stmt->rowCount();
}
?>
