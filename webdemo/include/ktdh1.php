<?php include("connection.php"); ?>
<?php 
	if(!isset($_SESSION['Email']))
	{
			echo '<meta http-equiv="refresh" content="0;URL=?inc=main.php&dn=dnhap">';
	}
?>
<div class="page-header">
	<h3>Danh sách đơn hàng của bạn</h3>
</div>
	
<form method="POST">
  <table class="table table-hover">
    <tr>
      <th>STT</th>
      <th>Mã ĐH</th>
      <th>Email đặt hàng</th>
      <th>Ngày đặt hàng</th>
      <th>Ngày giao hàng</th>
      <th>Tổng tiền</th>
      <th>Tình trạng đơn hàng</th>
      <th></th>
    </tr>
    <?php			
    		$stt = 0;
			$sq="SELECT * From dathang";
			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
			{
				$stt+=1;
	?>
    <tr>
	    <td><?php echo $stt; ?></td>
	    <td><?php echo $row['Ma_dh'];?></td>
	    <td><?php echo $row['Email_dh'];?></td>
		<td><?php echo $row['Ngay_dh'];?></td>
		<td><?php echo $row['Ngay_gh'];?></td>
		<td><?php echo number_format($row['Tongtien_dh'],0,',','.');?></td>
		<td><?php if($row['Tinhtrang_dh']=='xuly'){echo "Đang xử lý";}elseif($row['Tinhtrang_dh']=='giao'){echo "Đang giao hàng";}else{echo "Đã xong";};?></td>
	    <td><a href="?inc=ktdh2.php&ma=<?php echo $row['Ma_dh'];?>">Chi tiết</a></td>
    </tr>
    <?php
		}
	?>
  </table>
</form>
