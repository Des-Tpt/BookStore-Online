<?php
session_start();
session_unset(); 
session_destroy();

header("Location: ../User/index.php"); // hoặc trang login tuỳ bạn
exit();
?>