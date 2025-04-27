<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
    header("Location: ../Admin/index.php");
    exit();
} else {
    header("Location: ../User/index.php");
    exit();
}
?>
