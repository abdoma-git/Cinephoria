<!DOCTYPE html>
<html>

<?php
  include("../connexion.php");
  include("../Modeles/Reservation.php");
  include("../Modeles/Film.php");
  include("../Modeles/Seance.php");
  
  $film_class = new Film($pdo);
  $film = $film_class->getFilmById($_GET['id_film']);

  $seance_class = new Seance($pdo);
  $seance = $seance_class->getById($_GET['id_seance']);

  $reservation_class = new Reservation($pdo);
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
  
  .img-box img{
    width: 230px;
    height: 300px;
    display: block;
    border-radius:20px;
  }

  .layout_padding {
    padding: 40px 0 !important;
  }

  .poster-hover {
    transition: transform 0.3s ease;
    text-align:center;
  }

  .poster-hover:hover {
    transform: scale(1.1);
    z-index: 2;
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
        <div class="row">
          <div class="col-md-8">
            <form method="POST" class="p-4 m-5 border rounded bg-light shadow-sm">

              <div class="mb-3">
                <input type="number" hidden class="form-control" name="user_id" value="<?= $_SESSION['id_user']; ?>" >
              </div>

              <div class="mb-3">
                <input type="number" hidden class="form-control" name="seance_id" value="<?= $_GET['id_seance']; ?>" >
              </div>

              <div class="mb-3">
                <label for="nombre_places" class="form-label">Nombre de places</label>
                <input type="number" class="form-control" name="nombre_places" id="nombre_places" required min="1">
              </div>

              <div class="mb-3">
                <label for="date_reservation" class="form-label">Date de réservation</label>
                <input type="date" class="form-control" name="date_reservation" id="date_reservation" value="<?= date('Y-m-d') ?>" required>
              </div>

              <div class="mb-1">
                <input type="text" hidden class="form-control" name="statut" value="En attente">
              </div>

              <button type="submit" name="submit" class=" mt-5 btn btn-primary">Réserver</button>
              </form>
          </div>
          <div class="col-md-4 mt-5">
                <div class="img-box">
                  <img src="<?= $film['poster']; ?>" alt="" srcset="">
                  <h2 class="poster-title mx-5"> <?= $film['titre']; ?> </h2>
                </div>
          </div>
        </div>
        

        <?php
          if (isset($_POST['submit'])){

            $user_id = $_SESSION['id_user']; 
            $seance_id = $_GET['id_seance']; 
            $id_film = $_GET['id_film']; 
            $nombre_places = $_POST['nombre_places']; 
            $date_reservation = $_POST['date_reservation']; 
            $statut = $_POST['statut']; 

            if ($reservation_class->create($user_id, $seance_id, $id_film, $nombre_places, $date_reservation, $statut)){
              echo "<p class='my-5'> Reservation reussit ! </p>";
            }else{
              echo "<p class='my-5'> Echec de la reservation </p>";
            }
          }
        
        ?>


      <div class="mt-3">

        <a href="details_film.php?id_film=<?=$_GET['id_film']?>">
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