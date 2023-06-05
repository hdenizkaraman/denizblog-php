<?php require_once "includes/head.php";?>
<?php require_once "includes/menu.php";?>

<section class="cat_content fadeIn">
	<div class="cpc_title">
		<?php
		    $q = strip_tags($_GET["q"]);
			echo '<b>'.$q.'</b> Aramasının Sonuçları';
		?>
	</div>
	<hr style="width: 1200px; margin: 20px 30px;">
	
	
	<div class="postarea" id="cpc_postarea">
	<?php
		$q = strip_tags($_GET["q"]);
		if(!$q){ header('Location:'.$arow->site_url);}
	
		$qSorgu = $db->prepare("SELECT yazi_kat_id FROM yazilar INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id WHERE  yazi_durum=:d AND yazi_baslik LIKE :baslik");
		$qSorgu->execute([":d" => 1, ":baslik"=>'%'.$q.'%']);
		$qToplam = $qSorgu->rowCount();
	
		
		$qSorgu  = $db->prepare("SELECT * FROM yazilar
		INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id WHERE yazi_durum=:d AND yazi_baslik LIKE :baslik
		ORDER BY yazi_tarih");
		$qSorgu->bindValue(":d",(int) 1, PDO::PARAM_INT);
		$qSorgu->bindValue(":baslik",'%'.$q.'%', PDO::PARAM_STR);
		$qSorgu->execute();
		
		if($qSorgu->rowCount())
		{
		foreach($qSorgu as $qItm)
		{
		?>	
		<a href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $qItm['yazi_sef'];?>&id=<?php echo $qItm['yazi_id']?>" class="postHref">
		<div class="post" id="catPost">
			<div class="post_image">
			<img src="<?php echo $qItm["yazi_resim"];?>" width="400px" height="220px" 
		    alt="<?php echo $qItm["yazi_baslik"];?>">
		    </div>
		 </a>
		<div class="post_detail">
			<span class="post_date_text"><i class="fas fa-calendar-alt"></i><?php echo ' '. date("d.m.Y",strtotime($qItm["yazi_tarih"]));?></span>
			<span class="post_like_text"><i class="fas fa-eye"></i><?php echo ' '.$qItm["yazi_hit"];?></span>
		</div>
		<div class="post_content">
		<a href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $qItm['yazi_sef'];?>&id=<?php echo $qItm['yazi_id']?>" class="postHref">			
			<div class="post_content_title">
				<h2>
					<?php
						$postName = $qItm['yazi_baslik'];
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
			<div class="post_content_text"><h2><?php echo mb_substr($qItm["yazi_icerik"],0, 200, 'utf8'). '...';?></h2></div>
		</div>
		<div class="post_tagbox">
			<a href="<?php echo $arow->site_url . "/categories.php?kat_sef=".$qItm['kat_sef'];?>" class="postHref"><span class="post_tag"><?php echo $qItm["kat_adi"];?></span></a>
		</div>
	    </div>
		<?php
		}
		?>

	   <?php
 		}else{echo '<div class="redAlert">"'.$q.'" Kelimesine Uygun Bir Sonuç Bulunamadı</div>';}
	   ?>
	</div>
</section>
<?php require_once "includes/footer.php";?>		
		