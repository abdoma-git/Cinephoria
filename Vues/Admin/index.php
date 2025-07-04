<?php
    require_once 'check_auth.php';
    require_once '../../connexion.php';
    require_once '../../Modeles/Film.php';
    require_once '../../Modeles/Salle.php';
    require_once '../../Modeles/Seance.php';
    require_once '../../Modeles/Employe.php';
    require_once '../../Modeles/Reservation.php';
    require_once '../../Modeles/Utilisateur.php';



    $seance= new Seance($pdo);
    $nombre_seance = $seance->count_seances();
    
    $salle = new Salle($pdo);
    $nombre_salle = $salle->count_salle();
       
    $film = new Film($pdo);
    $nombre_film = $film->count_films();


    $reservation = new Reservation($pdo);
    $nombre_reservation = $reservation->count_reservations();

    $utilisateur = new Utilisateur($pdo);
    $nombre_utilisateur = $utilisateur->nombre_utilisateur();

    $employe = new Employe($pdo);
    $nombre_employe = $employe->nombre_employe();



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <?php include('menu_admin.php');?>

    <div class="container mt-4">
        <h1>Bienvenue dans l'administration de Cinephoria</h1>
        <p>Utilisez le menu ci-dessous pour gérer les différentes sections du site.</p>

        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Totales Reservations</h5>
                    <p class="card-text"> <?php echo $nombre_reservation["nbr_reservation"]; ?> </p>
                    <a href="lister.php?table=reservations&titre=Reservation" class="btn btn-primary">Go</a>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Totales Utilisateurs</h5>
                    <p class="card-text"><?php echo $nombre_utilisateur["nbr_utilisateur"]; ?></p>
                    <a href="lister.php?table=utilisateurs&titre=Utilisateurs" class="btn btn-primary">Go</a>
                </div>
            </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Totales Employes </h5>
                    <p class="card-text"><?php echo $nombre_employe["nbr_employe"]; ?></p>
                    <a href="lister.php?table=employer&titre=Employers" class="btn btn-primary">Go</a>
                </div>
                </div>
            </div>
            
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Totales Films</h5>
                    <p class="card-text"><?php echo $nombre_film["nbr_film"]; ?></p>
                    <a href="lister.php?table=films&titre=Films" class="btn btn-primary">Go</a>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Totales Salles</h5>
                    <p class="card-text"><?php echo $nombre_salle["nbr_salle"]; ?></p>
                    <a href="lister.php?table=salles&titre=Salles" class="btn btn-primary">Go</a>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Totales Seances </h5>
                    <p class="card-text"><?php echo $nombre_seance["nbr_seance"]; ?></p>
                    <a href="lister.php?table=seances&titre=Seances" class="btn btn-primary">Go</a>
                </div>
                </div>
            </div>
            
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 