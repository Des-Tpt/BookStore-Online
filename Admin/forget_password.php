<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Vui lòng đăng nhập.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "Mật khẩu mới và xác nhận mật khẩu không khớp!";
        exit();
    }

    $sql = "SELECT * FROM users WHERE user_id = $user_id AND full_name = '$full_name' AND username = '$username'";
    $result = $connect->query($sql);

    if ($result->num_rows != 1) {
        echo "Thông tin người dùng không chính xác!";
        exit();
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update_sql = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";
    
    if ($connect->query($update_sql) === TRUE) {
        echo "Mật khẩu đã được cập nhật thành công!";
    } else {
        echo "Lỗi: " . $connect->error;
    }
}
?>

<style>
    .form-container {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container input[type="text"],
    .form-container input[type="password"] {
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
    <h2>Đổi mật khẩu</h2>
</div>

<form method="post" class="form-container">
    <label>Họ tên:</label>
    <input type="text" name="full_name" required>

    <label>Tên đăng nhập:</label>
    <input type="text" name="username" required>

    <label>Mật khẩu mới:</label>
    <input type="password" name="new_password" required>

    <label>Xác nhận mật khẩu mới:</label>
    <input type="password" name="confirm_password" required>

    <button type="submit">Đổi mật khẩu</button>
</form>
