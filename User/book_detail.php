<?php
include "config.php";
$id = $_GET['id'] ?? 0;
$query = mysqli_query($connect, "SELECT * FROM books WHERE book_id = $id");
$book = mysqli_fetch_assoc($query);

$category_query = mysqli_query($connect,"SELECT * FROM books WHERE book_id = $id");
$category_row = mysqli_fetch_assoc($category_query);
$category_id = $category_row['category_id'];

$slide_result = mysqli_query($connect,"SELECT * FROM books WHERE category_id = $category_id AND book_id != $id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Việt Anh</title>
    <link rel="stylesheet" href="css/book_detail.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
</head>
<body>
    <div>
    <?php
        include "header.php";
    ?>
    </div>

    <div class="book-detail-container">
        <div class="book-image">
            <img src="<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
        </div>

        <div class="middle-part">
        <div class="book-info">
            <h2 class="title-book"><?= htmlspecialchars($book['title']) ?></h2>
            <p><strong>Tác giả:</strong> <?= htmlspecialchars($book['author']) ?></p>
            <p><strong>Giá:</strong> 
            <?php if ($book['discount_percent'] > 0): 
                $discounted_price = $book['price'] * (1 - $book['discount_percent'] / 100);
            ?>
                <span class="price discounted"><?= number_format($discounted_price, 0, ',', '.') ?>đ</span>
                <span class="original-price"><?= number_format($book['price'], 0, ',', '.') ?>đ</span>
                <span class="discount-label">-<?= $book['discount_percent'] ?>%</span>
            <?php else: ?>
                <span class="price discounted"><?= number_format($book['price'], 0, ',', '.') ?>đ</span>
            <?php endif; ?>
            </p>
            <p><strong>Mô tả chi tiết:</rong> <?= nl2br(htmlspecialchars($book['detail_description'])) ?></p>
        </div>
        <div class="shipping-info">
            <div class="info"><span>Thông tin vận chuyển:</span></div>
            <div class="address">
                <span>Giao đến: số 1093, Hòa An, Chợ Mới, An Giang...</span>
                <span><a href="#">Đổi</a></span>
            </div>
            <div class="shipping-text">
                <div class="shipping-text-container">
                <span>🚚</span>
                <span><strong>Giao hàng tiêu chuẩn:</strong></span><br>
                <div class="shipping-text-container-p"><p1> Dự kiến giao Thứ 5, 25/04 - Thứ 7, 27/04.</p1></div>
                </div>
                <p class="free-ship">Miễn phí vận chuyển cho đơn từ 150.000đ</p>
            </div>
        </div>
        </div>

        <div class="book-actions">
             <p><strong>Số lượng</strong></p>
            <div class="quantity-selector">
                <button onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" value="1" min="1">                
                <button onclick="increaseQuantity()">+</button>
            </div>

            <p><strong>Tạm tính</strong></p>
            <div class="subtotal" id="subtotal">
                <?= number_format($book['price'], 0, ',', '.') ?>đ
            </div>

            <button class="buy-now">Mua ngay</button>
            <button class="add-to-cart">Thêm vào giỏ</button>
            <button class="buy-later">Mua trước trả sau</but>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-text">
            <h1>Cùng thể loại</h1>
        </div>
        <div class="swiper mySwiper"> 
            <div class="swiper-wrapper">
                <?php while($row = $slide_result -> fetch_assoc()): ?>

                    <?php
                        $original_price = $row['price']; 
                        $discount_percent = $row['discount_percent'];
                        $discounted_price = $original_price * (100 - $discount_percent) / 100;
                    ?>
                    <div class="swiper-slide">
                        <div class="book-item">
                            <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>" class ="book-image-swiper">
                            <a href="book_detail.php?id= <?= $row['book_id'] ?>" class="book-overlay">
                            <span>Xem chi tiết</span>
                            </a>
                            <div class="book-title"><?= $row['title'] ?></div>
                            <div class="book-pricing">
                            <?php if ($original_price > $discounted_price): ?>
                                <del><?= number_format($original_price) ?>₫</del>
                                <span class="discounted-swiper"><?= number_format($discounted_price) ?>₫</span>
                                <span class="discount-tag">-<?= $discount_percent ?>%</span>
                                <?php else: ?>
                                <span class="discounted-swiper"><?= number_format($original_price) ?>₫</span>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        </div>

    <div>
        <?php
            include 'footer.php';
        ?>
    </div>

    <script>
    const originalPrice = <?= $book['price'] ?>;
    const discountPercent = <?= $book['discount_percent'] ?>;
    const price = discountPercent > 0 ? originalPrice * (1 - discountPercent / 100) : originalPrice;

    function updateSubtotal() {
        const quantity = parseInt(document.getElementById('quantity').value);
        const subtotal = price * quantity;
        document.getElementById('subtotal').innerText = subtotal.toLocaleString('vi-VN') + 'đ';
    }

    function decreaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value--;
            updateSubtotal();
        }
    }

    function increaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        quantityInput.value++;
        updateSubtotal();
    }

    document.getElementById('quantity').addEventListener('input', updateSubtotal);

   
    updateSubtotal();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 5,
                spaceBetween: 20,
                navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                },
            loop: true,
            });
    </script>
    
</body>

</html>