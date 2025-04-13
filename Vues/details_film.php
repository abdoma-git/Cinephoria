<!DOCTYPE html>
<html>

<?php
  include("../connexion.php");
  //la table des films
  include("../Modeles/Film.php");
  include("../Modeles/Seance.php");
  
  $film_class = new Film($pdo);
  $film = $film_class->getFilmById($_GET['id_film']);

  $seance_class = new Seance($pdo);
  $seances = $seance_class->getByFilmId($_GET['id_film']);

?>

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
  <title>Cinephoria</title>

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

<style>

  .img-box{
    position: relative;
  }
  
  .box .img-box img{
    width: 100%;
    height: 237px;
    display: block;
    
  }

  .layout_padding {
    padding: 40px 0 !important;
  }

  .poster-hover {
    transition: transform 0.3s ease;
  }

  .poster-hover:hover {
    transform: scale(1.1);
    z-index: 2;
  }


  .poster-title{
    position: absolute;
    bottom:0;
    left:0;
    top:0;
    right:0;
    background:rgba(0,0,0,0.4);
    color:white;
    text-align:center;
    padding: 5px;
    opacity:0;
    transition: opacity 0.4s ease;
    font-weight:800px;
    font-size:20px;
  }

  .poster-hover:hover .poster-title{
    opacity:1;
  }

  .star-rating {
    font-size: 20px;
    color: #ccc;
    }

    .star-rating .star {
    margin-right: 5px;
    }

    .star-rating .star.filled {
    color: #ffdc0f;
    }

    #description {
      width: 700px;
    }	
</style>

<body>

    <!-- header section strats -->
    <?php include("menu.php"); ?>
    <!-- end header section -->

  <!-- Details du film -->

  <section class="team_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
            Details du Film <mark><i><u> <?= $film['titre'];?> </u></i></mark>
        </h2>
      </div>
      <div class="row display-flex mt-5" style="gap:20px;">
        <img width="320" height="426" style="border-radius:20px;" src="<?= $film['poster']; ?>" alt="" srcset="">
        <div class="container-details-film">
            <h1> <?= $film['titre']; ?> </h1>
            <p>Genre : <?= $film['genre']; ?> </p>
            <p id="description">Description: </br> <?= $film['description']; ?> </p>
            <span class="star-rating">
                <?php
                    $note = (int)$film['note'];
                    for ($i=1; $i <= 5 ; $i++) { 
                        echo '<span class="star' . ($i <= $note ? ' filled' : '') . '">&#9733;</span>';
                    }

                ?>
            </span>
            <div class="row m-3">
                <h5>Seances disponibles pour ce film :</h5>
                <div class="poster-hover col-md-12 col-sm-6">
                    <?php
                        foreach ($seances as $seance) {
                            print('
                                <a href="reservation.php?id_film='.$_GET['id_film'].'&id_seance='.$seance['id'].'">
                                    <button class="btn btn-primary">
                                        '.$seance['heure_debut'].' </br> (fin a '.$seance['heure_fin'].' ) </br> Salle '. $seance['salle_id'] .'
                                    </button>
                                </a>
                            ');
                        }
                    ?>
                    
                </div>
            </div>

        </div>
      </div>
      <div class="mt-3">
        <a href="index.php#selection">
            <button class="btn btn-primary"> &lt; Retour</button>
        </a>
      </div>
    </div>
  </section>

  <?php include("footer.php"); ?>

  <!-- jQery -->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <!-- bootstrap js -->
  <script src="../js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="../js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->
</body>

</html>