<?php
    require_once 'check_auth.php';
    require_once '../../connexion.php';

    $table_get = $_GET["table"];
    $table = $_GET["table"];
    $titre = $_GET["titre"];

    function getAll($table, $pdo){
        $requette = $pdo->prepare("SELECT * FROM ".$table." ");
        $requette->execute();
        $elements = $requette->fetchAll();
        return $elements;
    }


    $table_elements = getAll($table_get, $pdo);

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
        <h1> Liste des <?php echo $_GET["titre"] ?> </h1>
    </div>
    
    <?php 
        if ($table_get == "films"){
    ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Age Min</th>
                    <th scope="col">Note</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Date</th>
                    <th scope="col">Poster</th>
                    <th scope="col">Actions</th>

                </tr>
                </thead>
                <tbody>
                    <?php foreach ($table_elements as $value) {
                        print('
                        <tr>
                            <th>'.$value["titre"].'</th>
                            <td>'.$value["description"].'</td>
                            <td>'.$value["age_min"].'</td>
                            <td>'.$value["note"].'</td>
                            <td>'.$value["genre"].'</td>
                            <td>'.$value["date"].'</td>
                            <td> <img width="100" height="100" src='.$value["poster"].'></td>
                            <td class="d-flex" style="gap:20px;">
                                <a href="delete.php?table='.$table.'&titre='.$titre.'&id='.$value["id"].'"> 
                                    <button class="btn btn-danger">
                                        <img width="20" height="20" src="https://img.icons8.com/sf-regular/20/filled-trash.png" alt="filled-trash"/> 
                                    </button> 
                                </a>

                                <a href="film.php?table='.$table.'&titre_page='.$titre.'&id='.$value["id"].'&titre_film='.$value["titre"].'&description='.$value["description"].'&age_min='.$value['age_min'].'&note='.$value["note"].'&genre='.$value["genre"].'&date='.$value["date"].'&poster='.$value["poster"].'"> 
                                    <button class="btn btn-warning"> 
                                        <img width="20" height="20" src="https://img.icons8.com/pastel-glyph/20/create-new--v1.png" alt="create-new--v1"/> 
                                    </button> 
                                </a>
                            </td>
                            
                        </tr>
                        ');

                    }
                    ?>
                
                </tbody>
            </table>
            </div>
    <?php        
        }
    ?>

     <?php 
        if ($table_get == "reservations"){
    ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">user ID</th>
                    <th scope="col">Film ID</th>
                    <th scope="col">Nombre places</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">seance_id</th>
                    <th scope="col">Actions</th>
                   
                    
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($table_elements as $value) {
                        print('
                        <tr>
                            <th scope="row">'.$value["id"].'</th>
                            <td>'.$value["user_id"].'</td>
                            <td>'.$value["film_id"].'</td>
                            <td>'.$value["nombre_places"].'</td>
                            <td>'.$value["date_reservation"].'</td>
                            <td>'.$value["statut"].'</td>
                            <td>'.$value["seance_id"].'</td>
                            <td class="d-flex" style="gap:20px;">
                                <a href="delete.php?table='.$table.'&titre='.$titre.'&id='.$value["id"].'"> <button class="btn btn-danger">
                                        <img width="20" height="20" src="https://img.icons8.com/sf-regular/20/filled-trash.png" alt="filled-trash"/> 
                                    </button> </a>
                               
                            </td>
                        </tr>
                        ');

                    }
                    ?>
                
                </tbody>
            </table>
            </div>
    <?php        
        }
    ?>

     <?php 
        if ($table_get == "employer"){
    ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Email</th> 
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($table_elements as $value) {
                        print('
                        <tr>
                            <th scope="row">'.$value["id"].'</th>
                            <td>'.$value["nom"].'</td>
                            <td>'.$value["prenom"].'</td>
                            <td>'.$value["email"].'</td>
                            <td class="d-flex" style="gap:20px;">
                                <a href="delete.php?table='.$table.'&titre='.$titre.'&id='.$value["id"].'"> <button class="btn btn-danger">
                                        <img width="20" height="20" src="https://img.icons8.com/sf-regular/20/filled-trash.png" alt="filled-trash"/> 
                                    </button> </a>
                                
                            </td> 
                        </tr>
                        ');
                    }
                    ?>
                
                </tbody>
            </table>
            </div>
    <?php        
        }
    ?>
    
    <?php 
        if ($table_get == "utilisateurs"){
    ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Nom_utilisateur</th>
                    <th scope="col">Email</th> 
                    <th scope="col">Actions</th>                 
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($table_elements as $value) {
                        print('
                        <tr>
                            <th scope="row">'.$value["id"].'</th>
                            <td>'.$value["nom"].'</td>
                            <td>'.$value["prenom"].'</td>
                            <td>'.$value["nom_utilisateur"].'</td>
                            <td>'.$value["email"].'</td>   
                            <td class="d-flex" style="gap:20px;">
                                <a href="delete.php?table='.$table.'&titre='.$titre.'&id='.$value["id"].'"> <button class="btn btn-danger">
                                        <img width="20" height="20" src="https://img.icons8.com/sf-regular/20/filled-trash.png" alt="filled-trash"/> 
                                    </button> </a>
                                
                            </td>                        
                        </tr>
                        ');

                    }
                    ?>
                
                </tbody>
            </table>
            </div>

    <?php        
        }
    ?>

    
     <?php 
        if ($table_get == "seances"){
    ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">heure_debut</th>
                    <th scope="col">heure_fin</th>
                    <th scope="col">qualité</th>
                    <th scope="col">film_id</th>
                    <th scope="col">salle_id</th>
                   <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($table_elements as $value) {
                        print('
                        <tr>
                            <th scope="row">'.$value["id"].'</th>
                            <td>'.$value["heure_debut"].'</td>
                            <td>'.$value["heure_fin"].'</td>
                            <td>'.$value["qualite"].'</td>
                            <td>'.$value["film_id"].'</td>
                            <td>'.$value["salle_id"].'</td>
                            <td class="d-flex" style="gap:20px;">
                                <a href="delete.php?table='.$table.'&titre='.$titre.'&id='.$value["id"].'"> <button class="btn btn-danger">
                                        <img width="20" height="20" src="https://img.icons8.com/sf-regular/20/filled-trash.png" alt="filled-trash"/> 
                                    </button> </a>
                                <a href="seance.php?table='.$table.'&titre='.$titre.'&id='.$value["id"].'&heure_debut='.$value["heure_debut"].'&heure_fin='.$value["heure_fin"].'&qualité='.$value["qualite"].'&salle_id='.$value["salle_id"].'&film_id='.$value["film_id"].'"> 
                                    <button class="btn btn-warning"> 
                                        <img width="20" height="20" src="https://img.icons8.com/pastel-glyph/20/create-new--v1.png" alt="create-new--v1"/> 
                                    </button> 
                                </a>
                            </td>  
                           
                        </tr>
                        ');

                    }
                    ?>
                
                </tbody>
            </table>
            </div>
    <?php        
        }
    ?>


   <?php 
        if ($table_get == "salles"){
    ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">nbr_places</th>
                    <th scope="col">qualite_projection</th>
                    <th scope="col">cinema_id</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($table_elements as $value) {
                        print('
                        <tr>
                            <th scope="row">'.$value["id"].'</th>
                            <td>'.$value["nbr_places"].'</td>
                            <td>'.$value["qualite_projection"].'</td>
                            <td>'.$value["cinema_id"].'</td>
                            <td class="d-flex" style="gap:20px;">

                                <a href="delete.php?table='.$table.'&titre='.$titre.'&id='.$value["id"].'"> 
                                        <button class="btn btn-danger">
                                        <img width="20" height="20" src="https://img.icons8.com/sf-regular/20/filled-trash.png" alt="filled-trash"/> 
                                    </button> 
                                </a>
                                <a href="salle.php?table='.$table.'&titre_page='.$titre.'&id='.$value["id"].'&nbr_places='.$value["nbr_places"].'&qualite_projection='.$value["qualite_projection"].'&cinema_id='.$value["cinema_id"].'"> 
                                    <button class="btn btn-warning"> 
                                        <img width="20" height="20" src="https://img.icons8.com/pastel-glyph/20/create-new--v1.png" alt="create-new--v1"/> 
                                    </button>
                                    
                                    </a>
                            </td>  

                        </tr>
                        ');

                    }
                    ?>
                
                </tbody>
            </table>
            </div>
    <?php        
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 