<?php
	include("connection.php");
?>
<body>
<?php

	if(isset($_POST['subgopy']))
	{
		$Email_gy = $_POST['Email_gy'];
		$Tieude_gy = $_POST['Tieude_gy'];
		$Noidung_gy = $_POST['Noidung_gy'];
    $rsemail = mysql_query("SELECT * From thanhvien Where Email = '$Email_gy'");
    if($Email_gy =="" || $Tieude_gy=="" || $Noidung_gy=="") //kiểm tra rỗng
    {
      echo '<p style="color:red;"> Nhập thiếu thông tin, tất cả trường đều bắt buột! </p>';
    }
    else if(!empty($Email_gy) && !eregi("^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,30}$", $Email_gy) ) //kiểm tra định dạng email
    { 
      echo "<p style='color:red;'>Email nhập không đúng định dạng!<p>";
    }  
    else if(!isset($_SESSION['Email']) && mysql_num_rows($rsemail)>0) //kiểm tra email có trùng không với khách hàng chưa đăng nhập
    {
      echo '<p style="color:red;"> Email đã có người sử dụng! </p>';
    }
    else
    {
      $sq = "insert into gopy values ('','$Email_gy','$Tieude_gy','$Noidung_gy')";
      mysql_query($sq);
      echo '<p style="color:green;"> Góp ý của bạn đã được đăng. Cảm ơn ý kiến đóng góp của bạn! </p>';
    }
	}
	
?>
<form class="form-horizontal" role="form" method="POST">
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="Email_gy" name="Email_gy" value="<?php if(isset($_SESSION['Email'])){echo $_SESSION['Email'];} ?>"
      <?php if(isset($_SESSION['Email'])){echo "readonly";}?> placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">Tiêu đề</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Tieude_gy" name="Tieude_gy" placeholder="Tiêu đề bài viết" " size="50">
    </div>
  </div>
 
   <div class="form-group">
    <label for="" class="col-sm-2 control-label">Nội dung bài viết</label>
    <div class="col-sm-10">
      <textarea cols="50" rows="10" class="form-control" id="Noidung_gy" name="Noidung_gy" value="<?php echo $Noidung_gy ?>"placeholder="Nội dung"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="subgopy" name="subgopy" class="btn btn-default">Đăng góp ý</button>
    </div>
  </div>
</body>
</html>