<?php include("connection.php");?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<form method="post">
<table width="90%" class="table table-hover">
<tr align="center">
<th>chon</th>
<th>Mã góp ý</th>
<th>Tiêu Đề</th>
<th>Nộidung</th>
<th>Email</th>

</tr>
<?php		
			$sq="Select * From gopy";
			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
			{
		?>
<tr width="90%" class="table table-hover" height="100" >
<td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['Ma_gy']; ?>"></td>
<td><?php echo $row['Ma_gy'] ?></td>
<td><?php echo $row['Tieude_gy'] ?></td>
<td><?php echo $row['Noidung_gy'] ?></td>
<td><?php echo $row['Email_gy'] ?></td>
<td><a href="?inc=dsgy.php&ma=<?php echo $row['Ma_gy'];?>" onclick="return sure();">Xóa</a></td>

</tr>

                    <?php
			        }
                    ?>
                     <tr>
                        <td colspan="8">
                        <input type="submit" value="Xóa mục chọn" name="subxoanhieu" id="subxoanhieu" onclick='return sure()'/> </td>
                    </tr>
</table>
</form>
<script>
	function sure()
	{	
		result= confirm("Bạn có thực sự muốn xóa?");
		return result;
	}
</script>
 
<?php
				if (isset($_POST['subxoanhieu'])&& isset($_POST['checkbox']))
		{
			for ($i = 0; $i < count($_POST['checkbox']); $i++)
			{					
						$maxoanhieu = $_POST['checkbox'][$i];
						mysql_query("DELETE FROM gopy WHERE Ma_gy='$maxoanhieu'");
			}
			echo "<script>alert('Xóa thành công')</script>";
			echo '<meta http-equiv="refresh" content="0;URL=?inc=dsgy.php"/>';
		}

?>
<?php
if(isset($_GET['ma']))
{
	$Ma_gy = $_GET['ma'];
	mysql_query("DELETE FROM gopy WHERE Ma_gy='$Ma_gy'");
	echo "<script>alert('Xóa thành công')</script>";
	echo '<meta http-equiv="refresh" content="0;URL=?inc=dsgy.php"/>';
} 
?> 


</body>
</html>