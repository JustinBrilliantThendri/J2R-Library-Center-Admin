<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin - Books</title>
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
            <div class="col-3 h-100 py-4 px-0 d-flex flex-column justify-content-between align-items-center border-end border-2">
                <img src="../assets/img/logo.png" class="w-100 border-bottom px-4 pb-4 border-2">
                <ul class="nav nav-pills flex-column w-100 gap-3 px-4">
                    <li class="nav-item">
                        <a href="../" class="nav-link fw-bold" style="font-size:25px;">
                            <i class="fa-solid fa-keyboard"></i>&nbsp;Input code
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link fw-bold active" style="font-size:25px;">
                            <i class="fa-solid fa-book"></i>&nbsp;Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../order" class="nav-link fw-bold" style="font-size:25px;">
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
            <div class="col-9 h-100 p-0 overflow-y-scroll overflow-x-hidden">
                <div class="row mb-5 pt-5 pb-4 bg-white position-sticky top-0" style="z-index:5;">
                    <div class="col-6 border-end border-2 border-black d-flex justify-content-end align-items-center pe-5">
                        <a href="../books/?opt=1" class="link <?= (!isset($_GET["opt"]) || (isset($_GET["opt"]) && $_GET["opt"] == "") || (isset($_GET["opt"]) && $_GET["opt"] == "1")) ? "text-black" : "text-black-50"; ?> text-decoration-none fw-bold" style="font-size:20px;">Your library</a>
                    </div>
                    <div class="col-6 border-start border-2 border-black d-flex justify-content-start align-items-center ps-5">
                        <a href="../books/?opt=2" class="link <?= (isset($_GET["opt"]) && $_GET["opt"] == "2") ? "text-black" : "text-black-50"; ?> text-decoration-none fw-bold" style="font-size:20px;">All libraries</a>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-stretch flex-wrap gap-5 px-5 pb-5">
                    <?php foreach($books as $each): ?>
                        <div class="card shadow-sm" style="width:200px;">
                            <a href="../book-details/?buku=<?= $each["id_buku"]; ?>" class="text-decoration-none text-black">
                                <img src="../assets/book-covers/<?= $each["cover"]; ?>" class="card-img-top">
                                <div class="card-body p-3 d-flex align-items-center justify-content-center">
                                    <h5 class="text-center fw-semibold m-0 text-capitalize"><?= $each["judul_buku"]; ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <?php if(!isset($_GET["opt"]) || (isset($_GET["opt"]) && $_GET["opt"] == "") || (isset($_GET["opt"]) && $_GET["opt"] == "1")): ?>
                        <div class="card shadow-sm" style="width:200px">
                            <a href="../create-new-book/" class="text-decoration-none h-100 d-flex align-items-center">
                                <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                    <img src="../assets/img/add.png" class="w-50">
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>