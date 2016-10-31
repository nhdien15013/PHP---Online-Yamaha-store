<?php include("connection.php");?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<div class="page-header">
	<h3>Danh sách khuyến mãi sản phẩm</h3>
</div>


<form method="POST">
  <table class="table table-hover">
    <tr>
      <th>Chọn</th>
      <th>Mã CTKM</th>
      <th>Khuyến mãi</th>
      <th>Sản phẩm</th>
      <th>Hình thức KM</th>
      <th>Giá KM</th>
      <th>Ngày BĐ</th>
      <th>Ngày KT</th>
      <th></th>
      <th></th>
    </tr>
    <?php			
			$sqctkm="SELECT a.Ma_ctkm, a.Ma_km, b.Ten_km, a.Ma_sp, c.Ten_sp, a.Kieu_km, a.Giatri_km, a.Gia_km, a.Ngay_bd, a.Ngay_kt
				FROM ct_khuyenmai as a, khuyenmai as b, sanpham as c
				WHERE a.Ma_km = b.Ma_km and a.Ma_sp = c.Ma_sp";
			$rectkm= mysql_query($sqctkm);
			while($rowctkm=mysql_fetch_array($rectkm))
			{
	?>
    <tr>
      <td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rowctkm['Ma_ctkm']; ?>"></td>
      <td><?php echo $rowctkm['Ma_ctkm'];?></td>
      <td><?php echo '#'.$rowctkm['Ma_km'].' '.$rowctkm['Ten_km']; ?></td>
      <td><?php echo '#'.$rowctkm['Ma_sp'].' '.$rowctkm['Ten_sp']; ?></td>
      <td><?php echo $rowctkm['Giatri_km'].$rowctkm['Kieu_km']; ?></td>
      <td><?php echo number_format($rowctkm['Gia_km'],0,',','.');?></td>
      <td><?php echo $rowctkm['Ngay_bd'];?></td>
      <td><?php echo $rowctkm['Ngay_kt'];?></td>
      <td><a href="?inc=dskmsp.php&ma=<?php echo $rowctkm['Ma_ctkm'];?>" onclick="return sure();">Xóa</a></td>
      <td><a href="?inc=suakm.php&ma=<?php echo $rowctkm['Ma_ctkm']; ?>"> Sửa</a></td>
    </tr>
    <?php
		}
	?>
    <tr>
    	<td colspan="10">
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
						mysql_query("DELETE FROM ct_khuyenmai WHERE Ma_ctkm='$maxoanhieu'");
						echo "<p style='color:green'>Đã xóa thành công mã $maxoanhieu!</p>";
						echo '<meta http-equiv="refresh" content="2;URL=?inc=dskmsp.php"/>';
			}
		}

		//XÓA 1 LOẠI

		if(isset($_GET['ma']))
		{
			$Ma_ctkm = $_GET['ma'];
			$sq ="delete from ct_khuyenmai where Ma_ctkm = $Ma_ctkm";
			mysql_query($sq);
			echo "<script>alert('Xóa thành công mã $Ma_ctkm')</script>";
			echo '<meta http-equiv="refresh" content="0;URL=?inc=dskmsp.php"/>';
		}

?>
