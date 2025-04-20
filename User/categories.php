<?php
    include "config.php";
    include "header.php";

    $selected_category = $_GET['category'] ?? '';
    $selected_price = $_GET['price'] ?? '';

    $sql = "SELECT books.*, categories.category_name 
        FROM books 
        JOIN categories ON books.category_id = categories.category_id 
        WHERE 1";
    
    if (!empty($selected_category)) {
        $selected_category = (int)$selected_category;
        $sql .= " AND books.category_id = $selected_category";
    }

    if (!empty($selected_price)) {
        $price_range = explode('-', $selected_price);
        if (count($price_range) == 2) {
            $min = (int)$price_range[0];
            $max = (int)$price_range[1];
            $sql .= " AND books.price BETWEEN $min AND $max";
        }
    }
    $result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Việt Anh</title>
        <link rel="stylesheet" href="css/categories.css">
    </head>
    <body>
        <div class="main-page">
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>
        <div class="book-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($book = mysqli_fetch_assoc($result)): 
                $discounted_price = $book['price'] * (1 - $book['discount_percent'] / 100);
            ?>
                <div class="book-item">
                    <a href="book_detail.php?id=<?= $book['book_id']?>" class="book-overlay">
                        <span>Xem chi tiết</span>
                    </a>
                    <img src="<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
                    <h4><?= htmlspecialchars($book['title']) ?></h4>
                    <p>Tác giả: <?= htmlspecialchars($book['author']) ?></p>
                    <p>
                    <span class="price"><?= number_format($discounted_price, 0, ',', '.') ?>đ</span>
                    <?php if ($book['discount_percent'] > 0): ?>
                    <span class="original-price"><?= number_format($book['price'], 0, ',', '.') ?>đ</s>
                    <?php endif; ?>
                    </p>
                </div>

            <?php endwhile; ?>
            <?php else: ?>
            <p class="undefined-text">Không có sách nào phù hợp với bộ lọc.</p>
            <?php endif; ?>

        </div>
        </div>
    </body>
    <footer>
        <?php
            include 'footer.php';
        ?>
    </footer>
</html>