<?php
require_once "../system/functions.php";

if ($_POST){
	
	$ad 	 = post('comName');
	$email 	 = post('comEmail');
	$website = post('comWebsite');
	$yorum	 = post('comText');
	$yaziid	 = post('yaziid');
	
	if(!$ad || !$email || !$yorum){
		echo 'empty';
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'format';
	}
	else{
		$kaydet = $db->prepare("INSERT INTO yorumlar SET
		yorum_yazi_id = :id,
		yorum_isim	  = :ad,
		yorum_eposta  = :email,
		yorum_website = :web,
		yorum_icerik  = :icerik,
		yorum_ip  	  = :ip
		");
		
		$kaydet->execute([
			":id"      => $yaziid,
			":ad" 	   => $ad,
			":email"   => $email,
			":web"	   => $website,
			":icerik"  => $yorum,
			":ip"      => IP()
		]);
		
		if($kaydet){
			echo "successful";
		}else{
			echo "syerror";
		}
		
	}
}

?>