<?php include("connection.php");?>
<?php session_start(); ?>
<a class="navbar-brand" href="index.php"><span>Yamaha</span>Điền Khánh Minh</a>
<ul class="user-menu">
	<li class="dropdown pull-right">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
		<?php echo $_SESSION['Email']; ?> <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo "?inc=suatv.php&ma=".$_SESSION['Email']; ?>"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
			<li><a href="<?php if(isset($_GET['inc'])){echo strstr($_SERVER['REQUEST_URI'],'?').'&dn=dxuat';}else {echo '?dn=dxuat';} ?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
		</ul>
	</li>
</ul>
<?php 
	if(isset($_GET['dn']) && $_GET['dn']=='dxuat')
		{
			session_destroy(); echo '<meta http-equiv="REFRESH" content ="0;URL=index.php"/>';
		}
?>