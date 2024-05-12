<?php 
    require_once "../config/database.php";

    $status;

    function get_admin($nama_admin){
        global $conn;
        $sql = "SELECT id_admin, password FROM tb_admin WHERE nama_admin = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $nama_admin);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_SESSION["id_admin"]) || isset($_COOKIE["id_admin"])){
            header("Location: http://localhost/j2r-library-center-admin/");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama_admin = test_input($_POST["nama-admin"]);
        $password = test_input($_POST["password"]);
        $data_admin = get_admin($nama_admin);
        if(!empty($data_admin)){
            if(password_verify($password, $data_admin["password"])){
                $_SESSION["id_admin"] = $data_admin["id_admin"];
                if(isset($_POST["remember-me"])){
                    setcookie("id_admin", $data_admin["id_admin"], time() + 86400, "/");
                }
                $status = 1;
            }else{
                $status = 2;
            }
        }else{
            $status = 3;
        }
    }
?>