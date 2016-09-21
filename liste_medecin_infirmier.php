<?php
	// Avant tout contenu HTML, on lance une session
	session_start();
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>

<html>
	<head><title>liste_medecin_infirmier</title>
	
	<script type="text/javascript" src="date_heure.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
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
		<p>Vous etes actuellement connecte en tant que <a href="profile.php?id=<?php echo $_SESSION["login"]; ?>"><?php echo $_SESSION["login"]; ?></a>.</p>
		<p>Voulez-vous vous <a href="logout.php">deconnecter</a> ?</p>
	
		<br><br>

		<h2><span style="border: 3px #002B5D ridge; paddling 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Liste des medecins et infirmieres du service du medecin connecte&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h2>
		<br>

<?php
	
	
	$base = mysqli_connect('localhost', 'root', '','bdd_hopital_cfdj');
	mysqli_select_db($base,'bdd_hopital_cfdj'); 
	
	$requete='SELECT id_service FROM medecin WHERE 	id_medecin="'.$_SESSION['login'].'"';
	$ajout = mysqli_query($base,$requete);
	$donnees = mysqli_fetch_array($ajout);	
	// on recupere le service du medecin
	
	$requete1='SELECT nom_personne, prenom_personne FROM infirmier WHERE id_service='.$donnees['id_service'].'';
	$ajout1 = mysqli_query($base,$requete1);
	$donnees1 = mysqli_fetch_array($ajout1);
	// on trouve les infirmiers de son service.
	
	$requete2='SELECT nom_personne, prenom_personne FROM medecin WHERE id_service='.$donnees['id_service'].'';
	$ajout2 = mysqli_query($base,$requete2);
	$donnees2 = mysqli_fetch_array($ajout2);
	//on trouve les medecin de son service.
	
	echo 'les medecins de votre service sont : <ul>';
	
	while($donnees2){
		echo '<li> nom ='.$donnees2['nom_personne'].'<br> prenom = '.$donnees2['prenom_personne'].'</li>';
		$donnees2 = mysqli_fetch_array($ajout2);	
	}
	echo '</ul>';
	
	echo 'les infirmiers de votre service sont : <ul>';
	
	while($donnees1){
		echo '<li> nom ='.$donnees1['nom_personne'].'<br> prenom = '.$donnees1['prenom_personne'].'</li>';
		$donnees1 = mysqli_fetch_array($ajout1);	
	}
	echo '</ul>';
	
	
	mysqli_close($base);
?>
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

<?php
	}
?>

</body></html>