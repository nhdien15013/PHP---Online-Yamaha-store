<?php include("connection.php"); ?>
<?php @session_start();
  
  if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
  <div class="page-header"><h3>Sửa khuyến mãi</h3></div>



  <div id="frm-suakm" width="80%" align="center">
   <?php
    if(isset($_GET['ma']))
  {
      $mactkm = $_GET['ma'];
      $sq = "select * from ct_khuyenmai where Ma_ctkm ='$mactkm'";
      $rs = mysql_query($sq);
      $r = mysql_fetch_array($rs);
        $masp = $r['Ma_sp'];
        $makm = $r['Ma_km'];
  ?>
  <form name="frm-datkm" id="frm-themsp" class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="inputText3" class="col-sm-2 control-label">Mã chi tiết KM</label>
    <div class="col-xs-3">
      <input type="text" class="form-control" id="Ma_ctkm" name="Ma_ctkm" value="<?php echo $mactkm ?>" readonly=readonly />
    </div>
  </div>
  <div class="form-group">
    <label for="Ma_sp" class="col-sm-2 control-label">Sản phẩm</label>
    <div class="col-xs-3">
      <?php
          $sqMa_sp="select * from sanpham where Ma_sp = '$masp'";
          $rsMa_sp=mysql_query($sqMa_sp);
          while($rowMa_sp=mysql_fetch_array($rsMa_sp))
          {
       ?>
        <input type="hidden" id="Ma_sp" name="Ma_sp" value="<?php echo $rowMa_sp['Ma_sp']; ?>"/>
        <input type="text" class="form-control"  value="<?php echo '#'.$rowMa_sp['Ma_sp'].' '.$rowMa_sp['Ten_sp']; ?>" readonly=readonly />
      <?php } ?>
    </div>
  </div>
  <div class="form-group">
    <label for="Ma_km" class="col-sm-2 control-label">Chọn khuyến mãi</label>
    <div class="col-xs-3">
      <?php
              $sqMa_km="select * from khuyenmai";
              $rsMa_km=mysql_query($sqMa_km);
        ?>
                <select name="Ma_km" id="Ma_km" class="Ma_km form-control">
                <option value="0">Loại khuyến mãi</option>
        <?php
              while($rowMa_km=mysql_fetch_array($rsMa_km))
              {
                if($rowMa_km['Ma_km']==$makm)
                {
                  echo '<option value="'.$rowMa_km['Ma_km'].'" selected>'.$rowMa_km['Ten_km'].'</option>';
                }
                else
                {
                  echo '<option value="'.$rowMa_km['Ma_km'].'">'.$rowMa_km['Ten_km'].'</option>';
                }
                
              }
        ?>
                </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Kiểu khuyễn mãi</label>
    <div class="col-xs-3">
     <select class="form-control" id="Kieu_km" name="Kieu_km">
      <option value="">Chọn kiểu khuyến mãi</option>
      <option value="%" <?php if($r['Kieu_km']=="%") echo 'selected' ?> >Giảm phần trăm %</option>
      <option value="d" <?php if($r['Kieu_km']=="d") echo 'selected' ?> >Giảm tiền mặt</option>
     </select> 
    </div>
  </div>
  <div class="form-group">
      <label for="inputPassword3" class="col-sm-2 control-label">Giá trị khuyến mãi</label>
    <div class="col-xs-3">
      <input type="text" class="form-control" id="Giatri_km" name="Giatri_km" value="<?php echo $r['Giatri_km'] ?>" placeholder="Nhập giá trị được giảm">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Ngày bắt đầu</label>
    <div class="col-xs-3">
      <input type="date" class="form-control" id="Ngay_bd" name="Ngay_bd" value="<?php echo $r['Ngay_bd'] ?>" placeholder="Nhập ngày bắt đầu">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Ngày kết thúc</label>
    <div class="col-xs-3">
      <input type="date" class="form-control" id="Ngay_kt" name="Ngay_kt" value="<?php echo $r['Ngay_kt'] ?>" placeholder="Nhập ngày kết thúc">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"></label>
    <div class="col-xs-3">
      <button type="submit" id="subsuakm" name="subsuakm" class="btn btn-default">Sửa khuyến mãi</button>
    </div>
  </div>
  </form>
  <?php } ?>
  <?php

    if(isset($_POST['subsuakm']))
    {
      $Ma_ctkm = $_POST['Ma_ctkm'];
      $Ma_km = $_POST['Ma_km'];
      $Kieu_km = $_POST['Kieu_km'];
      $Giatri_km = $_POST['Giatri_km'];
      $Ngay_bd = $_POST['Ngay_bd'];
      $Ngay_kt = $_POST['Ngay_kt'];
      $Ma_sp = $_POST['Ma_sp'];
      $rowsp = mysql_fetch_array(mysql_query("SELECT * FROM sanpham WHERE Ma_sp=$Ma_sp"));
      $Ten_sp = $rowsp['Ten_sp'];
      $Gia_sp = $rowsp['Gia_sp'];
  
      if($Kieu_km=="%")                                                                       //tính giá km
      {
        $Gia_km=$Gia_sp-($Gia_sp*$Giatri_km/100);
      }
      else
      {
        $Gia_km=$Gia_sp-$Giatri_km;
      }
      if($Ma_km!="" and $Kieu_km!="" and $Giatri_km!="" and $Ngay_bd!="" and $Ngay_kt!="")    //xét thông tin nhập có đầy đủ không
      {
        if(mysql_num_rows(mysql_query("SELECT * FROM ct_khuyenmai
                                      WHERE Ma_ctkm!=$Ma_ctkm and Ma_km=$Ma_km and Ma_sp=$Ma_sp and ('$Ngay_bd' between Ngay_bd and Ngay_kt)"))==0) //xét khuyến mãi có trùng không
        {
          mysql_query("UPDATE ct_khuyenmai
                      SET Ma_km = $Ma_km, Kieu_km = '$Kieu_km', Giatri_km = $Giatri_km, Gia_km = $Gia_km, Ngay_bd = '$Ngay_bd', Ngay_kt = '$Ngay_kt'
                      WHERE Ma_ctkm = $Ma_ctkm");
          echo "<p style='color:green'>Đã cập nhật khuyến mãi thành công cho $Ten_sp!</p>";
        }
        else
        {
          echo "<p style='color:red'>Khuyến mãi $Ma_km cho $Ten_sp đã trùng!</p>";
        }
      }
      else
      {
        echo "<p style='color:red'>Chưa nhập đầy đủ thông tin. Tất cả thông tin là bắt buột!</p>";
      }
    }
  ?>
  </div>
