<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin</title>
    <link rel="icon" type="icon/x-image" href="assets/img/icon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <?php if(isset($id_admin)): ?>
        <div class="container-fluid p-0 position-absolute h-100">
            <form action="" method="post">
                <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header py-4">
                                <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                            </div>
                            <div class="modal-body py-5">
                                <img src="assets/img/question-mark.png" class="d-block mx-auto w-25 mb-4">
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
                    <img src="assets/img/logo.png" class="w-100 border-bottom px-4 pb-4 border-2">
                    <ul class="nav nav-pills flex-column w-100 gap-3 px-4">
                        <li class="nav-item">
                            <a href="" class="nav-link fw-bold active" style="font-size:25px;">
                                <i class="fa-solid fa-keyboard"></i>&nbsp;Input code
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="books" class="nav-link fw-bold" style="font-size:25px;">
                                <i class="fa-solid fa-book"></i>&nbsp;Books
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="order" class="nav-link fw-bold" style="font-size:25px;">
                                <i class="fa-solid fa-receipt"></i>&nbsp;Order
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="info" class="nav-link fw-bold" style="font-size:25px;">
                                <i class="fa-solid fa-circle-info"></i>&nbsp;Info
                            </a>
                        </li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-danger fw-bold w-75" data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout
                    </button>
                </div>
                <div class="col-9 d-flex justify-content-center align-items-center position-relative">
                    <div class="position-fixed top-0 end-0 py-4 px-5 d-flex align-items-center gap-4">
                        <h5 class="fw-bold m-0"><?= $nama_admin; ?></h5>
                        <img src="assets/img/user.png" style="width:60px;" data-bs-toggle="tooltip" title="Admin">
                    </div>
                    <form action="results" method="get" class="w-50">
                        <input type="number" name="code" id="kode-peminjaman" class="form-control form-control-lg fw-bolder shadow-sm w-100 text-center mb-5" style="font-size:50px;letter-spacing:15px;" placeholder="Enter code" onkeypress="if(this.value.length == 6) return false" required>
                        <div class="w-100 d-flex justify-content-center align-items-center gap-5">
                            <button type="button" class="btn btn-lg btn-secondary" id="paste"><i class="fa-solid fa-paste"></i></button>
                            <button type="submit" class="btn btn-lg btn-primary fw-bold w-50">Find</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-4">
                        <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                    </div>
                    <div class="modal-body py-5">
                        <img src="assets/img/login.png" class="d-block mx-auto w-25 mb-4">
                        <h5 class="text-center fw-semibold m-0">Silahkan login terlebih dahulu!</h5>
                    </div>
                    <div class="modal-footer">
                        <a href="login" class="btn btn-lg btn-danger fw-bold w-25">Close</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php if(isset($id_admin)): ?>
        <script src="assets/js/show-tooltip.js"></script>
        <script src="assets/js/paste-code.js"></script>
    <?php else: ?>
        <script src="assets/js/show-modal.js"></script>
    <?php endif; ?>
</body>
</html>