<?php include("connection.php"); ?>
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php //error_reporting(E_ALL & ~E_NOTICE & ~8192);   ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Yamaha Điền Khánh Minh</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>  


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script src="js/superfish.js"></script>
<script language="javascript" src="quantri/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script language="javascript" src="quantri/js/ckfinder/ckfinder.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="header-bg">
	<div class="wrap"> 
		<div class="h-bg">
			<div class="total">
				<div class="header">
					<?php include_once('include/header.php'); ?>
				</div>		
			</div>	
			<div class="menu"> 	
				<?php include_once('include/top-menu.php'); ?>
			</div>
			<div class="banner-top bodytrai">
				<div class="header-bottom">
					<div class="header_bottom_right_images">
					     	<?php
								if (isset($_GET['inc']))
								{
									$trang = $_GET['inc'];
									include('include/'.$trang);
								}
								else
									include("include/main.php");
							?>
					</div>
					<div class="header-para bodyphai">
							<?php include_once('include/sidebar.php'); ?>
					</div>
					<div class="clear"></div>
					<div class="footer-bottom">
						<?php include_once('include/footer.php'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>

    	
    	
            