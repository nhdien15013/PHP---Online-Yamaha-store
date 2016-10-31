<?php include("connection.php"); ?>
<?php @session_start();
  
  if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
<div class="page-header"><h3>Sửa bài viết</h3></div>
<?php
    if(isset($_POST['subsuabv']))
    {
    	$Email_tv=$_POST['Email_tv'];
      $Ma_bv = $_POST['Ma_bv'];
    	$Ten_bv = $_POST['Ten_bv'];
      $Ma_dmbv = $_POST['Ma_dmbv'];
    	$Noidung_bv = htmlspecialchars($_POST['Noidung_bv']);
    	$Hinh_bv = $_POST['Hinh_bv'];
    	$typehinh = explode(".",$Hinh_bv)[count(explode(".",$Hinh_bv))-1]; //lấy các ký tự cuối từ dấu chấm cuối của địa chỉ hình
    	
    	 if($Ten_bv && $Ma_dmbv!="" && $Noidung_bv!="")
        {
          if($typehinh=='jpg' || $typehinh=='jpeg' || $typehinh=='png' || $typehinh=='bmp' || $typehinh=='gif')
          {
            $sqkttensp="select * from baiviet where Ma_bv!=$Ma_bv and Ten_bv='$Ten_bv'";
            if(mysql_num_rows(mysql_query($sqkttensp))==0)
            {
              $sql1 = "UPDATE baiviet SET Email_tv = '$Email_tv', Ten_bv = '$Ten_bv', Ma_dmbv = $Ma_dmbv, Noidung_bv = '$Noidung_bv', Hinh_bv = '$Hinh_bv'
                        where Ma_bv = $Ma_bv";
              mysql_query($sql1);
              echo "<script>alert('Đã cập nhật bài viết thành công')</script>";
              echo '<meta http-equiv="refresh" content="0;URL=?inc=dsbv.php"/>';
            }
            else
            {
              echo '<loi style="color:red;"> Bài viết trùng tên! </loi>';
            }
          }
          else
          {
            echo '<loi style="color:red;"> Hình không đúng định dạng! </loi>';
          }
        }
        else
        {
          echo '<loi style="color:red;"> Chưa nhập đầy đủ thông tin! </loi>';
        }
    }

?>

<?php
  if(isset($_GET['ma']))
  {
    $mabv = $_GET['ma'];
    $sq = "select * from baiviet where Ma_bv='$mabv'";
    $rs = mysql_query($sq);
    $r = mysql_fetch_array($rs);
?>
<div id="frm-themsp" width="80%" align="center">
  <form name="frm-suabv" id="frm-suabv" class="frm-suabv form-horizontal" action="" method="post">
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tác giả</label>
      <div class="col-xs-3">
        <input type="text" id="Email_tv" name="Email_tv" class="Email form-control" placeholder="Email" value="<?php echo $_SESSION['Email']; ?>" readonly=readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Mã bài viết</label>
      <div class="col-xs-3">
        <input type="text" id="Ma_bv" name="Ma_bv" class="Email form-control" placeholder="Email" value="<?php echo $r['Ma_bv']; ?>" readonly=readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tên bài viết</label>
      <div class="col-xs-3">
        <input type="text" id="Ten_bv" name="Ten_bv" class="Ten_bv form-control" placeholder="Tên bài viết" value="<?php echo $r['Ten_bv']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Danh mục bài viết</label>
      <div class="col-xs-3">
      
        <select class="Ma_dmbv form-control" name="Ma_dmbv" id="Ma_dmbv">
    		<option value="">Chọn danh mục bài viết</option>
           <?php
              $sqMa_dmbv="Select * From danhmuc_bv";
              $rsMa_dmbv=mysql_query($sqMa_dmbv);
              while($rowMa_dmbv=mysql_fetch_array($rsMa_dmbv))
                {
                  if($rowMa_dmbv['Ma_dmbv']==$r['Ma_dmbv'])
                  {
                    echo '<option value="'.$rowMa_dmbv['Ma_dmbv'].'" selected>'.$rowMa_dmbv['Ten_dmbv'].'</option>';
                  }
                  else
                  {
                    echo '<option value="'.$rowMa_dmbv['Ma_dmbv'].'">'.$rowMa_dmbv['Ten_dmbv'].'</option>';
                  }
                }
          ?>
       </select>
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">Nội dung bài viết</label>
    <div class="col-sm-10">
      <textarea cols="50" rows="10" class="form-control" id="Noidung_bv" name="Noidung_bv"><?php echo $r['Noidung_bv']; ?></textarea>
      <script type="text/javascript">CKEDITOR.replace('Noidung_bv'); </script>
    </div>
  </div>
  <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label">Hình ảnh</label>
      <div class="col-xs-3">
          <input type="text" id="Hinh_bv" name="Hinh_bv" class="Hinh_bv form-control" placeholder="Địa chỉ hình" value="<?php echo $r['Hinh_bv']; ?>">
      </div>
      <div class="col-xs-1">
          <input type="button" onclick="BrowseServer()"  name="btnHinh_bv" id="btnHinh_bv" class="btn btn-default" value="Chọn file">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label"></label>
      <div class="col-xs-2">
          <a id="linkHinh" href="<?php echo $r['Hinh_bv']; ?>" target="_blank"><img id="hienthiHinh" class="img-thumbnail" height="140px" width="140px" style="border:0px;" src="<?php echo $r['Hinh_bv']; ?>"/></a>
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
                    document.getElementById('Hinh_bv').value = fileUrl;
                    document.getElementById('hienthiHinh').src = fileUrl;
                    document.getElementById('linkHinh').href= fileUrl;
                  }
              </script>
  <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label"></label>
      <div class="col-xs-3">
          <input type="submit" name="subsuabv" id="subsuabv" class="btn btn-default btn-lg" value="Sửa bài viết"/>
       </div>
    </div>
  </form>
</div>
<?php } ?>