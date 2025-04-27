<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

$sql = "SELECT books.*, categories.category_name
        FROM books
        LEFT JOIN categories ON books.category_id = categories.category_id
        ORDER BY book_id ASC";

$result = $connect->query($sql);
?>

<h3>Danh sách Sách</h3>
<a href="index.php?do=book_them">➕ Thêm sách mới</a>
<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Tên sách</th>
        <th>Tác giả</th>
        <th>Giá</th>
        <th>Tồn kho</th>
        <th>Danh mục</th>
        <th>Ảnh</th>
        <th>Hành động</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr style='text-align: center; background-color: #ffffff;' onmouseover=\"this.style.background='#dee3e7'\" onmouseout=\"this.style.background='#ffffff'\">";
        echo "<td>" . $row['book_id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . number_format($row['price']) . " VNĐ</td>";
        echo "<td>" . $row['stock'] . "</td>";
        echo "<td>" . ($row['category_name'] ?? 'Chưa phân loại') . "</td>";
        echo "<td><img src='../User/". $row['image'] . "' width='80'></td>";
        echo "<td>
            <a href='index.php?do=book_chitiet&id=" . $row['book_id'] . "'>👀 Xem</a> | 
            <a href='index.php?do=book_sua&id=" . $row['book_id'] . "'>✏️ Sửa</a> | 
            <a href='index.php?do=book_xoa&id=" . $row['book_id'] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">🗑️ Xóa</a>
        </td>";
        echo "</tr>";

    } 
    ?>
</table>
