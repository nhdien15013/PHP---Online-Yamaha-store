
<?php include("connection.php"); ?>

<?php
	if(isset($_GET['xe']))
	{
		$Ma_sp = $_GET['xe'];
		$sqxe = "SELECT a.Ma_sp, a.Ten_sp, a.Mau_sp, a.Hinh_sp, b.Ten_loai, a.Gia_sp, a.Solg_sp, a.Thongtin_sp
				From sanpham as a, loai_sp as b
				where a.Ma_loai = b.Ma_loai and Ma_sp = '$Ma_sp' ";
		$rsxe = mysql_query($sqxe);
		$rowxe = mysql_fetch_array($rsxe);
?>
<div class="page-header">
  <h3><?php echo $rowxe['Ten_sp']; ?></h3>
</div>
<div class="row" style="width: 95%; margin: 0 auto">
  <div class="col-md-6">
  	<img src="<?php echo $rowxe['Hinh_sp'];?>"/>
  </div>
  <div class="col-md-6">
  	<div class="panel panel-info" style="width:100%; height: 300px ;font-size: 120%;">
		<div class="panel-heading" style="text-align: center; font-size: 120%;">Mô tả</div>
		<div class="panel-body">
			<p><span style="font-weight: bold;">Tên xe: </span><?php echo $rowxe['Ten_sp']; ?></p>
			<p><span style="font-weight: bold;">Loại xe: </span><?php echo $rowxe['Ten_loai']; ?></p>
			<p><span style="font-weight: bold;">Màu xe: </span><?php echo $rowxe['Mau_sp']; ?></p>
			<?php
				// XÉT SẢN PHẨM CÓ KHUYẾN MÃI KHÔNG
				$date=date("Y-m-d");
				$rectkm = mysql_query("SELECT * FROM ct_khuyenmai WHERE Ma_sp = '$Ma_sp' and '$date' between Ngay_bd and Ngay_kt");
				$rowctkm = mysql_fetch_array($rectkm);
				if(mysql_num_rows($rectkm)>0)
				{
					$mactkm = $rowctkm['Ma_ctkm']; //có thỳ gán mã chi tiết khuyến mãi
				}
				else
				{
					$mactkm ="";
				}
			?>
			<p><span style="font-weight: bold;">Giá: </span>
					<?php if($mactkm!="")
						{
							echo '<span class="reducedfrom">'.number_format($rowctkm['Gia_km'],0,',','.').'</span>';
							echo '<span class="actual">'.number_format($rowxe['Gia_sp'],0,',','.').'</span>';
						}
						else
						{
								echo '<span class="reducedfrom">'.number_format($rowxe['Gia_sp'],0,',','.').'</span>';
						}
					?>
			</p>
			<p><span style="font-weight: bold;">Số lượng: </span><?php echo $rowxe['Solg_sp']; ?></p>

			<p style="margin: 10px 0 20px 0">
				<a type="button" class="btn btn-warning btn-lg" href="<?php echo '?inc=giohang1.php&xe='.$rowxe['Ma_sp']; ?>">
				<span class="glyphicon glyphicon-shopping-cart"></span> ĐẶT MUA </a>
			</p>
		</div>
	</div>
  </div>
</div>
<div class="row" style="width: 95%; margin: 0 auto">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading" style="font-size:140%;">Thông tin chi tiết</div>
			<div class="panel-body">
				<?php echo htmlspecialchars_decode($rowxe['Thongtin_sp']); ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>