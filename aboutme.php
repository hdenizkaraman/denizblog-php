<?php require_once "includes/head.php";?>
<?php require_once "includes/menu.php";?>


<div class="abo-content fadeIn">
	<div class="abo-section" id="abo-sec1">
		<div id="abo1-img"><img src="https://i.hizliresim.com/8Z1OBl.png"></div>
		<div id="abo1-content">
			<div id="abo1-title"><b>Hmm.. Beni mi Merak Ettin?</b></div>
			<div id="abo1-text">Sellaamm! Ben Deniz. Buraya kadar geldiysen ya gerçekten beni merak etmişsindir ya da bana iş gereği ulaşmaya çalışıyorsundur. Eğer benle iletişime geçmek istiyorsan hemen alttaki formdan bana ulaşabilirsin. Şimdi gelelim asıl soruya, kimim ki ben? Öncelikle ben bir lise öğrencisiyim. Bu zamana kadar teknolojiye hep ilgi duydum. Ve bir süre sonra Programlama ve Dijital tasarım ile tanıştım. Programlamaya ilk adımlarımı oyun geliştirmekle attım.
			Bu zaman içinde C# ve C++ temellerini öğrendim. Daha sonra Webtasarımı ile uğraştım ki bu satırları okuyorsan kendi sitemi açmayı başarmışım demektir. Ve son olarak Python dilinde kendimi geliştirdim, yapay asistanlar ürettim, bazı çok-işlevli uygulamalar yazdım. Ve tabiiki bu projeler için tasarımlarda gerekti, onlarıda kendim tasarladım.<br>
			Özetle, ben Hüseyin Deniz Karaman ve sadece bir lise öğrencisiyim.</div>
		</div>
	</div>
	<div class="abo-section" id="abo-sec2">
		<div id="abo2-title"><b>Bu Ayın Hedefleri</b></div>
		<div id="abo2-content">
			<?php
			$barSorgu = $db->prepare('SELECT * FROM hedefler');
			$barSorgu->execute();
			if($barSorgu->rowCount()){
				foreach($barSorgu as $bar){
					?>
					<div class="abo-sing" id="abo-sing1">
						<div class="abo-prog"><progress value="<?php echo $bar['hedef_sayi'];?>" max="100"></progress></div>
						<span><i class="fas fa-long-arrow-alt-left fa-lg"></i><?php echo $bar['hedef_yazi'];?></span>
					</div>
					<?php
					}
			}
			?>
		</div>
	</div>
	<div class="abo-section" id="abo-sec3">
			<form action="" method="post" onsubmit="return false;" class="basic-grey" id="aboutForm">
   				<h1>Bana Söylemek İstediklerini Aşağıdan Yazabilirsin 
    			<span>Lütfen aşağıdaki tüm boşlukları doldurun. Eğer ki benle diyaloğa geçmek istiyorsanız,
				'<?php echo $arow->site_contact;?>' instagram hesabından iletişime geçebilirsiniz.</span>
    			</h1>
				
  			 	<label>
    			<span>İsmin:</span>
       			<input id="name" type="text" name="name" placeholder="Adını Buraya Yaz" />
   				</label>
    
   				<label>
    			<span>Mail Adresin:</span>
       			<input id="email" type="email" name="email" placeholder="Geri Dönüş Sağlamak İçin" />
   				</label>
    
  				<label>
    		    <span>Mesajın:</span>
      			<textarea id="message" name="message" placeholder="Buraya Mesajın Gelecek"></textarea>
  				</label> 
				
     			<label>
    			<span>Hangi Konu?</span><select name="selection">
       			<option value="İş Hakkında">İş Hakkında</option>
       			<option value="Blog Hakkında">Blog Hakkında</option>
       			<option value="Yazılımla ilgili">Yazılımla İlgili</option>
       			<option value="Tasarımla ilgili">Tasarımla İlgili</option>
      			<option value="Kişisel Soru">Kişisel Soru</option>
     		    </select>
 				</label>  
				
    		    <label>
    			<span> </span> 
      			<input type="button" class="button" value="Gönder" onclick="sendmessage();" id="aboutFormSend"/> 
  				</label>    
			</form>		
	</div>
	<div class="abo-section" id="abo-sec4">
		<iframe src="<?php echo $arow->site_harita;?>" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>	
	</div>
</div>




<?php require_once "includes/footer.php";?>		