<?php
include __DIR__ . "/../User/config.php";

$login = trim($_POST['login']);
$password = trim($_POST['password']);
$_POST ['error'] = null;

if ($login == "") {
    $_SESSION['error'] = "Tên đăng nhập không được bỏ trống!";
} else if ($password == "") {
    $_SESSION["error"] = "Mật khẩu không được bỏ trống!";
} else {
    $sql_check = "SELECT * FROM users WHERE username = ?";
    $stmt = $connect->prepare($sql_check);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($row["role"] == 'admin') {
                header("Location: ../Admin/index.php");
            } else {
                header("Location: ../User/index.php");
            }
            exit();
        } else {
            $_SESSION["error"] = "Tên đăng nhập hoặc mật khẩu sai...";
            header("Location: login_register.php");
            exit();
        }
    } else {
        $_SESSION["error"] = "Tên đăng nhập hoặc mật khẩu sai...";
        header("Location: login_register.php");
        exit();
    }
}
?>
