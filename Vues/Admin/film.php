<?php
require_once '../../connexion.php';
require_once '../../Modeles/Film.php';

$message = '';

if (!empty($_GET["id"])){

    $titre_page = $_GET['titre_page'];
    $titre_film = $_GET['titre_film'];
    $description = $_GET['description'];
    $age_min = $_GET['age_min'];
    $note = $_GET['note'];
    $genre = $_GET['genre'];
    $date = $_GET['date'];
    $poster = $_GET['poster'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $age_min = $_POST['age_min'];
    $note = $_POST['note'];
    $genre = $_POST['genre'];
    $date = $_POST['date'];
    $poster = $_POST['poster'];

    $film = new Film($pdo);

    if (!empty($_GET["id"])){
        
        if ($film->update($_GET["id"],$titre, $description, $age_min, $note, $genre, $date, $poster)) {
        $message = '<div class="alert alert-success">Film modifié avec succès !</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur lors de la modification du film.</div>';
        }

    } else{

        if ($film->create($titre, $description, $age_min, $note, $genre, $date, $poster)) {
            $message = '<div class="alert alert-success">Film ajouté avec succès !</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur lors de l\'ajout du film.</div>';
        }
    } 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des films - Administration Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <?php include('menu_admin.php');?>

    <div class="container mt-4">
        <h1>
            <?php 
                if (!empty($_GET["id"])){
                    print('Modifier film : <mark>'.$titre_film.'</mark>');
                }else{
                    print('Ajouter un film');
                }
            ?>

        </h1>
        <?php echo $message; ?>

        <?php  
            if (!empty($_GET["id"])){
        ?>

        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?php print($titre_film) ?>">
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input class="form-control" id="description" name="description" value="<?php print($description) ?>"/>
            </div>
            
            <div class="mb-3">
                <label for="age_min" class="form-label">Âge minimum</label>
                <input type="number" class="form-control" id="age_min" name="age_min" value="<?php print($age_min) ?>">
            </div>
            
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" id="note" name="note" step="0.1" min="0" max="10" value="<?php print($note) ?>">
            </div>
            
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" value="<?php print($genre) ?>">
            </div>
            
            <div class="mb-3">
                <label for="date" class="form-label">Date de sortie</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php print($date) ?>">
            </div>
            
            <div class="mb-3">
                <label for="poster" class="form-label">URL ou chemin de l'affiche</label>
                <input type="text" class="form-control" id="poster" name="poster"  value="<?php print($poster) ?>">
                <div class="form-text">Entrez le chemin relatif ou l'URL complète de l'image du film</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Modifier le film</button>
        </form>

        <?php } else { ?>
        
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="age_min" class="form-label">Âge minimum</label>
                <input type="number" class="form-control" id="age_min" name="age_min" required>
            </div>
            
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" id="note" name="note" step="0.1" min="0" max="10" required>
            </div>
            
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            
            <div class="mb-3">
                <label for="date" class="form-label">Date de sortie</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            
            <div class="mb-3">
                <label for="poster" class="form-label">URL ou chemin de l'affiche</label>
                <input type="text" class="form-control" id="poster" name="poster" placeholder="Ex: images/posters/film.jpg" required>
                <div class="form-text">Entrez le chemin relatif ou l'URL complète de l'image du film</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter le film</button>
        </form>

        <?php }?>

    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 