<?php 
    require_once "../config/database.php";

    $id_admin;
    $data_admin;

    function get_data_admin($id_admin){
        global $conn;
        $sql = "SELECT tb_perpustakaan.nama_perpustakaan, tb_admin.nama_admin, tb_kota.nama_kota, tb_perpustakaan.alamat, tb_perpustakaan.maps, tb_perpustakaan.banyak_peminjaman, tb_perpustakaan.penghasilan FROM ((tb_admin INNER JOIN tb_perpustakaan ON tb_admin.id_perpustakaan = tb_perpustakaan.id_perpustakaan) INNER JOIN tb_kota ON tb_perpustakaan.id_kota = tb_kota.id_kota) WHERE id_admin = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_admin);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
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
            $data_admin = get_data_admin($id_admin);
            $id_perpustakaan = get_id_perpustakaan($id_admin);
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