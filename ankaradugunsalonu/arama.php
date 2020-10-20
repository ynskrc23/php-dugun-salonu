<?php require_once("baglan.php"); ?>
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

<h2 style="text-align:center; margin-top:20px; margin-bottom:40px;">Arama Sonuçları</h2>
<div class="container text-center">    
  <div class="row">
	<?php 
		$ara=$_GET['ara'];
		$sorgu=$db->query("select * from sayfalar where sayfa_adi like '%$ara%' ");
		$miktar=$sorgu->rowCount();
		if($sorgu){
			if($miktar>0){
				foreach($sorgu as $row){
					$row['sayfa_id'];
					$row['sayfa_olusturucu'];
					$row['sayfa_adi'];
					?>
					<div class="col-sm-4"> 
						<img src="resim/abc.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;" alt="Image">
						<?php	
						echo "<a href='sayfa.php?id=".$row["sayfa_id"]."&baskadeger=".$row["sayfa_olusturucu"]."&d=".$row["sayfa_adi"]."'>"; ?>
						<p style="text-transform: uppercase; font-size:16px; margin-bottom:35px;"><?php echo $row['sayfa_adi']; ?> || <?php echo $row['sayfa_ilce']; ?></p> 
						</a>
					</div><?php 
					}
				}else{
					echo "Aranan Kelime Bulunamadı.";
				}
			}else{
				echo "Veri Çekilemedi";
			}
	?>
  </div>
</div>
<br><br><br>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
