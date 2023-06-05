<?php
ob_start();
try{	
$db = new PDO("mysql:host=localhost;dbname=denizkaramanvt", "root", "");
$db->query("SET CHARACTER SET UTF8");
$db->query("SET NAMES UTF8");
}
catch(PDOExpection $hata){
	echo $hata -> getMessage();
}

##Ayarlar Tablosuna Bağlanmak

$ayarlar = $db->prepare("SELECT * FROM ayarlar");
$ayarlar->execute();
$arow = $ayarlar->fetch(PDO:: FETCH_OBJ);
$site = $arow->site_url;
$sitebaslik = $arow->site_baslik;
$sitelogo   = $arow->site_logo;
$sitekeyw   = $arow->site_keyw;
$sitedesc   = $arow->site_desc;
?>