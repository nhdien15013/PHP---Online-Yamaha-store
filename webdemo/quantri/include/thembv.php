<?php include("connection.php"); ?>
<?php @session_start();
  
  if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
<div class="page-header"><h3>Đăng bài viết</h3></div>
<?php
    if(isset($_POST['subdangbv']))
    {
    	$Email_tv=$_POST['Email_tv'];
    	$Ten_bv=$_POST['Ten_bv'];
      $Ma_dmbv=$_POST['Ma_dmbv'];
    	$Noidung_bv=htmlspecialchars($_POST['Noidung_bv']);
    	$Hinh_bv = $_POST['Hinh_bv'];
    	$typehinh = explode(".",$Hinh_bv)[count(explode(".",$Hinh_bv))-1]; //lấy các ký tự cuối từ dấu chấm cuối của địa chỉ hình
    	
    	 if($Ten_bv!="" &&  $Ma_dmbv!="" && $Noidung_bv!="")
        {
          if($typehinh=='jpg' || $typehinh=='jpeg' || $typehinh=='png' || $typehinh=='bmp' || $typehinh=='gif')
          {
            $sqkttensp="select * from baiviet where Ten_bv='$Ten_bv'";
            if(mysql_num_rows(mysql_query($sqkttensp))==0)
            {
              $sql1 = "insert into baiviet values(null,'$Ten_bv',$Ma_dmbv,'$Noidung_bv','$Hinh_bv','$Email_tv')";
              mysql_query($sql1);
              echo "<script>alert('Đã thêm bài viết thành công')</script>";
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

<div id="frm-themsp" width="80%" align="center">
  <form name="frm-themsp" id="frm-themsp" class="frm-themsp form-horizontal" action="" method="post">
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tác giả</label>
      <div class="col-xs-3">
        <input type="text" id="Email_tv" name="Email_tv" class="Email form-control" value="<?php echo $_SESSION['Email']; ?>" placeholder="Email" readonly=readonly>
      </div>
    </div>
     <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tên bài viết</label>
      <div class="col-xs-3">
        <input type="text" id="Ten_bv" name="Ten_bv" class="Ten_bv form-control" placeholder="Tên bài viết">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Danh mục bài viết</label>
      <div class="col-xs-3">
       
        <select class="Ma_dmbv form-control" name="Ma_dmbv" id="Ma_dmbv">
    		<option value="">Chọn danh mục bài viết</option>
          <?php
            $sql="Select * From danhmuc_bv";
            $result=mysql_query($sql);
      			while($row=mysql_fetch_array($result))
      			{
                echo '<option value="'.$row['Ma_dmbv'].'">'.$row['Ten_dmbv'].'</option>';
      			}
      			?>
        </select> 
      </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">Nội dung bài viết</label>
    <div class="col-sm-10">
      <textarea cols="50" rows="10" class="form-control" id="Noidung_bv" name="Noidung_bv"></textarea>
      <script type="text/javascript">CKEDITOR.replace('Noidung_bv'); </script>
    </div>
  </div>
  <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label">Hình ảnh</label>
      <div class="col-xs-3">
          <input type="text" id="Hinh_bv" name="Hinh_bv" class="Hinh_bv form-control" placeholder="Địa chỉ hình">
      </div>
      <div class="col-xs-1">
          <input type="button" onclick="BrowseServer()"  name="btnHinh_bv" id="btnHinh_bv" class="btn btn-default" value="Chọn file">
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label"></label>
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
                    document.getElementById('Hinh_bv').value = fileUrl;
                    document.getElementById('hienthiHinh').src = fileUrl;
                    document.getElementById('linkHinh').href= fileUrl;
                  }
              </script>
  <div class="form-group">
      <label for="inputTexr3" class="col-sm-2 control-label"></label>
      <div class="col-xs-3">
          <input type="submit" name="subdangbv" id="subdangbv" class="btn btn-default btn-lg" value="Đăng bài viết"/>
       </div>
    </div>
  </form>
</div>

