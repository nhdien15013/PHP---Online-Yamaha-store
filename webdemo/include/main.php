					<div id="slideshow">
							<?php include_once("banner.php"); ?>
				  	</div>

		  			<div class="content-wrapper">	
						<div class="content-top">
							<div class="box_wrapper"><h3>Sản phẩm mới</h3></div>
							<div class="text">
								<?php
										$xhang = 0;	//đặt biến hàng để xuống hàng trong giao diện lưới
										$sqsp="SELECT * from sanpham ORDER BY Ma_sp DESC LIMIT 6";
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
						</div>
					</div>
