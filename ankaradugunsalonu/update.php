<?php require_once("baglan.php"); ?>

<?php
		if(isset($_POST['okundu'])){
			$idArr=$_POST['checked_id'];
			foreach($idArr as $id){
				$guncelle = $db->prepare("UPDATE email SET email_okundu=? WHERE email_id =$id");
				$guncelle->execute(array('1'));
				$hata = $guncelle->errorInfo();
				
			} 	
			header("Location:bildirim.php");
		}	
	
?>

<?php
		if(isset($_POST['teklif'])){
			$idArr=$_POST['checked_id'];
			foreach($idArr as $id){
				$guncelle = $db->prepare("UPDATE teklif SET teklif_incelendi=? WHERE teklif_id =$id");
				$guncelle->execute(array('1'));
				$hata = $guncelle->errorInfo();
				
			} 	
			header("Location:teklif.php");
		}	
	
?>


