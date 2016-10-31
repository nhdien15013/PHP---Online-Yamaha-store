<?php include("connection.php"); ?>

<?php
	$somautintrentrang = 5;
	if(isset($_GET['trang']))
	{
		$tranghientai = $_GET['trang'];
	}
	else
	{
		$tranghientai = 1;
	}
	$sqbv="SELECT * from baiviet ORDER BY Ma_bv DESC LIMIT ".(($tranghientai-1)*$somautintrentrang).",".$somautintrentrang;
	$rsbv=mysql_query($sqbv);
	while ($rowbv=mysql_fetch_array($rsbv))
	{
?>
<div class="panel panel-default">
  <div class="panel-heading"><a href="<?php echo '?inc=bai.php&bai='.$rowbv['Ma_bv']; ?>"><?php echo $rowbv['Ten_bv']; ?></a></div>
  <div class="panel-body">
    <div class="row">
	  <div class="col-md-4">
	  	<a href="<?php echo '?inc=bai.php&bai='.$rowbv['Ma_bv']; ?>"><img src="<?php echo $rowbv['Hinh_bv']; ?>"></a>
	  </div>
	  <div class="col-md-8">
	  	<?php echo substr(strip_tags(htmlspecialchars_decode($rowbv['Noidung_bv'])), 0,900); ?>
	  	<a href="<?php echo '?inc=bai.php&bai='.$rowbv['Ma_bv']; ?>">... Xem tiếp</a>
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
		echo "<li><a href='?inc=baiviet.php&trang=".$back."'>&laquo;</a></li>";
	}
?>
	<!-- Các trang có số -->
<?php
	$result = mysql_query("SELECT COUNT(*) From baiviet");
	$tongsomautin = mysql_result($result,0);
	$sotrang = ceil($tongsomautin/$somautintrentrang);
	for($i=1;$i<=$sotrang;$i++)
	{
		if($i==$tranghientai)
		{
			echo "<li class='active'><a>".$i."</a></li>";
		}
		else
		{
			echo "<li><a href='?inc=baiviet.php&trang=".$i."'>".$i."</a></li>";
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
		echo "<li><a href='?inc=baiviet.php&trang=".$next."'>&raquo;</a></li>";
	}
?>
</ul>