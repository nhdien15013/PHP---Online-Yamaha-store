
<script type="text/javascript">
	$(document).ready(function()
	{
        
        setInterval(function(){next()},5000);
        var a = 2;
        function next(varb = 5)
        {
            if(varb != 5)
            {
                a = varb;
            }else{
                a = a;
            }
             $("#ig_1").hide(); 
            $("#ig_2").hide(); 
            $("#ig_3").hide(); 
            $("#ig_4").hide(); 
            $("#ig_"+a).slideDown(); 
            a++;
            if(a == 5)
            {
                a = 1;
            }
        }
        
    }
);
</script>

							<ul class="slides">
						    	<li id="ig_1"><a href="?inc=xe.php&xe=64"><canvas ></canvas><img src="media/themes/banner1.jpg" alt="YZF-R3" ></a></li>
						        <li id="ig_2"><a href="?inc=bai.php&bai=11"><canvas></canvas><img src="media/themes/banner2.jpg" alt="FZ-150i" ></a></li>
						        <li id="ig_3"><a href="?inc=xe.php&xe=4"><canvas></canvas><img src="media/themes/banner3.jpg" alt="Chạy thử xe" ></a></li>
						        <li id="ig_4"><a href="?inc=xe.php&xe=63"><canvas></canvas><img src="media/themes/banner4.jpg" alt="Exciter Movistar" ></a></li>
						    </ul>
						    <span class="arrow previous"></span>
						    <span class="arrow next"></span>
