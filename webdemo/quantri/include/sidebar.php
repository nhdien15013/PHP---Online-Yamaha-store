<?php include("connection.php"); ?>
<?php @session_start();
  
  if(!isset($_SESSION['Email'])&&$_SESSION['Chucvu']!='qt')
  {
    echo '<meta http-equiv="REFRESH" content ="0;URL=login.php"/>';
  }
?>
              <ul class="nav navbar-nav" id="sidenav01" style="font-size:120%;">
                <li class="active">
                  <a href="?inc=main.php" data-toggle="collapse" data-parent="#sidenav01" class="collapsed">
                  <h4>
                  Bảng điều khiển
                  </h4>
                  </a>
                </li>
                <li>
                  <a href="#" data-toggle="collapse" data-target="#sanpham" data-parent="#sidenav01" class="collapsed">
                  <span class="glyphicon glyphicon-th-large"></span> Quản lý sản phẩm <span class="caret pull-right"></span>
                  </a>
                  <div class="collapse" id="sanpham" style="height: 0px;">
                    <ul class="nav nav-list">
                      <li><a href="?inc=themsp.php">Thêm sản phẩm</a></li>
                      <li><a href="?inc=dssp.php">Danh sách sản phẩm</a></li>
                      <li class="divider"></li>
                      <li><a href="?inc=dsloaisp.php">Danh sách loại sản phẩm</a></li>
                    </ul>
                  </div>
                </li>
                <li><a href="?inc=dsdh.php"><span class="glyphicon glyphicon-shopping-cart"></span> Quản lý đơn hàng </a></li>
                <li>
                  <a href="#" data-toggle="collapse" data-target="#baiviet" data-parent="#sidenav01" class="collapsed">
                  <span class="glyphicon glyphicon-pencil"></span> Quản lý bài viết <span class="caret pull-right"></span>
                  </a>
                  <div class="collapse" id="baiviet" style="height: 0px;">
                    <ul class="nav nav-list">
                      <li><a href="?inc=thembv.php">Thêm bài viết</a></li>
                      <li><a href="?inc=dsbv.php">Danh sách bài viết</a></li>
                      <li class="divider"></li>
                      <li><a href="?inc=themdmbv.php">Danh mục bài viết</a></li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a href="#" data-toggle="collapse" data-target="#khuyenmai" data-parent="#sidenav01" class="collapsed">
                  <span class="glyphicon glyphicon-star"></span> Quản lý khuyến mãi <span class="caret pull-right"></span>
                  </a>
                  <div class="collapse" id="khuyenmai" style="height: 0px;">
                    <ul class="nav nav-list">
                      <li><a href="?inc=themkm.php">Thêm khuyến mãi</a></li>
                      <li><a href="?inc=dskmsp.php">DS khuyến mãi sản phẩm</a></li>
                    </ul>
                  </div>
                </li>
                <li><a href="javascript: void(0);" onclick=" javascript:OpenPopup('js/ckfinder/ckfinder.html','WindowName','900px','450px','scrollbars=1');"><span class="glyphicon glyphicon-picture"></span> Quản lý đa phương tiện </a></li>
                <script type="text/javascript">
                  function OpenPopup(Url,WindowName,width,height,extras,scrollbars) {
                  var wide = width;
                  var high = height;
                  var additional= extras;
                  var top = (screen.height-high)/2;
                  var leftside = (screen.width-wide)/2; newWindow=window.open(''+ Url + 
                  '',''+ WindowName + '','width=' + wide + ',height=' + high + ',top=' + 
                  top + ',left=' + leftside + ',features=' + additional + '' + 
                  ',scrollbars=1');
                  newWindow.focus();
                  }
                  //]]>
                </script>
                <li><a href="?inc=dsgy.php"><span class="glyphicon glyphicon-comment"></span> Quản lý góp ý </a></li>
                <li><a href="?inc=dstv.php"><span class="glyphicon glyphicon-user"></span> Quản lý người dùng </a></li>
                <!--<li>
                  <a href="#" data-toggle="collapse" data-target="#nguoidung" data-parent="#sidenav01" class="collapsed">
                  <span class="glyphicon glyphicon-user"></span> Quản lý người dùng <span class="caret pull-right"></span>
                  </a>
                  <div class="collapse" id="nguoidung" style="height: 0px;">
                    <ul class="nav nav-list">
                      <li><a href="#">Danh sách thành viên</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Danh sách quản trị</a></li>
                    </ul>
                  </div>
                </li>
                <li><a href="?inc=dsgy.php"><span class="glyphicon glyphicon-envelope"></span> Quản lý góp ý </a></li>
                <li class="active">
                  <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
                  <span class="glyphicon glyphicon-inbox"></span> Submenu 2 <span class="caret pull-right"></span>
                  </a>
                  <div class="collapse" id="toggleDemo2" style="height: 0px;">
                    <ul class="nav nav-list">
                      <li><a href="#">Submenu2.1</a></li>
                      <li><a href="#">Submenu2.2</a></li>
                      <li><a href="#">Submenu2.3</a></li>
                    </ul>
                  </div>
                </li>
                <li><a href="#"><span class="glyphicon glyphicon-lock"></span> Normalmenu</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-calendar"></span> WithBadges <span class="badge pull-right">42</span></a></li>
                <li><a href=""><span class="glyphicon glyphicon-cog"></span> PreferencesMenu</a></li>-->
              </ul>