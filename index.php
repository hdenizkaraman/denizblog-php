<?php require_once "includes/head.php";?>
<?php require_once "includes/menu.php";?>


<div class="hpSlider fadeIn">
    <div class="hpSlider-all">
        <div class="hpSlider-sing">
			<div class="hpSlider-img" id="hpSlider-img1"><img src="https://www.bilimseldunya.com/wp-content/uploads/2018/09/Uzay-Kaç-Derece.jpg"></div>
            <div class="hpSlider-img" id="hpSlider-img2"><img src="https://blog-biletall.mncdn.com/wp-content/uploads/2016/05/orman.jpg"></div>
			<div class="hpSlider-img" id="hpSlider-img3"><img src="https://starfikir.files.wordpress.com/2016/02/deniz.jpg?w=1568"></div>
        </div>
    </div>
</div>

<section id="hpContent">
<div class="postarea">
	<?php
		$postSorgu = $db->prepare("SELECT yazi_kat_id FROM yazilar INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id WHERE yazi_durum=:d");
	
		$postSorgu->execute([":d" => 1]);
	
		$postToplam = $postSorgu->rowCount();
		$postLimit 	= 10;
	
		$postSorgu  = $db->prepare("SELECT * FROM yazilar
		INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id WHERE yazi_durum=:d
		ORDER BY yazi_tarih DESC LIMIT :lim");
	
		$postSorgu->bindValue(":d",(int) 1, PDO::PARAM_INT);
		$postSorgu->bindValue(":lim",(int) $postLimit, PDO::PARAM_INT);
		$postSorgu->execute();
	
		if($postSorgu->rowCount())
		{
		foreach($postSorgu as $postItm)
		{
		?>
		<a href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $postItm['yazi_sef'];?>&id=<?php echo $postItm['yazi_id'];?>" class="postHref">	
		<div class="post">
			<div class="post_image">
			<img src="<?php echo $postItm["yazi_resim"];?>" width="400px" height="220px" 
		    alt="<?php echo $postItm["yazi_baslik"];?>">
		    </div>
		 </a>
			
		<div class="post_detail">
			<span class="post_date_text"><i class="fas fa-calendar-alt"></i><?php echo ' '. date("d.m.Y",strtotime($postItm["yazi_tarih"]));?></span>
			<span class="post_like_text"><i class="fas fa-eye"></i><?php echo ' '.$postItm["yazi_hit"];?></span>
		</div>
			
		<div class="post_content">
		<a href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $postItm['yazi_sef'];?>&id=<?php echo $postItm['yazi_id'];?>" class="postHref">			
			<div class="post_content_title">
				<h2>
					<?php
						$postName = $postItm['yazi_baslik'];
						$postNamelen = strlen($postName);
						if($postNamelen > 70)
							{
								echo mb_substr($postName,0,70,'utf8').'...';
							}
							else
							{
								echo $postName;
							}
								?>					
				</h2>
			</div>
		</a>
			<div class="post_content_text"><h2><?php echo mb_substr($postItm["yazi_icerik"],0, 200, 'utf8'). '...';?></h2></div>
		</div>
			
		<div class="post_tagbox">
			<a href="<?php echo $arow->site_url . "/categories.php?kat_sef=".$postItm['kat_sef'];?>" class="postHref"><span class="post_tag"><?php echo $postItm["kat_adi"];?></span></a>
		</div>
	    </div>
		<?php
		}
		?>

	   <?php
 		} 
	   ?>
</div>	

<aside class="aside">
	<div class="asidePart">
		<div class="aside-titlebg">
			<span class="aside-title"><i class="fas fa-tags"></i> En Sevilen Konular </span>
		</div>	
		<div class="aside-content" id="aside-tag-content">
		<?php
			$katSorgu = $db->prepare("SELECT * FROM kategoriler WHERE kat_durum=:d");
			$katSorgu->execute([":d" => 1]);
	
			$ksToplam = $katSorgu->rowCount();
			$ksLimit  = 10;
	
			$katSorgu  = $db->prepare("SELECT * FROM kategoriler WHERE kat_durum=:d ORDER BY id DESC LIMIT :lim");
	
			$katSorgu->bindValue(":d",(int) 1, PDO::PARAM_INT);
			$katSorgu->bindValue(":lim",(int) $ksLimit, PDO::PARAM_INT);
			$katSorgu->execute();
	
			if($katSorgu->rowCount())
			{
				foreach($katSorgu as $ksItem)
				{
					echo '<div class="aside-tag">
					<a href="'.$arow->site_url.'/categories.php?kat_sef='.$ksItem['kat_sef'].'">'.$ksItem['kat_adi'].'</a></div>';
				}
			}		
			
		?>				
				
		</div>
	</div>
	
	<div class="asidePart">
		<div class="aside-titlebg">
			<span class="aside-title"><i class="fas fa-user"></i> Blogumu Takip Et </span>
		</div>	
		<div class="aside-content" id="aside-mail-content">
			<div id="aside-mail-title">Mail Aboneliği</div>
			<div id="aside-mail-text">
				Aşağıdaki kutucuğa mail hesabını yazarsan. Bloguma eklediğim her yeni yazıdan ilk senin haberin olur. 
				<br><i style="font-style: italic; color: slategray;">Ücretsiz Bir Servistir!</i>
			</div>
			<form class="mailSubForm" action="" method="post" onSubmit="return false;" id="mailsubform">
				<div class="sub-mail-box">
					<input name="subMail" class="sub-mail" type="email" placeholder="Mail Adresinizi Giriniz">
					<button type="submit" name="subMailSend" class="sub-mail-send" onclick="mailsub();">
						<i class="fas fa-paper-plane"></i>
					</button>
				</div>
			</form>
		</div>	
	</div>
	
	<div class="asidePart">
		<div class="aside-titlebg">
			<span class="aside-title"><i class="fas fa-file"></i> Son Yazılar </span>
		</div>	
		<div class="aside-content">
			<?php
				$asideSon = $db->prepare('SELECT * FROM yazilar WHERE yazi_durum=:d');
				$asideSon->execute([':d'=>1]);
			
				$asonToplam = $katSorgu->rowCount();
				$asonLimit  = 5;			
			
				$asideSon = $db->prepare('SELECT * FROM yazilar WHERE yazi_durum=:d ORDER BY yazi_tarih DESC LIMIT :lim');
				$asideSon->bindValue(":d",(int) 1, PDO::PARAM_INT);
				$asideSon->bindValue(":lim",(int) $asonLimit, PDO::PARAM_INT);
				$asideSon->execute();
			
				if($asideSon->rowCount()){
					foreach($asideSon as $item){
						echo '<div class="aside-lastones"><a href="'.$arow->site_url.'/articlepage.php?yazi_sef='.$item['yazi_sef'].'&id='.$item['yazi_id'].'">'.$item['yazi_baslik'].'</a></div>';	
					}
				}
			?>
		</div>
	</div>	

	<div class="asidePart">
		<div class="aside-titlebg">
			<span class="aside-title"><i class="fab fa-twitter"></i> Admin Beyinizin Tweetleri </span>
		</div>	
		<div class="aside-content">
			<a class="twitter-timeline" data-lang="tr" data-width="400" data-height="500" href="https://twitter.com/fatihusludur?ref_src=twsrc%5Etfw">Tweets by fatihusludur</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>	
	</div>
	
	<div class="asidePart">
		<div class="aside-titlebg">
			<span class="aside-title"><i class="fas fa-film"></i> Bunları Kesin İzle </span>
		</div>
		<div class="aside-content">
			<?php
			$filmkatid = 1;
			$filmsorgu = $db->prepare("SELECT * FROM yazilar 
			INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id WHERE yazi_durum=:d AND yazi_kat_id=:katid
			ORDER BY yazi_id DESC LIMIT :lim");
			$filmsorgu->bindValue(":d",(int) 1, PDO::PARAM_INT);
			$filmsorgu->bindValue(":katid",(int) $filmkatid, PDO::PARAM_INT);
			$filmsorgu->bindValue(":lim",(int) 6, PDO::PARAM_INT);
			$filmsorgu->execute();
			
			if ($filmsorgu->rowCount()){
				foreach($filmsorgu as $film){
					?>
					<div class="aside-film">
						<a href="<?php echo $arow->site_url.'/articlepage.php?yazi_sef='.$film['yazi_sef'].'&id='.$film['yazi_id'];?>"><div class="aside-filmbox">Neden Bu Film?</div></a>
						<img alt="<?php echo $film['yazi_baslik'];?>" src="<?php echo $film['yazi_resim'];?>">
					</div>									
					<?php
				}
			}
			?>

		</div>
	</div>	
</aside>
</section>



<?php require_once "includes/footer.php";?>		
		

</body>
</html>
