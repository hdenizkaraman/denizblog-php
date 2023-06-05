<?php
require_once "../system/functions.php";

if($_POST){
	$mail = post("subMail");
	if(!$mail)
	{
		echo "empty";
	}
	else
	{	
		if(!filter_var($mail,FILTER_VALIDATE_EMAIL))
		{
			echo "format";
		}
		else
		{
			$kontrol = $db->prepare("SELECT abone_mail FROM abone WHERE abone_mail=:mail");
			$kontrol->execute([":mail"=>$mail]);
			if($kontrol->rowCount()){
				echo "already";
			}
			else{
				$kaydet = $db->prepare("INSERT INTO abone SET abone_mail=:m, abone_ip=:ip");
				$kaydet->execute([":m"=>$mail, ":ip"=>IP()]);
				if($kaydet){
					echo "successful";
				}
				else{
					echo "syerror";
				}
			}
		}
	}	
}


?>