<?php
    include(__DIR__ . '/../User/config.php');
	$sql = "delete from `users` where user_id = " . $_GET['id'];
	$danhsach = $connect->query($sql);

	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
		exit();
	}
	else
	{
		header("Location: index.php?do=nguoidung");
        exit();
	}
?>