<?php 
    require_once "constants.php";

    date_default_timezone_set("Asia/Jakarta");

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if(!$conn){
        die(mysqli_connect_error());
    }

    function test_input($input){
        global $conn;
        return mysqli_real_escape_string($conn, htmlspecialchars(stripslashes(trim($input))));
    }

    session_start();
?>