<?php 
    require_once "../config/database.php";

    $orders;

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

    function get_all_orders($id_perpustakaan){
        global $conn;
        $sql = "SELECT tb_history.kode_peminjaman, tb_user.nama_user, tb_kota.nama_kota, tb_buku.judul_buku, tb_buku.cover, tb_buku.harga, tb_history.tanggal_peminjaman, tb_history.tanggal_pengembalian, tb_history.status FROM (((tb_history INNER JOIN tb_user ON tb_history.id_user = tb_user.id_user) INNER JOIN tb_kota ON tb_user.id_kota = tb_kota.id_kota) INNER JOIN tb_buku ON tb_history.id_buku = tb_buku.id_buku) WHERE tb_history.id_perpustakaan = ? and tb_history.status in ('Dipinjam', 'Dikembalikan')";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_perpustakaan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function return_peminjaman($kode_peminjaman, $id_user, $id_perpustakaan, $id_buku){
        global $conn;
        $sql1 = "UPDATE tb_user SET status = 'Idle' WHERE id_user = ?";
        $stmt1 = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt1, "i", $id_user);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);
        $sql2 = "UPDATE tb_history SET status = 'Done' WHERE kode_peminjaman = ? AND id_perpustakaan = ?";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "s", $kode_peminjaman, $id_perpustakaan);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        $sql3 = "SELECT stock FROM tb_buku WHERE id_buku = ?";
        $stmt3 = mysqli_prepare($conn, $sql3);
        mysqli_stmt_bind_param($stmt3, "i", $id_buku);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $current_stock);
        mysqli_stmt_fetch($stmt3);
        $stock = ++$current_stock;
        mysqli_stmt_close($stmt3);
        $sql4 = "UPDATE tb_buku SET stock = ? WHERE id_buku = ?";
        $stmt4 = mysqli_prepare($conn, $sql4);
        mysqli_stmt_bind_param($stmt4, "ii", $stock, $id_buku);
        mysqli_stmt_execute($stmt4);
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
            $orders = get_all_orders($id_perpustakaan);
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
        if(isset($_POST["return"])){
            $id_admin = $_SESSION["id_admin"] ?? $_COOKIE["id_admin"];
            $kode_peminjaman = $_POST["code"];
            $id_user = $_POST["user"];
            $id_perpustakaan = get_id_perpustakaan($id_admin);
            $id_buku = $_POST["buku"];
            return_peminjaman($kode_peminjaman, $id_user, $id_perpustakaan, $id_buku);
            header("Location: http://localhost/j2r-library-center-admin/order");
        }
    }
?>