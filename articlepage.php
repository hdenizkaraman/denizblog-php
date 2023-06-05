<?php require_once "includes/head.php";?>
<?php require_once "includes/menu.php";?>

<section class="ap_content">
<div class="apc_article">
	
	<?php
	
	$yazisef = strip_tags(trim($_GET['yazi_sef']));
	$yaziid  = strip_tags(trim($_GET['id']));
	
	if(!$yazisef || !$yaziid)
	{
		header('location:'.$arow->site_url);
	}
	
	$konubul = $db->prepare
	('
		SELECT * FROM yazilar 
		INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id
		WHERE yazi_sef=:sef AND yazi_id=:id AND yazi_durum=:d
	');
	
	$konubul->execute([":sef"=>$yazisef,":id"=>$yaziid,":d"=>1]);
	
	if($konubul->rowCount())
	{
		$row = $konubul->fetch(PDO::FETCH_OBJ);
		/*GÖRÜNTÜLENME ÇALIŞMIYOR!
		$hitdeger = $row->yazi_hit;
		$goruntulenme = @$_COOKIE[$hitdeger];
		if(!$goruntulenme){
			$hitart = $hitdeger+1;
			$hitupt = $db->prepare('UPTADE yazilar SET yazi_hit=:h WHERE yazi_id=:id');
			$hitupt->execute([":h"=>$hitart, ":id"=>$row->yazi_id]);
			setcookie($hitart, '1', time() + 3600);
		}
		
        $goruntulenme = @$_COOKIE[$row->yazi_hit];
		if(!$goruntulenme)
		{
			$okunma = $db->prepare("UPTADE yazilar SET yazi_hit=:h WHERE yazi_id=:id");
			$okunma->execute([":h"=>$row->yazi_hit+1, ":id"=>$row->yazi_id]);
			setcookie($row->yazi_hit, '1', time() + 3600);
		}*/
	?>
		<?php				
		$yorumsayi = $db->prepare("SELECT * FROM yorumlar WHERE yorum_yazi_id=:id AND yorum_durum=:d");
		$yorumsayi->execute([":id"=>$row->yazi_id, ":d"=>1]);
		?>
		<div class="article_cat"> <div class="post_tag" id="articleCat"><?php echo $row->kat_adi;?></div> </div>	
			<div class="article_title"><?php echo $row->yazi_baslik;?></div>
			<div class="article_details">
				<span class="detail_date"><i class="fas fa-clock"></i><?php echo ' '.date('d.m.Y',strtotime($row->yazi_tarih));?></span>
				<span class="detail_like"><i class="fas fa-eye"></i><?php echo ' '.$row->yazi_hit.' Görüntülenme';?></span>
				<span class="detail_comments"><i class="fas fa-comments"></i><?php echo ' '.$yorumsayi->rowCount().' Kişi Yorumlamış!';?></span>
			</div>

			<div class="article_content">
				<img class="arco-img1" alt="<?php echo $row->yazi_baslik ?>" src="<?php echo $row->yazi_resim;?>">
				<?php echo $row->yazi_icerik;?>
			</div>

			<div class="article_tags">
				<?php
				$etiketler = explode(',',$row->yazi_etiketler);
				$dizi  	   = array();
				foreach($etiketler as $etiket)
				{
					$dizi[] = '<a href="tagpage.php?tag='.sef_link($etiket).'" title="'.$etiket.'">'.$etiket.'</a>';
				}
				$sonuc = implode(' ',$dizi);
				echo $sonuc;
				?>

			</div>

			<div class="article_author">
				<img class="artAuthor_img" alt="Deniz Karaman Logo" src="https://i.hizliresim.com/8Z1OBl.png">
				<div class="artAuthor_box">
					<div class="artAuthor_name">Deniz Karaman</div>
					<div class="artAuthor_text">Selam Dostlar! Ben Deniz. Öncelikle ben bir lise öğrencisiyim. Bu zamana kadar teknolojiye hep ilgi duydum. Ve bir süre sonra Programlama ve Dijital tasarım ile tanıştım. Programlamaya ilk adımlarımı oyun geliştirmekle attım. Bu zaman içinde C# ve C++ temellerini öğrendim. Daha sonra Website Tasarımına yoğunlaştım. Şu aralar ise yazılım alanında her zaman en sevdiğim iş olan yapay zeka geliştirmesi üzerinde duruyorum.</div>
					<div class="artAuthor_readm"><a href="aboutme.php">Daha Fazlasını Oku</a><i class="fas fa-long-arrow-alt-right"></i></div>
				</div>
			</div>
	
	
	
	<div class="article_more">
		<div class="artMore_title">Bunlara Kesin Bak!</div>
		
		<?php
			$dfySorgu = $db->prepare('SELECT * FROM yazilar WHERE yazi_durum=:d');
			$dfySorgu->execute([':d'=>1]);
			
			$dfyToplam = $dfySorgu->rowCount();
			$dfyLimit  = 6;
			
			$dfySorgu = $db->prepare('SELECT * FROM yazilar WHERE yazi_durum=:d
			ORDER BY yazi_tarih DESC LIMIT :lim');
				
			$dfySorgu->bindValue(":d",(int) 1, PDO::PARAM_INT);
			$dfySorgu->bindValue(":lim",(int) $dfyLimit, PDO::PARAM_INT);
			$dfySorgu->execute();
		
			if($dfySorgu->rowCount())
			{
				
				foreach($dfySorgu as $dfyPost)
				{
				?>		
				<a class="postHref" href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $dfyPost['yazi_sef'];?>&id=<?php echo $dfyPost['yazi_id'];?>">
				<div class="artMore_post">
					<div class="artMore_img"><img alt="<?php echo $dfyPost['yazi_baslik']?>" src="<?php echo $dfyPost['yazi_resim']?>" width="270px" height="200px"></div>
					<div class="artMore_name"><?php echo mb_substr($dfyPost["yazi_baslik"],0, 130, 'utf8'). '...';?></div>
				</div>	
				</a>
				<?php
				}
			}

		?>
	</div>
	
	
	<div class="article_comments">
		<div class="comments_title">Bi' Yorum Bırak!</div>
		<div class="comments_send">
			<div class="comsend_sec1">
				<div class="comsend1_title">Yorumlarınızı <b>Saygı Çerçevesinde</b> Yapmayı Unutmayın!</div>
				
				<form class="comsend_form" action="" method="POST" onSubmit="return false;" id="comForm">
					<label>Adınız veya Mahlasınız:</label> <br>
					<input type="text" name="comName"> <br><br>
					<label>Mail adresiniz:</label> <br>
					<input type="email" name="comEmail"> <br><br>
					<label>İnternet siteniz:</label><br>
					<input type="url" placeholder="http:// ile beraber yazın" name="comWebsite"> <br><br>			
					<label>Mesajınız:</label> <br>
					<textarea name="comText" id="comsend_text"></textarea>	<br><br>
					
					<input type="hidden" value="<?php echo $row->yazi_id;?>" name="yaziid">
					<input type="submit" placeholder="Gönder" id="comsend_submit" name="comSubmit" onClick="sendcom();">
				</form>
				
			</div>
		</div>
		
		
		
		
		<div class="commentsArea">
			
			<?php
				$yorumlar = $db->prepare("SELECT * FROM yorumlar WHERE yorum_yazi_id=:id AND yorum_durum=:d");
				$yorumlar->execute([":id"=>$row->yazi_id, ":d"=>1]);
				
				if($yorumlar->rowCount()){
					foreach($yorumlar as $yorum){ ?>
						<div class="singleComment">
							<div class="singcom_name"><?php echo $yorum['yorum_isim'];?></div>
							<div class="singcom_date"><i class="fas fa-clock"></i>
								<?php echo date("d.m.Y",strtotime($yorum['yorum_tarih']));?>
							</div>		
							<div class="singcom_text"><?php echo $yorum['yorum_icerik'];?></div>
							<div class="singcom_tool">
								<?php
								if($yorum['yorum_website'] == null)
								{
									
								}else{?>
								<div class="singcom_web">
									<a href="<?php echo $yorum['yorum_website'];?>" target="_blank"><i class="fas fa-globe-americas"></i> Siteyi Görüntüle</a>
								</div>										
							<?php } ?>
								
					
								<div class="singcom_ok">
									<i class="fas fa-check-double"></i> Admin Tarafından Onaylandı
								</div>
							</div>
						</div>							
				<?php }
				}else{
					echo '<div class="redAlert">
					<i class="fas fa-exclamation-triangle"></i>
					Bu Yazıya Henüz Yorum Yapılmamış
					<i class="fas fa-exclamation-triangle"></i></div>';
				}
				
			?>
			
		</div>
	</div>
	

</div>					
	<?php
	}
	else
	{
		header('location:'.$arow->site_url);
	}
	?>
	
	
<div class="apc_aside">

	<div class="artaside-part">
		<div class="aside-titlebg" id="artaside-titlebg">
			<span class="aside-title" id="artaside-title"><i class="fas fa-map"></i> Site İçi Arama </span>
		</div>		
		<div class="artaside-content">
			<form action="search.php" method="get" id="artaside-qform">
				<div id="artaside-qbox"><i class="fas fa-search fa-lg"></i></div>
				<input id="artaside-qinput" name="q" type="search" placeholder="Arama Yapabilirsiniz..." aria-required="true">
			</form>
		</div>
	</div>
	
	<div class="artaside-part">
		<div class="aside-titlebg" id="artaside-titlebg">
			<span class="aside-title" id="artaside-title"><i class="fas fa-file"></i> Benzer Yazılar </span>
		</div>		
		<div class="artaside-content" id="artaside-samecat">
			<?php
				
				$apaKat = $row->yazi_kat_id;
				$apakatLim = 5;
			
				$apakatSorgu = $db->prepare
				('SELECT * FROM yazilar 
				INNER JOIN kategoriler ON kategoriler.id = yazilar.yazi_kat_id
				WHERE yazi_durum=:d ORDER BY yazi_kat_id=:katid DESC LIMIT :lim');
				
				$apakatSorgu -> bindValue(':d', (int) 1, PDO::PARAM_INT);
				$apakatSorgu -> bindValue(':lim', (int) $apakatLim, PDO::PARAM_INT);
				$apakatSorgu -> bindValue(':katid',(int) $apaKat, PDO::PARAM_INT);
				$apakatSorgu -> execute();
			
				if($apakatSorgu->rowCount()){
					foreach($apakatSorgu as $item){
						?>
						<div class="artaside-lastpost">
							<div class="artaside-postname">
							<a href="<?php echo $arow->site_url;?>/articlepage.php?yazi_sef=<?php echo $item['yazi_sef'];
							?>&id=<?php echo $item['yazi_id'];
							?>" class="postHref">
								<?php
								$apakAd = $item['yazi_baslik'];
								$apakAdlen = strlen($apakAd);
								if($apakAdlen > 70)
								{
									echo mb_substr($apakAd,0,70,'utf8').'...';
								}
								else{
									echo $apakAd;
								}
								?>
							</a>
							</div>
						</div>				
						<?php
					}
				}else{echo '';}
			?>	
		</div>
	</div>
	
	<div class="artaside-part">
		<div class="aside-titlebg" id="artaside-titlebg">
			<span class="aside-title" id="artaside-title"><i class="fas fa-user"></i> Blogumu Takip Et! </span>
		</div>		
		<div class="artaside-content" id="artaside-mail">
			<div id="artaside-mailtitle">Mail Aboneliği</div>
			<div id="artaside-mailtext">
				Aşağıdaki kutucuğa mail hesabını yazarsan. Bloguma eklediğim her yeni yazıdan ilk senin haberin olur. 
				<br><i style="font-style: italic; color: gray;">Ücretsiz Bir Servistir!</i>
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
	
	<div class="artaside-part">
		<div class="aside-titlebg" id="artaside-titlebg">
			<span class="aside-title" id="artaside-title"><i class="fas fa-cloud"></i> Etiket Bulutu </span>
		</div>		
		<div class="artaside-content" id="artaside-tagcloud">
			<?php echo etiketler();?>
		</div>
	</div>
</div>
	
</section>


<?php require_once "includes/footer.php";?>	