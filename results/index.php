<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin - Results</title>
    <link rel="icon" type="icon/x-image" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
    <?php if($_SERVER["REQUEST_METHOD"] == "GET"): ?>
        <?php if($status == 1): ?>
            <div class="container-fluid px-0 py-5 d-flex justify-content-center align-items-center">
                <div class="card w-75 border-3">
                    <div class="card-header border-3 py-4 px-5 d-flex align-items-center justify-content-between">
                        <a href="../" class="text-decoration-none text-black" style="font-size:40px;">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </a>
                        <h1 class="fw-bold m-0">Results</h1>
                        <i class="fa-solid fa-arrow-left-long" style="font-size:40px;opacity:0;"></i>
                    </div>
                    <div class="card-body border-3 p-5">
                        <div class="row">
                            <div class="col-3">
                                <img src="../assets/book-covers/<?= $results["cover"]; ?>" class="w-100">
                            </div>
                            <div class="col-9 ps-5">
                                <h1 class="fw-bold m-0 mb-5">#<?= $results["kode_peminjaman"]; ?></h1>
                                <table class="table mb-5">
                                    <tr>
                                        <td class="fw-bold">Nama peminjam</td>
                                        <td><?= $results["nama_user"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Kota asal peminjam</td>
                                        <td><?= $results["nama_kota"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Judul buku</td>
                                        <td><?= $results["judul_buku"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Harga</td>
                                        <td>Rp <?= number_format($results["harga"], 2, ",", "."); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Durasi peminjaman</td>
                                        <td><?= $results["durasi"]; ?> minggu</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tanggal booking</td>
                                        <td><?= date("d F Y", strtotime($results["tanggal_expire"]) - 86400); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tanggal pengembalian</td>
                                        <td><?= date("d F Y", time() + ($results["durasi"] * 7 * 86400)); ?></td>
                                    </tr>
                                </table>
                                <form action="" method="post" class="w-100 d-flex align-items-center justify-content-end">
                                    <input type="hidden" name="kode" value="<?= $results["kode_peminjaman"]; ?>">
                                    <button type="submit" name="confirm" class="btn btn-lg btn-primary fw-bold w-25">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($status == 2): ?>
            <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-4">
                            <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                        </div>
                        <div class="modal-body py-5">
                            <img src="../assets/img/unknown.png" class="d-block mx-auto w-25 mb-4">
                            <h5 class="text-center fw-semibold m-0">Maaf! Kode peminjaman ini tidak tersedia.</h5>
                        </div>
                        <div class="modal-footer">
                            <a href="../" class="btn btn-lg btn-danger fw-bold w-25">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php elseif($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-4">
                        <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                    </div>
                    <div class="modal-body py-5">
                        <img src="../assets/img/success.png" class="d-block mx-auto w-25 mb-4">
                        <h5 class="text-center fw-semibold m-0">Selamat! Peminjaman ini telah dikonfirmasi.</h5>
                    </div>
                    <div class="modal-footer">
                        <a href="../" class="btn btn-lg btn-danger fw-bold w-25">Close</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php if($_SERVER["REQUEST_METHOD"] == "POST" || (isset($status) && $status == 2)): ?>
        <script src="../assets/js/show-modal.js"></script>
    <?php endif; ?>
</body>
</html>