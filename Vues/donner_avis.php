<!DOCTYPE html>
<html>

<?php
  include("../connexion.php");
  include("../Modeles/Reservation.php");
  include("../Modeles/Film.php");
  include("../Modeles/Avis.php");
  
  $film_class = new Film($pdo);
  $film = $film_class->getFilmById($pdo,$_GET['id_film']);

  $avis = new Avis($pdo);
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
            Donnez votre avis sur le film :  <mark><i><u> <?= $film['titre'];?> </u></i></mark>
        </h2>
      </div>
        <div class="row">
          <div class="col-md-8">
            <form method="POST" class="p-4 m-5 border rounded bg-light shadow-sm">

              <div class="mb-3">
                <input type="number" hidden class="form-control" name="user_id" value="<?= $_SESSION['id_user']; ?>" >
              </div>

              <div class="mb-3">
                <input type="number" hidden class="form-control" name="id_film" value="<?= $_GET['id_film']; ?>" >
              </div>

              <div class="mb-3">
                <label for="nombre_places" class="form-label">Note / 5</label>
                <input type="number" class="form-control" name="note" id="note" required max="5">
              </div>

              <div class="mb-3">
                <label for="nombre_places" class="form-label">Commentaire</label>
                <input type="text" class="form-control" name="commentaire" id="commentaire">
              </div>

             

              <button type="submit" name="submit" class=" mt-5 btn btn-primary">Publier mon avis</button>
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
            $id_film = $_GET['id_film']; 
            $note = $_POST['note']; 
            $commentaire = $_POST['commentaire']; 
            $statut = '0';

            if ($avis->create($user_id, $id_film, $note, $commentaire)){
              echo "<p class='my-5'> Merci d'avoir pris le temps de noter ce film ! </p>";
            }else{
              echo "<p class='my-5'> Echec de notation </p>";
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