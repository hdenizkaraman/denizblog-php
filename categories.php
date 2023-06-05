<?php require_once "includes/head.php";?>
<?php require_once "includes/menu.php";?>

<section class="cat_content fadeIn">
	<div class="cpc_title">
		<?php
		
			$katisim = strip_tags($_GET["kat_sef"]);
			$katisimBul = $db->prepare("SELECT * FROM kategoriler WHERE kat_sef=:k");
			$katisimBul->execute([':k' => $katisim]);
			if($katisimBul->rowCount())
			{
			$katad = $katisimBul->fetch(PDO::FETCH_OBJ);
			}
			echo '<b>'.$katad->kat_adi.'</b> Kategorisinde Bulunan Yazılar';
		?>
	</div>
	<hr style="width: 1200px; margin: 20px 30px;">
	
	
	<div class="postarea" id="cpc_postarea">
	<?php
		$kategoriler = strip_tags($_GET["kat_sef"]);
		if(!$kategoriler){ header('Location:'.$arow->site_url);}
	
		$kategoriBul = $db->prepare("SELECT * FROM kategoriler WHERE kat_sef=:k");
		$kategoriBul->execute([':k' => $kategoriler]);
		if($kategoriBul->rowCount())
		{
			$katrow = $kategoriBul->fetch(PDO::FETCH_OBJ);
		}
		else
		{
			header('Location:'.$arow->site_url);	
		}
		$ksSorgu = $db->prepare("SELECT yazi_kat_id FROM yazilar INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id WHERE  yazi_durum=:d AND yazi_kat_id=:kat"); /*ks->kategori sayfası*/	
	
		$ksSorgu->execute([":d" => 1,":kat"=> $katrow->id]);
	
		$ksToplam = $ksSorgu->rowCount();
	
		$ksSorgu  = $db->prepare("SELECT * FROM yazilar
		INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id WHERE yazi_durum=:d AND yazi_kat_id=:kat
		ORDER BY yazi_tarih");
	
		$ksSorgu->bindValue(":d",(int) 1, PDO::PARAM_INT);
		$ksSorgu->bindValue(":kat",(int) $katrow->id, PDO::PARAM_INT);
		$ksSorgu->execute();
		
		if($ksSorgu->rowCount())
		{
		foreach($ksSorgu as $ksItm)
		{
		?>	
		<a href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $ksItm['yazi_sef'];?>&id=<?php echo $ksItm['yazi_id']?>" class="postHref">
		<div class="post" id="catPost">
			<div class="post_image">
			<img src="<?php echo $ksItm["yazi_resim"];?>" width="400px" height="220px" 
		    alt="<?php echo $ksItm["yazi_baslik"];?>">
		    </div>
		 </a>
		<div class="post_detail">
			<span class="post_date_text"><i class="fas fa-calendar-alt"></i><?php echo ' '. date("d.m.Y",strtotime($ksItm["yazi_tarih"]));?></span>
			<span class="post_like_text"><i class="fas fa-eye"></i><?php echo ' '.$ksItm["yazi_hit"];?></span>
		</div>
		<div class="post_content">
		<a href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $ksItm['yazi_sef'];?>&id=<?php echo $ksItm['yazi_id']?>" class="postHref">			
			<div class="post_content_title">
				<h2>
					<?php
						$postName = $ksItm['yazi_baslik'];
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
			<div class="post_content_text"><h2><?php echo mb_substr($ksItm["yazi_icerik"],0, 200, 'utf8'). '...';?></h2></div>
		</div>
		<div class="post_tagbox">
			<a href="<?php echo $arow->site_url . "/categories.php?kat_sef=".$ksItm['kat_sef'];?>" class="postHref"><span class="post_tag"><?php echo $ksItm["kat_adi"];?></span></a>
		</div>
	    </div>
		<?php
		}
		?>

	   <?php
 		}else{header('Location:'.$arow->site_url);}
	   ?>
	</div>
</section>
<?php require_once "includes/footer.php";?>		
		