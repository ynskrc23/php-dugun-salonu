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

	<?php 
        session_start();
        if($_SESSION){               
                "Hoşgeldiniz ".$_SESSION["uye"].",".$_SESSION["id"].",".$_SESSION["tel"].",".$_SESSION["kapasite"].",".$_SESSION["mekan"]." ";		
        }
        ?> 
    
<div class="kullaniciekraniortaalan">
<form action="" method="post">
<h3 style="text-align:center;">Sayfa Oluşturma Ekranına Hoşgeldiniz</h3>
<input type="text" style="margin-left:380px; width:410px;" class="form-control" name="sayfa_adi" placeholder="Lütfen Sayfa Adını Giriniz" id="recipient-name"><br>
<div class="böl" style="text-align:center;">
<h4>Hakkımızda<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_hakkimizda" id="exampleFormControlTextarea1" rows="13"></textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Hizmetler<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_hizmet" id="exampleFormControlTextarea2" rows="13"></textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Menü<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_menu" id="exampleFormControlTextarea3" rows="13"></textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Fotograf Galerisi<h4>
</div>

<div class="böl" style="text-align:center;">
<h4>Adres<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_adres" id="exampleFormControlTextarea4" rows="13"></textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Ücret<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_ucret" id="exampleFormControlTextarea5" rows="13"></textarea>
</div>
</div>
<button type="submit" name="kaydet" style="margin-top:35px; font-size:18px;" class="btn btn-primary">Verileri Kaydet</button>
<br><br>
</form>
</div>

<!-- php sayfa ekleme -->
<?php 
	if($_POST){
		$sayfa_adi = $_POST["sayfa_adi"];
		$sayfa_hakkimizda = $_POST["sayfa_hakkimizda"];
		$sayfa_hizmet = $_POST["sayfa_hizmet"];
		$sayfa_menu = $_POST["sayfa_menu"];
		$sayfa_adres = $_POST["sayfa_adres"];
    	$sayfa_ucret = $_POST["sayfa_ucret"];
		$sayfa_tel= "".$_SESSION["tel"]."";
		$sayfa_yetkili= "".$_SESSION["uye"]."";
		$sayfa_kapasite= "".$_SESSION["kapasite"]."";
		
		$ekle=$db->prepare("insert into sayfalar set sayfa_hakkimizda=?,sayfa_hizmet=?,sayfa_menu=?,sayfa_adres=?,sayfa_ucret=?,sayfa_olusturucu=?,sayfa_ilce=?,sayfa_adi=?,sayfa_tel=?,sayfa_yetkili=?,sayfa_kapasite=?");
		$ekle->execute(array($sayfa_hakkimizda,$sayfa_hizmet,$sayfa_menu,$sayfa_adres,$sayfa_ucret,$_SESSION["id"],$_SESSION["ilce"],$sayfa_adi,$sayfa_tel,$sayfa_yetkili,$sayfa_kapasite));
		header("location:sayfaolustur.php");
	}
?>
<!-- php sayfa ekleme -->

<?php 
	$veri = $db->query("SELECT * FROM sayfalar", PDO::FETCH_ASSOC);
	if ( $veri->rowCount() ){
	   foreach( $veri as $row ){
		  $row['sayfa_id'];
	   }
	}
	echo "<a href='listeleme.php?id=".$row["sayfa_id"]."' style='margin-left:86%; font-size:22px;'>Devam Et</a>";
?>

</body>
</html>