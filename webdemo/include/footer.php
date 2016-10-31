			<div class="copy">
				<p>&copy2016 <a href="index.php">Yamaha Điền Khánh Minh</a> | Phát triển bởi <b>Nhóm 1 CP1596G01</b> | Đơn vị chủ quản <b>Cty TNHH Phân Phối Xe Điền Khánh Minh</b></p>
				<div id="goTop">
					<h1><span class="glyphicon glyphicon-circle-arrow-up" style="color: #36f"></span></h1>
				</div>
			</div>

			<style type="text/css">
				#goTop {
				bottom: 200px;
				cursor: pointer;
				display: none;
				height: 35px;
				position: fixed;
				right: 155px;
				width: 44px;
				z-index: 1000;
				}
			</style>
			
			<script type="text/javascript">
				$(function(){
				$(window).scroll(function () {
				if ($(this).scrollTop() > 100) $('#goTop').fadeIn();
				else $('#goTop').fadeOut();
				});
				$('#goTop').click(function () {
				$('body,html').animate({scrollTop: 0}, 'slow');
				});
				});
			</script>