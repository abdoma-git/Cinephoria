<?php 
	include("../connexion.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="../css/login-signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">

				<form method="POST">
					<label for="chk" aria-hidden="true">S'inscrire</label>
					<input type="text" name="nom" placeholder="Nom" required="">
					<input type="text" name="prenom" placeholder="Prenom " required="">
					<input type="text" name="username" placeholder="Username" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Mot de passe" required="">
					<input id="sign-up-submit" type="submit">
				</form>

			</div>

			<div class="login">
				<form method="POST">
					<label for="chk" aria-hidden="true">Se connecter</label>
					<input type="email" name="email2" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<input id="sign-up-submit" type="submit">
				</form>
			</div>
	</div>

	<?php 

		include("../Modeles/Utilisateur.php");

		if ( isset($_POST["username"]) ){

			$nouveau_utilisateur = new Utilisateur($pdo);
			
			$nom = $_POST["nom"];
			$prenom = $_POST["prenom"];
			$email = $_POST["email"];
			$nom_utilisateur = $_POST["username"];
			$mot_de_passe = $_POST["password"];

			// Création de l'utilisateur
            if ($nouveau_utilisateur->create($nom, $prenom, $nom_utilisateur, $email, $mot_de_passe)) {
				header("Location: login-signup.php");
            } else {
                echo "Erreur lors de l'ajout de l'utilisateur.";
            }

		}

	?>

	<?php 

		if ((!empty($_POST['email2'])) && (!empty($_POST['pswd'])) ){

			$email = $_POST["email2"];
			$pwd = md5($_POST["pswd"]);
			
			//la table des visiteurs
			$requette = $pdo->prepare(" SELECT * FROM `utilisateurs` ");
			$requette->execute();
			$tableUsers = $requette->fetchAll();
			$point = 0;
			//boucle sur les utilisateurs de la table visiteur
			foreach ( $tableUsers as $ligne ){

				if ($ligne["email"] == $email && $ligne["mot_de_passe"] == $pwd){

					$_SESSION["connecte"] = 1;
					$_SESSION["nom"] = $ligne["nom"];
					$_SESSION["prenom"] = $ligne["prenom"];
					$_SESSION["email"] = $ligne["email"];
					$_SESSION["username"] = $ligne["nom_utilisateur"];
					$_SESSION["id_user"] = $ligne["id"];
					$point = 1 ;

					header('Location: index.php');
				}
			}

			if ( $point == 0){
				echo "utilisateur indisponible </br>";
			}
		}       
		
	?>

</body>
</html>