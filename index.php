<?php
require 'connection.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pegawai</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Daftar Nama Pegawai</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                            Data Pegawai
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Daftar Nama Pegawai</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Pegawai
                            </button>
                        </div>
                        <div class="card-body">
                            <?php
                            $ambildatapegawai = mysqli_query($conn, "select * from pegawai");
                            while ($fetch = mysqli_fetch_array($ambildatapegawai)) {
                                $pegawai = $fetch['nama'];
                                ?>
                                <?php
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Nama Ruangan</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $allpegawai = mysqli_query($conn, "SELECT p.*, r.keterangan FROM pegawai p JOIN ruangan r ON p.id_ruangan = r.id_ruangan");

                                        while ($data = mysqli_fetch_array($allpegawai)) {
                                            $nama = $data['nama'];
                                            $alamat = $data['alamat'];
                                            $tgl_lahir = $data['tgl_lahir'];
                                            $id_ruangan = $data['id_ruangan'];
                                            $nip = $data['nip'];
                                            $keterangan = $data['keterangan'];
                                            ?>
                                            <tr>
                                                <td><?= $nip; ?></td>
                                                <td><?= $nama; ?></td>
                                                <td><?= $alamat; ?></td>
                                                <td><?= $tgl_lahir; ?></td>
                                                <td><?= $keterangan; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#edit<?= $nip; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#delete<?= $nip; ?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Data Pegawai -->
                                            <div class="modal fade" id="edit<?= $nip; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Pegawai</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <h6>Nama</h6>
                                                                <input type="text" name="nama" value="<?= $nama; ?>"
                                                                    class="form-control" required>
                                                                <br>
                                                                <h6>Alamat</h6>
                                                                <input type="text" name="alamat" value="<?= $alamat; ?>"
                                                                    class="form-control" required>
                                                                <br>
                                                                <h6>Tanggal Lahir</h6>
                                                                <input type="date" name="tgl_lahir"
                                                                    value="<?= $tgl_lahir; ?>" class="form-control"
                                                                    required>
                                                                <br>
                                                                <h6>Nama Ruangan</h6>
                                                                <select name="id_ruangan" class="form-control" required>
                                                                    <option value="">-- Pilih Ruangan --</option>
                                                                    <?php
                                                                    $allruangan = mysqli_query($conn, "SELECT * FROM ruangan");
                                                                    while ($ruangan = mysqli_fetch_array($allruangan)) {
                                                                        $id_ruangan_db = $ruangan['id_ruangan'];
                                                                        $nama_ruangan = $ruangan['keterangan'];
                                                                        $selected = ($id_ruangan == $id_ruangan_db) ? 'selected' : '';

                                                                        echo "<option value='$id_ruangan_db' $selected>$nama_ruangan</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <br>
                                                                <input type="hidden" name="nip" value="<?= $nip; ?>">
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="updatedatapegawai">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hapus Data Pegawai -->
                                            <div class="modal fade" id="delete<?= $nip; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data Pegawai</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <?= $nama; ?>?
                                                                <input type="hidden" name="nip" value="<?= $nip; ?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger"
                                                                    name="hapusdatapegawai">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php
                                        }
                                        ;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Data Pegawai PDAM 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <h6>Nama</h6>
                    <input type="text" name="nama" placeholder="Input Nama Pegawai" class="form-control" required>
                    <br>
                    <h6>Alamat</h6>
                    <input type="text" name="alamat" placeholder="Input Alamat" class="form-control" required>
                    <br>
                    <h6>Tanggal Lahir</h6>
                    <input type="date" name="tgl_lahir" placeholder="Input Tanggal Lahir" class="form-control" required>
                    <br>
                    <h6>Nama Ruangan</h6>
                    <select name="id_ruangan" class="form-control" required>
                        <option value="">-- Pilih Ruangan --</option>
                        <?php
                        $allruangan = mysqli_query($conn, "SELECT * FROM ruangan");
                        while ($ruangan = mysqli_fetch_array($allruangan)) {
                            $id_ruangan_db = $ruangan['id_ruangan'];
                            $nama_ruangan = $ruangan['keterangan'];
                            $selected = ($id_ruangan == $id_ruangan_db) ? 'selected' : '';

                            echo "<option value='$id_ruangan_db' $selected>$nama_ruangan</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewpegawai">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>