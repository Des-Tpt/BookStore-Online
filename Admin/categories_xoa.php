<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM categories WHERE category_id=$id";
    mysqli_query($connect, $sql);
}

header("Location: index.php?do=categories");
exit();
