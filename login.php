<?php
	// Avant tout contenu HTML, on lance une session
	session_start(); // À faire dans toutes les pages pour rester connecter à son compte
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>

<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="date_heure.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">

		<meta charset="utf-8"/>
		<title>Connection</title>
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
	// On affiche d'abord les éventuelles erreurs
	foreach($erreurs as $err) {
		echo "\t\t<p><strong>$err</strong></p>\n";
	}
?>

<br><br>

	<h2><span style="border: 3px #002B5D ridge; paddling 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accueil&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h2>
<br>

	<?php
	$base = mysqli_connect('localhost', 'root', '','bdd_hopital_cfdj'); 
	?>
	<?php
		// On vérifie si des informations de formulaire ont été envoyées et qu'on n'est pas déjà connecté
		if(!isset($_SESSION["login"]) && isset($_POST["send"])) {
			// isset (prononcé comme "is set") signifie que la variable a été initialisée
			// isset($_POST["send"]) sera vrai si on a clické sur le bouton de soumission appelé "send" ci-dessous
			// des info de formulaires sont définies, on vérifie si elles sont complètes
		if (!isset($_POST["login"]) || $_POST["login"] == "") {
			// il manque l'identifiant ou il est vide
			// On ajoute un message d'erreur
			$erreurs[] = "Veuillez renseigner l'identifiant.";
		}
		if (!isset($_POST["pwd"]) || $_POST["pwd"] == "") {
			// il manque l'identifiant ou il est vide
			// On ajoute un message d'erreur
			$erreurs[] = "Veuillez renseigner le mot de passe.";
		}
		// si pas d'erreur, on va tester les identifiants soumis
		if (empty($erreurs)) {
			// on vérifie que le couple identifiant/mot de passe est bien dans la base de données
			if($_POST["choix"] == 'medecin') {
				$requete = "SELECT id_medecin,id_service,nom_personne,prenom_personne,date_naissance FROM medecin WHERE medecin.id_medecin = '".$_POST['login']."' AND medecin.pwd = '".$_POST['pwd']."'" ;
				$retour = mysqli_query($base,$requete);
				$donnees = mysqli_fetch_array($retour);
				if(!$donnees){
					$erreurs[] = "Ce médecin n'existe pas!";
					$est_dans_la_base = false;
					}
				else
					$est_dans_la_base = true;
			}	
			if($_POST["choix"] == 'respo_adm'){
				$requete = "SELECT id_perso_adm,nom_personne,prenom_personne,date_naissance FROM Personnel_administratif WHERE Personnel_administratif.id_perso_adm = '".$_POST['login']."' AND Personnel_administratif.pwd = '".$_POST['pwd']."'";
				$retour = mysqli_query($base,$requete);
				$donnees = mysqli_fetch_array($retour);
				if(!$donnees) {
					$erreurs[] = "Ce responsable n'existe pas!";
					$est_dans_la_base = false;
					}
				else
					$est_dans_la_base = true;
			}	
			
			if ( $est_dans_la_base ) {
				// On enregistre l'identifiant dans les données de session
				$_SESSION["login"] = $_POST["login"];
				$_SESSION["nom"] = $donnees["nom_personne"];
				$_SESSION["prenom"] = $donnees["prenom_personne"];
				$_SESSION["date_naissance"] = $donnees["date_naissance"];
			}
			else {
				// C'est le cas où le couple id/pass n'est pas dans la base
				$erreurs[] = "Le login et/ou le mot de passe sont incorrects.";
			}
		}
	}
	// Après avoir traité les données de formulaire, deux cas sont possibles:
	//  1. on a réussi à se connecter ou on l'était déjà
	//  2. on n'est pas connecté
	// Premier cas:
	// On vérifie si la session en cours indique un login
	// Cela signifie que le visiteur de la page est connecté
	// On y met également un lien vers la page de profile de l'utilisateur connecté
	if(isset($_SESSION["login"])) {
?>

	<?php
		if(isset($_POST['send']) && $_POST["choix"] == 'respo_adm'){
			echo "<p>" . $_POST['send'] . "</p>";
			header("location: accueil_respo_adm.php");
			}

		if(isset($_POST['send']) && $_POST["choix"] == 'medecin'){
			echo "<p>" . $_POST['send'] . "</p>";
			header("location: accueil_medecin.php");
			}
	?>
	
	<p>Vous êtes actuellement connecté en tant que <a href="profile.php?id=<?php echo $_SESSION["login"]; ?>"><?php echo $_SESSION["login"]; ?></a>.</p>
		<p>Voulez-vous vous <a href="logout.php">déconnecter</a> ?</p>
	<?php
		}
		// Deuxième cas:
		// On affiche d'abord les éventuelles erreurs
		foreach($erreurs as $err) {
			echo "\t\t<p><strong>$err</strong></p>\n";
		}
		// Puis on peut simplement afficher le formulaire HTML de connection
	?>
		<p>Veuillez vous connecter avec vos identifiants.</p>
		<form action="login.php" method="post">
			<p>Identifiant: <input type="text" name="login"/><br/>
			Mot de passe: <input type="password" name="pwd"/><br/>
			<select name="choix"></p>
				<option value="medecin">Medecin</option>
				<option value="respo_adm">Responsable administratif</option>
			</select>
			<input name="send" type="submit"/>
		</form>
		
		<HR WIDTH="50%">
	<br>
<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
	
	<HR WIDTH="50%">
	<p><span id="date_heure"></span>
	<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>


	<?php
		mysqli_close($base); 
	?>
	</body>

</html>