<?php

require_once 'connect.php';

/*Herhangi Bir Forma Girilen Değerleri Güvenli Hale Getirir?
[Kullanımı: post($isim) şeklindedir, ikinci değer olarak true verirsen,elseif komutunu çalıştırır(fonksiyonu incele)]
*/
function post($parametre, $kosul = false){
    if( $kosul == false ){
        $sonuc = strip_tags(trim($_POST[$parametre]));
    }elseif( $kosul == true ){
        $sonuc = strip_tags(trim(addslashes($_POST[$parametre])));
    }
    return $sonuc;
}

/*İp değerlerini bize verir. Kullanımı echo IP() şeklindedir*/
function IP(){

    if(getenv("HTTP_CLIENT_IP")){
        $ip = getenv("HTTP_CLIENT_IP");
    }elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }else{
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}


/*1-2-3-4 gibi sayfa numara bölümünü kolaylaştırmak için yazılan bir fonksiyondur.*/
function pagination($s, $ptotal, $url){
    global $site;

    $forlimit = 3;
    if($ptotal < 2){
        null;
    }else{
        if($s > 4){
            $prev  = $s - 1;
            echo '<li class="page-item"><a class="pagi-button" href="'.$site.'/'.$url.'1" ><i class="fa fa-angle-left"></i></a></li>';
            echo '<li class="page-item"><a class="pagi-button" href="'.$site.'/'.$url.($s-1).'" ><</a></li>';
        }

        for($i = $s - $forlimit; $i < $s + $forlimit + 1; $i++){
            if($i > 0 && $i <= $ptotal){
                if($i == $s){
                    echo '<li class="page-item active"><a class="pagi-button"  href="#">'.$i.'</a></li>';
                }else{
                    echo '<li class="page-item"><a class="pagi-button" href="'.$site.'/'.$url.$i.'" >'.$i.'</a></li>';
                }
            }
        }

        if($s <= $ptotal - 4){
            $next  = $s + 1;
            echo '<li class="page-item"><a class="pagi-button" href="'.$site.'/'.$url.$next.'" > <i class="fa fa-angle-right"></i></a></li>';
            echo '<li class="page-item"><a class="pagi-button" href="'.$site.'/'.$url.$ptotal.'" >»</a></li>';
        }
    }

}




function sef_link($str){
    $preg = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
    $match = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
    $perma = strtolower(str_replace($preg, $match, $str));
    $perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $perma);
    $perma = trim(preg_replace('/\s+/', ' ', $perma));
    $perma = str_replace(' ', '-', $perma);
    return $perma;
}


function etiketler(){
	global $db;
	global $site;
	
	$sorgu = $db->prepare('SELECT yazi_id, yazi_etiketler FROM yazilar WHERE yazi_durum=:d ORDER BY yazi_id DESC LIMIT :lim');
	
	$sorgu -> bindValue(':d', (int) 1, PDO::PARAM_INT);
	$sorgu -> bindValue(':lim', (int) 3, PDO::PARAM_INT);
	$sorgu -> execute();
	
	if($sorgu->rowCount())
	{
		$arr = array();
		foreach($sorgu as $row)
		{
			$etiketler = $row['yazi_etiketler'];
			$exp	   = explode(',',$etiketler);
			foreach($exp as $e)
			{
				$arr[] = '<a href="'.$site.'/tagpage.php?etiket='.sef_link($e).'" title="'.$e.'">'.$e.'</a>';
			}
		}
		
		$arr = array_unique($arr);
		foreach($arr as $etiketbilgi)
		{
			echo $etiketbilgi;
		}
	}
}


function tit(){
	global $db;
	global $sitebaslik;
	global $site;
	global $sitelogo;
	global $sitedesc;
	global $sitekeyw;
	/*4 get olacak*/
	
	$yazisef = @$_GET['yazi_sef'];
	$katsef = @$_GET['kat_sef'];
	$q = @$_GET['q'];
	$etiket = @$_GET['etiket'];
	
	if($yazisef){
		$yazilar = $db->prepare('SELECT * FROM yazilar WHERE yazi_sef=:s AND yazi_durum=:d');
		$yazilar->execute([":s"=>$yazisef, ":d"=>1]);
		$yazirow = $yazilar->fetch(PDO::FETCH_OBJ);
		
		$tit['baslik'] = $yazirow->yazi_baslik ."-". $sitebaslik;
		$tit['resim'] = $yazirow->yazi_resim;
		$tit['kelimeler'] = $yazirow->yazi_etiketler;
		$tit['aciklama'] = mb_substr($yazirow->yazi_icerik, 0, 260, "utf8");
	}
	else if ($katsef){
		$kategoriler = $db->prepare('SELECT * FROM kategoriler WHERE kat_sef=:s');
		$kategoriler->execute([":s"=>$katsef]);
		$katrow = $kategoriler->fetch(PDO::FETCH_OBJ);
	
		$tit['baslik'] = $katrow->kat_adi ."-". $sitebaslik;
		$tit['resim'] = $sitelogo;
		$tit['kelimeler'] = $katrow->kat_keyw;
		$tit['aciklama'] = mb_substr($katrow->kat_desc, 0, 260, "utf8");		
	}
	else if ($q){
		$tit['baslik'] = $q ."-". $sitebaslik;
		$tit['resim'] = $sitelogo;
		$tit['kelimeler'] = $sitekeyw;
		$tit['aciklama'] = mb_substr($sitedesc, 0, 260, "utf8");
	}
	else if ($etiket){
		$tit['baslik'] = $etiket ."-". $sitebaslik;
		$tit['resim'] = $sitelogo;
		$tit['kelimeler'] = $sitekeyw;
		$tit['aciklama'] = mb_substr($sitedesc, 0, 260, "utf8");
	}
	else{
		$tit['baslik'] = $sitebaslik;
		$tit['resim'] = $sitelogo;
		$tit['kelimeler'] = $sitekeyw;
		$tit['aciklama'] = mb_substr($sitedesc, 0, 260, "utf8");		
	}
	return $tit;
}
$tit = tit();





?>