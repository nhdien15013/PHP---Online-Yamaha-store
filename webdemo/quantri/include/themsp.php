<?php include("connection.php"); ?>
<?php @session_start();
  
  if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
<div class="page-header"><h3>Đăng xe mới</h3></div>
<?php
if(isset($_POST['subdangsp']))
{

  $Ten_sp = $_POST['Ten_sp'];
  $Ma_loai = $_POST['Ma_loai'];
  $Gia_sp = $_POST['Gia_sp'];
  $Solg_sp = $_POST['Solg_sp'];
  $Mau_sp = $_POST['Mau_sp'];
  $Hinh_sp = $_POST['Hinh_sp'];
  $typehinh = explode(".",$Hinh_sp)[count(explode(".",$Hinh_sp))-1]; //lấy các ký tự cuối từ dấu chấm cuối của địa chỉ hình
  $Thongtin_sp = htmlspecialchars($_POST['Thongtin_sp']);
  //$Thongtin_sp = htmlspecialchars(stripslashes($_POST['Thongtin_sp'])); 
  
  //THÊM SẢN PHẨM

  if($Ten_sp!="" && $Ma_loai!="" && $Gia_sp!="" && $Solg_sp!="" && $Mau_sp!="" && $Thongtin_sp!="")  //nếu nhập đầy đủ thông tin
  {
    if($typehinh=='jpg' || $typehinh=='jpeg' || $typehinh=='png' || $typehinh=='bmp' || $typehinh=='gif') //hình chọn đúng định dạng
    {
      $sqkttensp="select * from sanpham where Ten_sp='$Ten_sp'";
      if(mysql_num_rows(mysql_query($sqkttensp))==0)                                                           //và không tồn tại tên sản phẩm trùng
      {
        $sql1 = "insert into sanpham values(null,'$Ten_sp',$Ma_loai,$Gia_sp,$Solg_sp,'$Mau_sp','$Hinh_sp','$Thongtin_sp')";
        mysql_query($sql1);                                                                                                 //thì thêm sản phẩm
        echo "<script>alert('Đã thêm sản phẩm thành công')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php?inc=themsp.php"/>';
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
    echo '<loi style="color:red;"> Chưa nhập đầy đủ thông tin! </loi>';
  }
}
?>

<div id="frm-themsp" width="80%" align="center">
  <form name="frm-themsp" id="frm-themsp" class="frm-themsp form-horizontal" action="" method="post">
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tên xe</label>
      <div class="col-xs-3">
        <input type="text" id="Ten_sp" name="Ten_sp" class="Ten_sp form-control" placeholder="Nhập tên xe">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Loại xe</label>
      <div class="col-xs-3">
          
                  <select name="Ma_loai" id="Ma_loai" class="Ma_loai form-control">
                  <option value="">Loại sản phẩm</option>
          <?php
                $sqMa_loai="select * from loai_sp";
                $rsMa_loai=mysql_query($sqMa_loai);
                while($rowMa_loai=mysql_fetch_array($rsMa_loai))
                {
                  echo '<option value="'.$rowMa_loai['Ma_loai'].'">'.$rowMa_loai['Ten_loai'].'</option>';
                }
          ?>
                  </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Màu xe</label>
      <div class="col-xs-3">
        <input type="text" id="Mau_sp" name="Mau_sp" class="Mau_sp form-control" placeholder="Nhập các màu xe hiện có">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNumber3" class="col-sm-2 control-label">Giá</label>
      <div class="col-xs-3">
        <input type="number" id="Gia_sp" name="Gia_sp" class="Gia_sp form-control" placeholder="Nhập giá xe">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNumber3" class="col-sm-2 control-label">Số lượng</label>
      <div class="col-xs-3">
        <input type="number" id="Solg_sp" name="Solg_sp" class="Solg_sp form-control" placeholder="Nhập số lượng">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Thông tin xe</label>
      <div class="col-sm-offset-2 col-sm-10">
        <textarea name="Thongtin_sp" id="Thongtin_sp" class="" rows="5" cols="50" required></textarea></td>
        <script type="text/javascript">CKEDITOR.replace('Thongtin_sp'); </script>
      </div>
    </div>
    <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label">Hình ảnh</label>
      <div class="col-xs-3">
          <input type="text" id="Hinh_sp" name="Hinh_sp" class="Hinh_sp form-control" placeholder="Địa chỉ hình">
      </div>
      <div class="col-xs-1">
          <input type="button" onclick="BrowseServer()"  name="btnHinh_sp" id="btnHinh_sp" class="btn btn-default" value="Chọn file">
      </div>
    </div>
    <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label"></label>
      <div class="col-xs-2">
          <a id="linkHinh" href="" target="_blank"><img id="hienthiHinh" class="img-thumbnail" height="140px" width="140px" style="border:0px;" src=""/></a>
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
          <input type="submit" name="subdangsp" id="subdangsp" class="btn btn-default btn-lg" value="Đăng sản phẩm"/>
       </div>
    </div>
</form>
</div>
