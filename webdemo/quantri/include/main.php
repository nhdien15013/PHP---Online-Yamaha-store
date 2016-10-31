<?php include("connection.php"); ?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<div class="page-header">
	<h3><span class="glyphicon glyphicon-th"></span> Bảng điều khiển chính</h3>
</div>

<?php
	$sodh=mysql_num_rows(mysql_query("SELECT * from dathang where Tinhtrang_dh='xuly'"));
	$sosp=mysql_num_rows(mysql_query("SELECT * from sanpham"));
	$sotv=mysql_num_rows(mysql_query("SELECT * from thanhvien"));
	$sobv=mysql_num_rows(mysql_query("SELECT * from baiviet"));
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="width: 100%; margin: 0 auto;">		
									
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<a href="?inc=dsdh.php">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $sodh; ?></div>
								<div class="text-muted">Đ.hàng mới</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<a href="?inc=dssp.php">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $sosp; ?></div>
								<div class="text-muted">Sản phẩm</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<a href="?inc=dstv.php">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $sotv; ?></div>
								<div class="text-muted">Thành viên</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<a href="?inc=dsbv.php">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $sobv; ?></div>
								<div class="text-muted">Bài viết</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Danh sách đơn hàng mới</div>
					<div class="panel-body">
						<table class="table table-hover">
						    <tr>
						      <th>Mã đặt hàng</th>
						      <th>Email đặt hàng</th>
						      <th>Ngày đặt hàng</th>
						      <th>Ngày giao hàng</th>
						      <th>Tổng tiền</th>
						      <th>Tình trạng đơn hàng</th>
						    </tr>
						    <?php
									$sq="SELECT * From dathang where Tinhtrang_dh='xuly' ORDER BY Ma_dh DESC";
									$result= mysql_query($sq);
									while($row=mysql_fetch_array($result))
									{
							?>
						    <tr>
							    <td><?php echo $row['Ma_dh'];?></td>
							    <td><?php echo $row['Email_dh'];?></td>
								<td><?php echo $row['Ngay_dh'];?></td>
								<td><?php echo $row['Ngay_gh'];?></td>
								<td><?php echo number_format($row['Tongtien_dh'],0,',','.');?></td>
								<td><?php if($row['Tinhtrang_dh']=='xuly'){echo "Đang xử lý";}elseif($row['Tinhtrang_dh']=='giao'){echo "Đang giao hàng";}else{echo "Đã xong";};?></td>
						    </tr>
						    <?php
								}
							?>
						</table>
					</div>
				</div>
				
			</div><!--/.col-->
			
			<div class="col-md-4">
			
				<div class="panel panel-red">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Calendar</div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
								
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->
		  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	
</body>

</html>

