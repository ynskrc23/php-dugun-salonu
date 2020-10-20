<?php
	require_once("baglan.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <title>Ankara Düğün Salonları</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
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

<?php 
	session_start();
	if($_SESSION){               
		"Hoşgeldiniz ".$_SESSION["uye"].",".$_SESSION["id"].",".$_SESSION["tel"].",".$_SESSION["kapasite"].",".$_SESSION["mekan"]." ";		
	}
?>

<?php 
if (!isset($id,$baskadeger,$d)) {
		$id = $_GET['id'];
		$baskadeger = $_GET['baskadeger'];
		$d= $_GET['d'];
	}	
	$veri= $db->query("SELECT * FROM sayfalar where sayfa_id=$id")->fetch(PDO::FETCH_ASSOC);
?>


<div class="listelemealani">
    <div class="listelemealanisol">
    <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Hakkımızda')">Hakkımızda</button>
    <button class="tablinks" onclick="openCity(event, 'Hizmet')">Hizmetler</button>
    <button class="tablinks" onclick="openCity(event, 'Menü')">Menü</button>
    <button class="tablinks" onclick="openCity(event, 'Fotograf')">Fotoğraf Galerisi</button>
    <button class="tablinks" onclick="openCity(event, 'Adres')">Adres</button>
    <button class="tablinks" onclick="openCity(event, 'Yorum')">Yorumlar</button>
    <button class="tablinks" onclick="openCity(event, 'Teklif')">Ücretsiz Teklif Verme</button>
    </div>

    <div id="Hakkımızda" class="tabcontent">
    <h3>Hakkımızda</h3>
		<?php echo $veri['sayfa_hakkimizda']; ?>
    </div>

    <div id="Hizmet" class="tabcontent">
    <h3>Hizmetler</h3>
		<?php echo $veri['sayfa_hizmet']; ?>
    </div>

    <div id="Menü" class="tabcontent">
    <h3>Menü</h3>
		<?php echo $veri['sayfa_menu']; ?>
    </div>

    <div id="Fotograf" class="tabcontent">
    <h3>Fotoğraf Galerisi</h3>
	<?php
	$a = $db->prepare("SELECT * FROM resim where resim_sayfaid=$id"); 
	$a ->execute();
    if($a->rowCount()){ 
		foreach($a as $row){ ?>      
			<?php echo "<img src='image/".$row['resim_isim']."' class='img-thumbnail' style='margin-left:20px; margin-top:20px;' >";
			}
		}
	?>
    </div>

    <div id="Adres" class="tabcontent">
    <h3>Adresimiz</h3>
		<?php echo $veri['sayfa_adres']; ?>
    </div>
	
    <div id="Yorum" class="tabcontent">
		<?php
		// yorumları listele
		  $c = $db->prepare("SELECT * FROM yorumlar where yorumlar_sayfaid=?");
		  $c->execute(array($id));
		  
		  $x = $c->fetchAll();
		  $xx = $c->rowCount();
		  
		  if($xx){
            echo "<div class='w'>Bu Düğün Salonuna ".$xx." Kere Yorum Yapılmış.</div>";		
			foreach($x as $b){	
				?>
					<div class="yorum">
					<h4> Ekleyen : <?php echo $b["yorumlar_adsoyad"];?> <span>Tarih :  <?php echo $b["yorumlar_tarih"];?></h4>
					<p><?php echo $b["yorumlar_mesaj"];?></p>
					</div>
				<?php
			}  
		  }
		  else{		  
			echo "<div class='mesajiniz'>Hiç Yorum Yazan Olmamış İlk Yazan Sen Ol</div>";  
		  }
		  
		  // yorumları listele bitisi 
		  ?>
    </div>

    <div id="Teklif" class="tabcontent">
    <h3>Ücretsiz Teklif Verme</h3>
    <form action="" method="post">
        <div class="form-group">
		    <label for="message-text" class="col-form-label">Ad-Soyad</label>
		    <input class="form-control" name="teklif_adsoyad" id="message-text"/>
		    </div>
		    <div class="form-group">
		    <label for="message-text" class="col-form-label">E-mail</label>
		    <input class="form-control" name="teklif_email" id="message-text1"/>
			</div>
			<div class="form-group">
			<label for="message-text" class="col-form-label">Telefon</label>
			<input class="form-control" name="teklif_tel" id="message-text2"/>
            </div>
            <div class="form-group">
			<label for="exampleFormControlTextarea1">İsteklerinizi Belirtiniz</label>
            <textarea class="form-control" name="teklif_istek"  id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" name="gönder" style="margin-left:320px;" class="btn btn-primary">Teklif Ver</button>
        </div>
    </form>
	<!-- Php teklif gönderme -->
	<?php
	
	if(isset($_POST['gönder']))
	{
		$teklif_adsoyad = $_POST["teklif_adsoyad"];
		$teklif_email = $_POST["teklif_email"];
		$teklif_tel = $_POST["teklif_tel"];
		$teklif_istek = $_POST["teklif_istek"];
		$teklif_sayfaid = $id;
		$teklif_sayfaolusturucu = $baskadeger;
		
		$ekle=$db->prepare("insert into teklif set teklif_adsoyad=?,teklif_email=?,teklif_tel=?,teklif_istek=?,teklif_sayfaid=?,teklif_sayfaolusturucu=?");
		$ekle->execute(array($teklif_adsoyad,$teklif_email,$teklif_tel,$teklif_istek,$teklif_sayfaid,$baskadeger));
	}
	?>
	<!-- Php teklif gönderme -->
</div>

<div class="listelemealanisag">
    <h2><?php echo $veri['sayfa_adi']; ?></h2>
    <p style="text-transform: capitalize;">Yetkili Kişi&nbsp&nbsp&nbsp&nbsp&nbsp:<?php echo $veri['sayfa_yetkili']; ?>&nbsp&nbsp</p>
    <p>Kapasite&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<?php echo $veri['sayfa_kapasite']; ?>&nbsp&nbsp&nbsp</p>
    <p>Ücret&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<?php echo $veri['sayfa_ucret']; ?>&nbsp&nbsp&nbsp</p>
    <p>Telefon No&nbsp&nbsp&nbsp:<?php echo $veri['sayfa_tel']; ?>&nbsp&nbsp&nbsp</p>
    <br>
    <!-- Modal -->
    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">E-Mail Gönder</button>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="margin-left:220px;">E-Mail Gönder</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Konu</label>
                <input type="text" class="form-control" name="email_konu" id="recipient-name">
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Ad-Soyad</label>
                <input class="form-control" name="email_adsoyad" id="message-text"/>
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">E-Mail</label>
                <input class="form-control" name="email_eposta" id="message-text1"/>
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Telefon</label>
                <input class="form-control" name="email_telefon" id="message-text2"/>
                </div>
                <div class="form-group">
                <label for="exampleFormControlTextarea1">Mesajınız</label>
                <textarea class="form-control" name="email_mesaj" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
		  <button type="submit" name="submit" class="btn btn-primary">Gönder</button>
		</div>
		 </form>
        </div>
        </div>
    </div>
    <!-- Modal bitiş -->
	
	<!-- Php email gönderme -->
	<?php
	if(isset($_POST['submit']))
	{
		$email_konu = $_POST["email_konu"];
		$email_adsoyad = $_POST["email_adsoyad"];
		$email_eposta = $_POST["email_eposta"];
		$email_telefon = $_POST["email_telefon"];
		$email_mesaj = $_POST["email_mesaj"];
		$email_sayfaolusturucu = $baskadeger;
		$email_sayfaid = $id;
		
		$ekle=$db->prepare("insert into email set email_konu=?,email_adsoyad=?,email_eposta=?,email_telefon=?,email_mesaj=?,email_sayfaolusturucu=?,email_sayfaid=?");
		$ekle->execute(array($email_konu,$email_adsoyad,$email_eposta,$email_telefon,$email_mesaj,$email_sayfaolusturucu,$email_sayfaid));
	}
	?>
	<!-- Php email gönderme -->
	
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
    <!-- Modal -->
    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal1">Yorum Gönder</button>
    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="margin-left:150px;">Yorum Gönder</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Ad-Soyad</label>
                <input type="text" class="form-control" name="yorumlar_adsoyad" id="recipient-name">
                </div>
                <div class="form-group">
                <label for="exampleFormControlTextarea1">Yorumunuz</label>
                <textarea class="form-control" name="yorumlar_mesaj" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            <button type="submit" name="yorum" class="btn btn-primary">Gönder</button>
            </div>
			</form>
        </div>
        </div>
    </div>
     <!-- Modal bitiş -->
	 
	 <!-- Php yorum gönderme -->
	<?php
	if(isset($_POST['yorum']))
	{	
		$today = date('d.m.Y H:i:s');
		$yorumlar_adsoyad = $_POST["yorumlar_adsoyad"];
		$yorumlar_mesaj = $_POST["yorumlar_mesaj"];
		$yorumlar_tarih = $today;
		$yorumlar_sayfaid = $id;
		
		$ekle=$db->prepare("insert into yorumlar set yorumlar_adsoyad=?,yorumlar_mesaj=?,yorumlar_tarih=?,yorumlar_sayfaid=?");
		$ekle->execute(array($yorumlar_adsoyad,$yorumlar_mesaj,$yorumlar_tarih,$yorumlar_sayfaid));
		header("location:sayfa.php");
	}
	?>
	<!-- Php yorum gönderme -->
	 
     <br><br><p></p>
    <h5 style="margin-left:30px; font-size:20px;">Hemen Arayın:<?php echo $veri['sayfa_tel']; ?> </h5>
</div>
</div>

</body>
</html>