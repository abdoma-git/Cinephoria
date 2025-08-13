<?php
require_once '../../connexion.php'; //  j'ai la valrianble $pdo
require_once '../../Modeles/Employe.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $employe = new Employe($nom, $prenom, $email, $mot_de_passe);
    if ($employe->save($pdo)) {
        $message = '<div class="alert alert-success">Employé ajouté avec succès !</div>';
    } else {
        $message = '<div class="alert alert-danger">Erreur lors de l\'ajout de l\'employé.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des employés - Administration Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
       <?php include('menu_admin.php');?>

    <div class="container mt-4">
        <h1>Ajouter un employé</h1>
        <?php echo $message; ?>
        
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter l'employé</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 