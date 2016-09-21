<?php
	// Avant tout contenu HTML, on lance une session
	session_start();
	
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();
?>

<html>
	<head><title>Ajout_diagnostique</title>
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
<?php
	}
	// On affiche d'abord les éventuelles erreurs
	foreach($erreurs as $err) {
		echo "\t\t<p><strong>$err</strong></p>\n";
	}
?>

<br><br>


<?php
	
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
	if (!isset($_POST["exam_pratique"]) || $_POST["exam_pratique"] == "") {
		// il manque l'examen pratique ou il est vide
		// On ajoute un message d'erreur
		$erreurs[] = "Veuillez renseigner l'examen pratique du patient.";
		}
	if (!isset($_POST["date"]) || $_POST["date"] == "") {
		// il manque la date du diagnostique ou il est vide
		// On ajoute un message d'erreur
		$erreurs[] = "Veuillez renseigner la date du diagnostique du patient.";
		}
	
	if (empty($erreurs)){
		
		//		
		$requete='SELECT id_patient FROM patient WHERE nom_personne="'.$_POST['nom'].'" AND prenom_personne="'.$_POST['prenom'].'" AND date_naissance="'.$_POST['date_naissance'].'"';
		$ajout = mysqli_query($base,$requete);
		$donnees = mysqli_fetch_array($ajout);
		// ici on a donc recupéré L' id_patient de notre patient.
		
		if (empty($donnees)){
			header("location: result_ajout_diag2.php" );
			// si on ne trouve pas d'id_patient, c'est qu'il n'existe pas donc message d'erreur.
		}
		
		else {
			$requete1='SELECT id_sejour FROM sejour WHERE id_patient = '.$donnees['id_patient'].' ORDER BY date_arrivee DESC LIMIT 1;';
			$ajout1 = mysqli_query($base,$requete1);
			$donnees1 = mysqli_fetch_array($ajout1);
			// on trouve L' id_sejour de son sejour actuel.
			//Il ne peut il y a voir qu'un seul sejour en meme temps par patient. 
			//c'est donc le sejour avayant la date d'arrivée la plus tardive.
				
			$requete2='INSERT INTO diagnostique(id_medecin, exam_pratique, commentaire, date ) VALUES ('.$_SESSION['login'].',"'.$_POST['exam_pratique'].'","'.$_POST['commentaire'].'","'.$_POST['date'].'")';
			$ajout2 = mysqli_query($base,$requete2);
			// on insere le diagnostique.
		
			$requete3 ='SELECT id_diag FROM diagnostique WHERE exam_pratique = "'.$_POST['exam_pratique'].'" AND commentaire = "'.$_POST['commentaire'].'"';
			$ajout3 = mysqli_query($base,$requete3);
			$donnees3  = mysqli_fetch_array($ajout3);
			// on recupere L'id_diag du diagnostique fraichement ajouté.

			$requete4='UPDATE sejour SET id_diag = '.$donnees3['id_diag'].' WHERE id_sejour= '.$donnees1['id_sejour'].';';
			$ajout4 = mysqli_query($base,$requete4);
						echo'<p>'.$requete4.'</p>';	
			// on met a jour le pointeur vers id_diag de sejour.
			if($ajout4){
				header("location: result_ajout_diag.php" );
			// si il n'y a pas d'erreur, le diagnostique a bien été insere.
			
			}
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
			
			<form action="ajout_diagnostique1.php" method="post">
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

?>
	</body>
</html> 