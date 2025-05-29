
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/fevicon.png" type="image/x-icon">
  <title>Finter</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

  <?php include("menu.php"); ?>

    <section class="container m-5" id="list-reservations">

    <?php 
        include('../Modeles/Reservation.php');
        include('../Modeles/Film.php');
        include('../Modeles/Seance.php');
        include('../Modeles/Avis.php');

        $reservation = new Reservation($pdo);
        $film = new Film($pdo);
        $seance = new Seance($pdo);
        $avis = new Avis($pdo);
        $reservation_donnees = $reservation->getByUserId($_SESSION["id_user"]);
        $tableAvis = $avis->getAll($pdo);

        foreach ($reservation_donnees as $ligne) {
            
            $drapeau = 0;
            $mon_film = $film->getFilmById($pdo, $ligne["film_id"]);
            $ma_seance = $seance->getById($ligne["seance_id"]);

            print('

                <div class="card mb-3" style="max-width: 900px;">
                    <div class="row g-0">
                        <div class="col-md-2">
                        <img src="'.$mon_film["poster"].'" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Reservation pour le film <b> '.$mon_film["titre"].' </b></h5>
                            <p class="card-text">Nombre de places '.$ligne["nombre_places"].'</h5>
                            <p class="card-text"><small class="text-body-secondary">Date : '.$ligne["date_reservation"].'</small></p>
                            <p class="card-text"><small class="text-body-secondary">'.$ma_seance["heure_debut"].' - '.$ma_seance["heure_fin"].'</small></p> ');
                            
                            foreach ($tableAvis as $ligneAvis) {
                                if ( ($ligne["film_id"] == $ligneAvis["film_id"]) &&  ($ligneAvis["user_id"] == $_SESSION["id_user"]) ){
                                  $drapeau = 1;
                                  print('
                                  <p class="card-text"><small class="text-body-secondary"><mark>Vous avez deja note ce film</mark></small></p>
                                ');
                                }

                              }
                            if ($ligne["date_reservation"] < date('Y-m-d') && $drapeau != 1) {
                              
                                print('
                                  <a href="donner_avis.php?id_film='.$ligne["film_id"].'&id_user='.$_SESSION["id_user"].' ">
                                    <button class="btn btn-success"> Donner mon avis </button>
                                  </a>
                                ');
                              
                            }
                            

                            print('
                        </div>
                        </div>
                    </div>
                </div>
            ');
        }

    ?>
        
    </section>



  <?php include("footer.php"); ?>

</body>

</html>