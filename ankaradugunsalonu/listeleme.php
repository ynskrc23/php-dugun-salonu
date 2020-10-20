<?php
	require_once("baglan.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <title>Ankara Düğün Salonları</title>
    <link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
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
if (!isset($id)) {
		$id = $_GET['id'];
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
		$a = $db->query("SELECT * FROM sayfalar", PDO::FETCH_ASSOC);
		if ( $a->rowCount() ){
		   foreach( $a as $row ){
			  $row['sayfa_id'];
		   }
		}
		echo "<a href='upload.php?id=".$row["sayfa_id"]."' style='font-size:20px;'>Fotograf Ekleme Alanı</a>";
	?>
    </div>

    <div id="Adres" class="tabcontent">
    <h3>Adresimiz</h3>
    <?php echo $veri['sayfa_adres']; ?>
    </div>

    </form>
</div>
<div class="listelemealanisag">
    <h2><?php echo $veri['sayfa_adi']; ?></h2>
    <p style="text-transform: capitalize;">Yetkili Kişi&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp<?php echo $veri['sayfa_yetkili']; ?></p>
    <p>Kapasite&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp<?php echo $veri['sayfa_kapasite']; ?></p>
    <p>Ücret&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp<?php echo $veri['sayfa_ucret']; ?></p>
    <p>Telefon No&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp<?php echo $veri['sayfa_tel']; ?></p>
    <br>
    <!-- Modal -->
    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">E-Mail Gönder</button>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="margin-left:150px;">E-Mail Gönder</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" onsubmit="return false">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Konu</label>
                <input type="text" class="form-control" name="konu" id="recipient-name">
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Ad-Soyad</label>
                <input class="form-control" name="ad" id="message-text"/>
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">E-Mail</label>
                <input class="form-control" name="email" id="message-text1"/>
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Telefon</label>
                <input class="form-control" name="telefon" id="message-text2"/>
                </div>
                <div class="form-group">
                <label for="exampleFormControlTextarea1">Mesajınız</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            <button type="button" name="gönder" class="btn btn-primary">Gönder</button>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal bitiş -->
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
                <form action="" onsubmit="return false">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Ad-Soyad</label>
                <input type="text" class="form-control" name="ad" id="recipient-name">
                </div>
                <div class="form-group">
                <label for="exampleFormControlTextarea1">Yorumunuz</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            <button type="button" name="gönder" class="btn btn-primary">Gönder</button>
            </div>
        </div>
        </div>
    </div>
     <!-- Modal bitiş -->
     <br><br><p></p>
    <h5 style="margin-left:30px; font-size:20px;">Hemen Arayın: <?php echo "".$_SESSION["tel"].""; ?></h5>
</div>
</div>
	
	<?php 
		$veri = $db->query("SELECT * FROM sayfalar", PDO::FETCH_ASSOC);
		if ( $veri->rowCount() ){
		   foreach( $veri as $row ){
			  $row['sayfa_id'];
			  $row['sayfa_olusturucu'];
			  $row['sayfa_adi'];
		   }
		}
		echo "<a href='sayfa.php?id=".$row["sayfa_id"]."&baskadeger=".$row["sayfa_olusturucu"]."&d=".$row["sayfa_adi"]."' style='margin-left:90px; margin-top:50px; margin-bottom:30px; font-size:20px;'>Sayfayı Önizleme</a>";
	?>
	
	<br><br>
</body>
</html>