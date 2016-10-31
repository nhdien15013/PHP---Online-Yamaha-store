<?php
  include("connection.php");
?>
<div class="page-header">
  <h3>Đăng kí</h3>
</div>
<?php
if(isset($_POST['subdangky']))
  {
    $Email = $_POST['Email'];
    $Pass = md5($_POST['Pass']);
    $Cf_pass = md5($_POST['Cf_pass']);
    $Ten_tv = $_POST['Ten_tv'];
    $Dt_tv = $_POST['Dt_tv'];
    $Dc_tv = $_POST['Dc_tv'];
    $loi = "";
  
    if(!$Email or !$Pass or !$Ten_tv or !$Dc_tv or !$Dt_tv) //Kiểm tra rỗng
    {
      $loi.="<p style='color:red;'>Chưa nhập đầy đủ thông tin! Tất cả thông tin đều bắt buộc!<p>";
    }
    if($Pass != $Cf_pass) //Kiểm tra nhập pass và confirm pass có trùng không
    {
      $loi.="<p style='color:red;'>Pass nhập không trùng<p>";
    }
    if(!empty($Email) && !eregi("^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,30}$", $Email) ) //kiểm tra định dạng email
    { 
      $loi.="<p style='color:red;'>Email nhập không đúng định dạng!<p>";
    }  
    $sq = "select * from thanhvien where Email = '$Email'";
    $result = mysql_query($sq);
    if(mysql_num_rows($result)>0)   //kiểm tra tài khoản email có người đăng ký chưa
    {
      $loi.= "<p style='color:red;'>Email đã có người sử dụng<p>"; 
    }
    if($loi!="")
    {
      echo $loi;
    }
    else
    {
      mysql_query("INSERT into thanhvien
            values('$Email','$Pass','$Ten_tv','$Dt_tv','$Dc_tv','tv')");
      $_SESSION['Email']=$_POST['Email'];
      echo '<meta http-equiv="REFRESH" content ="0;URL=index.php"/>';
      echo "<script>alert ('Đăng kí thành công') </script>";

    }
  }
?>

<form class="form-horizontal" role="form" method="POST">
  <div class="form-group">
    <label for="inputEmail3" class="col-xs-3 control-label">Email</label>
    <div class="col-xs-3">
      <input type="email" class="form-control" id="Email" name="Email" placeholder="Nhập Email" value="<?php if(isset($_POST['subdangky'])) echo $_POST['Email'] ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-xs-3 control-label">Password</label>
    <div class="col-xs-3">
      <input type="password" class="form-control" id="Pass" name="Pass" placeholder="Nhập password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-xs-3 control-label">Nhập lại password</label>
    <div class="col-xs-3">
      <input type="password" class="form-control" id="Cf_pass" name="Cf_pass" placeholder="Nhập lại password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-xs-3 control-label">Tên thành viên</label>
    <div class="col-xs-3">
      <input type="text" class="form-control" id="Ten_tv" name="Ten_tv" placeholder="Nhập tên thành viên" value="<?php if(isset($_POST['subdangky'])) echo $_POST['Ten_tv'] ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-xs-3 control-label">Số điện thoại</label>
    <div class="col-xs-3">
      <input type="tel" class="form-control" id="Dt_tv" name="Dt_tv" placeholder="Nhập số điện thoại" value="<?php if(isset($_POST['subdangky'])) echo $_POST['Dt_tv'] ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-xs-3 control-label">Địa chỉ</label>
    <div class="col-xs-3">
      <input type="text" class="form-control" id="Dc_tv" name="Dc_tv" placeholder="Nhập địa chỉ" value="<?php if(isset($_POST['subdangky'])) echo $_POST['Dc_tv'] ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-xs-3 control-label"></label>
    <div class="col-xs-3">
      <button type="submit" id="subdangky" name="subdangky" class="btn btn-default">Đăng ký</button>
    </div>
  </div>
</form>
