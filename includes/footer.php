<footer>
	<div class="ft-sections">
		<div class="ft-sec" id="ft-s1">
			<div class="ft-title">Tecrübelerim</div>
			<div class="ft-text">
				<?php
				$tecrubeSorgu = $db->prepare('SELECT * FROM tecrubeler ORDER BY id DESC LIMIT :lim');
				$tecrubeSorgu->bindValue(':lim', (int) 4, PDO::PARAM_INT);
				$tecrubeSorgu->execute();
				if($tecrubeSorgu->rowCount()){
					foreach($tecrubeSorgu as $tec){
						?>
							<font color="<?php echo $tec['tecrube_renk'];?>"><?php echo $tec['tecrube_yazi'];?></font>
							<br><br>
						<?php
						}
				}
				?>
			</div>
		</div>
		
		<div class="ft-sec" id="ft-s2">
			<div class="ft-title">Akış</div>
			<div class="ft-text">
				<span><a href=""><i class="fas fa-angle-double-right"></i>Ana Sayfa</a></span><br><br>
				<span><a href=""><i class="fas fa-angle-double-right"></i>Hakkımda</a></span><br><br>
				<span><a href=""><i class="fas fa-angle-double-right"></i>Feed Akışı</a></span><br><br>
				<span><a href=""><i class="fas fa-angle-double-right"></i>Site Haritası</a></span><br><br>
			</div>
		</div>		
		
		<div class="ft-sec" id="ft-s3">
			<div class="ft-title">Bu Ayın Hedefleri</div>
			<div class="ft-text">
				<?php
				$barSorgu = $db->prepare('SELECT * FROM hedefler ORDER BY id DESC LIMIT :lim');
				$barSorgu->bindValue(':lim', (int) 3, PDO::PARAM_INT);
				$barSorgu->execute();
				if($barSorgu->rowCount()){
					foreach($barSorgu as $bar){
						?>
						<div class="ft3-box">
							<b><?php echo $bar['hedef_yazi'];?></b><br>
							<progress value="<?php echo $bar['hedef_sayi'];?>" max="100"></progress>
						</div><br>
						<?php
						}
				}
				?>				
			</div>
		</div>
		
		<div id="ft-down">denizkaraman.com.tr 2020 | Tüm Hakları Saklıdır.</div>
	</div>
</footer>

</body>
</html> 

