<?php require_once("baglan.php"); ?>
<?php 
	$veri = $db->prepare("DELETE FROM sayfalar WHERE sayfa_id = :id");
	$delete = $veri->execute(array('id' => $_GET['id']));
	header("location:sayfalarim.php");
?>

<?php
		if(isset($_POST['sil'])){
			$idArr=$_POST['checked_id'];
			foreach($idArr as $id){
				$query = $db->prepare("DELETE FROM resim WHERE resim_id=$id");
				$delete = $query->execute();
				
			} 	
			header("Location:sayfalarim.php");
		}	
	
?>