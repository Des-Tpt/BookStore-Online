<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

$categories = [];
$sql_cate = "SELECT * FROM categories ORDER BY category_name ASC";
$res_cate = $connect->query($sql_cate);
while ($cate = $res_cate->fetch_assoc()) {
    $categories[] = $cate;
}

if (isset($_POST['them'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $detail_description = $_POST['detail_description'];
    $category_id = $_POST['category_id'];
    $discount_percent = $_POST['discount_percent'];

    $image_input = $_POST['image'];
    $image_name = 'Image/' . $image_input;

    $sql = "INSERT INTO books (title, author, price, stock, image, description, detail_description, category_id, discount_percent)
            VALUES ('$title', '$author', '$price', '$stock', '$image_name', '$description', '$detail_description', '$category_id', '$discount_percent')";

    if ($connect->query($sql)) {
        header("Location: index.php?do=books");
        exit();
    } else {
        echo "Thêm thất bại!";
    }
}
?>

<style>
    .form-container {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 20px;
    }

    .form-heading {
        text-align: center;
        color: #333;
        margin-top: 30px;
    }

    .form-box {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-box label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
        display: block;
    }

    .form-box input[type="text"],
    .form-box input[type="number"],
    .form-box textarea,
    .form-box select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-box input[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-box input[type="submit"]:hover {
        background-color: #218838;
    }
    
</style>

<div class="form-container">
    <h3 class="form-heading">Thêm sách mới</h3>
    <form method="post" enctype="multipart/form-data" class="form-box">
        <label for="title">Tên sách:</label>
        <input type="text" name="title" id="title" required>

        <label for="author">Tác giả:</label>
        <input type="text" name="author" id="author" required>

        <label for="price">Giá:</label>
        <input type="number" name="price" id="price" required>

        <label for="stock">Tồn kho:</label>
        <input type="number" name="stock" id="stock" required>

        <label for="image">Ảnh bìa sách:</label>
        <input type="text" name="image" id="image" placeholder="Nhập tên ảnh (ví dụ: abc.jpg)">

        <label for="description">Mô tả ngắn:</label>
        <textarea name="description" id="description"></textarea>

        <label for="detail_description">Mô tả chi tiết:</label>
        <textarea name="detail_description" id="detail_description"></textarea>

        <label for="category_id">Danh mục:</label>
        <select name="category_id" id="category_id" required>
            <?php foreach ($categories as $cate): ?>
                <option value="<?= $cate['category_id']; ?>"><?= htmlspecialchars($cate['category_name']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="discount_percent">Giảm giá (%):</label>
        <input type="number" name="discount_percent" id="discount_percent" value="0">

        <input type="submit" name="them" value="Thêm sách">
    </form>
</div>
