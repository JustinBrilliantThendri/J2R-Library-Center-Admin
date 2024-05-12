<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin - Create New Book</title>
    <link rel="icon" type="icon/x-image" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
    <?php if(isset($status)): ?>
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-4">
                        <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                    </div>
                    <div class="modal-body py-5">
                        <img src="../assets/img/<?= ($status == 1) ? "success.png" : "fail.png"; ?>" class="d-block mx-auto w-25 mb-4">
                        <h5 class="text-center fw-semibold m-0">
                            <?php if($status == 1): ?>
                                Selamat! Anda berhasil menambahkan buku baru.
                            <?php elseif($status == 2): ?>
                                Maaf! Judul buku anda telah ada sebelumnya.
                            <?php endif; ?>
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= ($status == 1) ? "../books" : ""; ?>" class="btn btn-lg btn-danger fw-bold w-25">Close</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container-fluid position-absolute d-flex align-items-center justify-content-center p-5">
            <div class="card w-75 shadow border-3">
                <div class="card-header border-3 py-4 px-5 d-flex align-items-center justify-content-between">
                    <a href="../books" class="text-decoration-none text-black" style="font-size:40px;">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </a>
                    <h1 class="fw-bold m-0">Create new book</h1>
                    <i class="fa-solid fa-arrow-left-long" style="font-size:40px;opacity:0;"></i>
                </div>
                <div class="card-body border-3 p-5">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-3 d-flex flex-column gap-4">
                                <label for="change-cover" style="cursor:pointer;" data-bs-toggle="tooltip" title="Click to add cover">
                                    <img src="../assets/book-covers/empty.png" class="w-100" id="cover">
                                </label>
                                <input type="file" name="cover-file" class="d-none" id="change-cover">
                                <p class="fw-semibold text-center m-0 text-secondary">Hover and click to add cover</p>
                            </div>
                            <div class="col-9 ps-5">
                                <div class="form-floating fw-bold mb-4">
                                    <input type="text" name="judul" class="form-control form-control-lg" placeholder="Judul buku" autocomplete="off" required>
                                    <label class="form-label">Judul buku</label>
                                </div>
                                <div class="form-floating fw-bold mb-4">
                                    <input type="text" name="penulis" class="form-control form-control-lg" placeholder="Penulis" autocomplete="off" required>
                                    <label class="form-label">Penulis</label>
                                </div>
                                <div class="form-floating fw-bold mb-4">
                                    <input type="text" name="penerbit" class="form-control form-control-lg" placeholder="Penerbit" autocomplete="off" required>
                                    <label class="form-label">Penerbit</label>
                                </div>
                                <div class="form-floating fw-bold mb-4">
                                    <textarea name="deskripsi" class="form-control form-control-lg" placeholder="Deksripsi" autocomplete="off" style="height:150px;resize:none;" required></textarea>
                                    <label class="form-label">Deksripsi</label>
                                </div>
                                <div class="form-floating fw-bold mb-4">
                                    <input type="number" name="harga" class="form-control form-control-lg" placeholder="Harga (Rp)" autocomplete="off" required>
                                    <label class="form-label">Harga (Rp)</label>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-6 d-flex align-items-center gap-4">
                                        <label class="form-label fw-bold m-0">Rating</label>
                                        <div class="input-group input-group-lg w-50">
                                            <button type="button" class="btn btn-lg btn-secondary" id="minus-rating">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="number" name="rating" value="0.0" id="show-rating" class="form-control form-control-lg text-center" autocomplete="off" step="any" required readonly>
                                            <button type="button" class="btn btn-lg btn-secondary" id="plus-rating">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex align-items-center gap-4">
                                        <label class="form-label fw-bold m-0">Stock</label>
                                        <div class="input-group input-group-lg w-50">
                                            <button type="button" class="btn btn-lg btn-secondary" id="minus-stock">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="number" name="stock" value="1" id="show-stock" class="form-control form-control-lg text-center" autocomplete="off" step="any" required readonly>
                                            <button type="button" class="btn btn-lg btn-secondary" id="plus-stock">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary fw-bold w-25 d-block ms-auto">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php if(isset($status)): ?>
        <script src="../assets/js/show-modal.js"></script>
    <?php else: ?>
        <script src="../assets/js/show-tooltip.js"></script>
        <script src="../assets/js/change-cover.js"></script>
        <script src="../assets/js/add-rating.js"></script>
        <script src="../assets/js/add-stock.js"></script>
    <?php endif; ?>
</body>
</html>