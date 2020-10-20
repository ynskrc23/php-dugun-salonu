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
	<script language="javascript">
		function confirmDel() {
		 var agree=confirm("Bu içeriği silmek istediğinizden emin misiniz?\nBu işlem geri alınamaz!");
		 if (agree) {
		  return true ; }
		 else {
		  return false ;}
		}
	</script>
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


<div class="container text-center">    
  <h3>Düğün Salonlarımız</h3>
  <br>
  <div class="row">
   
    <?php 
	$veri = $db->prepare("SELECT * FROM sayfalar where sayfa_olusturucu=".$_SESSION["id"]."");
	$veri->execute();
	 
	if ( $veri->rowCount() ){
		foreach( $veri as $row ){
			$row['sayfa_id'];
			$row['sayfa_olusturucu'];
			$row['sayfa_adi'];
		?> 
		<div class="col-sm-4"> 
		<img src="resim/abc.jpg" class="img-thumbnail" style="width:100%; margin-bottom:5px;" alt="Image">
		<?php	
			echo "<a href='sayfa.php?id=".$row["sayfa_id"]."&baskadeger=".$row["sayfa_olusturucu"]."&d=".$row["sayfa_adi"]."'>"; ?> 
			<p style="text-transform: uppercase; font-size:16px;"><?php echo $row['sayfa_adi']; ?> || <?php echo $row['sayfa_ilce']; ?></p>  
			</a>
			<?php	
			echo "<a href='sayfagüncelleme.php?id=".$row["sayfa_id"]."'>"; ?> 
			<p style="text-transform: uppercase; font-size:16px;">Sayfa Güncelleme</p>  
			</a>
			<?php	
			echo "<a href='sil.php?id=".$row["sayfa_id"]."'";?>< onclick="return confirmDel();">
			<p style="text-transform: uppercase; font-size:16px;">Sayfa Sil</p>  
			</a>
		</div>
		<?php
		}
	}
 
?>
   
  </div>
</div>
<br><br>

</body>
</html>