<!DOCTYPE html>
<html>

<?php
  require_once '../connexion.php';
  require_once '../Modeles/Cinema.php';

  // Récupération des cinémas depuis la base
  $cinemas = [];
  $stmt = $pdo->query("SELECT nom FROM cinemas");
  if ($stmt) {
      $cinemas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

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
  <title>Contact</title>

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
  <div class="hero_area">
    <div class="hero_bg_box">
      <img src="../images/Cinema-header.jpg" alt="">
    </div>
    <!-- header section strats -->
    <?php include("menu.php"); ?>
    <!-- end header section -->
  </div>

  <!-- contact section -->
  <section class="contact_section ">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img-box ">
            <img src="../images/contact-img.jpg" class="box_img" alt="about img">
          </div>
        </div>
        <div class="col-md-5 mx-auto">
          <div class="form_container">
            <div class="heading_container heading_center">
              <h2>Entrer en contact</h2>
            </div>
            <form method="post">
              <div class="form-row">
                <div class="form-group col">
                  <input type="text" name="nom" class="form-control" placeholder="Votre nom" required />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-lg-6">
                  <input type="text" name="telephone" class="form-control" placeholder="Votre téléphone" required />
                </div>
                <div class="form-group col-lg-6">
                  <select name="cinema" class="form-control wide" required>
                    <option value="">Choisir le cinéma</option>
                    <?php foreach ($cinemas as $cinema): ?>
                      <option value="<?= htmlspecialchars($cinema['nom']) ?>">
                        <?= htmlspecialchars($cinema['nom']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <input type="email" name="email" class="form-control" placeholder="Email" required />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <input type="text" name="message" class="message-box form-control" placeholder="Message" required />
                </div>
              </div>
              <div class="btn_box">
                <button type="submit" name="submit">Envoyer la demande</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <?php
    // Traitement du formulaire
    if (isset($_POST['submit'])) {
        // Sécurisation des entrées
        $nom = $_POST['nom'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $cinema_nom = $_POST['cinema'];

        // Insertion directe du nom du cinéma dans la table contact
        $stmtInsert = $pdo->prepare("
            INSERT INTO contact (Nom, Tel, Email, Message, Cinema) 
            VALUES (:nom, :telephone, :email, :message, :cinema_nom)
        ");
        $stmtInsert->execute([
            'nom' => $nom,
            'telephone' => $telephone,
            'email' => $email,
            'message' => $message,
            'cinema_nom' => $cinema_nom
        ]);

        echo "<p style='color:green'>Votre demande a bien été enregistrée.</p>";
    }
?>

  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="info_top">
        <div class="row">
          <div class="col-md-3 ">
            <a class="navbar-brand" href="index.html">
              Finter
            </a>
          </div>
          <div class="col-md-5 ">
            <div class="info_contact">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  +01 1234567890
                </span>
              </a>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="social_box">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="info_bottom">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="info_detail">
              <h5>
              Entreprise
              </h5>
              <p>
              Cinéphoria est un joyau du cinéma français une icône du cinéma responsable.<br>
              Horaires d'ouverture : Tous les jours de 10h à 23h.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="info_form">
              <h5>
                Vennez nous rencontrer.
              </h5>
              <form action="">
                <input type="text" placeholder="Enter votre Email" />
                <button type="submit">
                S'abonner
                </button>
              </form>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="info_detail">
              <h5>
                Un geste de bienveillance.
              </h5>
              <p>
              20% de notre chiffre d'affaires est reversé à des initiatives écologiques.
              </p>
            </div>
          </div>
          <div class="col-lg-2 col-md-6">
            <div class="">
              <h5>
                 
             Liens utiles
              </h5>
              <ul class="info_menu">
                <li>
                  <a href="index.html">
                    Accueil
                  </a>
                </li>
                <li>
                  <a href="about.html">
                    Mes resrvations
                  </a>
                </li>
                <li>
                  <a href="service.html">
                    contact
                  </a>
                </li>
                <li>
                  <a href="team.html">
                    A propos
                  </a>
                </li>
                <li class="mb-0">
                  <a href="contact.html">
                    Soyez les biens venues !
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> Tous droits réservés 
        <a href="https://html.design/">Free Html Templates</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->

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