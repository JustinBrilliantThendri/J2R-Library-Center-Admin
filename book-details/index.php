<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J2R Library Center Admin - Book Details</title>
    <link rel="icon" type="icon/x-image" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
    <div class="container-fluid px-0 py-5 d-flex justify-content-center align-items-center">
        <?php if($_SERVER["REQUEST_METHOD"] == "GET"): ?>
            <div class="card w-75 border-3">
                <div class="card-header border-3 py-4 px-5 d-flex align-items-center justify-content-between">
                    <a href="../books" class="text-decoration-none text-black" style="font-size:40px;">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </a>
                    <h1 class="fw-bold m-0">Book details</h1>
                    <i class="fa-solid fa-arrow-left-long" style="font-size:40px;opacity:0;"></i>
                </div>
                <div class="card-body border-3 p-5">
                    <div class="row">
                        <div class="col-3">
                            <img src="../assets/book-covers/<?= $book_details["cover"]; ?>" class="w-100">
                        </div>
                        <div class="col-9 ps-5">
                            <h1 class="mb-5 fw-semibold"><?= $book_details["judul_buku"]; ?></h1>
                            <table class="table mb-5">
                                <tr>
                                    <td class="fw-bold">Writer</td>
                                    <td><?= $book_details["penulis"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Publisher</td>
                                    <td><?= $book_details["penerbit"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Description</td>
                                    <td><?= $book_details["deskripsi"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Rating</td>
                                    <td><?= show_rating_stars($book_details["rating"]) . " / " . $book_details["rating"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Price</td>
                                    <td>Rp <?= number_format($book_details["harga"], "2", ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Stock</td>
                                    <td><?= $book_details["stock"]; ?> buku</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center <?= (check_in_perpustakaan($book_details["id_buku"], $id_perpustakaan) == 0) ? "text-danger" : ""; ?> fw-bold"><?= (check_in_perpustakaan($book_details["id_buku"], $id_perpustakaan) == 1) ? "This book is in your library" : "This book is not in your library"; ?></td>
                                </tr>
                            </table>
                            <form action="" method="post" class="w-100 d-flex justify-content-end align-items-center">
                                <input type="hidden" name="buku" value="<?= $book_details["id_buku"]; ?>">
                                <?php if(check_in_perpustakaan($book_details["id_buku"], $id_perpustakaan) == 1): ?>
                                    <div class="input-group input-group-lg w-25 me-5">
                                        <button type="button" class="btn btn-lg btn-secondary" id="minus-stock">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                        <input type="number" name="count-stock" value="1" id="show-stock" class="form-control form-control-lg fw-bold text-center" readonly>
                                        <button type="button" class="btn btn-lg btn-secondary" id="plus-stock">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                    <button type="submit" name="add-stock" class="btn btn-lg btn-primary fw-bold w-25">Add stock</button>
                                <?php else: ?>
                                    <button type="submit" name="add-to-this-library" class="btn btn-lg btn-primary fw-bold w-50">Add to this library</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-4">
                            <h1 class="modal-title text-center fw-bolder mx-auto">Status</h1>
                        </div>
                        <div class="modal-body py-5">
                            <img src="../assets/img/success.png" class="d-block mx-auto w-25 mb-4">
                            <h5 class="text-center fw-semibold m-0">
                                <?php if(isset($_POST["add-stock"])): ?>
                                    Selamat! Stock buku ini berhasil ditambahkan.
                                <?php elseif(isset($_POST["add-to-this-library"])): ?>
                                    Selamat! Buku ini berhasil ditambahkan ke perpustakaan kamu.
                                <?php endif; ?>
                            </h5>
                        </div>
                        <div class="modal-footer">
                            <a href="" class="btn btn-lg btn-danger text-decoration-none fw-bold w-25">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php if($_SERVER["REQUEST_METHOD"] == "GET" && check_in_perpustakaan($book_details["id_buku"], $id_perpustakaan) == 1): ?>
        <script src="../assets/js/add-stock.js"></script>
    <?php elseif($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <script src="../assets/js/show-modal.js"></script>
    <?php endif; ?>
</body>
</html>