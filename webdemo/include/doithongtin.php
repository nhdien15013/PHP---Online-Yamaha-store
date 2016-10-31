
<?php include("connection.php"); ?>
<?php 
  if(!isset($_SESSION['Email']))
  {
      echo '<meta http-equiv="refresh" content="0;URL=?inc=main.php&dn=dnhap">';
  }
?>
<div class="page-header"><h3>Sửa thông tin</h3></div>

<?php
if(isset($_SESSION['Email']))
{
  $Email = $_SESSION['Email'];
  $sq = "select * from thanhvien where Email='$Email'";
  $rs = mysql_query($sq);
  $r = mysql_fetch_array($rs);
?>
<?php
    if(isset($_POST['subsuatv']))
    {
      $Pass = $_POST['Pass'];
      $Passmoi1 = $_POST['Passmoi1'];
      $Passmoi2 = $_POST['Passmoi2'];
      $Ten_tv = $_POST['Ten_tv'];
      $Dt_tv = $_POST['Dt_tv'];
      $Dc_tv = $_POST['Dc_tv'];
      if($Ten_tv!="" && $Dt_tv!="" && $Dc_tv!="" && $Dt_tv!="")
      {
        if(md5($Pass)==$r['Pass'])
        {
          if($Passmoi1!="")
          {
            if($Passmoi1==$Passmoi2)
            {
              $Passmoi1=md5($Passmoi1);
              mysql_query("UPDATE thanhvien SET Pass='$Passmoi1', Ten_tv='$Ten_tv', Dc_tv='$Dc_tv', Dt_tv='$Dt_tv'
                    Where Email = '$Email'");
              echo '<p style="color:green;"> Đã cập nhật password thành công! </p>';
              echo '<meta http-equiv="refresh" content="2;URL=?inc=doithongtin.php">';  
            }
            else
            {
              echo '<p style="color:red;"> Pass mới và Pass nhập lại không trùng nhau! </p>';
            }
          }
          mysql_query("UPDATE thanhvien SET Ten_tv='$Ten_tv', Dc_tv='$Dc_tv', Dt_tv='$Dt_tv'
                    Where Email = '$Email'");
          echo '<p style="color:green;"> Đã cập nhật thông tin thành công! </p>';
          echo '<meta http-equiv="refresh" content="2;URL=?inc=doithongtin.php">'; 
        }
        else
            {
              echo '<p style="color:red;"> Pass nhập sai, không cho phép đổi thông tin! </p>';
            }
      }
      else
      {
        echo '<p style="color:red;"> Nhập đầy đủ tên, điện thoại, địa chỉ! </p>';
      }
    }
  ?>
<div id="" width="80%" align="center">
  <form name="" id="frm-themsp" class="frm-themsp form-horizontal" action="" method="post">
    <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Email</label>
      <div class="col-xs-3">
        <input type="text" id="Email" name="Email" class="form-control" readonly="readonly" value="<?php echo $r['Email'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Password cũ</label>
      <div class="col-xs-3">
        <input type="password" id="Pass" name="Pass" class="form-control" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Password mới</label>
      <div class="col-xs-3">
        <input type="password" id="Passmoi1" name="Passmoi1" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Nhập lại Password mới</label>
      <div class="col-xs-3">
        <input type="password" id="Passmoi2" name="Passmoi2" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Tên thành viên</label>
      <div class="col-xs-3">
        <input type="text" id="Ten_tv" name="Ten_tv" class="form-control" value="<?php echo $r['Ten_tv'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Điện thoại</label>
      <div class="col-xs-3">
        <input type="text" id="Dt_tv" name="Dt_tv" class="form-control" value="<?php echo $r['Dt_tv'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNumber3" class="col-sm-3 control-label">Địa chỉ</label>
      <div class="col-xs-3">
        <input type="text" id="Dc_tv" name="Dc_tv" class="form-control" value="<?php echo $r['Dc_tv'];?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputTexr3" class="col-sm-3 control-label"></label>
      <div class="col-xs-3">
          <input type="submit" name="subsuatv" id="subsuatv" class="btn btn-default btn-lg" value="Cập nhật"/>
       </div>
    </div>
</form>
</div>
<?php } ?>
