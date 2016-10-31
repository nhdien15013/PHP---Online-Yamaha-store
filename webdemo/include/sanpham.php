					<?php include("connection.php"); ?>
					<div class="content-wrapper">	
						<?php
								if(isset($_GET['loai'])) //xét có chọn loại xe không
								{
									$loai = ' WHERE Ma_loai = '.$_GET['loai'];	//có thì gán biến truy xuất sản phẩm từ csdl
									$linkloai = '&loai='.$_GET['loai'];			//gán biến nhận link phân trang
								}
								else
								{
									$loai = '';
									$linkloai = '';
								}
								$sqloai_sp="SELECT * from loai_sp".$loai;
				                $rsloai_sp=mysql_query($sqloai_sp);
				                while($rowloai_sp=mysql_fetch_array($rsloai_sp))
				                {
				                	$maloai = $rowloai_sp['Ma_loai'];
				                	$tenloai = $rowloai_sp['Ten_loai'];
						?>	  
						<div class="content-top">
							<div class="box_wrapper"><h3><?php echo $tenloai; ?></h3></div>
							<div class="text">
								<?php
										$somautintrentrang = 6;
										if(isset($_GET['trang']))
										{
											$tranghientai = $_GET['trang'];
										}
										else
										{
											$tranghientai = 1;
										}
										$xhang = 0;	//đặt biến hàng để xuống hàng trong giao diện lưới
										$sqsp="SELECT * from sanpham where Ma_loai = '$maloai'
												LIMIT ".(($tranghientai-1)*$somautintrentrang).",".$somautintrentrang;
										$rssp=mysql_query($sqsp);
										while ($rowsp=mysql_fetch_array($rssp))
										{
											$xhang+=1;
											$masp=$rowsp['Ma_sp'];
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
								<div class="grid_1_of_3 images_1_of_3">
									<div class="grid_1">
										<a href="<?php echo '?inc=xe.php&xe='.$rowsp['Ma_sp']; ?>"><img src="<?php echo $rowsp['Hinh_sp']; ?>" title="continue reading" alt=""></a>
											<div class="grid_desc">
												<p class="title"><a href="<?php echo '?inc=xe.php&xe='.$rowsp['Ma_sp']; ?>"><?php echo $rowsp['Ten_sp']; ?></a></p>
												<p class="title1"><?php echo $rowsp['Mau_sp']; ?></p>
													<div class="price" style="height: 19px;">
														<?php if($mactkm!="")
															{
																echo '<span class="reducedfrom">'.number_format($rowctkm['Gia_km'],0,',','.').'</span>';
																echo '<span class="actual">'.number_format($rowsp['Gia_sp'],0,',','.').'</span>';
															}
															else
															{
								 								echo '<span class="reducedfrom">'.number_format($rowsp['Gia_sp'],0,',','.').'</span>';
								 							}
								 						?>
													</div>
													<div class="cart-button">
														<div class="cart">
															<a href="<?php echo '?inc=giohang1.php&xe='.$rowsp['Ma_sp']; ?>"><img src="images/cart.png" alt=""/></a>
														</div>
														<a class="button" href="<?php echo '?inc=xe.php&xe='.$rowsp['Ma_sp']; ?>"><span>Chi tiết</span></a>
														<div class="clear"></div>
													</div>
											</div>
									</div><div class="clear"></div>
								</div>	
								<?php
									if($xhang==3)
									{
										echo '</div><div class="clear"></div><div class="text">';
										$xhang = 0;
									}	
								}
								?>
									
							</div><div class="clear"></div>
								<ul class="pagination">
						  			<!-- Nút trang trước -->
						  			<?php $back=(int)$tranghientai-1;
										if($back<1)
										{
											echo "<li class='active'><a>&laquo;</a></li>";
										}
										else
										{
											echo "<li><a href='?inc=sanpham.php".$linkloai."&trang=".$back."'>&laquo;</a></li>";
										}
									?>
						  			<!-- Các trang có số -->
									<?php
										$result = mysql_query("SELECT COUNT(*) From sanpham where Ma_loai = '$maloai'");
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
												echo "<li><a href='?inc=sanpham.php".$linkloai."&trang=".$i."'>".$i."</a></li>";
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
											echo "<li><a href='?inc=sanpham.php".$linkloai."&trang=".$next."'>&raquo;</a></li>";
										}
									?>
								</ul>
						</div>
						<?php } ?> <!-- end loai xe -->

					</div>