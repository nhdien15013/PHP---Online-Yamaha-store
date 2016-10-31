<?php include("connection.php");?>
<?php @session_start();
	
	if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
	{
		echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
	}
?>
<form name="frmXoa" method="post" action="">
	<table width="100%" class="table table-hover">
		<tr>
			<th>Chọn</th>
			<th>Mã bài viết</th>
			<th>Hình</th>
			<th>Tên BV</th>
			<th>Danh mục</th>
			<th>Tác giả</th>
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
					$sq="SELECT a.Ma_bv, a.Ten_bv, b.Ten_dmbv, a.Hinh_bv, a.Email_tv From baiviet as a, danhmuc_bv as b
						where a.Ma_dmbv = b.Ma_dmbv
						LIMIT ".(($tranghientai-1)*$somautintrentrang).",".$somautintrentrang;
					$result= mysql_query($sq);
					while($row=mysql_fetch_array($result))
					{
				?>
		<tr>
			<td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['Ma_bv']; ?>"></td>
			<td><?php echo $row['Ma_bv'] ?></td>
			<td><img src="<?php echo $row['Hinh_bv'] ?>" height="100" width="100" /></td>
			<td><?php echo $row['Ten_bv'] ?></td>
			<td><?php echo $row['Ten_dmbv'] ?></td>
			<td><?php echo $row['Email_tv'] ?></td>
			<td><a href="?inc=dsbv.php&ma=<?php echo $row['Ma_bv'];?>" onclick="return sure();">Xóa</a></td>
			<td><a href="?inc=suabv.php&ma=<?php echo $row['Ma_bv'];?>">Cập nhật</a></td>
		</tr>

	                    <?php
				        }
	                    ?>
	                     <tr>
	                        <td colspan="8">
	                        <input type="submit" value="Xóa mục chọn" name="btnXoanhieu" id="btnXoanhieu" onclick='return sure()'/> </td>
	                    </tr>
	</table>

		<ul class="pagination">
			<!-- Nút trang trước -->
  			<li><a href="<?php $back=(int)$tranghientai-1;
  								if($back<1)
  								{
  									echo '';
  								}
  								else
  								{
  							 		echo '?inc=dsbv.php&trang='.$back;
  							 	}?>">&laquo;</a></li>
  			<!-- Các trang có số -->
			<?php
				$result = mysql_query("SELECT COUNT(a.Ma_bv) From baiviet as a, danhmuc_bv as b
										where a.Ma_dmbv=b.Ma_dmbv");
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
						echo "<li><a href='?inc=dsbv.php&trang=".$i."'>".$i."</a></li>";
					}
				}
			?>
			<!-- Nút trang sau -->
			<li><a href="<?php $next=(int)$tranghientai+1;
							if($next>$sotrang)
							{
								echo '';
							}
							else
							{
								echo '?inc=dsbv.php&trang='.$next;
							}?>">&raquo;</a></li>
		</ul>

	<script>
		function sure()
		{	
			result= confirm("Bạn có thực sự muốn xóa?");
			return result;
		}
	</script>
	 
	<?php
			if (isset($_POST['btnXoanhieu'])&& isset($_POST['checkbox']))
			{
				for ($i = 0; $i < count($_POST['checkbox']); $i++)
				{					
							$maxoanhieu = $_POST['checkbox'][$i];
							mysql_query("DELETE FROM baiviet WHERE Ma_bv='$maxoanhieu'");
				}
				echo "<script>alert('Xóa thành công')</script>";
				echo '<meta http-equiv="refresh" content="0;URL=?inc=dsbv.php"/>';
			}
	?>
	<?php
	if(isset($_GET['ma']))
	{
		$Ma_bv = $_GET['ma'];
		mysql_query("DELETE FROM baiviet WHERE Ma_bv='$Ma_bv'");
		echo "<script>alert('Xóa thành công')</script>";
		echo '<meta http-equiv="refresh" content="0;URL=?inc=dsbv.php"/>';
	} 
	?> 
</form>