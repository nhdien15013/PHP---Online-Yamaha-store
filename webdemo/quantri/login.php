<?php include("connection.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
function kt()
{
	var loi="";
	if(frmdangnhap.Email.value=="")
	{
		loi+="Nhập E-mail! ";
		
		
	}
	if(frmdangnhap.Pass.value=="")
	{
		loi+="Nhập Password! ";
	}
	if(loi!="")
	{
		alert(loi);
		return false;
	}
	return true;
}
</script>
<?php
session_start();
if(isset($_POST['subdangnhap']))
{
	$Email = $_POST['Email'];
	$Pass = md5($_POST['Pass']);
	$sqtv="select * from thanhvien where Email='$Email' and Pass='$Pass'";
	$sqqt="select * from thanhvien where Email='$Email' and Pass='$Pass' and Chucvu_tv='qt'";
	$rstv = mysql_query($sqtv);
	$rsqt = mysql_query($sqqt);
	if(mysql_num_rows($rsqt)>0)
	{
		$_SESSION['Email']=$Email;
		$_SESSION['Chucvu']=mysql_fetch_array($rstv)['Chucvu_tv'];
		echo "<script>alert('Đăng nhập quản trị thành công!')</script>";
		echo '<meta http-equiv="REFRESH" content ="0;URL=index.php"/>';
	}
	else if(mysql_num_rows($rstv)>0)
	{
		$_SESSION['Email']=$Email;
		echo "<script>alert('Đăng nhập thành công, bạn không phải quản trị!')</script>";
		echo '<meta http-equiv="REFRESH" content ="0;URL=../index.php"/>';
	}
	else
	{
		echo "<script>alert('Đăng nhập thất bại, tài khoản sai!')</script>";
	}
}
?>
</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Đăng nhập quản trị</div>
				<div class="panel-body">
					<form name="frmdangnhap" role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="Email" id="Email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="Pass" id="Pass" type="password" value="">
							</div>
							
							<input type="submit" name="subdangnhap" id="subdangnhap" class="btn btn-primary" value="Đăng nhập" onclick="kt()">
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
