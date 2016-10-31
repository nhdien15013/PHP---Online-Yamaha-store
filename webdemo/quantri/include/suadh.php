<?php include("connection.php"); ?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<?php

if(isset($_GET['ma']))
{
	$Ma_dh=$_GET['ma'];
	$sq1="SELECT * from dathang where Ma_dh ='$Ma_dh'";
	$rs1=mysql_query($sq1);
	while($row1=mysql_fetch_array($rs1))
	{
		$Email_dh = $row1['Email_dh'];
		$Ten_dh = $row1['Ten_dh'];
		$Dt_dh = $row1['Dt_dh'];
		$Dc_dh = $row1['Dc_dh'];
		$Ngay_dh = $row1['Ngay_dh'];
		$Ngay_gh = $row1['Ngay_gh'];
		$Tinhtrang_dh = $row1['Tinhtrang_dh'];
		$Tongtien_dh = $row1['Tongtien_dh'];
?>
<form class="form-horizontal" role="form" method="post">
<div class="panel panel-success">
  <div class="panel-heading"><?php echo "Đơn hàng số ".$Ma_dh ?></div>
  <?php
  	if(isset($_POST['subcndh']))
  	{
  		$Ngay_gh = $_POST['Ngay_gh'];
  		$Tinhtrang_dh = $_POST['Tinhtrang_dh'];
  		$loi = "";
  		if($Tinhtrang_dh=="")	// kiểm tra tình trạng đơn hàng có rỗng không
  		{
  			$loi.='<p style="color:red;"> Chưa chọn tình trạng đơn hàng! </p>';
  		}
  		if(strtotime($Ngay_gh) < strtotime($Ngay_dh)) //kiểm tra ngày giao hàng có trước ngày đặt hàng không
	  	{
  			$loi.='<p style="color:red;"> Ngày giao hàng không thể trước ngày đặt hàng! </p>';
  		}

  		if($loi == "")
  		{
  			mysql_query("UPDATE dathang SET Ngay_gh='$Ngay_gh', Tinhtrang_dh='$Tinhtrang_dh' Where Ma_dh = '$Ma_dh'");
				echo '<p style="color:green;"> Đã cập nhật thành công! </p>';
  		}else {
  			echo $loi;
  		}
  	}
  ?>
  <div class="panel-body">
  		<div class="form-group">
		    <label for="" class="col-xs-3 control-label">Email khách hàng:</label>
		    <div class="">
		      <?php echo "$Email_dh"; ?>
		    </div>
		</div>
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
		      <?php echo "$Ngay_dh"; ?>
		    </div>
  		</div>
  		<div class="form-group">
		    <label for="" class="col-xs-3 control-label">Ngày giao hàng:</label>
		    <div class="col-xs-3">
		      <input type="date" id="Ngay_gh" name="Ngay_gh" value="<?php echo "$Ngay_gh"; ?>">
		    </div>
  		</div>
  		<div class="form-group">
		    <label for="" class="col-xs-3 control-label">Tình trạng:</label>
		    <div class="col-xs-3">
		      	<select name="Tinhtrang_dh" id="Tinhtrang_dh" class="form-control">
	                <option value="">Tình trạng đơn hàng</option>
	                <option value="xuly" <?php if($Tinhtrang_dh=='xuly'){echo 'selected';} ?> >Đang xử lý</option>
	                <option value="giao" <?php if($Tinhtrang_dh=='giao'){echo 'selected';} ?> >Đang giao</option>
	                <option value="xong" <?php if($Tinhtrang_dh=='xong'){echo 'selected';} ?> >Đã xong</option>
            	</select>
		    </div>
  		</div>
  		<div class="form-group">
		    <label for="" class="col-xs-3 control-label"></label>
		    <div class="col-xs-3">
		      	<input type="submit" id="subcndh" name="subcndh" class="btn btn-default" value="Cập nhật">
		    </div>
  		</div>
  </div>
</div>
</form>
<?php	} ?>

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
          <td colspan="3"><div align="left">Tổng tiền: <?php echo number_format($tongtien,0,',','.')." Đồng";?></div></td>
    </tr>
</table>
<?php } ?>