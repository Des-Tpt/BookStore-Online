<?php
$connect = new mysqli("localhost", "root", "vertrigo", "shopbook");
$connect->set_charset("utf8");

$book_id = $_GET['id'];

$sql = "DELETE FROM books WHERE book_id = '$book_id'";

if ($connect->query($sql)) {
    header("Location: index.php?do=books");
} else {
    echo "Xóa thất bại!";
}
?>
    