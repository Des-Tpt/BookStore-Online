<?php
    include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Việt Anh</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
<header class="main-header">
    <div class="header-title">
        <div class="logo">
            <span class="logo-icon">📚</span>
            <div class="logo-text-group">
                <span class="logo-text">Việt Anh</span>
                <span class="logo-small-text">Hàng sách Online</span>
            </div>
        </div>

        <div class="search-bar">
            <select>
            <option>Tất cả thể loại</option>
            <?php
                include "config.php";

                $result = mysqli_query($connect, "SELECT * FROM categories");

                while($row = mysqli_fetch_assoc($result)) {
                    echo '<option>' . $row['category_name'] . '</option>';
                }
            ?>
            </select>
            <input type="text" placeholder="Vui lòng nhập sách bạn muốn tìm...">
            <button>🔍</button>
        </div>

        <div class="account">
            <a href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1rTLeQraa9s-Rkj2_KMPOzh30CwK1G2D85A&s" alt="Người dùng" width="45px" ></a>
            <div class="login-signin">
                <?php if (isset($_SESSION['username'])): ?>
                    <span><?=htmlspecialchars($_SESSION['username'])?></span>
                <?php else : ?>
                <a class="login" href="../Admin/login_register.php">Đăng ký</a>
                <a class="signin" href="../Admin/login_register.php">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="cart-group">
            <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/1782/1782696.png" alt="Giỏ hàng" width="45px"></a>
            <div class="note-cart">
                <a class="cart" href="#">Giỏ hàng</a>
                <a class="total" href="#">0.00 VNĐ</a>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="margin-left-right-wrapped">
            <a href="index.php"><button class="home-button">Trang chủ</button></a>
            <div class="categories">
            <a href="categories.php"><button class="dropbtn">Thể loại</button></a>
            </div>
            <button class="policy-button">Chính sách</button>                  
            <button class="contact-button">Liên hệ</button>
            <button class="store-button">Mua hàng trực tiếp</button>
        </div>      
    </div>
    
</header>

</body>
</html>
