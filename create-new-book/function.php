<?php 
    require_once "../config/database.php";

    $id_admin;
    $status;

    function check_book_exists($judul_buku){
        global $conn;
        $sql = "SELECT * FROM tb_buku WHERE LOWER(judul_buku) = LOWER(?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $judul_buku);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt);
    }

    function get_id_perpustakaan($id_admin){
        global $conn;
        $sql = "SELECT id_perpustakaan FROM tb_admin WHERE id_admin = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_admin);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_perpustakaan);
        mysqli_stmt_fetch($stmt);
        return $id_perpustakaan;
    }

    function upload_new_book($judul_buku, $cover_name, $penulis, $penerbit, $deskripsi, $rating, $harga, $stock){
        global $conn;
        $cover_name = ($cover_name == "") ? "empty.png" : $cover_name;
        $sql = "INSERT INTO tb_buku VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssdii", $judul_buku, $cover_name, $penulis, $penerbit, $deskripsi, $rating, $harga, $stock);
        mysqli_stmt_execute($stmt);
    }

    function add_to_this_library($judul_buku, $id_perpustakaan){
        global $conn;
        $sql1 = "SELECT id_buku FROM tb_buku WHERE judul_buku = ?";
        $stmt1 = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt1, "s", $judul_buku);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1, $get_id_buku);
        mysqli_stmt_fetch($stmt1);
        $id_buku = $get_id_buku;
        mysqli_stmt_close($stmt1);
        $sql2 = "INSERT INTO tb_lokasi_buku VALUES (?, ?)";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "ii", $id_buku, $id_perpustakaan);
        mysqli_stmt_execute($stmt2);
    }

    function check_due_date($id_perpustakaan){
        global $conn;
        $sql = "UPDATE tb_history SET status = 'Dikembalikan' WHERE tanggal_pengembalian < NOW() AND status = 'Dipinjam' AND id_perpustakaan = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_perpustakaan);
        mysqli_stmt_execute($stmt);
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_SESSION["id_admin"]) || isset($_COOKIE["id_admin"])){
            $id_admin = $_SESSION["id_admin"] ?? $_COOKIE["id_admin"];
            $id_perpustakaan = get_id_perpustakaan($id_admin);
            check_due_date($id_perpustakaan);
        }else{
            header("Location: http://localhost/j2r-library-center-admin/books");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "POST"){
        $judul_buku = $_POST["judul"];
        $penulis = $_POST["penulis"];
        $penerbit = $_POST["penerbit"];
        $deskripsi = $_POST["deskripsi"];
        $harga = $_POST["harga"];
        $rating = $_POST["rating"];
        $stock = $_POST["stock"];
        $cover_file = $_FILES["cover-file"];
        if(check_book_exists($judul_buku) == 0){
            $id_admin = $_SESSION["id_admin"] ?? $_COOKIE["id_admin"];
            $id_perpustakaan = get_id_perpustakaan($id_admin);
            upload_new_book($judul_buku, $cover_file["name"], $penulis, $penerbit, $deskripsi, $rating, $harga, $stock);
            if($cover_file["error"] == 0){
                move_uploaded_file($cover_file["tmp_name"], "../assets/book-covers/{$cover_file['name']}");
                copy("../assets/book-covers/{$cover_file['name']}", "D:/xampp/htdocs/j2r-library-center/assets/book-covers/{$cover_file['name']}");
            }
            add_to_this_library($judul_buku, $id_perpustakaan);
            $status = 1;
        }else{
            $status = 2;
        }
    }
?>