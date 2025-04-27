<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

$sql = "SELECT * FROM categories ORDER BY category_id ASC";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Không thể thực hiện câu lệnh SQL: " . mysqli_error($conn));
}
?>

<h2>Danh sách Thể loại</h2>

<a href="index.php?do=categories_them">➕ Thêm danh mục...</a>
<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên thể loại</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $row['category_id'] ?></td>
        <td><?= $row['category_name'] ?></td>
        <td>
            <a href="index.php?do=categories_sua&id=<?= $row['category_id'] ?>">Sửa</a> |
            <a href="index.php?do=categories_xoa&id=<?= $row['category_id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<style>
    h2 {
        text-align: center;
        margin-top: 20px;
        color: #333;
    }


    a:hover {
        background-color: #218838;
    }

    table {
        width: 80%;
        margin: 0 auto 30px;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    table th, table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table a {
        background-color: #007bff;
        padding: 5px 10px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        font-size: 13px;
    }

    table a:hover {
        background-color: #0056b3;
    }
</style>
