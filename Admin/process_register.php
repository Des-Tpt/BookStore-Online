<?php
include __DIR__ . "/../User/config.php";

$HoVaTen = $_POST['fullname'] ?? '';
$TenDangNhap = $_POST['username'] ?? '';
$Email = $_POST['email'] ?? '';
$MatKhau = $_POST['password'] ?? '';
$XacNhanMatKhau = $_POST['confirm_password'] ?? '';

if (trim($HoVaTen) == "") {
    $_SESSION['error'] = "Họ và tên không được bỏ trống!";
} elseif (trim($TenDangNhap) == "") {
    $_SESSION['error'] = "Tên đăng nhập không được bỏ trống!";
} elseif (trim($Email) == "") {
    $_SESSION['error'] = "Email không được bỏ trống!";
} elseif (trim($MatKhau) == "") {
    $_SESSION['error'] = "Mật khẩu không được bỏ trống!";
} elseif ($MatKhau !== $XacNhanMatKhau) {
    $_SESSION['error'] = "Xác nhận mật khẩu không khớp!";
} else {

    $sql_check = "SELECT * FROM users WHERE username = '$TenDangNhap' OR email = '$Email'";
    $result = $connect->query($sql_check);

    if ($result && $result->num_rows > 0) {
        $_SESSION['error'] = "Tên đăng nhập hoặc email đã được sử dụng!";
    } else {
        $hashedPassword = password_hash($MatKhau, PASSWORD_DEFAULT);
        $role = 'customer';

        $sql_insert = "INSERT INTO users (username, password, full_name, email, role)
                       VALUES ('$TenDangNhap', '$hashedPassword', '$HoVaTen', '$Email', '$role')";

        if ($connect->query($sql_insert)) {
            $_SESSION['success'] = "Đăng ký thành công! Mời bạn đăng nhập.";
        } else {
            $_SESSION['error'] = "Lỗi khi thêm người dùng: " . $connect->error;
        }
    }
}

header("Location: login_register.php");
exit;
?>
