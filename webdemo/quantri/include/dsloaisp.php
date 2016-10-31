<?php include("connection.php");?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<div class="page-header">
	<h3>Danh sách loại xe</h3>
</div>
<?php
	if(isset($_POST['subthemloai']))
	{
		$Ten_loai = $_POST['Ten_loai'];
		if($Ten_loai!="")
		{
			if(mysql_num_rows(mysql_query("select * from loai_sp where Ten_loai = '$Ten_loai'"))==0)
			{
				$sql = "insert into loai_sp (Ten_loai) values ('$Ten_loai')";
				mysql_query($sql);
				echo "<span style='color:green'>Đã thêm loại $Ten_loai!</span>";
			}
			else
			{
				echo '<span style="color:red">Tên loại đã tồn tại!</span>';
				
			}
			
		}
		else
		{
			echo '<span style="color:red">Chưa nhập tên loại!</span>';
		}
	}
?>

<form class="form-horizontal" role="form" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tên loại</label>
    <div class="col-xs-3">
      <input type="text" class="form-control" id="Ten_loai" name="Ten_loai" placeholder="Tên loại">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="subthemloai" name="subthemloai" class="btn btn-default">Tạo loại</button>
    </div>
  </div>
</form>
<form method="POST">
  <table class="table table-hover">
    <tr>
      <th>Chọn</th>
      <th>Mã loại</th>
      <th>Tên loại</th>
      <th></th>
    </tr>
    <?php			
			$sq="Select * From loai_sp";
			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
			{
	?>
    <tr>
      <td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['Ma_loai']; ?>"></td>
      <td><?php echo $row['Ma_loai'];?></td>
      <td><input type="text" style="border:0" id="suaTen_loai<?php echo $row['Ma_loai']; ?>" name="suaTen_loai<?php echo $row['Ma_loai']; ?>" value="<?php echo $row['Ten_loai'];?>" /></td>
      <label for="check"></label>
      <td><a href="?inc=dsloaisp.php&ma=<?php echo $row['Ma_loai'];?>" onclick="return sure();">Xóa</a></td>
    </tr>
    <?php
		}
	?>
    <tr>
    	<td colspan="4">
    		<input type="submit" name="subxoanhieu" id="subxoanhieu" value="Xóa các mục" onclick="return sure()">
			<input type="submit" name="subcapnhat" id="subxcapnhat" value="Cập nhật">				
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
						if(mysql_num_rows(mysql_query("select * from sanpham where Ma_loai='$maxoanhieu'"))==0)
						{
							mysql_query("DELETE FROM loai_sp WHERE Ma_loai='$maxoanhieu'");
							echo "<p style='color:green'>Đã xóa thành công mã loại $maxoanhieu!</p>";
						}
						else
						{
							echo "<script>alert('Mã loại $maxoanhieu có tồn tại sản phẩm, không thể xóa!')</script>";
						}

					
			}
			echo '<meta http-equiv="refresh" content="2;URL=?inc=dsloaisp.php"/>';
		}

		//XÓA 1 LOẠI

		if(isset($_GET['ma']))
		{
			$Ma_loai = $_GET['ma'];
			$sq ="delete from loai_sp where Ma_loai = $Ma_loai";
			if(mysql_num_rows(mysql_query("select * from sanpham where Ma_loai= '$Ma_loai'"))==0)
			{
				mysql_query($sq);
				echo "<script>alert('Xóa thành công mã loại $Ma_loai')</script>";
				echo '<meta http-equiv="refresh" content="0;URL=?inc=dsloaisp.php"/>';
			}
			else
			{
				echo "<script>alert('Mã loại $Ma_loai có tồn tại sản phẩm, không thể xóa!')</script>";
				echo '<meta http-equiv="refresh" content="0;URL=?inc=dsloaisp.php"/>';
			}
		}

		//CẬP NHẬT TÊN LOẠI

		if(isset($_POST['subcapnhat']))
		{
			
			$sq="Select * From loai_sp";
			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
			{
				$maloai = $row['Ma_loai'];
				$x = "suaTen_loai"."$maloai";
				$suaTen_loai = $_POST[$x];
				if($row['Ten_loai']!=$suaTen_loai)
				{
					if($suaTen_loai=="") {$suaTen_loai=$row['Ten_loai'];}
					$sqktloai="SELECT * FROM loai_sp where Ten_loai='$suaTen_loai' and Ma_loai!=$maloai";
					if(mysql_num_rows(mysql_query($sqktloai))==0)
					{
						mysql_query("UPDATE loai_sp SET Ten_loai = '$suaTen_loai' WHERE Ma_loai = $maloai");
						echo "<p style='color:green'>Đã cập nhật thành công tên loại $suaTen_loai!</p>";
					}
					else
					{
						echo "<p style='color:red'>Đã tồn tại tên loại $suaTen_loai!</p>";
					}
				}
			}
						echo '<meta http-equiv="refresh" content="2;URL=?inc=dsloaisp.php"/>';
		}
?>
