<?php include("connection.php"); ?>
<div class="panel panel-success">
  <div class="panel-heading">
    	<h3 class="panel-title">Thông tin đặt hàng</h3>
  	</div>
    <?php
      if(!isset($_SESSION['Email']))
      {
          echo "<script language='Javascript'>alert('Chưa đăng nhập!')</script>";
          echo '<meta http-equiv="refresh" content="0;URL=?inc=sanpham.php&dn=dnhap">';
      }
    ?>
    <?php
        if(isset($_POST['subdathang']))
        {
          if($_POST['Ten_dh']=="" || $_POST['Dt_dh']=="" || $_POST['Dc_dh']=="" || $_POST['Ngay_dh']=="")
          {
            echo "<p style='color:red'>Chưa điền đủ thông tin, tất cả thông tin là bắt buộc!</p>";
          }
          else
          {
            //phan nay luu don dat hang vao CSDl(bang dondathang)
              //lấy mã đặt hàng tự động tăng
              $sqmadh = "SHOW TABLE STATUS LIKE 'dathang'";
              $rsmadh = mysql_query($sqmadh);
              $rowmadh = mysql_fetch_array($rsmadh);
              $Ma_dh = $rowmadh['Auto_increment'];
  
              $_SESSION['Ma_dh']=$Ma_dh;
              $Email_dh=$_POST['Email_dh'];
              $Ten_dh=$_POST['Ten_dh'];
              $Dt_dh=$_POST['Dt_dh'];
              $Dc_dh=$_POST['Dc_dh'];
              $Ngay_dh=date("Y-m-d");
              $Ngay_gh=date("Y-m-d", strtotime("+1 week"));
              $Tongtien_dh=$_SESSION['tongtien'];
              $Tinhtrang_dh="xuly";
              $sqdh="INSERT into dathang values(null,'$Email_dh','$Ngay_dh','$Ngay_gh','$Dc_dh','$Dt_dh','$Ten_dh','$Tongtien_dh','$Tinhtrang_dh')";
              mysql_query($sqdh);
              //phan nay luu chi tiet dat hang vao CSDL(bang chi tiet dat hang)

              $sqsp = "SELECT * from sanpham";
              $rssp = mysql_query($sqsp);
              while ($rowsp = mysql_fetch_array($rssp))
              {
                $Ma_sp=$rowsp['Ma_sp'];
                if(isset($_SESSION["'".$Ma_sp."'"]))
                {
                  $Solg_dh=$_SESSION["'".$Ma_sp."'"];
                  $Gia_sp = $rowsp['Gia_sp'];
                  $date=date("Y-m-d");
                  $rectkm = mysql_query("SELECT * FROM ct_khuyenmai WHERE Ma_sp = '$Ma_sp' and '$date' between Ngay_bd and Ngay_kt");
                  $rowctkm = mysql_fetch_array($rectkm);
                    if(mysql_num_rows($rectkm)>0)
                    {
                      $Gia_dh = $rowctkm['Gia_km']; //có thỳ gán giá sp = giá km
                    }
                    else
                    {
                      $Gia_dh = $rowsp['Gia_sp'];
                    }
                  $sqctdh="INSERT into ct_dathang values(null,$Ma_dh,$Ma_sp,$Solg_dh,$Gia_dh)";
                  mysql_query($sqctdh);
                  $squpsp="UPDATE sanpham set Solg_sp=Solg_sp-".$Solg_dh." where Ma_sp='$Ma_sp'";
                  mysql_query($squpsp);
                  $_SESSION["'".$Ma_sp."'"]=$_SESSION["'".$Ma_sp."'"]-$_SESSION["'".$Ma_sp."'"];
                  if($_SESSION["'".$Ma_sp."'"]==0) {unset($_SESSION["'".$Ma_sp."'"]); unset($_SESSION['stt']);}
                }
              }
                echo "<script language='Javascript'>alert('Đặt hàng thành công, Cảm ơn quýkhách')</script>";
                echo '<meta http-equiv="refresh" content="0;URL=?inc=giohang3.php">';
                //session_unregister($Ma_sp);
          }
        }
    ?>
  	<div class="panel-body">
    	<form class="form-horizontal" role="form" method="post">
    		<?php
    			$email = $_SESSION['Email'];
    			$sqkh = "SELECT * From thanhvien where Email = '$email'";
    			$rskh = mysql_query($sqkh);
    			$rowkh = mysql_fetch_array($rskh);
    		?>
			<div class="form-group">
			    <label for="" class="col-sm-3 control-label">Email:</label>
			    <div class="col-xs-3">
			      <input type="email" class="form-control" id="Email_dh" name="Email_dh" value="<?php echo $rowkh['Email']; ?>" readonly=readonly>
			    </div>
  			</div>
  			<div class="form-group">
			    <label for="" class="col-sm-3 control-label">Tên khách hàng:</label>
			    <div class="col-xs-3">
			      <input type="text" class="form-control" id="Ten_dh" name="Ten_dh" value="<?php echo $rowkh['Ten_tv']; ?>">
			    </div>
  			</div>
        <div class="form-group">
          <label for="" class="col-sm-3 control-label">Số điện thoại:</label>
          <div class="col-xs-3">
            <input type="text" class="form-control" id="Dt_dh" name="Dt_dh" value="<?php echo $rowkh['Dt_tv']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="" class="col-sm-3 control-label">Địa chỉ:</label>
          <div class="col-xs-5">
            <textarea class="form-control" id="Dc_dh" name="Dc_dh"><?php echo $rowkh['Dc_tv']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="" class="col-sm-3 control-label">Ngày đặt hàng:</label>
          <div class="col-xs-3">
            <input type="date" class="form-control" id="Ngay_dh" name="Ngay_dh" value="<?php $date=date("Y-m-d");echo $date; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="" class="col-sm-3 control-label"></label>
          <div class="col-xs-6">
              <input type="submit" class="btn btn-default" id="subdathang" name="subdathang" value="Đặt hàng">
              <input type="submit" class="btn btn-default" id="subhuy" name="subhuy" value="Hủy bỏ">
          </div>
        </div>
        
  		</form>
  	</div>
</div>