<?php
require_once 'jwt.php';
require_once 'create.php';
require_once 'read.php';
require_once 'update.php';
require_once 'delete.php';

// Mengatur header untuk API
header("Content-Type: application/json");

// Mendapatkan method HTTP
$request_method = $_SERVER["REQUEST_METHOD"];

// Mengatur token JWT
$token = null;
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
}

// Validasi token jika ada
if ($token) {
    $user_data = validate_jwt($token);
}

// Mengatur rute API
switch ($request_method) {
    case 'POST':
        // Menambahkan pegawai
        $data = json_decode(file_get_contents("php://input"), true);
        $nip = createPegawai($data);
        echo json_encode(["message" => "Pegawai ditambahkan", "nip" => $nip]);
        break;

    case 'GET':
        // Mengambil semua pegawai
        $pegawai = getAllPegawai();
        echo json_encode($pegawai);
        break;

    case 'PUT':
        // Memperbarui pegawai
        $nip = $_GET['nip'];
        $data = json_decode(file_get_contents("php://input"), true);
        $updated = updatePegawai($id, $data);
        echo json_encode(["message" => "Pegawai diperbarui", "updated" => $updated]);
        break;

    case 'DELETE':
        // Menghapus pegawai
        $nip = $_GET['nip'];
        $deleted = deletePegawai($nip);
        echo json_encode(["message" => "Pegawai dihapus", "deleted" => $deleted]);
        break;

    default:
        echo json_encode(["message" => "Metode tidak didukung"]);
        break;
}
?>
