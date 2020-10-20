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

<h1 style="text-align:center; margin-top:30px;">Profil Düzenleme Ekranı</h1>
<?php 
		$veri= $db->prepare("select * from uyeler where uye_id=?;");
		$veri ->execute(array("".$_SESSION['id'].""));
		$islem= $veri->fetch();
?>

		<!--  veri güncelleme -->
		<?php 
	if($_POST){
		$uye_mekanadi = $_POST["uye_mekanadi"];
		$uye_yetkili = $_POST["uye_yetkili"];
		$uye_eposta = $_POST["uye_eposta"];
		$uye_sifre = $_POST["uye_sifre"];
		$uye_tel = $_POST["uye_tel"];

		$guncelle=$db->prepare("update uyeler set uye_mekanadi=?,uye_yetkili=?,uye_eposta=?,uye_sifre=?,uye_tel=? where uye_id=?");
        $guncelle->execute(array($uye_mekanadi,$uye_yetkili,$uye_eposta,$uye_sifre,$uye_tel,"".$_SESSION['id'].""));
        header("location:kullaniciekrani.php");
    }
?>
		<!-- veri güncelleme -->
<div class="container">
<div class="profil">
<form action="" method="post">
    <div class="form-group row">
      <div class="col-lg-12">
        <label for="ex3">Mekanın Adı</label>
        <input class="form-control" name="uye_mekanadi" type="text" value="<?php echo $islem[1] ?>">
      </div>
      <div class="col-lg-12">
        <label for="ex3">Yetkili Kişi</label>
        <input class="form-control"name="uye_yetkili" type="text" value="<?php echo $islem[2] ?>">
      </div>
      <div class="col-lg-12">
        <label for="ex3">E-Mail</label>
        <input class="form-control" name="uye_eposta" type="text" value="<?php echo $islem[3] ?>">
      </div>
      <div class="col-lg-12">
        <label for="ex3">Şifre</label>
        <input class="form-control" name="uye_sifre" type="text" value="<?php echo $islem[4] ?>">
      </div>
      <div class="col-lg-12">
        <label for="ex3">Telefon No</label>
        <input class="form-control" name="uye_tel" type="text" value="<?php echo $islem[5] ?>">
      </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Veri Güncelle</button>
  </form>
</div>
</div>

</body>
<html>