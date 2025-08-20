<!DOCTYPE html>
<html>

<?php
  include("../connexion.php");
  include("../Modeles/Film.php");
  //la table des films

  $film_class = new Film($pdo);
  
  $tableefilms = $film_class->getAll($pdo);
  
  $topFilms = Film::getTop5($pdo);
  $nouveauxFilms = Film::getLast5($pdo);
  $filmsAleatoires = Film::getRandom5($pdo);

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
  <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
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
    height: 250px;
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

  .hero_area{
    background-image:url("../images/Cinema-header.jpg");
    background-size:cover;
  }

  .container{
    padding: 0 70px;
  }

</style>


<body>
  <div class="hero_area">
    
    <!-- header section strats -->
    <?php include("menu.php"); ?>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-lg-10 col-md-11 mx-auto">
                  <div class="detail-box">
                    <h1>
                      Cinephoria <br>
                      "Plus de passion, plus d'émotions"
                    </h1>
                    
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Nous Contacter
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-lg-10 col-md-11 mx-auto">
                  <div class="detail-box">
                    <h1>
                    Ambiance et expériences uniques :<br>
              
                    </h1>
                    <p>
                      Une sortie en famille, un rendez-vous en amoureux ou un moment entre amis… Le cinéma, c'est toujours une bonne idée !
                      Plongez au cœur de l’action, vibrez avec les héros… Il n’y a rien de mieux qu’un film sur grand écran !
                      Du pop-corn, un fauteuil confortable et le meilleur du 7e art… Il ne manque plus que vous !
                    </p>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-lg-10 col-md-11 mx-auto">
                  <div class="detail-box">
                    <h1>
                      Bienvenue chez <br>
                      Cinéphoria Cinéma
                    </h1>
                    <p>
                      Découvrez une expérience cinématographique inoubliable ! Films en avant-première, confort optimal, et une ambiance unique vous attendent. Réservez vos billets en ligne et profitez de nos services exclusifs.
                    </p>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- Choix du jour -->

  <section class="team_section layout_padding" id="selection">
    <div class="container">
      <div class="heading_container">
        <h2>
         Tous les films
        </h2>
      </div>
      <div class="row">
      <?php
          foreach ( $tableefilms as $ligne ){
            print('
            
              <div class=" poster-hover col-md-2 col-sm-6 mx-auto">
                <a href="details_film.php?id_film='.$ligne['id'].'">
                  <div class="box">
                    <div class="img-box">
                      <img src='.$ligne["poster"].'>
                      <p class="poster-title"> '.$ligne["titre"].' </p>
                    </div>
                  </div>
                </a>
              </div>
            
            ');
          }
        ?>
      </div>
      
    </div>
    
  </section>



  <!-- end team section -->

  <?php include("footer.php") ?>
  

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