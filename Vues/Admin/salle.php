<?php
require_once '../../connexion.php'; // cela me donne la variable $pdo
require_once '../../Modeles/Salle.php';
require_once '../../Modeles/Cinema.php';

// Initialisation de la connexion PDO pour la classe Cinema


$message = '';

if (!empty($_GET["id"])){

    $titre_page = $_GET['titre_page'];
    $nbr_places = $_GET['nbr_places'];
    $qualite_projection = $_GET['qualite_projection'];
    $cinema_id = $_GET['cinema_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nbr_places = $_POST['nbr_places'];
    $qualite_projection = $_POST['qualite_projection'];
    $cinema_id = $_POST['cinema_id'];

    $salle = new Salle($nbr_places, $qualite_projection, $cinema_id);
     if (!empty($_GET["id"])){

        if ($salle->update($pdo,$_GET["id"],$nbr_places,$qualite_projection,$cinema_id)) {
            $message = '<div class="alert alert-success">Salle modifiee avec succès !</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur lors de la modification de la salle.</div>';
        }
     }else{
        if ($salle->save($pdo)) {
            $message = '<div class="alert alert-success">Salle ajoutée avec succès !</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur lors de l\'ajout de la salle.</div>';
        }
     }
    
}

// Récupération des cinémas pour le select
$cinema = new Cinema($pdo);
$cinemas = $cinema->getAll($pdo);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des salles - Administration Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

       <?php include('menu_admin.php');?>

    <div class="container mt-4">
        <h1>
            <?php 
                if (!empty($_GET["id"])){
                    print('Modifier Salle');
                }else{
                    print('Ajouter une Salle');
                }
            ?>
        </h1>
        <?php echo $message; ?>

        <?php  
            if (!empty($_GET["id"])){
        ?>
        
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nbr_places" class="form-label">Nombre de places</label>
                <input type="number" class="form-control" id="nbr_places" name="nbr_places" value="<?php print($nbr_places) ?>">
            </div>
            
            <div class="mb-3">
                <label for="qualite_projection" class="form-label">Qualité de projection</label>
                <select class="form-select" id="qualite_projection" name="qualite_projection">
                    <option value="<?php print($qualite_projection)?>">Actuelle : <?php print($qualite_projection)?></option>
                    <option value="2D">2D</option>
                    <option value="3D">3D</option>
                    <option value="IMAX">IMAX</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="cinema_id" class="form-label">Cinéma</label>
                <select class="form-select" id="cinema_id" name="cinema_id" required>
                    <option value="<?php print($cinema_id)?>">Actuelle : <?php print($cinema_id)?></option>
                    <?php foreach ($cinemas as $cinema): ?>
                        <option value="<?php echo $cinema['id']; ?>">
                            <?php echo htmlspecialchars($cinema['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Modifier la salle</button>
        </form>

        <?php } else { ?>

            <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nbr_places" class="form-label">Nombre de places</label>
                <input type="number" class="form-control" id="nbr_places" name="nbr_places" required>
            </div>
            
            <div class="mb-3">
                <label for="qualite_projection" class="form-label">Qualité de projection</label>
                <select class="form-select" id="qualite_projection" name="qualite_projection" required>
                    <option value="2D">2D</option>
                    <option value="3D">3D</option>
                    <option value="IMAX">IMAX</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="cinema_id" class="form-label">Cinéma</label>
                <select class="form-select" id="cinema_id" name="cinema_id" required>
                    <?php foreach ($cinemas as $cinema): ?>
                        <option value="<?php echo $cinema['id']; ?>">
                            <?php echo htmlspecialchars($cinema['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter la salle</button>
        </form>

        <?php } ?>


    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 