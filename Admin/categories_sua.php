<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?do=categories");
    exit();
}

$id = (int)$_GET['id'];
$sql = "SELECT * FROM categories WHERE category_id = $id";
$result = $connect->query($sql);

if ($result->num_rows == 0) {
    echo "Không tìm thấy thể loại!";
    exit();
}

$cat = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $name = $connect->real_escape_string($_POST['name']);

    $update = "UPDATE categories SET category_name='$name' WHERE category_id=$id";
    if ($connect->query($update)) {
        header("Location: index.php?do=categories");
        exit();
    } else {
        echo "Cập nhật thất bại: " . $connect->error;
    }
}
?>

<style>
    .form-container {
        max-width: 500px;
        margin: 30px auto;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container label {
        font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-container button:hover {
        background-color: #0056b3;
    }

    .back-link {
        display: block;
        width: fit-content;
        margin: 20px auto;
        text-decoration: none;
        color: #007bff;
        font-size: 16px;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .page-title {
        text-align: center;
        margin-top: 30px;
    }
</style>

<div class="page-title">Chỉnh sửa Thể loại</div>

<form method="post" class="form-container">
    <label>Tên thể loại:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($cat['category_name']) ?>" required>

    <button type="submit" name="submit">Cập nhật</button>
</form>

<a href="index.php?do=categories" class="back-link">← Quay lại danh sách</a>
