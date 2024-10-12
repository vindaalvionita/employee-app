<?php
require_once 'config.php';

function getAllPegawai() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM pegawai");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
