<?php include("connection.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>YamahaĐKM - Quản trị</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/sidebar-vertical.css" rel="stylesheet">
<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
<script language="javascript" src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script language="javascript" src="js/ckfinder/ckfinder.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<?php include_once('include/header.php'); ?>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div class="row affix-row">
    <div class="col-sm-3 col-md-2 affix-sidebar">
        <div class="sidebar-nav">
				  <div class="navbar navbar-default" role="navigation">
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
				      <span class="sr-only">Toggle navigation</span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      </button>
				      <span class="visible-xs navbar-brand">Sidebar menu</span>
				    </div>
				    <div class="navbar-collapse collapse sidebar-navbar-collapse">
				      <?php include_once('include/sidebar.php'); ?>
				    </div><!--/.nav-collapse -->
				  </div><!-- navbar -->
 				</div><!-- sidebar-nav -->
			</div><!-- affix-sidebar -->
	    <div class="col-sm-9 col-md-10 affix-content">
	        <div class="container">
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
	    </div>
</div><!-- row -->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

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
