<?php include("connection.php"); ?>
<?php @session_start();
  
  if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
<div class="page-header"><h3>Sửa thông tin thành viên</h3></div>

<?php
if(isset($_GET['ma']))
{
  $Email = $_GET['ma'];
  $sq = "select * from thanhvien where Email='$Email'";
  $rs = mysql_query($sq);
  $r = mysql_fetch_array($rs);
?>
<?php
    if(isset($_POST['subsuatv']))
    {
      if($_POST['Pass']!="")
      {
        $Pass = md5($_POST['Pass']);
      }else{
        $Pass = $r['Pass'];
      }
      $Ten_tv = $_POST['Ten_tv'];
      $Dt_tv = $_POST['Dt_tv'];
      $Dc_tv = $_POST['Dc_tv'];
      $Chucvu_tv = $_POST['Chucvu_tv'];
      if($Ten_tv!="" && $Dt_tv!="" && $Dc_tv!="" && $Dt_tv!="" && $Chucvu_tv!="")
      {
        mysql_query("UPDATE thanhvien SET Pass='$Pass', Ten_tv='$Ten_tv', Dc_tv='$Dc_tv', Dt_tv='$Dt_tv', Chucvu_tv='$Chucvu_tv'
          Where Email = '$Email'");
        echo '<p style="color:green;"> Đã cập nhật thành công! </p>';
        echo '<meta http-equiv="refresh" content="2;URL=?inc=suatv.php&ma='.$Email.'">';  
      }
      else
      {
        echo '<p style="color:red;"> Nhập đầy đủ tên, điện thoại, địa chỉ, chức vụ thành viên! </p>';
      }
    }
  ?>
<div id="" width="80%" align="center">
  <form name="" id="frm-themsp" class="frm-themsp form-horizontal" action="" method="post">
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Email</label>
      <div class="col-xs-3">
        <input type="text" id="Email" name="Email" class="form-control" readonly="readonly" value="<?php echo $r['Email'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Password</label>
      <div class="col-xs-3">
        <input type="password" id="Pass" name="Pass" class="form-control" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tên thành viên</label>
      <div class="col-xs-3">
        <input type="text" id="Ten_tv" name="Ten_tv" class="form-control" value="<?php echo $r['Ten_tv'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Điện thoại</label>
      <div class="col-xs-3">
        <input type="text" id="Dt_tv" name="Dt_tv" class="form-control" value="<?php echo $r['Dt_tv'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNumber3" class="col-sm-2 control-label">Địa chỉ</label>
      <div class="col-xs-3">
        <input type="text" id="Dc_tv" name="Dc_tv" class="form-control" value="<?php echo $r['Dc_tv'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNumber3" class="col-sm-2 control-label">Chức vụ</label>
      <div class="col-xs-3">
        <select name="Chucvu_tv" id="Chucvu_tv" class="form-control">
                <option value="">Chức vụ thành viên</option>
                <option value="tv" <?php if($r['Chucvu_tv']=='tv'){echo 'selected';} ?> >Thành viên</option>
                <option value="qt" <?php if($r['Chucvu_tv']=='qt'){echo 'selected';} ?> >Quản trị</option>
              </select>
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label"></label>
      <div class="col-xs-3">
          <input type="submit" name="subsuatv" id="subsuatv" class="btn btn-default btn-lg" value="Cập nhật"/>
       </div>
    </div>
</form>
</div>
<?php } ?>
