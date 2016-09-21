<?php
	// Avant tout contenu HTML, on lance une session
	session_start(); // À faire dans toutes les pages pour rester connecter à son compte
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>

<html>
	<head><title>check_patient</title>
	<script type="text/javascript" src="date_heure.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body bgcolor = "#A4C4E9" text = "#000000" >
	<hr align = "center" width = 50% size = 3 color = "#00000">
	<div style="float: left;"><IMG SRC="photo.jpg"></div>
	<div style="float: right;"><IMG SRC="photo.jpg"></div>
	<h1><b>.oO Hopital GALAN Oo.</b></h1>


	<br>

<?php	
	if(isset($_SESSION["login"])) {
?>
	<p>Vous etes actuellement connecte en tant que <a href="profile.php?id=<?php echo $_SESSION["login"]; ?>"><?php echo $_SESSION["login"]; ?></a>.</p>
	<p>Voulez-vous vous <a href="logout.php">deconnecter</a> ?</p>
<?php
	
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
		// il manque la date de naissance ou il est vide
		// On ajoute un message d'erreur
		$erreurs[] = "Veuillez renseigner la date de naissance du patient.";
		}
	
	if (empty($erreurs)) {
	
		$requete='SELECT id_patient,nom_personne,prenom_personne, date_naissance FROM Patient WHERE nom_personne="'.$_POST['nom'].'" AND prenom_personne="'.$_POST['prenom'].'" AND date_naissance="'.$_POST['date_naissance'].'"';
		$ajout = mysqli_query($base,$requete);
		$donnees = mysqli_fetch_array($ajout);
		// ici on a donc recupéré L' id_patient de notre patient.
		
		if (empty($donnees)){
			header("location: result_check_patient2.php" );
			// si on ne trouve pas d'id_patient, c'est qu'il n'existe pas donc message d'erreur.
		}
		
		else {
		echo '<p><ul><li> nom :' . $donnees['nom_personne'] . '</li></p>';
		echo '<p><li> prenom :' . $donnees['prenom_personne'] . '</li></p>';
		echo '<p><li> ne(e) le : ' . $donnees['date_naissance'] . '</li></p>';
		echo '<p></ul></p>';	
	
		$requete2='SELECT Count(*) FROM Sejour WHERE id_patient = '.$donnees['id_patient'].'';
		$ajout2 = mysqli_query($base,$requete2);
		$donnees2 = mysqli_fetch_array($ajout2);
		//On compte son nombre total de sejour.
		
		echo '<p><u> Le patient a effectue '.$donnees2['Count(*)'].' sejour(s) :  </u></p>';
			
		$requete3='SELECT date_arrivee, date_sortie FROM Sejour WHERE id_patient = '.$donnees['id_patient'].'';
		$ajout3 = mysqli_query($base,$requete3);
		$donnees3 = mysqli_fetch_array($ajout3);
		// on selectionne les dates correspondantes à tous ces séjours.

		echo '<ul>';
		while ($donnees3) {
			if (empty($donnees3['date_sortie'])){
				echo "<li> le patient est dans l'hopital et il est arrive le ".$donnees3['date_arrivee']." <li>";
				// ceci correspond au cas ou le patient est actuellement en service.
			}
			else {
				echo "<li>date d'arrivee : ".$donnees3['date_arrivee']."<li>";
				echo "<li>date de sortie : ".$donnees3['date_sortie']."</li>";
			}
?> <br><br> <?php
		$donnees3 = mysqli_fetch_array($ajout3);
		}
	echo '</ul>';
	
?>		<HR WIDTH="50%">			
		<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
		<HR WIDTH="50%">
		
		<p><span id="date_heure"></span>
		<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>
		
		<form action="accueil_medecin.php" method="post">
		<p><input VALUE="Cliquez ici pour revenir au menu principal" type="submit"></p>
		</form> 
<?php
	}
	}
	else {
	// si il y a des erreurs :
	
?>
	<h2><span style="border: 3px #002B5D ridge; paddling 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resultats&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h2>
<?php
		foreach($erreurs as $err) {
			echo "\t\t<p><strong>".$err."</strong></p>\n";
		}
			?>
			
		<form action="check_patient1.php" method="post">
		<p><input name="envoi" type="submit"></p>
		</form> 

		<HR WIDTH="50%">			
		<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
		<HR WIDTH="50%">
		
		<p><span id="date_heure"></span>
		<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>
		
		<form action="accueil_medecin.php" method="post">
		<p><input VALUE="Cliquez ici pour revenir au menu principal" type="submit"></p>
		</form> 

			<?php
					
		}
	mysqli_close($base);
	}
else {
	  $erreurs[] = "Vous n'etes pas connecte.";
	 
	// On affiche d'abord les éventuelles erreurs
	foreach($erreurs as $err) {
		echo "\t\t<p><strong>$err</strong></p>\n";
	}
?>
	<br>
	<form action="login.php" method="post">
	<p><input value="Cliquez ici pour vous connecter" type="submit"></p>
	</form>
	<HR WIDTH="50%">			
	<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
	
	<HR WIDTH="50%">
	<p><span id="date_heure"></span>
	<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>
			
	<form action="accueil_medecin.php" method="post">
	<p><input VALUE="Cliquez ici pour revenir au menu principal" type="submit"></p>
	</form> 
			
<?php
	}
?>
	</body>
</html> 