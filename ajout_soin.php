<?php
	// Avant tout contenu HTML, on lance une session
	session_start();
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>

<html>
	<head>
	<script type="text/javascript" src="date_heure.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>ajout_soin</title></head>
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
		<p>Vous etes actuellement connecte en tant que <a href="profile.php?id=<?php echo $_SESSION["login"]; ?>"><?php echo $_SESSION["login"]; ?></a>.</p>
		<p>Voulez-vous vous <a href="logout.php">deconnecter</a> ?</p>
<?php
	}
	// On affiche d'abord les éventuelles erreurs
	foreach($erreurs as $err) {
		echo "\t\t<p><strong>$err</strong></p>\n";
	}
	
	$base = mysqli_connect('localhost', 'root', '','bdd_hopital_cfdj');
	mysqli_select_db($base,'bdd_hopital_cfdj'); 
	
	if (!isset($_POST["nom"]) || $_POST["nom"] == "") {
		// il manque le nom du patient ou il est vide
		// On ajoute un message d'erreur
		$erreurs[] = "Veuillez renseigner le nom du patient.";
	}
	
	if (!isset($_POST["prenom"]) || $_POST["prenom"] == "") {
		// il manque le prenom du patient ou il est vide
		// On ajoute un message d'erreur
		$erreurs[] = "Veuillez renseigner le prenom du patient.";
	}
		
	if (!isset($_POST["date_naissance"]) || $_POST["date_naissance"] == "") {
		$erreurs[] = "Veuillez renseigner la date de naissance du patient.";
	}
		
	if (!isset($_POST["soin"]) || $_POST["soin"] == "") {
		$erreurs[] = "Veuillez renseigner le soin a administrer.";
	}
		
	if (!isset($_POST["date"]) || $_POST["date"] == "") {
		// il manque la date du diagnostique ou il est vide
		// On ajoute un message d'erreur
		$erreurs[] = "Veuillez renseigner la date du diagnostique du patient.";
		}
	
	if (empty($erreurs)) {
	
		$requete1='SELECT id_patient FROM Patient WHERE nom_personne="'.$_POST['nom'].'" AND prenom_personne="'.$_POST['prenom'].'" AND date_naissance="'.$_POST['date_naissance'].'"';
		$ajout1 = mysqli_query($base,$requete1);
		$donnees1 = mysqli_fetch_array($ajout1);
		// ici on a donc recupéré L' id_patient de notre patient.
		
		if (empty($donnees1)){
			header("location: result_ajout_soin2.php");		
			// si on ne trouve pas d'id_patient, c'est qu'il n'existe pas donc message d'erreur.
		}
		
		else {
			$requete='INSERT INTO soin(id_patient,description, date) VALUES ("'.$donnees1['id_patient'].'","'.$_POST['soin'].'","'.$_POST['date'].'")';
			$ajout=mysqli_query($base,$requete);
		// on ajoute le soin.
		
			if ($ajout) {
				header("location: result_ajout_soin.php");
				// si il n'y a pas d'erreur, le soin a bien été insere.
			}
		}

	}
	
	else {
		foreach($erreurs as $err) {
	
			echo "\t\t<p><strong>".$err."</strong></p>\n";
		}
		
		?>
		<br>
	
		<form action="ajout_soin1.php" method="post">
			<p><input value="Revenir a la feuille de soin" name="envoi" type="submit"></p>
		</form> 
		<HR WIDTH="50%">	
		<br>
		<form action="retour_accueil.php" method="post">			<p><input value="Cliquez ici pour revenir au menu principal" type="submit"></p>
		</form> 
		
		<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
	
	<HR WIDTH="50%">
	<p><span id="date_heure"></span>
	<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>

		<?php
	}
		
	mysqli_close($base);
?>
	</body>
</html>