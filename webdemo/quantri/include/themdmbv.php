<?php include("connection.php"); ?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<div class="page-header">
	<h3>Danh mục bài viết</h3>
</div>
<?php
	
	if(isset($_POST['subthemdanhmuc']))
	{
		$Ten_dmbv = $_POST['Ten_dmbv'];
		if($Ten_dmbv!="")
		{
			if(mysql_num_rows(mysql_query("select ten_dmbv from danhmuc_bv where ten_dmbv = '$Ten_dmbv'"))==0)
			{
				$sql = "insert into danhmuc_bv (Ten_dmbv) values ('$Ten_dmbv')";
				mysql_query($sql);
				echo '<span style="color:green">Danh mục đã được tạo!</span>';
			}
			else
			{
				echo '<span style="color:red">Tên danh mục đã tồn tại!</span>';
			}
			
		}
		else
		{
			echo '<span style="color:red">Chưa nhập đầy đủ thông tin!</span>';
		}
	}
?>

<form class="form-horizontal" role="form" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tên danh mục</label>
    <div class="col-xs-3">
      <input type="text" class="form-control" id="Ten_dmbv" name="Ten_dmbv" placeholder="Tên danh mục">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="subthemdanhmuc" name="subthemdanhmuc" class="btn btn-default">Tạo danh mục</button>
    </div>
  </div>
</form>
<form method="POST">
  <table class="table table-hover">
    <tr>
      <th width="44">Chọn</th>
      <th width="65">Mã danh mục</th>
      <th width="70">Tên danh mục</th>
      <th width="56">Delete</th>
    </tr>
    <?php			
			$sq="Select * From danhmuc_bv";
			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
	
			{
				?>
	 <tr>
      <td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['Ma_dmbv']; ?>"></td>
      <td><?php echo $row['Ma_dmbv'];?></td>
      <td><input type="text" style="border:0" id="suaTen_dmbv<?php echo $row['Ma_dmbv']; ?>" name="suaTen_dmbv<?php echo $row['Ma_dmbv']; ?>" value="<?php echo $row['Ten_dmbv'];?>" /></td>
      <label for="check"></label>
      <td><a href="?inc=themdmbv.php&ma=<?php echo $row['Ma_dmbv'];?>" onclick="return sure();">Xóa</a></td>
    </tr>
    <?php
		}
	?>
    <tr>
    	<td colspan="8"><input type="submit" name="subxoanhieu" id="subxoanhieu" value="Xóa các mục" onclick="return sure()">
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
						if(mysql_num_rows(mysql_query("select * from baiviet where Ma_dmbv='$maxoanhieu'"))==0)
						{
							mysql_query("DELETE FROM danhmuc_bv WHERE Ma_dmbv='$maxoanhieu'");
							echo "<p style='color:green'>Đã xóa thành công mã danh mục $maxoanhieu!</p>";
						}
						else
						{
							echo "<script>alert('Mã danh mục $maxoanhieu có tồn tại bài viết, không thể xóa!')</script>";
						}
			}
			echo '<meta http-equiv="refresh" content="2;URL=?inc=themdmbv.php"/>';
		}

		//XÓA 1 DANH MỤC

		if(isset($_GET['ma']))
		{
			$Ma_dmbv = $_GET['ma'];
			$sq ="delete from danhmuc_bv where Ma_dmbv = $Ma_dmbv";
			if(mysql_num_rows(mysql_query("select * from baiviet where Ma_dmbv= '$Ma_dmbv'"))==0)
			{
				mysql_query($sq);
				echo "<script>alert('Xóa thành công mã danh mục $Ma_dmbv')</script>";
				echo '<meta http-equiv="refresh" content="0;URL=?inc=themdmbv.php"/>';
			}
			else
			{
				echo "<script>alert('Mã danh mục $Ma_dmbv có tồn tại bài viết, không thể xóa!')</script>";
				echo '<meta http-equiv="refresh" content="0;URL=?inc=themdmbv.php"/>';
			}
		}
		//CẬP NHẬT
		if(isset($_POST['subcapnhat']))
				{
					
					$sq="Select * From danhmuc_bv";
					$result= mysql_query($sq);
					while($row=mysql_fetch_array($result))
					{
						$madmbv = $row['Ma_dmbv'];
						$x = "suaTen_dmbv"."$madmbv";
						$suaTen_dmbv = $_POST[$x];
						if($row['Ten_dmbv']!=$suaTen_dmbv)
						{
							if($suaTen_dmbv=="") {$suaTen_dmbv=$row['Ten_dmbv'];}
							$sqktloai="SELECT * FROM danhmuc_bv where Ten_dmbv='$suaTen_dmbv' and Ma_dmbv!=$madmbv";
							if(mysql_num_rows(mysql_query($sqktloai))==0)
							{
								mysql_query("UPDATE danhmuc_bv SET Ten_dmbv = '$suaTen_dmbv' WHERE Ma_dmbv = $madmbv");
								echo "<p style='color:green'>Đã cập nhật thành công danh mục bài viết $suaTen_dmbv!</p>";
							}
							else
							{
								echo "<p style='color:red'>Đã tồn tại tên danh mục $suaTen_loai!</p>";
							}
						}
					}
								echo '<meta http-equiv="refresh" content="2;URL=?inc=themdmbv.php"/>';
				}
?>