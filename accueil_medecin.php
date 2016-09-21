<?php
	// Avant tout contenu HTML, on lance une session
	session_start();
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>

<!DOCTYPE html>
<html>
	<head>
	
	<script type="text/javascript" src="date_heure.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8"/>
	
	<title>Accueil</title>
	
	</head>

	<body bgcolor = "#A4C4E9" text = "#000000" >

	<hr align = "center" width = 50% size = 3 color = "#00000">
	<div style="float: left;"><IMG SRC="photo.jpg"></div>
	<div style="float: right;"><IMG SRC="photo.jpg"></div>
	<h1><b>.oO Hopital GALAN Oo.</b></h1>
	<hr align = "center" width = 50% size = 3 color = "#00000">
	<br>

<?php	
	if(isset($_SESSION["login"])) {
?>
	<p>Vous êtes actuellement connecté en tant que <a href="profile.php?id=<?php echo $_SESSION["login"]; ?>"><?php echo $_SESSION["login"]; ?></a>.</p>
	<p>Voulez-vous vous <a href="logout.php">déconnecter</a> ?</p>
<?php
	}
	if (isset($_POST["send"])){
	// On affiche d'abord les éventuelles erreurs
	foreach($erreurs as $err) {
		echo "\t\t<p><strong>$err</strong></p>\n";
	}	
?>
	<?php
	if($_POST['choix'] == 'default')
		echo 'Veuillez faire un choix.';
	if($_POST['choix'] == 'ajout_diag')
		header('location: ajout_diagnostique1.php');
	if($_POST['choix'] == 'details')
		header('location: check_patient1.php');
	if($_POST['choix'] == 'ajout_soin')
		header('location: ajout_soin1.php');
	if($_POST['choix'] == 'liste_patient')
		header('location: liste_patient.php');
	if($_POST['choix'] == 'liste_medecin_infirmier')
		header('location: liste_medecin_infirmier.php');
	if($_POST['choix'] == 'liste_reunion')
		header('location: liste_reunion.php');
	if($_POST['choix'] == 'bilan_patient')
		header('location: bilan_patient1.php');
	}
	?>
	
	<p>Que voulez vous faire?</p>
<form action="accueil_medecin.php" method="post">
	<p><select name="choix"></p>
		<option value="default">Choisissez</option>
		<option value="ajout_diag">rédiger un compte rendu de visite médicale</option>
		<option value="details">voir les détails concernant un patient</option>
		<option value="ajout_soin">ajouter un soin à administrer</option>
		<option value="liste_medecin_infirmier">lister les médecins et infirmiers de votre service </option>
		<option value="liste_patient">liste des patients qui occupent les chambres de votre service </option>
		<option value="liste_reunion">consulter la liste des reunions </option>
		<option value="bilan_patient">consulter le bilan d'un patient </option>
	</select>
	<input name="send" type="submit"/>
</form>

<HR WIDTH="50%">
	<br>
	
	<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
	
	<HR WIDTH="50%">
	<p><span id="date_heure"></span>
	<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>


	</body>
</html>
