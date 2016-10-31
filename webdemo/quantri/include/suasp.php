<?php include("connection.php"); ?>
<?php @session_start();
  
  if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
<div class="page-header"><h3>Sửa thông tin xe</h3></div>
<?php

if(isset($_POST['subsuasp']))
{
  $Ma_sp = $_POST['Ma_sp'];
  $Ten_sp = $_POST['Ten_sp'];
  $Ma_loai = $_POST['Ma_loai'];
  $Gia_sp = $_POST['Gia_sp'];
  $Solg_sp = $_POST['Solg_sp'];
  $Mau_sp = $_POST['Mau_sp'];
  $Hinh_sp = $_POST['Hinh_sp'];
  $typehinh = explode(".",$Hinh_sp)[count(explode(".",$Hinh_sp))-1]; //lấy các ký tự cuối từ dấu chấm cuối của địa chỉ hình
  $Thongtin_sp = htmlspecialchars($_POST['Thongtin_sp']);
  //$Thongtin_sp = htmlspecialchars(stripslashes($_POST['Thongtin_sp'])); 
  
  //CẬP NHẬT SẢN PHẨM

  if($Ma_loai!="") //nếu có chọn mã loại
  {
    if($typehinh=='jpg' || $typehinh=='jpeg' || $typehinh=='png' || $typehinh=='bmp' || $typehinh=='gif') //hình chọn đúng định dạng
    {
      $sqkttensp="SELECT * FROM sanpham WHERE Ma_sp!='$Ma_sp' and Ten_sp='$Ten_sp'";
      if(mysql_num_rows(mysql_query($sqkttensp))==0)                                  //và không tồn tại Mã sp khác trùng tên
      {
        $sql1 = "UPDATE sanpham SET Ten_sp='$Ten_sp',
                                    Ma_loai=$Ma_loai,
                                    Gia_sp=$Gia_sp,
                                    Solg_sp=$Solg_sp,
                                    Mau_sp='$Mau_sp',
                                    Hinh_sp='$Hinh_sp',
                                    Thongtin_sp='$Thongtin_sp'
                  WHERE Ma_sp = '$Ma_sp'";                                          //thì cập nhật sản phẩm
        mysql_query($sql1);
        echo "<script>alert('Đã cập nhật sản phẩm thành công')</script>";
      }
      else
      {
        echo '<loi style="color:red;"> Sản phẩm trùng tên! </loi>';
      }
    }
    else
    {
      echo '<loi style="color:red;"> Hình xe không đúng định dạng! </loi>';
    }
  }
  else
  {
    echo '<loi style="color:red;"> Chưa chọn loại xe! </loi>';
  }

}
?>
<?php
if(isset($_GET['ma']))
{
  $masp = $_GET['ma'];
  $sq = "select * from sanpham where Ma_sp='$masp'";
  $rs = mysql_query($sq);
  $r = mysql_fetch_array($rs);
?>

<div id="frm-themsp" width="80%" align="center">
  <form name="frm-themsp" id="frm-themsp" class="frm-themsp form-horizontal" action="" method="post">
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Mã xe</label>
      <div class="col-xs-3">
        <input type="text" id="Ma_sp" name="Ma_sp" class="Ma_sp form-control" readonly="readonly"value="<?php echo $r['Ma_sp'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tên xe</label>
      <div class="col-xs-3">
        <input type="text" id="Ten_sp" name="Ten_sp" class="Ten_sp form-control" placeholder="Nhập tên xe" value="<?php echo $r['Ten_sp'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Loại xe</label>
      <div class="col-xs-3">
          <?php
                $sqMa_loai="select * from loai_sp";
                $rsMa_loai=mysql_query($sqMa_loai);
          ?>
                  <select name="Ma_loai" id="Ma_loai" class="Ma_loai form-control">
                  <option value="">Loại sản phẩm</option>
          <?php
                while($rowMa_loai=mysql_fetch_array($rsMa_loai))
                {
                  if($rowMa_loai['Ma_loai']==$r['Ma_loai'])
                  {
                    echo '<option value="'.$rowMa_loai['Ma_loai'].'" selected>'.$rowMa_loai['Ten_loai'].'</option>';
                  }
                  else
                  {
                    echo '<option value="'.$rowMa_loai['Ma_loai'].'">'.$rowMa_loai['Ten_loai'].'</option>';
                  }
                }
          ?>
                  </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Màu xe</label>
      <div class="col-xs-3">
        <input type="text" id="Mau_sp" name="Mau_sp" class="Mau_sp form-control" placeholder="Nhập các màu xe hiện có" value="<?php echo $r['Mau_sp'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNumber3" class="col-sm-2 control-label">Giá</label>
      <div class="col-xs-3">
        <input type="number" id="Gia_sp" name="Gia_sp" class="Gia_sp form-control" placeholder="Nhập giá xe" value="<?php echo $r['Gia_sp'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNumber3" class="col-sm-2 control-label">Số lượng</label>
      <div class="col-xs-3">
        <input type="number" id="Solg_sp" name="Solg_sp" class="Solg_sp form-control" placeholder="Nhập số lượng" value="<?php echo $r['Solg_sp'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Thông tin xe</label>
      <div class="col-sm-offset-2 col-sm-10">
        <textarea name="Thongtin_sp" id="Thongtin_sp" class="form-control"><?php echo $r['Thongtin_sp'];?></textarea></td>
        <script type="text/javascript">CKEDITOR.replace('Thongtin_sp'); </script>
      </div>
    </div>
    <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label">Hình ảnh</label>
      <div class="col-xs-3">
          <input type="text" id="Hinh_sp" name="Hinh_sp" class="Hinh_sp form-control" placeholder="Địa chỉ hình" value="<?php echo $r['Hinh_sp'];?>">
      </div>
      <div class="col-xs-1">
          <input type="button" onclick="BrowseServer()"  name="btnHinh_sp" id="btnHinh_sp" class="btn btn-default" value="Chọn file">
      </div>
    </div>
    <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label"></label>
      <div class="col-xs-2">
          <a id="linkHinh" href="" target="_blank"><img id="hienthiHinh" class="img-thumbnail" height="140px" width="140px" style="border:0px;" src="<?php echo $r['Hinh_sp'];?>"/></a>
      </div>
    </div>
    
              <script type="text/javascript">
                  function BrowseServer()
                  {
                    var finder = new CKFinder();
                    //finder.basePath = '../';
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
                  }
                  function SetFileField(fileUrl)
                  {
                    document.getElementById('Hinh_sp').value = fileUrl;
                    document.getElementById('hienthiHinh').src = fileUrl;
                    document.getElementById('linkHinh').href= fileUrl;
                  }
              </script>
    <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label"></label>
      <div class="col-xs-3">
          <input type="submit" name="subsuasp" id="subsuasp" class="btn btn-default btn-lg" value="Sửa sản phẩm"/>
       </div>
    </div>
</form>
</div>
<?php } ?>
