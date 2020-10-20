<?php require_once("baglan.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <title>Ankara Düğün Salonları</title>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Ankara Düğün Salonları</h1>      
    <p>Doğru, Dürüst & Güvenilir Adres</p>
  </div>
</div>

<div class="sag">
	<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" style="text-transform: capitalize;" type="button" data-toggle="dropdown">
	<?php 
        session_start();
        if($_SESSION){               
                echo "Hoşgeldiniz ".$_SESSION["uye"].",".$_SESSION["id"]."";		
        }
        ?> 
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="profildüzenle.php">Profil Düzenle</a></li>
	   <li><a href="bildirim.php">Bildirimler</a></li>
	   <li><a href="teklif.php">Teklif Formu Ekranı</a></li>
	   <li><a href="sayfalarim.php">Sayfalarım</a></li>
	  <li><a href="sayfaolustur.php">Sayfa Olustur</a></li>
      <li><a href="cikis.php">Çıkış Yap</a></li>
    </ul>
  </div>

</div>

</body>
</html>