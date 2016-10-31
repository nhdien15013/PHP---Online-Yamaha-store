<?php include("connection.php");?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<div class="page-header">
	<h3>Danh sách thành viên</h3>
</div>

<form method="POST">
  <table class="table table-hover">
    <tr>
      <th>Chọn</th>
      <th>Email</th>
      <th>Tên thành viên</th>
      <th>Chức vụ</th>
      <th></th>
      <th></th>
    </tr>
    <?php			
			$sq="Select * From thanhvien";
			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
			{
	?>
    <tr>
      <td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['Email']; ?>"></td>
      <td><?php echo $row['Email'];?></td>
      <td><?php echo $row['Ten_tv'];?></td>
      <td><?php echo $row['Chucvu_tv'];?></td>
      <td><a href="?inc=suatv.php&ma=<?php echo $row['Email'];?>">Cập nhật</a></td>
      <td><a href="?inc=dstv.php&ma=<?php echo $row['Email'];?>" onclick="return sure();">Xóa</a></td>
    </tr>
    <?php
		}
	?>
    <tr>
    	<td colspan="6">
    		<input type="submit" name="subxoanhieu" id="subxoanhieu" value="Xóa các mục" onclick="return sure()">			
    	</td>
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
		//XÓA NHIỀU

		if (isset($_POST['subxoanhieu'])&& isset($_POST['checkbox']))
		{
			for ($i = 0; $i < count($_POST['checkbox']); $i++)
			{					
						$maxoanhieu = $_POST['checkbox'][$i];
						mysql_query("DELETE FROM thanhvien WHERE Email='$maxoanhieu'");
						echo "<p style='color:green'>Đã xóa thành công mã loại $maxoanhieu!</p>";
			}
			echo '<meta http-equiv="refresh" content="2;URL=?inc=dstv.php"/>';
		}

		//XÓA 1 LOẠI

		if(isset($_GET['ma']))
		{
			$Email = $_GET['ma'];
			$sq ="delete from thanhvien where Email = '$Email'";
			mysql_query($sq);
			echo "<script>alert('Xóa thành công tài khoản $Email')</script>";
			echo '<meta http-equiv="refresh" content="0;URL=?inc=dstv.php"/>';
		}

?>
