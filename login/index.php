<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin - Login</title>
    <link rel="icon" type="icon/x-image" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
    <?php if($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php if($status == 1): ?>
            <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-4">
                            <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                        </div>
                        <div class="modal-body py-5">
                            <img src="../assets/img/success.png" class="d-block mx-auto w-25 mb-4">
                            <h5 class="text-center fw-semibold m-0">Selamat! Anda berhasil login.</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-danger fw-bold w-25" data-bs-dismiss="modal" onclick="location.href='../'">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-4">
                <div class="toast">
                    <div class="toast-header justify-content-between px-3">
                        <h5 class="m-0 fw-bold">Status</h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body p-3">
                        <p class="m-0 fw-semibold text-danger">
                            <?= ($status == 2) ? "Password salah!" : "Nama admin tidak tersedia!"; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container-fluid position-absolute h-100 d-flex justify-content-center align-items-center flex-column">
        <img src="../assets/img/logo.png" class="w-25 mb-5">
        <div class="card w-50 shadow">
            <div class="card-header py-4">
                <h1 class="text-center m-0 text-secondary fw-bolder">Admin Login</h1>
            </div>
            <div class="card-body p-4">
                <form action="" method="post" class="w-100">
                    <div class="form-floating mb-4 fw-bold">
                        <input type="text" name="nama-admin" id="nama-admin" class="form-control" placeholder="Admin name" autocomplete="off" required>
                        <label for="nama-admin" class="form-label">Admin name</label>
                    </div>
                    <div class="form-floating mb-4 fw-bold">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input type="checkbox" name="remember-me" id="remember-me" class="form-check-input">
                        <label for="remember-me" class="form-check-label fw-bold">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary fw-bold d-block ms-auto w-25">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php if($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php if($status == 1): ?>
            <script src="../assets/js/show-modal.js"></script>
        <?php else: ?>
            <script src="../assets/js/show-toast.js"></script>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>