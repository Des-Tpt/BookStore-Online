<?php
include(__DIR__ . '/../User/config.php');

if (!isset($_GET['id'])) {
    die("Không có ID người dùng.");
}
$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $email     = $_POST['email'];
    $role      = $_POST['role'];

    $sql = "UPDATE users SET 
                full_name = '$full_name',
                username  = '$username',
                email     = '$email',
                role      = '$role'
            WHERE user_id = $id";

    if ($connect->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
    } else {
        echo "Lỗi: " . $connect->error;
    }
}

$sql = "SELECT * FROM users WHERE user_id = $id";
$result = $connect->query($sql);
if ($result->num_rows != 1) {
    die("Không tìm thấy người dùng.");
}
$row = $result->fetch_assoc();
?>

<style>
    .page-title {
        text-align: center;
        color: #333;
    }

    .form-container {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container input[type="text"],
    .form-container select {
        width: 100%;
        padding: 10px 12px;
        margin: 10px 0 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-container label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .form-container button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-container button[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<div class="page-title">
    <h2>Sửa người dùng</h2>
</div>

<form method="post" class="form-container">
    <label>Họ tên:</label>
    <input type="text" name="full_name" value="<?= $row['full_name'] ?>" required>

    <label>Tên đăng nhập:</label>
    <input type="text" name="username" value="<?= $row['username'] ?>" required>

    <label>Email:</label>
    <input type="text" name="email" value="<?= $row['email'] ?>" required>

    <label>Vai trò:</label>
    <select name="role" required>
        <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
        <option value="customer" <?= $row['role'] == 'customer' ? 'selected' : '' ?>>Khách hàng</option>
    </select>

    <button type="submit">Cập nhật</button>
</form>
