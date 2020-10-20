<?php require_once("baglan.php"); ?>
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
  <?php
	$a = $db->prepare("SELECT * FROM resim where resim_sayfaid=$id"); 
	$a ->execute();
    if($a->rowCount()){ 
		foreach($a as $row){ ?>  
		<form action="sil.php" method="post">
			<center><table class="table table-bordered"style="width:50%;">
				<thead>
				<tr>
					<th>#</th>
					<th>Resim</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row["resim_id"]; ?> "/></td>
					<td style="text-align:left;"><?php echo "<img src='image/".$row['resim_isim']."' class='img-thumbnail' style='height:150px; width:250px; margin-left:125px;' >";?></td>
				</tr>
				</tbody>
				</table></center>
			<?php
			}
		}
	?>
	<input type="submit" name="sil" id="button" value="Fotografları Sil" onclick="return confirmDel(); " /><br><br>
		</form>
  </div>
</div>

</body>
</html>
