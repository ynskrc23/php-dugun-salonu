<?php
	require_once("baglan.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ankara Düğün Salonları</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="alert/css/alertify.css" />
  <link rel="stylesheet" href="alert/css/themes/default.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="alert/alertify.js"></script>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Ankara Düğün Salonları</h1>      
    <p>Doğru, Dürüst & Güvenilir Adres</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      
    </div>
    <ul class="nav navbar-nav"></ul>
     <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#exampleModal1"><span class="glyphicon glyphicon-log-in"></span> Sisteme Üye Ol</a></li>
		<li><a href="#" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-log-in"></span> Sisteme Giriş</a></li>
      </ul>
  </div>
</nav>


<!-- php giriş kontrol -->

	<?php
		session_start();
		
		$v = $db->prepare("select * from uyeler where uye_eposta=? and uye_sifre=?");
		
		if($_POST){
			
			$uye_eposta = $_POST["uye_eposta"];
			$uye_sifre = $_POST["uye_sifre"];
			
		$v->execute(array($uye_eposta,$uye_sifre));
		
		$x = $v->fetch(PDO::FETCH_ASSOC);
		
		$d = $v->rowCount();
		
		if($d){

			$_SESSION["uye"] = $x["uye_yetkili"];
			$_SESSION["id"] = $x["uye_id"];
			$_SESSION["durum"] = $x["uye_durum"];
			$_SESSION["ilce"] = $x["uye_ilce"];
			$_SESSION["mekan"] = $x["uye_mekanadi"];
			$_SESSION["tel"] = $x["uye_tel"];
			$_SESSION["kapasite"] = $x["uye_kapasite"];
			

			if($_SESSION["durum"] == 1){
				header("location:kullaniciekrani.php");
			}

		else {
				echo '<div class="alert alert-danger">Üyeliğiniz Henüz Onaylanmadı</div>';
				header("refresh: 2; url=index.php"); 
			}

		}

		else{
			echo '<div class="alert alert-danger">Kullanıcı Adı veya Parola Yanlış</div>';
			header("refresh: 2; url=index.php");
		}	

		}

	?>

<!-- php giriş kontrol -->

	 <!--sisteme giriş modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title"  id="exampleModalLabel" style="font-size:20px; text-align:center">Sisteme Giriş</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <form action="" method="post">
			<div class="form-group">
			  <input type="text" class="form-control" name="uye_eposta" id="recipient-name" placeholder="E-Postanızı Giriniz">
			</div>
			<div class="form-group">
			  <input type="password" class="form-control" name="uye_sifre" id="message-text"  placeholder="Şifrenizi Giriniz"/>
			</div>
		  
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
		  <button type="submit" name="submit" class="btn btn-primary">Giriş Yap</button>
		</div>
		</form>
	  </div>
	</div>
	</div>
	  <!-- modal bitiş -->
	
	<!--sisteme üye ol modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel" style="font-size:20px; text-align:center">Sisteme Üye Ol</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
		  <form action="" method="post">
			<div class="form-group">
			  <input type="text" class="form-control" name="uye_mekanadi" id="recipient-name" placeholder="Mekanın Adı">
			</div>
			<div class="form-group">
			  <input class="form-control" name="uye_yetkili" id="message-text"  placeholder="Yetkili İsim"/>
			</div>
			<div class="form-group">
			  <input class="form-control" name="uye_eposta" id="message-text1"  placeholder="E-mail"/>
			</div>
			<div class="form-group">
			  <input class="form-control" name="uye_sifre" id="message-text2"  placeholder="Şifre"/>
			</div>
			<div class="form-group">
			  <input class="form-control" name="uye_tel" id="message-text3"  placeholder="Telefon"/>
			</div>
			<div class="form-group">
      <select id="il" name="uye_il" class="form-control">
				<option selected>Ankara</option>
      </select>
			</div>
			<div class="form-group">
      <select id="ilce" name="uye_ilce" class="form-control">
				<option selected>Akyurt</option>
				<option selected>Altındağ</option>
				<option selected>Altınpark</option>
				<option selected>Batıkent</option>
				<option selected>Cebeci</option>
				<option selected>Çankaya</option>
				<option selected>Çayyolu</option>
				<option selected>Çubuk</option>
				<option selected>Elvankent</option>
				<option selected>Eryaman</option>
				<option selected>Etimesgut</option>
				<option selected>Gölbaşı</option>
				<option selected>Kazan</option>
				<option selected>Keçiören</option>
				<option selected>Maltepe</option>
				<option selected>Mamak</option>
				<option selected>Polatlı</option>
				<option selected>Pursaklar</option>
				<option selected>Sincan</option>
				<option selected>Yenimahalle</option>
      </select>
    	</div>
		<div class="form-group">
			<textarea class="form-control" name="uye_mekan" id="exampleFormControlTextarea1" rows="4"  
			placeholder="Mekanınız Hakkında Kısa Bilgi"></textarea>
  		</div>
		<div class="form-group">
			<input class="form-control" name="uye_kapasite" id="message-text4"  placeholder="Mekanın Kapasitesi Aralığı"/>
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

	  <!-- modal bitiş -->
	  
	<!-- php uye ekleme -->
<?php 
	if($_POST){
		@$uye_mekanadi = $_POST["uye_mekanadi"];
		@$uye_yetkili = $_POST["uye_yetkili"];
		@$uye_eposta = $_POST["uye_eposta"];
		@$uye_sifre = $_POST["uye_sifre"];
		@$uye_tel = $_POST["uye_tel"];
		@$uye_il = $_POST["uye_il"];
		@$uye_ilce = $_POST["uye_ilce"];
		@$uye_mekan = $_POST["uye_mekan"];
		@$uye_kapasite = $_POST["uye_kapasite"];

		$ekle=$db->prepare("insert into uyeler set uye_mekanadi=?,uye_yetkili=?,uye_eposta=?,uye_sifre=?,uye_tel=?,uye_il=?,uye_ilce=?,uye_mekan=?,uye_kapasite=?");
		$ekle->execute(array(	$uye_mekanadi,$uye_yetkili,	$uye_eposta,$uye_sifre,$uye_tel,$uye_il,$uye_ilce,$uye_mekan,$uye_kapasite));
	}
?>
<!-- php uye ekleme -->
	  
<div class="container">
<div class="row">
  <div class="col-sm-8">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="resim/evlilik1.jpg" style="width:800px; height:400px;" alt="Image">
          <div class="carousel-caption">
          </div>      
        </div>

        <div class="item">
          <img src="resim/evlilik2.jpg" style="width:800px; height:400px;" alt="Image">
          <div class="carousel-caption">
          </div>      
        </div>
		<div class="item">
          <img src="resim/abc.jpg" style="width:800px; height:400px;" alt="Image">
          <div class="carousel-caption">
          </div>      
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  
  <div class="col-sm-4">
  <div class="col-lg-12 md-6 sm-6 xs-hidden">
	<form action="arama.php" method="get">
      <input type="text" style="width:90%;" placeholder="Lütfen Düğün Salonun Adını Giriniz" name="ara">
      <button type="submit" name="btn_ara" style="width:29px; height:25px;"><i class="fa fa-search"></i></button>
    </form>
  </div><br><br>
	
	
    <div class="sagkutu">
	<?php 
	$veri = $db->prepare("SELECT DISTINCT  sayfa_ilce FROM sayfalar");
	$veri->execute();
	 
	if ($veri->rowCount() ){
		foreach( $veri as $row ){
			$row['sayfa_ilce'];
		}
	}
?>
		<a href="sayfalisteleme.php?variable=Akyurt"><p>Akyurt Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Altındağ"><p>Altındağ Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Altınpark"><p>Altınpark Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Batıkent"><p>Batıkent Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Cebeci"><p>Cebeci Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Çankaya"><p>Çankaya Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Çayyolu"><p>Çayyolu Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Çubuk"><p>Çubuk Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Elvankent"><p>Elvankent Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Eryaman"><p>Eryaman Salonları</p></a>
    </div>
	<div class="sagkutu">
		<a href="sayfalisteleme.php?variable=Etimesgut"><p>Etimesgut Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Gölbaşı"><p>Gölbaşı Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Kazan"><p>Kazan Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Keçiören"><p>Keçiören Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Maltepe"><p>Maltepe Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Mamak"><p>Mamak Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Polatlı"><p>Polatlı Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Pursaklar"><p>Pursaklar Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Sincan"><p>Sincan Salonları</p></a>
		<a href="sayfalisteleme.php?variable=Yenimahalle"><p>Yenimahalle Salonları</p></a>
	</div>
  </div>
</div>
<hr>
</div>
<div class="container text-center">    
  <h3>Düğün Salonlarımız</h3>
  <br>
    <div class="row">
    <?php 
	$veri = $db->prepare("SELECT * FROM sayfalar");
	$veri->execute();
	 
	if ( $veri->rowCount() ){
		foreach( $veri as $row ){
			$row['sayfa_id'];
			$row['sayfa_olusturucu'];
			$row['sayfa_adi'];
		?> 
		<div class="col-sm-2"> 
		<img src="resim/abc.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;" alt="Image">
		<?php	
			echo "<a href='sayfa.php?id=".$row["sayfa_id"]."&baskadeger=".$row["sayfa_olusturucu"]."&d=".$row["sayfa_adi"]."'>"; ?> 
			<p style="text-transform: uppercase;"><?php echo $row['sayfa_adi']; ?> || <?php echo $row['sayfa_ilce']; ?></p>  
			</a>
		</div>
		<?php
		}
	}
?>
	</div>
  </div>
</div><br>

<div class="yazialani">
		<h2>Ankara Düğün Salonları</h2>
		<p>Ankara’nın düğün salonlarını sitemiz farkıyla gezmek için doğru yerdesiniz, 
		Ankara Düğün Salonlarını 360 derece gezerken fark edeceksiniz ki mekana kadar gitmeden de orayı görebileceksiniz
		ve böylece uzun uzun dolaşmakla vakit harcamayacaksınız. 
		Düğün salonlarını 360 derece farkıyla gezebileceğiniz sitemizde mutlaka tercihinize uygun bir mekan bulacaksınız..</p>

		<p>Ankara Düğün Salonları sitesinde, Ankara ilindeki ve Ankara ilçelerindeki düğün salonlarını yayınladığımız sitemizle umarız 
			siz yeni yuva kuracak kardeşlerimize bir ışık tutmuş ve yardımcı olmuşuzdur.</p>

		<p>Ankara düğün salonlarını farklı kılan sitemizi umarız beğenir ve arkadaşlarınıza tavsiye edersiniz.</p>

		<p>Ankara Düğün Salonları anasayfasındaki orta kısımda bulunan vitrin mekanlarından dilediğiniz düğün mekanını seçebilir 
		veya arama bölümünden ismiyle arayabilir yada istediğiniz ilçeyi seçerek düğününüzü planlamaya başlayabilirsiniz. 
		Mekanın sayfasına ulaştığınızda Ücretsiz Teklif Formu bölümünü kullanarak mesajınızı gönderebilirsiniz 
		veya İletişim Bilgilerine tıklayarak telefon ile arayarak mekan yetkilisi ile görüşebilirsiniz.</p>

		<p>En özel gününüzü unutulmaz kılmak için doğru yerdesiniz.</p>

		<p>Ankara Düğün Salonları</p>

		<p>Ankara Düğün Mekanları</p>

		<p>Ankara Kır Düğünü</p>

		<p>Ankara Otel Düğünü</p>

		<p>Ankara Havuzbaşı Düğünü</p>

		<p>kategorilerinde farklı seçenekler, farklı tarz düğün konseptleri ve daha fazlası sizin için burada…</p>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
