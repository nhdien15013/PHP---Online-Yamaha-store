<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(!isset($_SESSION['Email']))
{
		echo "<script language='Javascript'>alert('Chưa đăng nhập!')</script>";
		echo '<meta http-equiv="refresh" content="0;URL=?inc=sanpham.php&dn=dnhap">';
}
else
{
if(isset($_GET['xe']))
	{
		$Ma_sp=$_GET['xe'];
		if(isset($_SESSION["'".$Ma_sp."'"]))
		{
			$_SESSION["'".$Ma_sp."'"]=$_SESSION["'".$Ma_sp."'"]+1;
		}
		else
		{
			$_SESSION["'".$Ma_sp."'"]=1;
		}
		echo "<script>alert('Sản phẩm đã thêm vào giỏ hàng')</script>";
	}
}
?>
<div class="row" style="width: 95%; margin: 0 auto">
  <div class="col-md-12">
	<div class="panel panel-success">
		<div class="panel-heading" align="center"><h4>Giỏ hàng<h4></div>
		<div class="panel-body" id="giohang" name="giohang">
			<form name="sl" action="" method="post" class="form-horizontal">
		    	<table class="table table-hover">
					<tr>
						<th>Chọn</th>
					    <th>STT</th>
					    <th>Hình</th>
					    <th>Sản phẩm</th>
					    <th>Giá</th>
					    <th>Số Lượng</th>
					    <th>Thành Tiền</th>
					    <th>Xóa</th>
				    </tr>
				    <?php
				    	$sqsp = "SELECT * from sanpham";
				    	$rssp = mysql_query($sqsp);
				    	$stt=0;
						$tongtien=0;
				    	while ($rowsp = mysql_fetch_array($rssp))
				    	{
				    		$Ma_sp=$rowsp['Ma_sp'];
				    		$Hinh_sp=$rowsp['Hinh_sp'];
							$Ten_sp=$rowsp['Ten_sp'];
				    		$Solg_sp = $rowsp['Solg_sp'];
				    		$Gia_sp = $rowsp['Gia_sp'];
				    		$date=date("Y-m-d");
							$rectkm = mysql_query("SELECT * FROM ct_khuyenmai WHERE Ma_sp = '$Ma_sp' and '$date' between Ngay_bd and Ngay_kt");
							$rowctkm = mysql_fetch_array($rectkm);
								if(mysql_num_rows($rectkm)>0)
								{
									$dongia = $rowctkm['Gia_km']; //có thỳ gán giá sp = giá km
								}
								else
								{
									$dongia = $rowsp['Gia_sp'];
								}
							if(isset($_SESSION["'".$Ma_sp."'"]))
							{
								$stt+=1;
								$soluong=$_SESSION["'".$Ma_sp."'"];
								$tt=$soluong*$dongia;
								$tongtien+=$tt;
								
					?>
				    <tr>
				    	<td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $Ma_sp; ?>"></td>
						<td><?php echo $stt ?></td>
						<td><a href="<?php echo '?inc=xe.php&xe='.$Ma_sp; ?>"><img src="<?php echo $Hinh_sp; ?>" width="100px"></a></td>
						<td><a href="<?php echo '?inc=xe.php&xe='.$Ma_sp; ?>"><?php echo $Ten_sp; ?></a></td>
						<td><?php echo number_format($dongia,0,',','.'); ?></td>
						<td>
							    <input type="number" style="width:3em;" id="cnsl<?php echo $rowsp['Ma_sp']; ?>" name="cnsl<?php echo $rowsp['Ma_sp']; ?>" value="<?php echo $_SESSION["'".$Ma_sp."'"]; ?>"/>
							    <br>Số lượng tối đa có thể đặt: <?php echo $Solg_sp ?>
		      			</td>
		      			<td><?php echo number_format($tt,0,',','.'); ?></td>
			  			<td><a href="?inc=giohang1.php&xoaxe=<?php echo $Ma_sp; ?>" onclick="sure()">Xóa</a></td>  
					</tr>
					<?php } } ?>
					<tr>
					  <td colspan="8">
					  	<div class="row">
					  		<div class="col-md-6" align="left"><input type="submit" id="subxoanhieu" name="subxoanhieu" class="btn btn-default" value="Xóa"/> <input type="submit" id="subcapnhat" name="subcapnhat" class="btn btn-default" value="Cập nhật"/></div>
					    	<div class="col-md-6" align="right">
					    		<p><b>Tổng Số Tiền: <?php echo number_format($tongtien,0,',','.'); ?> Đồng</b></p>
					    	</div>
					    </div>
					  </td>
					</tr>
					<tr>
						<td colspan="7">
						  	<div class="row">
			  					<div class="col-md-6"><a href="?inc=sanpham.php" class="style3">&lt; &lt; Trở lại</a></div>
								<div class="col-md-6" align="right">
									<?php $_SESSION['stt']=$stt; $_SESSION['tongtien']=$tongtien; if($_SESSION['tongtien']!=0){ echo '<a href="?inc=giohang2.php" class="style3">Tiếp tục &gt; &gt;</a>';} ?>
								</div>
			  				</div>
		  				</td>
		    		</tr>
				</table>
			</form>
		</div>
	</div>
  </div>
</div>
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
					unset($_SESSION["'".$maxoanhieu."'"]);	
		}
		echo "<script>alert('Đã xóa sản phẩm khỏi giỏ hàng')</script>";
		echo '<meta http-equiv="refresh" content="0;URL=?inc=giohang1.php"/>';
	}

	//XÓA 1

	if(isset($_GET['xoaxe']))
	{
		$xoaxe = $_GET['xoaxe'];
		unset($_SESSION["'".$xoaxe."'"]);
		echo "<script>alert('Đã xóa sản phẩm khỏi giỏ hàng')</script>";
		echo '<meta http-equiv="refresh" content="0;URL=?inc=giohang1.php"/>';
	}
	//CẬP NHẬT
	if(isset($_POST['subcapnhat']))
	{
		
		$sqcnsp="SELECT * From sanpham";
		$rscnsp= mysql_query($sqcnsp);
		while($rowcnsp=mysql_fetch_array($rscnsp))
		{
			$spcn = $rowcnsp['Ma_sp'];
			
			if(isset($_SESSION["'".$spcn."'"]))
			{
				$x = "cnsl"."$spcn";
				$slspcn = $rowcnsp['Solg_sp'];
				if($_SESSION["'".$spcn."'"] != $_POST[$x])
				{
					if($_POST[$x] > $slspcn)
					{
						$_SESSION["'".$spcn."'"] = $slspcn;
						echo "<script>alert('".$rowcnsp['Ten_sp']." chỉ còn đặt được số lượng tối đa ".$slspcn."')</script>";
					}
					else if($_POST[$x] > 0)
					{
						$_SESSION["'".$spcn."'"] = $_POST[$x];
					}
					else
					{
						unset($_SESSION["'".$spcn."'"]);
					}
				}
			}
			
		}
		echo "<script>alert('Đã cập nhật số lượng!')</script>";
		echo '<meta http-equiv="refresh" content="0;URL=?inc=giohang1.php"/>';	
	}
?>