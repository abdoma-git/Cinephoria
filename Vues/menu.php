<?php 
  include("../connexion.php"); 
  session_start();
?>
<style>
  header{
    background-color:black;
  }
  .container{
    padding: 0 70px;
  }
  .header_bottom{
    position:fixed;
    width:100%;
    background-color:black;
    z-index: 100;
  }
</style>
<header class="header_section">        
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand " href="index.php"> <img src="../images/logo.png" width="70" height="70" alt="Cinephoria logo"> </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Accueil </a>
                </li>
                <?php
                  if ($_SESSION['connecte'] == 1){
                    print('
                      <li class="nav-item">
                        <a class="nav-link" href="mes_reservations.php">
                          <span>
                            Mes reservations
                          </span>
                        </a>
                      </li>
                    ');
                  }
                ?>
                <li class="nav-item active">
                  <a class="nav-link" href="about.php"> A propos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  
                    <?php  
                      if ($_SESSION['connecte'] == 1){
                        print('
                          <a class="nav-link" href="logout.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>
                              Se deconnecter
                            </span>
                          </a>
                      ');
                      //}if ($_SESSION["connecte"] == 0){
                      }else{
                        print('
                          <a class="nav-link" href="login-signup.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>
                              Se connecter
                            </span>
                          </a>
                      ');
                      }
                    ?>

                    
                </li>
                <form class="form-inline justify-content-center">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </form>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>