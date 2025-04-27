<?php
include(__DIR__ . '/../User/config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST['full_name']);
    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $role      = $_POST['role'];

    if (empty($full_name) || empty($username) || empty($email) || empty($password)) {
        echo "Vui lòng điền đầy đủ thông tin.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (full_name, username, email, password, role) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssss", $full_name, $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            echo "Thêm người dùng thành công!";
        } else {
            echo "Lỗi: " . $connect->error;
        }
    }
}
?>

<h2 class="form-heading">Thêm người dùng</h2>

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
    }

    .form-box {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-box input[type="text"],
    .form-box input[type="password"],
    .form-box select {
        width: 100%;
        padding: 10px 12px;
        margin: 10px 0 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-box label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .submit-btn {
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

    .submit-btn:hover {
        background-color: #45a049;
    }
</style>

<div class="form-container">
    <form method="post" class="form-box">
        <label for="full_name">Họ tên:</label>
        <input type="text" id="full_name" name="full_name" required>

        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Vai trò:</label>
        <select name="role" id="role" required>
            <option value="admin">Quản trị viên</option>
            <option value="customer" selected>Khách hàng</option>
        </select>

        <button type="submit" class="submit-btn">Thêm người dùng</button>
    </form>
</div>
