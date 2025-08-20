<?php
require_once '../../connexion.php';
require_once '../../Modeles/Seance.php';
require_once '../../Modeles/Film.php';
require_once '../../Modeles/Salle.php';

// Initialisation de la connexion PDO pour les classes

if (!empty($_GET["id"])){

    $titre = $_GET['titre'];
    $heure_debut_1 = $_GET['heure_debut'];
    $heure_fin_1 = $_GET['heure_fin'];
    $qualité = $_GET['qualité'];
    $salle_id = $_GET['salle_id'];
    $film_id = $_GET['film_id'];

}


$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];
    $qualite = $_POST['qualite'];
    $film_id = $_POST['film_id'];
    $salle_id = $_POST['salle_id'];

    $seance = new Seance($pdo);
    
    if (!empty($_GET["id"])){
        
        if ($seance->update($_GET["id"],$heure_debut, $heure_fin, $qualite, $film_id, $salle_id)) {
        $message = '<div class="alert alert-success">Salle modifié avec succès !</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur lors de la modification de la salle.</div>';
        }

    }else{

        if ($seance->create($heure_debut, $heure_fin, $qualite, $film_id, $salle_id)) {
            $message = '<div class="alert alert-success">Séance ajoutée avec succès !</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur lors de l\'ajout de la séance.</div>';
        }

    }
}

// Récupération des films et salles pour les selects
$films = Film::getAll($pdo);
$salles = Salle::getAll($pdo);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des séances - Administration Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>

<?php include('menu_admin.php');?>

    <div class="container mt-4">
        <h1>Ajouter une séance</h1>
        <?php echo $message; ?>

        <?php  
            if (!empty($_GET["id"])){
        ?>

                <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="heure_debut" class="form-label">Heure de début</label>
                <input type="time" class="form-control" id="heure_debut" name="heure_debut" value="<?php print($heure_debut_1) ?>" >
            </div>
            
            <div class="mb-3">
                <label for="heure_fin" class="form-label">Heure de fin</label>
                <input type="time" class="form-control" id="heure_fin" name="heure_fin" value="<?php print($heure_fin_1) ?>" >
            </div>
            
            <div class="mb-3">
                <label for="qualite" class="form-label">Qualité de projection</label>
                <select class="form-select" id="qualite" name="qualite" required>
                    <option value="<?php print($qualité)?>">Actuelle : <?php print($qualité)?></option>
                    <option value="2D">2D</option>
                    <option value="3D">3D</option>
                    <option value="IMAX">IMAX</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="film_id" class="form-label">Film</label>
                <select class="form-select" id="film_id" name="film_id">
                    <option value="<?php print($film_id)?>">Actuelle : <?php print($film_id)?></option>
                    <?php foreach ($films as $film): ?>
                        <option value="<?php echo $film['id']; ?>">
                            <?php echo htmlspecialchars($film['titre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="salle_id" class="form-label">Salle</label>
                <select class="form-select" id="salle_id" name="salle_id">
                    <option value="<?php print($salle_id)?>">Actuelle : <?php print($salle_id)?></option>
                    <?php foreach ($salles as $salle): ?>
                        <option value="<?php echo $salle['id']; ?>">
                            Salle (<?php echo $salle['id']; ?>) : <?php echo $salle['nbr_places']; ?> places
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Modifier la séance</button>
        </form>

        <?php } else { ?>
        
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="heure_debut" class="form-label">Heure de début</label>
                <input type="datetime-local" class="form-control" id="heure_debut" name="heure_debut" required>
            </div>
            
            <div class="mb-3">
                <label for="heure_fin" class="form-label">Heure de fin</label>
                <input type="datetime-local" class="form-control" id="heure_fin" name="heure_fin" required>
            </div>
            
            <div class="mb-3">
                <label for="qualite" class="form-label">Qualité de projection</label>
                <select class="form-select" id="qualite" name="qualite" required>
                    <option value="2D">2D</option>
                    <option value="3D">3D</option>
                    <option value="IMAX">IMAX</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="film_id" class="form-label">Film</label>
                <select class="form-select" id="film_id" name="film_id" required>
                    <?php foreach ($films as $film): ?>
                        <option value="<?php echo $film['id']; ?>">
                            <?php echo htmlspecialchars($film['titre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="salle_id" class="form-label">Salle</label>
                <select class="form-select" id="salle_id" name="salle_id" required>
                    <?php foreach ($salles as $salle): ?>
                        <option value="<?php echo $salle['id']; ?>">
                            Salle <?php echo $salle['id']; ?> (<?php echo $salle['nbr_places']; ?> places)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter la séance</button>
        </form>

        <?php }?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 