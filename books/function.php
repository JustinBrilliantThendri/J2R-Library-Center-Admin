<?php 
    require_once "../config/database.php";

    $id_admin;
    $id_perpustakaan;
    $books;

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

    function get_books($id_perpustakaan, $opt){
        if($opt == ""){
            $opt = "1";
        }
        global $conn;
        $sql = "";
        if($opt == "1"){
            $sql = "SELECT tb_buku.id_buku, tb_buku.judul_buku, tb_buku.cover FROM tb_lokasi_buku INNER JOIN tb_buku on tb_lokasi_buku.id_buku = tb_buku.id_buku WHERE id_perpustakaan = ?";
        }elseif($opt == "2"){
            $sql = "SELECT id_buku, judul_buku, cover FROM tb_buku";
        }
        $stmt = mysqli_prepare($conn, $sql);
        if($opt == "1"){
            mysqli_stmt_bind_param($stmt, "i", $id_perpustakaan);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
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
            $books = get_books($id_perpustakaan, $_GET["opt"] ?? "1");
            check_due_date($id_perpustakaan);
        }else{
            header("Location: http://localhost/j2r-library-center-admin");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["logout"])){
            setcookie("id_admin", "", time() - 3600, "/");
            unset($_SESSION["id_admin"]);
            header("Location: http://localhost/j2r-library-center-admin/login");
        }
    }
?>