<?php include("connection.php"); ?>
<?php
if(!isset($_SESSION['Email']))
{
		echo "<script language='Javascript'>alert('Chưa đăng nhập!')</script>";
		echo '<meta http-equiv="refresh" content="0;URL=?inc=sanpham.php&dn=dnhap">';
}
if(isset($_SESSION['Ma_dh']))
{
	$Ma_dh=$_SESSION['Ma_dh'];
	$sq1="SELECT * from dathang where Ma_dh ='$Ma_dh'";
	$rs1=mysql_query($sq1);
	while($row1=mysql_fetch_array($rs1))
	{
		$Ten_dh = $row1['Ten_dh'];
		$Dt_dh = $row1['Dt_dh'];
		$Dc_dh = $row1['Dc_dh'];
		$Ngay_dh = $row1['Ngay_dh'];
		$Ngay_gh = $row1['Ngay_gh'];
		$Tongtien_dh = $row1['Tongtien_dh'];
	}
}
?>
<div class="panel panel-success">
  <div class="panel-heading" style="font-size: 120%;">Hóa đơn đặt hàng</div>
  <div class="panel-body">
	    <div class="form-group">
		    <label for="" class="col-xs-3 control-label">Tên khách hàng:</label>
		    <div class="">
		      <?php echo "$Ten_dh"; ?>
		    </div>
		</div>
	    <div class="form-group">
		    <label for="" class="col-xs-3 control-label">Số điện thoại:</label>
		    <div class="">
		      <?php echo "$Dt_dh"; ?>
		    </div>
  		</div>
  		<div class="form-group">
		    <label for="" class="col-xs-3 control-label">Địa chỉ:</label>
		    <div class="">
		      <?php echo "$Dc_dh"; ?>
		    </div>
  		</div>
  		<div class="form-group">
		    <label for="" class="col-xs-3 control-label">Ngày đặt hàng:</label>
		    <div class="">
		      <?php echo $Ngay_dh; ?>
		    </div>
  		</div>
  		<div class="form-group">
		    <label for="" class="col-xs-3 control-label">Ngày giao hàng:</label>
		    <div class="">
				Sản phẩm sẽ được giao trong 7 ngày từ ngày đặt hàng đến <?php echo $Ngay_gh; ?>
		    </div>
  		</div>
  </div>
</div>

<table class="table table-bordered">
	<tr>
      <th>STT</th>
      <th>Tên sản phẩm</th>
      <th>Loại sản phẩm</th>
      <th>Số lượng</th>
      <th>Đơn giá</th>
      <th>Thành tiền</th>
    </tr>
	<?php
		$sq2= "SELECT b.Ma_sp, b.Ten_sp, c.Ten_loai, a.Gia_dh, a.Solg_dh
			from ct_dathang as a, sanpham as b, loai_sp as c
			where a.Ma_sp = b.Ma_sp and b.Ma_loai = c.Ma_loai and a.Ma_dh = '$Ma_dh'";
		$rs2= mysql_query($sq2);
		$stt=0;
		$tongtien=0;
		while($row2=mysql_fetch_array($rs2))
		{
			$Ten_sp=$row2['Ten_sp'];
			$Ten_loai=$row2['Ten_loai'];
			$Solg_dh=$row2['Solg_dh'];
			$Gia_dh=$row2['Gia_dh'];
			$thanhtien=$Solg_dh*$Gia_dh;
			$stt+=1;
			$tongtien=$tongtien+$thanhtien;
	?>
	<tr>
          <td><?php echo "$stt";?></td>
          <td><?php echo "$Ten_sp";?></td>
          <td><?php echo "$Ten_loai";?></td>
          <td><?php echo "$Solg_dh";?></td>
          <td><?php echo number_format($Gia_dh,0,',','.');?></td>
          <td><?php echo number_format($thanhtien,0,',','.');?></td>
    </tr>
<?php } ?>
	<tr>
          <td colspan="3"></td>
          <td colspan="3"><div align="left" style="font-weight: bold">Tổng tiền: <?php echo number_format($tongtien,0,',','.')." Đồng";?></div></td>
    </tr>
</table>
<div align="center">
	<a type="button" class="btn btn-warning btn-lg" href="index.php">Về trang chủ</a>
</div>