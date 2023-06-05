<?php require_once 'system/functions.php';?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="Description" content="<?php echo $tit['aciklama'];?>">
	<meta name="Keywords" content="<?php echo $tit['kelimeler'];?>">
	<meta name="author" content="<?php echo $arow->site_baslik;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="icon" href="<?php echo $arow->site_favicon;?>">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/keyframes.css">
	<link rel="stylesheet" href="css/reset.css">
	
	<script src="https://kit.fontawesome.com/7b32f8dbb4.js" crossorigin="anonymous"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/sweetalert/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="js/sweetalert/sweetalert2.min.css">
	<script src="js/ajax.js"></script>
	<script src="js/custom.js"></script>
	
	<title><?php echo $tit['baslik'];?></title>	
</head>
<body>