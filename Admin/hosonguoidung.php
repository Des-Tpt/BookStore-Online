<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

if (!isset($_SESSION['user_id'])) {
    die("Vui lòng đăng nhập để xem hồ sơ.");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("Không tìm thấy thông tin người dùng.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
        }

        .user-container {
            background-color: #ffffff;
            padding: 30px;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
        }

        .user-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .user-header h2 {
            font-size: 28px;
            color: #333333;
            margin: 0;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table thead th {
            background-color: #e9ecef;
            padding: 12px;
            font-size: 16px;
            color: #495057;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .user-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            font-size: 15px;
            color: #212529;
        }

        .user-table tbody tr:last-child td {
            border-bottom: none;
        }

        .back-link {
            display: block;
            margin-top: 30px;
            text-align: center;
            color: #007bff;
            font-size: 16px;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .back-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="user-container">
    <div class="user-header">
        <h2>Thông tin người dùng</h2>
    </div>
    <table class="user-table">
        <tbody>
            <tr>
                <th>Họ tên</th>
                <td><?= htmlspecialchars($user['full_name']) ?></td>
            </tr>
            <tr>
                <th>Tên đăng nhập</th>
                <td><?= htmlspecialchars($user['username']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
            <tr>
                <th>Vai trò</th>
                <td><?= htmlspecialchars($user['role']) ?></td>
            </tr>
        </tbody>
    </table>
    <a href="index.php" class="back-link">Quay lại trang chủ</a>
</div>

</body>
</html>
