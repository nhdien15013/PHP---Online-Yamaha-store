<?php include("connection.php");?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<script>
	function ktxoa()
	{	
		result= confirm("Bạn chắc chắn sẽ xóa?");
		return result;
	}
</script>

 <?php
		if (isset($_POST['subXoa'])&& isset($_POST['checkbox']))
		{
			for ($i = 0; $i < count($_POST['checkbox']); $i++)
			{					
						$maxoanhieu = $_POST['checkbox'][$i];
						mysql_query("DELETE FROM sanpham WHERE Ma_sp='$maxoanhieu'");
				
			}
		}

		if(isset($_GET['ma']))
		{
			$maxoa1 = $_GET['ma'];
			mysql_query("DELETE from sanpham where Ma_sp='$maxoa1'");
			echo "<script>alert('Xóa thành công')</script>";
			echo '<meta http-equiv="refresh" content="0;URL=?inc=dssp.php"/>';
		}
?>
<form name="frmXoa" method="post" action="">
	<table width="100%" class="table table-hover">
		<tr>
        <th><strong>Chọn</strong></th>
			<th>Mã sp</th>
            <th>Tên sp</th>
			<th>Hình ảnh</th>
			<th>Loại xe</th>
			<th>Giá</th>
			<th>Số lượng</th>
			<th>Khuyến mãi</th>
            <th></th>
            <th></th>
		</tr>
		<?php
			$somautintrentrang = 10;
				if(isset($_GET['trang']))
				{
					$tranghientai = $_GET['trang'];
				}
				else
				{
					$tranghientai = 1;
				}
		
					$sq="SELECT a.Ma_sp, a.Ten_sp, a.Hinh_sp, b.Ten_loai, a.Gia_sp, a.Solg_sp
					From sanpham as a, loai_sp as b
					where a.Ma_loai=b.Ma_loai
					ORDER BY a.Ma_sp DESC
					LIMIT ".(($tranghientai-1)*$somautintrentrang).",".$somautintrentrang;

			$result= mysql_query($sq);
			while($row=mysql_fetch_array($result))
			{
				// XÉT SẢN PHẨM CÓ KHUYẾN MÃI KHÔNG
				$masp=$row['Ma_sp'];
				$date=date("Y-m-d");
				$rectkm = mysql_query("SELECT * FROM ct_khuyenmai WHERE Ma_sp = '$masp' and '$date' between Ngay_bd and Ngay_kt");
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
					<tr>
                    	<td class="cotCheckBox"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['Ma_sp']; ?>"></td>
						<td align="center"><?php echo $row['Ma_sp'] ?></td>
                        <td><?php echo $row['Ten_sp'] ?></td>
						<td><img src="<?php echo $row['Hinh_sp'] ?>" height="100" width="100"/></td>
						<td><?php echo $row["Ten_loai"] ?></td>
						<td align="center"><?php if($mactkm!="")
													{
														echo "<p><strike>".number_format($row['Gia_sp'],0,',','.')."</strike></p>";
														echo number_format($rowctkm['Gia_km'],0,',','.');
													}
													else
													{
						 								echo number_format($row['Gia_sp'],0,',','.');
						 							}
						 					?>
						</td>
						<td align="center"><?php echo $row["Solg_sp"] ?></td>
						<td align="center"><?php echo $mactkm ?></td>
                        <td><a href="?inc=dssp.php&ma=<?php echo $row['Ma_sp'];?>" onclick="return ktxoa();">Xóa</a></td>
                        <td><a href="?inc=suasp.php&ma=<?php echo $row['Ma_sp'];?>">Cập nhật</a></td>
					</tr>
		<?php
			}
		?>
        <tr>
                        <td colspan="10">
                        <input type="submit" value="Xóa mục chọn" name="subXoa" id="subXoa" onclick='return ktxoa()'/> </td>
                    </tr>
	</table>
		<ul class="pagination">
  			<!-- Nút trang trước -->
  			<?php $back=(int)$tranghientai-1;
				if($back<1)
				{
					echo "<li class='active'><a>&laquo;</a></li>";
				}
				else
				{
					echo "<li><a href='?inc=dssp.php&trang=".$back."'>&laquo;</a></li>";
				}
			?>
  			<!-- Các trang có số -->
			<?php
				$result = mysql_query("SELECT COUNT(a.Ma_sp) From sanpham as a, loai_sp as b
										where a.Ma_loai=b.Ma_loai");
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
						echo "<li><a href='?inc=dssp.php&trang=".$i."'>".$i."</a></li>";
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
					echo "<li><a href='?inc=dssp.php&trang=".$next."'>&raquo;</a></li>";
				}
			?>
		</ul>
</form>