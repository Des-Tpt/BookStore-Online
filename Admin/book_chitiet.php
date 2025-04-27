<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

$book_id = $_GET['id'];
$sql = "SELECT * FROM books WHERE book_id = '$book_id'";
$result = $connect->query($sql);

echo '<div class="book-detail">';
if ($row = $result->fetch_assoc()) {
    echo "<h3>Chi tiết sách</h3>";
    echo "<p><strong>Tên sách:</strong> " . htmlspecialchars($row['title']) . "</p>";
    echo "<p><strong>Tác giả:</strong> " . htmlspecialchars($row['author']) . "</p>";
    echo "<p><strong>Giá:</strong> " . number_format($row['price']) . " VNĐ</p>";
    echo "<p><strong>Tồn kho:</strong> " . $row['stock'] . "</p>";
    echo "<p><strong>Hình ảnh:</strong><br><img src='../User/" . $row['image'] . "'></p>";
    echo "<p><strong>Mô tả ngắn:</strong> " . nl2br(htmlspecialchars($row['description'])) . "</p>";
    echo "<p><strong>Mô tả chi tiết:</strong> " . nl2br(htmlspecialchars($row['detail_description'])) . "</p>";
} else {
    echo "<p>Không tìm thấy sách!</p>";
}
echo '</div>';

echo '<a href="index.php?do=books" class="back-link">Quay về danh sách</a>';
?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .book-detail {
        max-width: 700px;
        margin: 40px auto;
        padding: 20px 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .book-detail h3 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .book-detail p {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
        margin: 10px 0;
    }

    .book-detail p strong {
        color: #333;
        display: inline-block;
        width: 150px;
    }

    .book-detail img {
        margin-top: 10px;
        max-width: 100%;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .back-link {
        display: block;
        width: fit-content;
        margin: 20px auto;
        text-align: center;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .back-link:hover {
        background-color: #0056b3;
    }
</style>
