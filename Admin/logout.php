<?php
session_start();
session_unset(); 
session_destroy();

header("Location: ../User/index.php");
exit();
?>
