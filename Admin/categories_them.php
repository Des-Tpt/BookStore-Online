<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

if (isset($_POST['submit'])) {
    $name = $connect->real_escape_string($_POST['name']);

    $sql = "INSERT INTO categories (category_name) VALUES ('$name')";
    if ($connect->query($sql)) {
        header("Location: index.php?do=categories");
        exit();
    } else {
        echo "Thêm thất bại: " . $connect->error;
    }
}
?>

<style>
    form {
        max-width: 500px;
        margin: 30px auto;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    form label {
        font-weight: bold;
    }
    form input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    form button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    form button:hover {
        background-color: #218838;
    }
    a {
        display: block;
        width: fit-content;
        margin: 20px auto;
        text-decoration: none;
        color: #007bff;
        font-size: 16px;
    }
    a:hover {
        text-decoration: underline;
    }
    h2 {
        text-align: center;
        margin-top: 30px;
    }
</style>

<h2>Thêm Thể Loại Mới</h2>

<form method="post">
    <label>Tên thể loại:</label>
    <input type="text" name="name" required>

    <button type="submit" name="submit">➕ Thêm mới</button>
</form>

<a href="index.php?do=categories">← Quay lại danh sách</a>
