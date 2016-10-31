<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	include("connection.php");
	$sq="select * from thanhvien";
	$result=mysql_query($sq);
?>

<table width="500" border="1" align="center"
>
	<tr>
    	<td>Email</td>
        <td>Tên Thành viên</td>
        <td>Địa chỉ</td>
        <td>Số điện thoại</td>
    </tr>
   	<?php
		while($row=mysql_fetch_array($result))
		{
	?>
    <tr>
    	<td><?php echo $row['Email'] ?></td>
        <td><?php echo $row['Ten_tv'] ?></td>
        <td><?php echo $row['Dc_tv'] ?></td>
        <td><?php echo $row['Dt_tv'] ?></td>
    </tr>
    <?php
		}
	?>
</body>
</html>