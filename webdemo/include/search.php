<?php include("connection.php"); ?>

<?php
	if($_SESSION['tim']!="")
	{
		$somautintrentrang = 5;
		if(isset($_GET['trang']))
		{
			$tranghientai = $_GET['trang'];
		}
		else
		{
			$tranghientai = 1;
		}
		$sqtim="SELECT * from sanpham where Ten_sp LIKE '%".$_SESSION['tim']."%' LIMIT ".(($tranghientai-1)*$somautintrentrang).",".$somautintrentrang;;
		$rstim=mysql_query($sqtim);
		if(mysql_num_rows($rstim)<1)
		{
			echo 'Không có kết quả cho từ khóa '.$_SESSION['tim'];
		}
		else{
			while ($rowtim=mysql_fetch_array($rstim))
			{
				$masp=$rowtim['Ma_sp'];
				$date=date("Y-m-d");
				$rectkm = mysql_query("SELECT * FROM ct_khuyenmai
									WHERE Ma_sp = '$masp' and '$date' between Ngay_bd and Ngay_kt");	//xét sp có km không
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
<div class="panel panel-default">
  <div class="panel-heading"><a href="<?php echo '?inc=xe.php&bai='.$rowtim['Ma_sp']; ?>"><?php echo $rowtim['Ten_sp']; ?></a></div>
  <div class="panel-body">
    <div class="row">
	  <div class="col-md-4">
	  	<a href="<?php echo '?inc=xe.php&xe='.$rowtim['Ma_sp']; ?>"><img src="<?php echo $rowtim['Hinh_sp']; ?>"></a>
	  </div>
	  <div class="col-md-8">
	  	<p>
			<b>Giá: </b><?php
							if($mactkm!="")
							{
								echo '<span class="reducedfrom">'.number_format($rowctkm['Gia_km'],0,',','.').'</span>';
								echo '<span class="actual">'.number_format($rowtim['Gia_sp'],0,',','.').'</span>';
							}
							else
							{
								echo '<span class="reducedfrom">'.number_format($rowtim['Gia_sp'],0,',','.').'</span>';
							}
						?>
		</p>
		<p>
			<b>Màu: </b><?php echo $rowtim['Mau_sp']; ?>
		</p>
	  	<p>
		  	<?php echo substr(strip_tags(htmlspecialchars_decode($rowtim['Thongtin_sp'])), 0,700); ?>
		  	<a href="<?php echo '?inc=xe.php&xe='.$rowtim['Ma_sp']; ?>">... Xem chi tiết</a>
		</p>
	  </div>
	</div>
  </div>
</div>
<?php } ?>
	<ul class="pagination">
		<!-- Nút trang trước -->
		<?php $back=(int)$tranghientai-1;
		if($back<1)
		{
			echo "<li class='active'><a>&laquo;</a></li>";
		}
		else
		{
			echo "<li><a href='?inc=search.php&trang=".$back."'>&laquo;</a></li>";
		}
		?>
			<!-- Các trang có số -->
		<?php
			$result = mysql_query("SELECT * from sanpham where Ten_sp LIKE '%".$_SESSION['tim']."%'");
			$tongsomautin = mysql_num_rows($result);
			$sotrang = ceil($tongsomautin/$somautintrentrang);
			for($i=1;$i<=$sotrang;$i++)
			{
				if($i==$tranghientai)
				{
					echo "<li class='active'><a>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='?inc=search.php&trang=".$i."'>".$i."</a></li>";
				}
			}
		?>
		<!-- Nút trang sau -->
		<?php $next=(int)$tranghientai+1;
			if($next>$sotrang)
			{
				echo "<li class='active'><a>&raquo;</a></li>";
			}
			else
			{
				echo "<li><a href='?inc=search.php&trang=".$next."'>&raquo;</a></li>";
			}
		?>
	</ul>

<?php }}
else{echo 'Không có từ khóa tìm kiếm!';}
?>
