<header>	
<div id="heSocial_bg">
	<div class="socialMenu fadeIn" id="heSocial">
	<ul>
		<?php
			$sosyalmedya = $db->prepare("SELECT * FROM sosyalmedya WHERE durum=:d");
			$sosyalmedya -> execute([":d"=>1]);
			if($sosyalmedya->rowCount())
			{
				foreach($sosyalmedya as $item)
				{
					?>
					 <li title="<?php echo $item['bilgi_kutusu'];?>">
	   				 <a href="<?php echo $item['link'];?>" target="_blank">
       				 <img src="<?php echo $item['ikon'];?>">
	   				 </a>
       				 </li>
					<?php
				}
			}
		
		?>
	</ul>		
	</div>
</div>	

	
<div class="heLogo fadeIn"><img src="<?php echo $arow->site_logo; ?>" alt="Deniz Karaman Logo"></div>

<div id="menuAll">
<!--start CssMenu-->
<div id="navbar">
    <ul>
        <li><a href="<?php echo $arow->site_url?>">ANA SAYFA</a></li>
        <li>
            <span>KATEGORİLER <i class="arrow"></i></span>
            <ul class="dropdown">
				<?php
				$katMenu = $db->prepare("SELECT * FROM kategoriler");
				$katMenu->execute();
				if($katMenu->rowCount())
				{
					foreach($katMenu as $km)
					{
				
					echo '<li><a href="categories.php?kat_sef=' .$km["kat_sef"]. '">' .$km["kat_adi"]. '</a></li>';

					}
				}
				?>
                <li><a href="#">Film Dizi İnceleme</a></li>
            </ul>
        </li>	
		
        <li><a href="<?php echo $arow->site_url."/aboutme.php"?>">HAKKIMDA</a></li>
		
		<!--
        <li class="full-width">
            <span>Press <i class="arrow"></i></span>
            <div class="dropdown">
                <div class="clm">
                    <h3>Integer</h3>
                    <a href="#">Lacus iaculis</a>
                    <a href="#">Eu tortor</a>
                    <a href="#">Luctus varius</a>
                </div>
                <div class="clm">
                    <h3>Efficitur Viverra</h3>
                    <a href="#">Praesent</a>
                    <h3>At Eros</h3>
                    <a href="#">Pellentesque </a>
                    <a href="#">Dignissim pulvinar</a>
                </div>
                <div class="clm">
                    <a href="#"><img src="cssmenu/img2.jpg" style="width:280px;" /></a>
                </div>
            </div>
        </li>
		-->
		 
		<li>
			<a><i class="fas fa-search fa-lg"></i></a>
			<div class="dropdown navbar-floatleft fadeIn-short" id="search-drop">
				<form id="navbar-searchbox" action="search.php" method="get">
					<input name="q" id="navbar-search" type="text" placeholder="Arama Yapınız..">
					<button><i class="fas fa-paper-plane fa-lg"></i></button>
				</form>				
			</div>
		</li>
    </ul>
</div>
<!--end CssMenu-->
</div>
	
	
	
	
	
	
	
	
	
	
	
<!--<div class="heMenu fadeIn">
	<ul>
	    <li><a href="<?php echo $arow->site_url; ?>"> Ana Sayfa </a></li>
   	    <li><a href=""> Yazılarım </a>
			<ul class="dropdown fadeIn-short" id="drop-wrt">


			</ul>
		</li>
	    <li><a href=""> Eğitim Setleri </a>
			<ul class="dropdown fadeIn-short" id="drop-edu">
				<?php
				$egtMenu = $db->prepare("SELECT * FROM egitimler");
				$egtMenu->execute();
				if($egtMenu->rowCount())
				{
					foreach($egtMenu as $em)
					{
						echo '<li><a href="#"><i class="fas fa-chalkboard-teacher"></i>' .$em["egt_baslik"]. '</a></li>';
					}
				}
				?>

			</ul>
		</li>
	    <li><a href="<?php echo $arow->site_url.'/aboutme.php';?>"> Hakkımda </a></li>
	</ul>	
</div>
<hr>-->
</header>