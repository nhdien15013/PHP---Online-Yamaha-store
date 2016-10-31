<?php include("connection.php"); ?>
<?php session_start(); ?>
				<div class="row">
					<div class="box_header_user_menu col-md-7">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-2">
										<span class="glyphicon glyphicon-time" style="font-size: 180%;"></span>
									</div>
									<div class="col-md-10">
					                    <span class="boxed-content-title" style="font-size: 110%;">  THỜI GIAN </span>
					                    <br/>  08h00 - 21h00
					                </div>
					            </div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-2">
										<span class="glyphicon glyphicon-phone-alt" style="font-size: 180%;"></span>
									</div>
									<div class="col-md-10">
					                    <span class="boxed-content-title" style="font-size: 110%;">  ĐẶT HÀNG </span>
					                    <br/>  (07103) 1234 5678
					                </div>
					            </div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-2">
										<span class="glyphicon glyphicon-wrench" style="font-size: 180%;"></span>
									</div>
									<div class="col-md-10">
					                    <span class="boxed-content-title" style="font-size: 110%;">  BẢO HÀNH </span>
					                    <br/>  3 năm
					                </div>
					            </div>
							</div>
						</div>
					</div>
					<div class="header-right col-md-5">
						
						<ul class="">
							<?php
								if(isset($_SESSION['Email']))	//xét có tồn session email chưa có thỳ hiển thị menu của thành viên
								{
							?>		
							<ul class="follow_icon1">					
								<div class="btn-group" style="font-size:110%;">
								  <button type="button" class="btn btn-info" style="font-size:100%;"><?php echo $_SESSION['Email']; ?></button>
								  <button type="button" class="btn btn-info dropdown-toggle" style="font-size:100%;" data-toggle="dropdown">
								    <span class="caret"></span>
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <ul class="dropdown-menu" style="font-size:110%;" role="menu">
								    <li><a href="?inc=doithongtin.php">Đổi thông tin</a></li>
								    <li><a href="?inc=giohang1.php">Giỏ hàng</a></li>
								    <li><a href="?inc=ktdh1.php">Kiểm tra đơn hàng</a></li>
								    <li class="divider"></li>
								    <li><a href="<?php if(isset($_GET['inc'])){echo strstr($_SERVER['REQUEST_URI'],'?').'&dn=dxuat';}else {echo '?dn=dxuat';} ?>">Đăng xuất</a></li>
								  </ul>
								</div>
							</ul>
								<?php 
									if(isset($_GET['dn']) && $_GET['dn']=='dxuat')
										{
											session_destroy(); echo '<meta http-equiv="REFRESH" content ="0;URL="/>';
										}
								?>
							<?php }	else 	//không có sesion email thì hiện đăng nhập đăng ký
							{ ?>
								<ul class="follow_icon">
									<li><a href="<?php if(isset($_GET['inc'])){echo strstr($_SERVER['REQUEST_URI'],'?').'&dn=dnhap';}else {echo '?dn=dnhap';}?>">Đăng nhập</a></li>
									<li><a href="?inc=dangky.php">Đăng ký</a></li>
								</ul>
							<?php }?>
						<!-- Đăng nhập thành viên -->
						<?php
							if(isset($_GET['dn'])&&!isset($_SESSION['Email']))
							{
								if($_GET['dn']=='dnhap')	//có tồn tại get dnhap và không tồn tại session email thì hiện form đăng nhập
								{?>
									<ul class="follow_icon">
									<?php
										if(isset($_POST['subdn']))
										{
											$Email = $_POST['Email'];
											$Pass = md5($_POST['Pass']);
											$sqtv="select * from thanhvien where Email='$Email' and Pass='$Pass'";
											$rstv = mysql_query($sqtv);
											if(mysql_num_rows($rstv)>0)	//kiểm tra tài khoản có tồn tại không (Email & Pass)
											{
												$_SESSION['Email']=$_POST['Email'];				//có thì ghi session email
												echo '<meta http-equiv="REFRESH" content ="0;URL="/>';
											}
											else
											{
												echo '<loi style="color:red;"> Email hoặc Pass sai! Thử lại hoặc <a href="?inc=dangky.php">Đăng ký</a> </loi>';
											}
											if(isset($_POST['remember'])) //kiểm tra là có check ghi nhớ
											{
												setcookie("Email", $_POST['Email'], time()+(60*60*24*365));	//thì ghi cookie
												setcookie("Pass", $_POST['Pass'], time()+(60*60*24*365));
											}
											if(isset($_COOKIE['Email']) && !isset($_POST['remember']))	//kiểm tra có tồn tại cookie và không check ghi nhớ
											{
												setcookie("Email", $_POST['Email'], time()+0);	//thì xóa cookie
												setcookie("Pass", $_POST['Pass'], time()+0);
											}
										}
									?>								
										<form method="POST">
											<li><input type="text" id="Email" name="Email" class="form-control" placeholder="Email"
												value="<?php if (isset($_COOKIE['Email'])) echo $_COOKIE['Email']; else  echo ''?>">
												<p><input type="checkbox" id="remember" name="remember" class="" value="1" checked>Ghi nhớ</p>
											</li>
											<li><input type="password" id="Pass" name="Pass" class="form-control" placeholder="Mật khẩu" 
												value="<?php if (isset($_COOKIE['Pass'])) echo $_COOKIE['Pass']; else  echo ''?>">
                    						</li>
											<li><button type="submit" id="subdn" name="subdn" class="form-control btn-default">Đăng nhập</button></li>
										</form>
									</ul>
							<?php }
							}
						?>
						<!-- end - Đăng nhập thành viên -->
					</div>
				</div>
					<div class="clear"></div> 
					<div class="header-bot">
						<div class="logo">
							<a href="index.php"><img src="media/themes/logo.png" alt=""/></a>
						</div>
						<div class="search">
							<form method="post" action="?inc=search.php">
							    <input type="text" name="tim" id="tim" class="textbox" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
							    <button type="submit" name="subtim" id="subtim" class="gray-button"><span>Tìm kiếm</span></button>
							</form>
							<?php
								if(isset($_POST['subtim']))
								{
									if(isset($_POST['tim']))
									{
										$_SESSION['tim'] = $_POST['tim'];
										echo '<meta http-equiv="REFRESH" content ="0;URL=?inc=search.php"/>';
									}
								}
							?>
				       </div>
					<div class="clear"></div>