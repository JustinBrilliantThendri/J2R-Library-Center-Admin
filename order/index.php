<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin - Order</title>
    <link rel="icon" type="icon/x-image" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
    <div class="container-fluid h-100 p-0">
        <form action="" method="post">
            <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-4">
                            <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                        </div>
                        <div class="modal-body py-5">
                            <img src="../assets/img/question-mark.png" class="d-block mx-auto w-25 mb-4">
                            <h5 class="text-center fw-semibold m-0">Apakah anda yakin untuk logout?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-primary fw-bold w-25" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" name="logout" class="btn btn-lg btn-danger fw-bold w-25">Iya</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row h-100 m-0 position-fixed">
            <div class="col-3 py-4 px-0 d-flex flex-column justify-content-between align-items-center border-end border-2">
                <img src="../assets/img/logo.png" class="w-100 border-bottom px-4 pb-4 border-2">
                <ul class="nav nav-pills flex-column w-100 gap-3 px-4">
                    <li class="nav-item">
                        <a href="../" class="nav-link fw-bold" style="font-size:25px;">
                            <i class="fa-solid fa-keyboard"></i>&nbsp;Input code
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../books" class="nav-link fw-bold" style="font-size:25px;">
                            <i class="fa-solid fa-book"></i>&nbsp;Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link fw-bold active" style="font-size:25px;">
                            <i class="fa-solid fa-receipt"></i>&nbsp;Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../info" class="nav-link fw-bold" style="font-size:25px;">
                            <i class="fa-solid fa-circle-info"></i>&nbsp;Info
                        </a>
                    </li>
                </ul>
                <button type="button" class="btn btn-lg btn-danger fw-bold w-75" data-bs-toggle="modal" data-bs-target="#modal">
                    <i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout
                </button>
            </div>
            <div class="col-9 h-100 p-5 d-flex flex-column align-items-center gap-4 overflow-y-scroll overflow-x-hidden">
                <?php foreach($orders as $each): ?>
                    <div class="card w-75 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-3">
                                    <img src="../assets/book-covers/<?= $each["cover"]; ?>" class="w-100">
                                </div>
                                <div class="col-9 ps-4">
                                    <h2 class="fw-bold m-0 mb-4">#<?= $each["kode_peminjaman"]; ?></h2>
                                    <table class="table table-sm mb-4">
                                        <tr>
                                            <td class="fw-bold">Nama peminjam</td>
                                            <td><?= $each["nama_user"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Kota asal peminjam</td>
                                            <td><?= $each["nama_kota"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Judul buku</td>
                                            <td><?= $each["judul_buku"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Harga</td>
                                            <td>Rp <?= number_format($each["harga"], 2, ",", "."); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal peminjaman</td>
                                            <td><?= date("d F Y", strtotime($each["tanggal_peminjaman"])); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal pengembalian</td>
                                            <td><?= date("d F Y", strtotime($each["tanggal_pengembalian"])); ?></td>
                                        </tr>
                                    </table>
                                    <div class="d-flex justify-content-end align-items-center gap-4" id="container" data-code="<?= $each["kode_peminjaman"]; ?>">
                                        <?php if($each["status"] == "Dipinjam"): ?>
                                            <?php $diff = strtotime($each["tanggal_pengembalian"]) - time() - 25200; ?>
                                            <?php if($diff >= 0): ?>
                                                <p class="fw-semibold m-0 text-danger"><?= date("d", $diff - 86400) . " hari " . date("H", $diff) . " jam " . date("i", $diff) . " menit " . date("s", $diff) . " detik"; ?></p>
                                                <button type="button" class="btn btn-danger fw-bold w-25" disabled>Return</button>
                                            <?php else: ?>
                                                <script>window.location.reload();</script>
                                            <?php endif; ?>
                                        <?php elseif($each["status"] == "Dikembalikan"): ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="code" value="<?= $each["kode_peminjaman"]; ?>">
                                                <input type="hidden" name="user" value="<?= $each["id_user"]; ?>">
                                                <input type="hidden" name="buku" value="<?= $each["id_buku"]; ?>">
                                                <button type="submit" name="return" class="btn btn-danger fw-bold w-25">Return</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php if($_SERVER["REQUEST_METHOD"] == "GET"): ?>
        <?php if(count($orders) != 0): ?>
            <script src="../assets/js/returned-date-ajax.js"></script>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>