<?php
	// Avant tout contenu HTML, on lance une session
	session_start(); // À faire dans toutes les pages pour rester connecter à son compte
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>
<html><head>
	<script type="text/javascript" src="date_heure.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Création d'un nouveau soin</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="créer un nouveau soin">
	<meta name="keywords" content="formulaire, HTML,soin">
	<meta name="author" content="cfdj">
	
</head>


<body background= "backgroung.png" align=center bgcolor = "#A4C4E9" text = "#000000" >

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

	<h2><span style="border: 3px #002B5D ridge; paddling 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saisie d'un soin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h2>
<br>


	<form action="ajout_soin.php" method="post">
		<p>Nom du patient : <input name="nom" type="text"></p>
		<p>Prénom du patient : <input name="prenom" type="text"></p>
		<p>date de naissance : <input name="date_naissance" type="date"></p>
		<p>soin : <input name="soin" type="text"></p>
		<p>Date du soin : <input name="date" type="date"></p>
		<p><input type="submit"></p>
	</form> 
	
		<br>
		<HR WIDTH="50%">

	<form action="retour_accueil.php" method="post">
		<p><input value= "Cliquez ici pour revenir au menu principal" type="submit"></p>
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
		echo "\t\t<p><strong>$err</strong></p>";
	}
	echo'<br>';
?>
	<form action="login.php" method="post">
	<p><input value="Cliquez ici pour vous connecter" type="submit"></p>
	</form>

<?php
	}
?>

</body></html>