<?php include("connection.php"); ?>
<?php @session_start();
  
 if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
<div class="page-header"><h3>Thêm khuyến mãi</h3></div>

<div class="panel panel-primary">
  <div class="panel-heading">Thêm/Xóa khuyến mãi</div>
  <div class="panel-body">
     <script>
          function ktxoa()
          { 
            result= confirm("Bạn chắc chắn sẽ xóa?");
            return result;
          }
    </script>
     <?php
     // THÊM KHUYẾN MÃI
        if(isset($_POST['subthemkm']))
        {
          $Ten_km = $_POST['Ten_km'];
          if(!$Ten_km)
          {
            echo '<span style="color:red">Chưa nhập tên khuyến mãi!</span>';
          }
          else
          {
            if(mysql_num_rows(mysql_query("select * from khuyenmai where Ten_km = '$Ten_km'"))==0)
            {
              $sql = "insert into khuyenmai (Ten_km) values ('$Ten_km')";
              mysql_query($sql);
              echo "<span style='color:green'>Đã thêm khuyến mãi $Ten_km!</span>";
            }
            else
            {
              echo '<span style="color:red">Tên khuyến mãi đã tồn tại!</span>';
            }
          }
        }

        // XÓA KHUYẾN MÃI
        if (isset($_POST['subxoakm']) && $_POST['Ma_km']!="")
        {      
                $makm = $_POST['Ma_km'];
                mysql_query("DELETE FROM ct_khuyenmai WHERE Ma_km='$makm'");
                mysql_query("DELETE FROM khuyenmai WHERE Ma_km='$makm'");
        }
      
    ?>
    <form class="form-horizontal" role="form" method="post">
      <div class="form-group">
        <div class="col-xs-3">
          <input type="text" class="form-control" id="Ten_km" name="Ten_km" placeholder="Tên khuyến mãi">
        </div>
        <div class="col-xs-3">
            <?php
                    $sqMa_km="select * from khuyenmai";
                    $rsMa_km=mysql_query($sqMa_km);
              ?>
                      <select name="Ma_km" id="Ma_km" class="Ma_km form-control">
                      <option value="">Chọn KM để xóa</option>
              <?php
                    while($rowMa_km=mysql_fetch_array($rsMa_km))
                    {
                      echo '<option value="'.$rowMa_km['Ma_km'].'">#'.$rowMa_km['Ma_km'].' '.$rowMa_km['Ten_km'].'</option>';
                    }
              ?>
                      </select>
          </div>
      </div>
      <div class="form-group">
        <div class="col-xs-3">
          <button type="submit" id="subthemkm" name="subthemkm" class="btn btn-default">Thêm khuyến mãi</button>
        </div>
        <div class="col-xs-3">
          <button type="submit" id="subxoakm" name="subxoakm" onclick="ktxoa()" class="btn btn-default">Xóa khuyến mãi</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">Đặt khuyến mãi cho sản phẩm</div>
  <div class="panel-body">
    <div id="frm-datkm" width="80%" align="center">
      <form name="frm-datkm" id="frm-themsp" class="form-horizontal" action="" method="post">
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Chọn loại xe</label>
          <div class="col-xs-3">
              <select name="Ma_loai" id="Ma_loai" class="Ma_loai form-control" onchange="goto_url(this.value);">
                  <option value="?inc=themkm.php">Loại sản phẩm</option>
             <?php
                $sqMa_loai="select * from loai_sp";
                $rsMa_loai=mysql_query($sqMa_loai);
                while($rowMa_loai=mysql_fetch_array($rsMa_loai))
                {
                  if($rowMa_loai['Ma_loai']==$_GET['lxe'])
                  {
                    echo '<option value="?inc=themkm.php&lxe='.$rowMa_loai['Ma_loai'].'" selected>'.$rowMa_loai['Ten_loai'].'</option>';
                  }
                  else
                  {
                    echo '<option value="?inc=themkm.php&lxe='.$rowMa_loai['Ma_loai'].'">'.$rowMa_loai['Ten_loai'].'</option>';
                  }
                }
              ?>
              </select>
          </div>
            <script type="text/javascript">
              function goto_url(url)
              {
              if(url!="")
              self.location.href=url;
              }
            </script>
        </div>
        <?php 
          if(isset($_GET['lxe']))
          {
        ?>
        <div class="form-group">
          <label for="inputText3" class="col-sm-2 control-label">Chọn xe</label>
          <div class="col-sm-10">
            <div class="row">
            <?php
              $dk = " WHERE Ma_loai ='".$_GET['lxe']."'";
              $sqMa_sp="select * from sanpham".$dk;
              $reMa_sp= mysql_query($sqMa_sp);
              $xhang=0;
              while($rowMa_sp=mysql_fetch_array($reMa_sp))
              {
              ?>
                <div class="col-xs-3" style="text-align:left;">
                  <input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rowMa_sp['Ma_sp']; ?>">
                  <?php
                    $xhang+=1;
                    echo '#'.$rowMa_sp['Ma_sp'].' '.$rowMa_sp['Ten_sp']; 
                    if($xhang==4)
                    {
                        echo '</div><div class="row">'; $xhang=0;
                    }
                  ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="form-group">
          <label for="Ma_km" class="col-sm-2 control-label">Chọn khuyến mãi</label>
          <div class="col-xs-3">
            <?php
                    $sqMa_km="select * from khuyenmai";
                    $rsMa_km=mysql_query($sqMa_km);
              ?>
                      <select name="Ma_km" id="Ma_km" class="Ma_km form-control">
                      <option value="">Loại khuyến mãi</option>
              <?php
                    while($rowMa_km=mysql_fetch_array($rsMa_km))
                    {
                      echo '<option value="'.$rowMa_km['Ma_km'].'">'.$rowMa_km['Ten_km'].'</option>';
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
            <option value="%">Giảm phần trăm %</option>
            <option value="d">Giảm tiền mặt</option>
           </select> 
          </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Giá trị khuyến mãi</label>
          <div class="col-xs-3">
            <input type="number" class="form-control" id="Giatri_km" name="Giatri_km" placeholder="Nhập giá trị được giảm">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Ngày bắt đầu</label>
          <div class="col-xs-3">
            <input type="date" class="form-control" id="Ngay_bd" name="Ngay_bd" placeholder="Nhập ngày bắt đầu">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Ngày kết thúc</label>
          <div class="col-xs-3">
            <input type="date" class="form-control" id="Ngay_kt" name="Ngay_kt" placeholder="Nhập ngày kết thúc">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label"></label>
          <div class="col-xs-3">
            <button type="submit" id="subdatkm" name="subdatkm" class="btn btn-default">Đặt khuyến mãi</button>
          </div>
        </div>
        </form>
    <?php

      if(isset($_POST['subdatkm']))
      {

        $Ma_km = $_POST['Ma_km'];
        $Kieu_km = $_POST['Kieu_km'];
        $Giatri_km = $_POST['Giatri_km'];
        $Ngay_bd = $_POST['Ngay_bd'];
        $Ngay_kt = $_POST['Ngay_kt'];
        if(isset($_POST['checkbox']) and $Ma_km!="" and $Kieu_km!="" and $Giatri_km!="" and $Ngay_bd!="" and $Ngay_kt!="")
        {
          for ($i = 0; $i < count($_POST['checkbox']); $i++)
          {         
                $Ma_sp = $_POST['checkbox'][$i];
                $rowsp = mysql_fetch_array(mysql_query("SELECT * FROM sanpham WHERE Ma_sp=$Ma_sp"));
                $Ten_sp = $rowsp['Ten_sp'];
                $Gia_sp = $rowsp['Gia_sp'];
                if($Kieu_km=="%") //tính giá km
                {
                  $Gia_km=$Gia_sp-($Gia_sp*$Giatri_km/100);
                }
                else
                {
                  $Gia_km=$Gia_sp-$Giatri_km;
                }
                if(mysql_num_rows(mysql_query("SELECT * FROM ct_khuyenmai
                                              WHERE Ma_km=$Ma_km and Ma_sp=$Ma_sp and ('$Ngay_bd' between Ngay_bd and Ngay_kt)"))==0) //xét khuyến mãi có tồn tại không
                {
                  mysql_query("INSERT INTO ct_khuyenmai
                              VALUES (null, $Ma_km, $Ma_sp, '$Kieu_km', $Giatri_km, $Gia_km, '$Ngay_bd', '$Ngay_kt')");
                  echo "<p style='color:green'>Đã cập nhật khuyến mãi thành công cho $Ten_sp!</p>";
                }
                else
                {
                  echo "<p style='color:red'>Khuyến mãi $Ma_km cho $Ten_sp đã tồn tại!</p>";
                }
            
          }
        }
        else
        {
          echo "<p style='color:red'>Chưa nhập đầy đủ thông tin. Tất cả thông tin là bắt buột!</p>";
        }
      }
    ?>
    </div>
  </div>
</div>
