
<html><head>
	<script type="text/javascript" src="date_heure.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>resultat</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="resultat">
	<meta name="keywords" content="formulaire, HTML,resultat">
	<meta name="author" content="cfdj">



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
<?php
	}
?>

<br><br>

	<h2><span style="border: 3px #002B5D ridge; paddling 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resultat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h2>
<br>



	<form action="ajout_soin1.php" method="post">
		<p>Le soin n'a pas pu etre insere car ce patient n'existe pas.Veuillez reessayer.</p>
		<p><input VALUE="retour a la fiche de soin"  type="submit"></p>
	</form> 
<HR WIDTH="50%">
	<form action="retour_accueil.php" method="post">

		<p><input VALUE="Cliquez ici pour revenir au menu principal" type="submit"></p>
	</form> 
	<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
	
	<HR WIDTH="50%">
	<p><span id="date_heure"></span>
	<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>


</body></html>