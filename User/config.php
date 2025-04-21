<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


$servername = "localhost";
$username = "root";
$password = "vertrigo";
$dbname = "shopbook";

// Tạo kết nối
$connect = new mysqli($servername, $username, $password, $dbname);

// Thiết lập charset
mysqli_set_charset($connect, "utf8");

// Kiểm tra lỗi
if ($connect->connect_error) {
    die("Kết nối thất bại: " . $connect->connect_error);
}
?>