<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin - Info</title>
    <link rel="icon" type="icon/x-image" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
    <div class="container-fluid p-0 position-absolute h-100">
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
        <div class="row h-100 m-0">
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
                        <a href="../order" class="nav-link fw-bold" style="font-size:25px;">
                            <i class="fa-solid fa-receipt"></i>&nbsp;Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link fw-bold active" style="font-size:25px;">
                            <i class="fa-solid fa-circle-info"></i>&nbsp;Info
                        </a>
                    </li>
                </ul>
                <button type="button" class="btn btn-lg btn-danger fw-bold w-75" data-bs-toggle="modal" data-bs-target="#modal">
                    <i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout
                </button>
            </div>
            <div class="col-9 d-flex flex-column align-items-start p-5 gap-5">
                <h1 class="display-6 m-0 fw-bold"><?= $data_admin["nama_perpustakaan"]; ?></h1>
                <table class="table table-bordered table-striped table-hover w-100">
                    <tr>
                        <td class="fw-bold py-3">Pemilik</td>
                        <td class="py-3"><?= $data_admin["nama_admin"]; ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold py-3">Kota</td>
                        <td class="py-3"><?= $data_admin["nama_kota"]; ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold py-3">Alamat</td>
                        <td class="py-3"><?= $data_admin["alamat"]; ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold py-3">Lokasi</td>
                        <td class="py-3">
                            <a href="<?= $data_admin["maps"]; ?>" target="_blank" class="m-0 text-black"><?= $data_admin["maps"]; ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold py-3">Banyak peminjaman</td>
                        <td class="py-3"><?= $data_admin["banyak_peminjaman"]; ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold py-3">Penghasilan</td>
                        <td class="py-3">Rp <?= number_format($data_admin["penghasilan"], 2, ",", "."); ?></td>
                    </tr>
                </table>
                <p class="m-0 fw-semibold mt-auto">&copy;Copyright <?= date("Y", time()); ?> - Justin Brilliant Thendri</p>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>