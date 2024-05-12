<?php 
    require_once "../config/database.php";

    $status;
    $results;

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

    function check_kode_tersedia($kode){
        global $conn;
        $sql = "SELECT * FROM tb_kode_peminjaman WHERE kode_peminjaman = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $kode);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt);
    }

    function get_results($kode){
        global $conn;
        $sql = "SELECT tb_kode_peminjaman.kode_peminjaman, tb_user.nama_user, tb_kota.nama_kota, tb_buku.judul_buku, tb_buku.cover, tb_buku.harga, tb_kode_peminjaman.durasi, tb_kode_peminjaman.tanggal_expire FROM (((tb_kode_peminjaman INNER JOIN tb_user ON tb_kode_peminjaman.id_user = tb_user.id_user) INNER JOIN tb_kota ON tb_user.id_kota = tb_kota.id_kota) INNER JOIN tb_buku ON tb_kode_peminjaman.id_buku = tb_buku.id_buku) WHERE kode_peminjaman = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $kode);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    function get_data_from_kode($kode){
        global $conn;
        $sql = "SELECT kode_peminjaman, id_user, id_perpustakaan, durasi FROM tb_kode_peminjaman WHERE kode_peminjaman = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $kode);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    function get_harga_buku($id_buku){
        global $conn;
        $sql = "SELECT harga FROM tb_buku WHERE id_buku = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_buku);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $harga);
        mysqli_stmt_fetch($stmt);
        return $harga;
    }

    function confirm_peminjaman($kode_peminjaman, $id_user, $id_perpustakaan, $id_buku, $tanggal_pengembalian, $harga){
        global $conn;
        $sql1 = "INSERT INTO tb_history VALUES (?, ?, ?, ?, NOW(), ?, 'Dipinjam')";
        $stmt1 = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt1, "siiis", $kode_peminjaman, $id_user, $id_perpustakaan, $id_buku, $tanggal_pengembalian);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);
        $sql2 = "UPDATE tb_user SET status = 'Meminjam buku' WHERE id_user = ?";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "i", $id_user);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        $sql3 = "SELECT banyak_peminjaman, penghasilan FROM tb_perpustakaan WHERE id_perpustakaan = ?";
        $stmt3 = mysqli_prepare($conn, $sql3);
        mysqli_stmt_bind_param($stmt3, "i", $id_perpustakaan);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $banyak_peminjaman, $penghasilan);
        mysqli_stmt_fetch($stmt3);
        $new_banyak_peminjaman = ++$banyak_peminjaman;
        $new_penghasilan = $penghasilan + $harga;
        mysqli_stmt_close($stmt3);
        $sql4 = "UPDATE tb_perpustakaan SET banyak_peminjaman = ?, penghasilan = ? WHERE id_perpustakaan = ?";
        $stmt4 = mysqli_prepare($conn, $sql4);
        mysqli_stmt_bind_param($stmt4, "iii", $new_banyak_peminjaman, $new_penghasilan, $id_perpustakaan);
        mysqli_stmt_execute($stmt4);
        mysqli_stmt_close($stmt4);
        $sql5 = "DELETE FROM tb_kode_peminjaman WHERE kode_peminjaman = ?";
        $stmt5 = mysqli_prepare($conn, $sql5);
        mysqli_stmt_bind_param($stmt5, "s", $kode_peminjaman);
        mysqli_stmt_execute($stmt5);
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
            if(isset($_GET["code"]) && $_GET["code"] != ""){
                $kode = $_GET["code"];
                if(check_kode_tersedia($kode) == 1){
                    $results = get_results($kode);
                    $status = 1;
                }else{
                    $status = 2;
                }
            }else{
                header("Location: http://localhost/j2r-library-center-admin");
            }
        }else{
            header("Location: http://localhost/j2r-library-center-admin");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["confirm"])){
            $peminjaman = get_data_from_kode($_POST["kode"]);
            $kode_peminjaman = $peminjaman["kode_peminjaman"];
            $id_user = $peminjaman["id_user"];
            $id_perpustakaan = $peminjaman["id_perpustakaan"];
            $id_buku = $peminjaman["id_perpustakaan"];
            $harga = get_harga_buku($id_buku);
            $tanggal_pengembalian = date("Y-m-d H:i:s", time() + ($peminjaman["durasi"] * 7 * 86400));
            confirm_peminjaman($kode_peminjaman, $id_user, $id_perpustakaan, $id_buku, $tanggal_pengembalian, $harga);
        }
    }
?>