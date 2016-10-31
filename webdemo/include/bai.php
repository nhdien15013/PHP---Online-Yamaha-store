<?php include("connection.php"); ?>

<?php
	if(isset($_GET['bai']))
	{
		$Ma_bv = $_GET['bai'];
		$sqbai = "SELECT * From baiviet where Ma_bv = '$Ma_bv'";
		$rsbai = mysql_query($sqbai);
		$rowbai = mysql_fetch_array($rsbai);
	}
?>
<div class="page-header">
  <h3><?php echo $rowbai['Ten_bv']; ?></h3>
</div>
<div class="row" style="width: 95%; margin: 0 auto">
	<?php echo htmlspecialchars_decode($rowbai['Noidung_bv']); ?>
</div>
