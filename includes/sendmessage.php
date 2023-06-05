<?php
require_once "../system/functions.php";

if($_POST)
{
	$ad     = post("name");
	$eposta = post("email");
	$konu   = post("selection");
	$mesaj  = post("message");
	
	if(!$ad || !$eposta || !$mesaj)
	{
	echo "empty";
	}
	else
	{	
		if(!filter_var($eposta,FILTER_VALIDATE_EMAIL))
		{
			echo "format";
		}
		else
		{
			$kaydet = $db->prepare
			("
				INSERT INTO mesajlar SET
				isim   =:i,
				konu   =:k,
				eposta =:e,
				mesaj  =:m,
				ip 	   =:ip
			");
			
			$kaydet->execute([
				':i'  => $ad,
				':k'  => $konu,
				':e'  => $eposta,
				':m'  => $mesaj,
				':ip' => IP()
			]);
			
			if($kaydet)
			{
				echo "successful";
			}
			else
			{
				echo "syerror";
			}
		}
	}
}


?>