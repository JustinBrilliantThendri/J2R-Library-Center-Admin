<?php 
    require_once "../config/database.php";
    
    $status;
    $diff;

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

    function get_result($code, $id_perpustakaan){
        global $conn;
        $sql = "SELECT tanggal_pengembalian, status FROM tb_history WHERE kode_peminjaman = ? AND id_perpustakaan = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $code, $id_perpustakaan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $id_admin = $_SESSION["id_admin"] ?? $_COOKIE["id_admin"];
        $id_perpustakaan = get_id_perpustakaan($id_admin);
        if(isset($_GET["code"])){
            $code = $_GET["code"];
            $result = get_result($code, $id_perpustakaan);
            $status = $result["status"];
            $diff = strtotime($result["tanggal_pengembalian"]) - time() - 25200;
        }
    }
?>
<?php if($status == "Dipinjam"): ?>
    <?php if($diff >= 0): ?>
        <p class="fw-semibold m-0 text-danger"><?= date("d", $diff - 86400) . " hari " . date("H", $diff) . " jam " . date("i", $diff) . " menit " . date("s", $diff) . " detik"; ?></p>
        <button type="button" class="btn btn-danger fw-bold w-25" disabled>Return</button>
    <?php else: ?>
        <script>window.location.reload();</script>
    <?php endif; ?>
<?php elseif($status == "Dikembalikan"): ?>
    <form action="" method="post">
        <input type="hidden" name="code" value="<?= $each["kode_peminjaman"]; ?>">
        <input type="hidden" name="user" value="<?= $each["id_user"]; ?>">
        <input type="hidden" name="buku" value="<?= $each["id_buku"]; ?>">
        <button type="submit" name="return" class="btn btn-danger fw-bold w-25">Return</button>
    </form>
<?php endif; ?>