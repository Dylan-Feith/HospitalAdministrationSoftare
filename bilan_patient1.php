<?php
	// Avant tout contenu HTML, on lance une session
	session_start(); // À faire dans toutes les pages pour rester connecter à son compte
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>

<html><head>

	<title>Création d'un nouveau diagnostique</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="bilan patient">
	<meta name="keywords" content="formulaire, HTML,diagnostique">
	<meta name="author" content="cfdj">
	<script type="text/javascript" src="date_heure.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body bgcolor = "#A4C4E9" text = "#000000" >


<hr align = "center" width = 50% size = 3 color = "#00000">
<div style="float: left;"><IMG SRC="photo.jpg"></div>
<div style="float: right;"><IMG SRC="photo.jpg"></div>
<h1><b>.oO Hopital GALAN Oo.</b></h1>
<hr align = "center" width = 50% size = 3 color = "#00000">

<br><?php	
		if(isset($_SESSION["login"])) {
?>
		<p>Vous êtes actuellement connecté en tant que <a href="profile.php?id=<?php echo $_SESSION["login"]; ?>"><?php echo $_SESSION["login"]; ?></a>.</p>
		<p>Voulez-vous vous <a href="logout.php">déconnecter</a> ?</p>
		<br><br>
	<h2><span style="border: 3px #002B5D ridge; paddling 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bilan du patient&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h2>
<br>
	
	<form action="bilan_patient.php" method="post">
		<p>Nom du patient : <input name="nom" type="text"></p>
		<p>Prénom du patient : <input name="prenom" type="text"></p>
		<p>Date de naissance : <input name="date_naissance" type="date"></p>
			<p><input type="submit"></p>
	</form>
	
	<HR WIDTH="50%">
	<br>
	
	<form action="accueil_medecin.php" method="post">
		<p><input VALUE="Cliquez ici pour revenir au menu principal" type="submit"></p>
	</form>
	
	<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
	
	<HR WIDTH="50%">
	<p><span id="date_heure"></span>
	<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>
<?php
	}
	else {
	  $erreurs[] = "Vous n'êtes pas connecté.";
	 
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