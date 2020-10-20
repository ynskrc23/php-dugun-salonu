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
?>

<div class="container text-center">    
  <div class="row">
	<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file_img[]" multiple />
	<input type="submit" name="btn_upload" value="Fotograf Ekle">	
	</form>
  </div>
	<?php
	if(isset($_POST['btn_upload']))
	{
		for($i = 0; $i < count($_FILES['file_img']['name']); $i++)
		{
			$filetmp = $_FILES["file_img"]["tmp_name"][$i];
			$filename = $_FILES["file_img"]["name"][$i];
			$filetype = $_FILES["file_img"]["type"][$i];
			$fileimage = file_get_contents($filetmp);
			$filepath = "image/".$filename;
			
		move_uploaded_file($filetmp,$filepath);
		
		$ekle=$db->prepare("insert into resim set resim_isim=?,resim_yol=?,resim_tip=?,resim_image=?,resim_sayfaid=?");
		$ekle->execute(array($filename,$filepath,$filetype,$fileimage,$id));
		header("location:sayfalarim.php");
		}
	}
	?>
</div>

</body>
</html>
