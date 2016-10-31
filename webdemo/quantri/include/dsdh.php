<?php include("connection.php");?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<div class="page-header">
	<h3>Danh sách đơn hàng</h3>
</div>
	
<form method="POST">
  <table class="table table-hover">
    <tr>
      <th>Chọn</th>
      <th>Mã đặt hàng</th>
      <th>Email đặt hàng</th>
      <th>Ngày đặt hàng</th>
      <th>Ngày giao hàng</th>
      <th>Tổng tiền</th>
      <th>Tình trạng đơn hàng</th>
      <th></th>
      <th></th>
    </tr>
    <?php			
			$sq="Select * From dathang";
			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
			{
	?>
    <tr>
	    <td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['Ma_dh']; ?>"></td>
	    <td><?php echo $row['Ma_dh'];?></td>
	    <td><?php echo $row['Email_dh'];?></td>
		<td><?php echo $row['Ngay_dh'];?></td>
		<td><?php echo $row['Ngay_gh'];?></td>
		<td><?php echo number_format($row['Tongtien_dh'],0,',','.');?></td>
		<td><?php if($row['Tinhtrang_dh']=='xuly'){echo "Đang xử lý";}elseif($row['Tinhtrang_dh']=='giao'){echo "Đang giao hàng";}else{echo "Đã xong";};?></td>
	    <td><a href="?inc=suadh.php&ma=<?php echo $row['Ma_dh'];?>">Cập nhật</a></td>
	    <td><a href="?inc=dsdh.php&ma=<?php echo $row['Ma_dh'];?>" onclick="return sure();">Xóa</a></td>
    </tr>
    <?php
		}
	?>
    <tr>
    	<td colspan="9">
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
						
						mysql_query("DELETE FROM dathang WHERE Ma_dh='$maxoanhieu'");
						mysql_query("DELETE FROM ct_dathang WHERE Ma_dh='$maxoanhieu'");
						echo "<p style='color:green'>Đã xóa thành công đặt hàng $maxoanhieu!</p>";
			}
			echo '<meta http-equiv="refresh" content="2;URL=?inc=dsdh.php"/>';
		}

		//XÓA 1 LOẠI

		if(isset($_GET['ma']))
		{
			$Ma_dh = $_GET['ma'];
			mysql_query("DELETE FROM dathang WHERE Ma_dh='$Ma_dh'");
			mysql_query("DELETE FROM ct_dathang WHERE Ma_dh='$Ma_dh'");
			echo "<script>alert('Xóa thành công mã đặt hàng $Ma_dh')</script>";
			echo '<meta http-equiv="refresh" content="0;URL=?inc=dsdh.php"/>';
		}

?>
