<?php
	// Avant tout contenu HTML, on lance une session
	session_start();
		
	// Une variable utile pour gérer les erreurs (c'est un tableau où l'on mettra des messages d'erreur)
	$erreurs = array();	
?>

<html>
	<head><title>Bilan patient</title>
	
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

	<h2><span style="border: 3px #002B5D ridge; paddling 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bilan du patient&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h2>
	<br>

<?php
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
	if (empty($erreurs)){
	
		$requete='SELECT id_patient FROM patient WHERE nom_personne="'.$_POST['nom'].'" AND prenom_personne="'.$_POST['prenom'].'" AND date_naissance="'.$_POST['date_naissance'].'"';
		$ajout = mysqli_query($base,$requete);
		$donnees = mysqli_fetch_array($ajout);
		// ici on a donc recupéré L' id_patient de notre patient.
		
		if (empty($donnees)){
			header("location: result_bilan_patient.php" );
			// si on ne trouve pas d'id_patient, c'est qu'il n'existe pas donc message d'erreur.
		}
			
		$requete1='SELECT id_soin, description,date FROM soin WHERE id_patient='.$donnees['id_patient'].'';
		$ajout1 = mysqli_query($base,$requete1);
		$donnees1 = mysqli_fetch_array($ajout1);
		// ici on a donc recupéré tous les id_soin de notre patient.
		
		echo '<u>soin + medoc associe: </u><ul>';
		while($donnees1) {
			$requete2='SELECT medicament.id_medoc,description FROM medicament, soin_medicament WHERE soin_medicament.id_medoc=medicament.id_medoc AND id_soin='.$donnees1['id_soin'].'';
			$ajout2 = mysqli_query($base,$requete2);
			$donnees2 = mysqli_fetch_array($ajout2);
			
			echo '<li> id_soin ='.$donnees1['id_soin'].'<br> description = '.$donnees1['description'].'</li>';		
			while($donnees2) {
				
				echo '<li> id_medoc ='.$donnees2['id_medoc'].'<br> description = '.$donnees2['description'].'</li><br>';
				echo '<li> date de realisation soin ='.$donnees1['date'].'</li><br>';
				$donnees2 = mysqli_fetch_array($ajout2);
			}
			$donnees1 = mysqli_fetch_array($ajout1);	
		}
		echo '</ul>';		
		$requete3='SELECT id_sejour FROM sejour WHERE id_patient = '.$donnees['id_patient'].' ORDER BY date_arrivee DESC';
		$ajout3 = mysqli_query($base,$requete3);
		$donnees3 = mysqli_fetch_array($ajout3);
		// ici, on a récupéré tous les id_sejour de notre patient.
		
		echo '<u>Liste des examens pratiques realises : </u><ul>';		
		while ($donnees3) {
			
			$requete4 ='SELECT diagnostique.id_diag, exam_pratique, commentaire, date_arrivee FROM diagnostique, sejour WHERE sejour.id_diag=diagnostique.id_diag AND id_sejour='.$donnees3['id_sejour'].' ';
			$ajout4= mysqli_query($base,$requete4);
			$donnees4 = mysqli_fetch_array($ajout4);
			
			while ($donnees4) {			
				echo "<li> date d'arrivee = ".$donnees4['date_arrivee']." <br> examen pratique =".$donnees4['exam_pratique']."<br> commentaires = ".$donnees4['commentaire']."</li><br>";
				$donnees4 = mysqli_fetch_array($ajout4);			
			}
			$donnees3 = mysqli_fetch_array($ajout3);	
		}
		echo '</ul>';
?>
	<br>
			
	<form action="accueil_medecin.php" method="post">
	<p><input VALUE="Cliquez ici pour revenir au menu principal" type="submit"></p>
	</form> 
	<HR WIDTH="50%">			
	<div style="TEXT-ALIGN: center"><img src=ambulance.gif alt="PinPon" border=3 width=200 height=160></div>
	
	<HR WIDTH="50%">
	<p><span id="date_heure"></span>
	<script type="text/javascript">window.onload = date_heure('date_heure');</script></p>

			
<?php
		
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