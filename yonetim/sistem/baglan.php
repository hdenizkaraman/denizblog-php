<?php
session_start();
ob_start();
date_default_timezone_set("Europe/Istanbul");

try{	
	$db = new PDO("mysql:host=localhost;dbname=denizkaramanvt", "root", "");
	$db->query("SET CHARACTER SET UTF8");
	$db->query("SET NAMES UTF8");
}
catch(PDOExpection $hata){
	echo $hata -> getMessage();
}

$yonetimUrl = "http://localhost/DenizKaraman/yonetim";


if(@$_SESSION['oturum'] == sha1(md5(@$_SESSION['id'].IP()))){
	$yoneticibul = $db->prepare("SELECT * FROM yoneticiler WHERE id=:id");
	$yoneticibul->execute([':id'=> $_SESSION['id']]);

	if($yoneticibul->rowCount()){
		$row = $yoneticibul->fetch(PDO::FETCH_OBJ);
		$yid = $row->id;
		$ykadi = $row->adsoyad;
		$yposta = $row->eposta;
	}
}

?>