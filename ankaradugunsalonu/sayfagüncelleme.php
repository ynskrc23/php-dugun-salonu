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
    
	<?php 
	if (!isset($id)) {
		$id = $_GET["id"];
	}
	?>
	
	<?php 
		$veri= $db->prepare("select * from sayfalar where sayfa_id=?");
		$veri ->execute(array($id));
		$islem= $veri->fetch();
	?>

		<!--  veri güncelleme -->
		<?php 
	if($_POST){
		$sayfa_adi = $_POST["sayfa_adi"];
		$sayfa_hakkimizda = $_POST["sayfa_hakkimizda"];
		$sayfa_hizmet = $_POST["sayfa_hizmet"];
		$sayfa_menu = $_POST["sayfa_menu"];
		$sayfa_adres = $_POST["sayfa_adres"];
		$sayfa_ucret = $_POST["sayfa_ucret"];

		$guncelle=$db->prepare("update sayfalar set sayfa_adi=?,sayfa_hakkimizda=?,sayfa_hizmet=?,sayfa_menu=?,sayfa_adres=?,sayfa_ucret=? where sayfa_id=?");
        $guncelle->execute(array($sayfa_adi,$sayfa_hakkimizda,$sayfa_hizmet,$sayfa_menu,$sayfa_adres,$sayfa_ucret,$id));
        header("location:sayfalarim.php");
    }
?>
		<!--  veri güncelleme -->
	
<div class="kullaniciekraniortaalan">
<form action="" method="post">
<h3 style="text-align:center;">Sayfa Oluşturma Ekranına Hoşgeldiniz</h3>
<input type="text" style="margin-left:380px; width:410px;" class="form-control" name="sayfa_adi" 
	   placeholder="Lütfen Sayfa Adını Giriniz" value="<?php echo $islem['sayfa_adi']; ?>" id="recipient-name"><br>
<div class="böl" style="text-align:center;">
<h4>Hakkımızda<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_hakkimizda" id="exampleFormControlTextarea1" rows="13">
	<?php echo $islem['sayfa_hakkimizda']; ?>
	</textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Hizmetler<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_hizmet" id="exampleFormControlTextarea2" rows="13">
	<?php echo $islem['sayfa_hizmet']; ?>
	</textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Menü<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_menu" id="exampleFormControlTextarea3" rows="13">
	<?php echo $islem['sayfa_menu']; ?>
	</textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Fotograf Galerisi<h4>
	<?php 
		$a = $db->query("SELECT * FROM resim where resim_sayfaid=$id", PDO::FETCH_ASSOC);
		if ( $a->rowCount() ){
		   foreach( $a as $row ){
			  $row['resim_sayfaid'];
		   }
		}
		echo "<a href='fotogüncelle.php?id=".$row["resim_sayfaid"]."' style='font-size:20px;'>Fotograf Ekleme Alanı</a>";?><br><br>
  <?php echo "<a href='fotosil.php?id=".$row["resim_sayfaid"]."' style='font-size:20px;'>Fotograf Silme Alanı</a>";
	?>
</div>

<div class="böl" style="text-align:center;">
<h4>Adres<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_adres" id="exampleFormControlTextarea4" rows="13">
	<?php echo $islem['sayfa_adres']; ?>
	</textarea>
</div>
</div>

<div class="böl" style="text-align:center;">
<h4>Ücret<h4>
<div class="form-group">
	<textarea class="form-control" name="sayfa_ucret" id="exampleFormControlTextarea5" rows="13">
	<?php echo $islem['sayfa_ucret']; ?>
	</textarea>
</div>
</div> 
	<button type="submit" name="sayfaguncelle" style="margin-left:530px; margin-top:10px;" class="btn btn-primary">Güncelle</button>
	</a>

<br><br>
</form>
</div>

</body>
</html>