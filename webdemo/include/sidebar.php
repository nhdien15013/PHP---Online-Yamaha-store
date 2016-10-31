					<?php include("connection.php") ?>
					<div class="categories">
						<div class="list-categories">
							<?php
				                $sqloai_sp="select * from loai_sp";
				                $rsloai_sp=mysql_query($sqloai_sp);
				                while($rowloai_sp=mysql_fetch_array($rsloai_sp))
				                {
							?>
								<div class="first-list">
									<div class="div_2"><span class="glyphicon glyphicon-play"></span> <a href="<?php echo '?inc=sanpham.php&loai='.$rowloai_sp['Ma_loai']; ?>"><?php echo $rowloai_sp['Ten_loai'] ?></a></div>
									<div class="div_img"></div>
									<div class="clear"></div>
								</div>
							<?php } ?>
						</div> <!-- end list cag -->
						<div class="box"> 
								<div class="box-content">
									<h2><span class="glyphicon glyphicon-shopping-cart"></span><a href="?inc=giohang1.php">Giỏ hàng</a></h2>
									Số sản phẩm trong giỏ: <?php if(isset($_SESSION['stt'])) {echo $_SESSION['stt'];} else {echo 0;} ?>
								</div>	
						</div>
			

						<div class="box-title">
							<h3><span class="title-icon"></span>Tin tức mới</h3>
						</div>
						<div class="section group example">
							<div class="col_1_of_2 span_1_of_2">
							<?php
								$xhang=0;
								$sqbv="SELECT * from baiviet  ORDER BY Ma_bv DESC LIMIT 10";
				                $rsbv=mysql_query($sqbv);
				                while($rowbv=mysql_fetch_array($rsbv))
				                {
				                	$xhang+=1;
							?>
									<a href="?inc=bai.php&bai=<?php echo $rowbv['Ma_bv']; ?>"><img src="<?php echo $rowbv['Hinh_bv'];?>" alt=""/></a>
									<?php if($xhang==5)
											{
												echo '</div>
														<div class="col_1_of_2 span_1_of_2">';
												$xhang=0;
											}
									?>
							<?php } ?>
							</div>
						<div class="clear"></div>
			   		 	</div>
						
						<div class="clear"></div>
					</div>