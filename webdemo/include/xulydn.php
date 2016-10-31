<?php include("../connection.php"); ?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>YamahaĐKM - Đăng nhập</title>
<?php	
	$Email = $_POST['Email'];
	$Pass = md5($_POST['Pass']);
	$sqtv="select * from thanhvien where Email='$Email' and Pass='$Pass'";
	$rstv = mysql_query($sqtv);
	if(mysql_num_rows($rstv)>0)
	{
		$_SESSION['Email']=$Email;
		$_SESSION['Pass']=$Pass;
		echo "<script>alert('Đăng nhập thành công!')</script>";
		echo '<meta http-equiv="REFRESH" content ="0;URL=../index.php"/>';
	}
	else
	{
		echo '<loi style="color:red;"> Đăng nhập thất bại! Thử lại hoặc <a href="?inc=dangky.php">Đăng ký</a> </loi>';
	}
	if(isset($_POST['remember']))
	{
		setcookie("Email", $_SESSION['Email'], time()+(60*60*24*365));
		setcookie("Pass", $_SESSION['Pass'], time()+(60*60*24*365));
	}
?>