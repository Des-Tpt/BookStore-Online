<?php
	include('../User/config.php');
	$sql = "SELECT * FROM `users` WHERE 1";
	$danhsach = $connect->query($sql);

	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
	}

?>
<div>
<div>
	<h3>Danh sách người dùng</h3>
	<a href="index.php?do=nguoidung_them">➕ Thêm người dùng...</a>
</div>
	<table class="DanhSach" border="1" width="100%">

	<tr>
		<th>Mã ND</th>
		<th>Họ và tên</th>
		<th>Tên đăng nhập</th>
        <th>Email</th>
		<th>Quyền hạn</th>
		<th colspan="3">Hành động</th>
	</tr>
	<?php
		$stt = 1;
		while ($dong = $danhsach->fetch_array(MYSQLI_ASSOC)) 
		{			
			echo "<tr style='text-align: center; background-color: #ffffff;' onmouseover='this.style.background=\"#dee3e7\"' onmouseout='this.style.background=\"#ffffff\"'>";
				echo "<td>" . $dong["user_id"] . "</td>";
				echo "<td>" . $dong["full_name"] . "</td>";
				echo "<td>" . $dong["username"] . "</td>";
                echo "<td>" . $dong["email"] . "</td>";
                echo "<td>";
                     if ($dong["role"] == "admin")
                     { 
                        echo "Quản trị viên";
                }   else{
                        echo "Người dùng";
                        }
                echo "</td>";
                echo "<td align='center'><a href='index.php?do=nguoidung_sua&id=" . $dong["user_id"] . "'>✏️ Sửa</a></td>";
				echo "<td align='center'><a href='index.php?do=nguoidung_xoa&id=" . $dong["user_id"] . "' onclick='return confirm(\"Bạn có muốn xóa người dùng " . $dong['username'] . " không?\")'>🗑️ Xóa</a></td>";
					
			    echo "</tr>";
		}
	?>
</table>
</div>
</form>
