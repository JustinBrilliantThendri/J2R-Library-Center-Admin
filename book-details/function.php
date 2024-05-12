<?php 
    require_once "../config/database.php";

    $id_admin;
    $id_perpustakaan;
    $book_details;

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

    function get_book_details($id_buku){
        global $conn;
        $sql = "SELECT id_buku, judul_buku, cover, penulis, penerbit, deskripsi, rating, harga, stock FROM tb_buku WHERE id_buku = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_buku);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    function show_rating_stars($rating){
        $str = "";
        for($i = 1; $i <= 5; $i++){
            if($rating != 0){
                if($rating >= 1){
                    $str .= "<i class='fa-solid fa-star'></i>";
                    $rating--;
                }else{
                    $str .= "<i class='fa-solid fa-star-half-stroke'></i>";
                    $rating = 0;
                }
            }else{
                $str .= "<i class='fa-regular fa-star'></i>";
            }
        }
        return $str;
    }

    function check_in_perpustakaan($id_buku, $id_perpustakaan){
        global $conn;
        $sql = "SELECT * FROM tb_lokasi_buku WHERE id_buku = ? AND id_perpustakaan = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $id_buku, $id_perpustakaan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_num_rows($result);
    }

    function add_stock($id_buku, $count_stock){
        global $conn;
        $sql1 = "SELECT stock FROM tb_buku WHERE id_buku = ?";
        $stmt1 = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt1, "i", $id_buku);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1, $current_stock);
        mysqli_stmt_fetch($stmt1);
        $new_stock = $current_stock + $count_stock;
        mysqli_stmt_close($stmt1);
        $sql2 = "UPDATE tb_buku SET stock = ? WHERE id_buku = ?";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "ii", $new_stock, $id_buku);
        mysqli_stmt_execute($stmt2);
    }

    function add_to_this_library($id_buku, $id_perpustakaan){
        global $conn;
        $sql = "INSERT INTO tb_lokasi_buku VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $id_buku, $id_perpustakaan);
        mysqli_stmt_execute($stmt);
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
            if(isset($_GET["buku"]) && $_GET["buku"] != ""){
                $book_details = get_book_details($_GET["buku"]);
                $id_perpustakaan = get_id_perpustakaan($id_admin);
                check_due_date($id_perpustakaan);
            }else{
                header("Location: http://localhost/j2r-library-center-admin/books");
            }
        }else{
            header("Location: http://localhost/j2r-library-center-admin");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["add-stock"])){
            add_stock(intval($_POST["buku"]), intval($_POST["count-stock"]));
        }
        if(isset($_POST["add-to-this-library"])){
            $id_admin = $_SESSION["id_admin"] ?? $_COOKIE["id_admin"];
            $id_perpustakaan = get_id_perpustakaan($id_admin);
            add_to_this_library(intval($_POST["buku"]), $id_perpustakaan);
        }
    }
?>