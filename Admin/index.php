<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../User/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        body { margin: 0; font-family: Arial; }
        #TrangWeb { display: flex; flex-direction: column; height: 100vh; }
        #PhanDau { background: #222; color: white; padding: 10px; }
        #PhanGiua { display: flex; flex: 1; }
        #BenTrai { width: 200px; background: #f0f0f0; padding: 10px; }
        #BenPhai { flex: 1; padding: 20px; overflow-y: auto; }
        #PhanCuoi { background: #ddd; text-align: center; padding: 10px; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 5px; }
        a { text-decoration: none; color: #333; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div id="TrangWeb">
    <!-- Content -->
    <div id="PhanGiua">
        <!-- Sidebar -->
        <div id="BenTrai">
            <h3>Quản lý</h3>
            <ul>
                <li><a href="index.php?do=users">Người dùng</a></li>
                <li><a href="index.php?do=books">Sách</a></li>
                <li><a href="index.php?do=categories">Thể loại</a></li>
            </ul>

            <?php if (isset($_SESSION['MaND'])): ?>
                <h3>Hồ sơ cá nhân</h3>
                <ul>
                    <li><a href="index.php?do=hosocanhan">Hồ sơ</a></li>
                    <li><a href="index.php?do=doimatkhau">Đổi mật khẩu</a></li>
                </ul>
            <?php endif; ?>

            <h3>Khác</h3>
            <ul>
                <li><a href="#">.......</a></li>
                <li><a href="#">.......</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div id="BenPhai">
            <?php
                $do = $_GET['do'] ?? "home";
                $file = $do . ".php";
                if (file_exists($file)) {
                    include $file;
                } else {
                    echo "<h2>404 - Không tìm thấy trang</h2>";
                }
            ?>
        </div>
    </div>
</div>
</body>