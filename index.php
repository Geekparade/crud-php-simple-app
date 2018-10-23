<!DOCTYPE html>
<html lang="fr">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>C.R.U.D en Php</title>

	<!-- Boostrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Main Css -->
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Crud en Php</h1>
            </div>
        </div>
        <br />
        <div class="row">
            <a href="add.php" class="btn btn-success btn-lg btn-block">Ajouter un Utilisateur</a>
            <br />
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>Édition</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Age</th>
                        <th>Téléphone</th>
                        <th>Adresse E-mail</th>
                        <th>Pays</th>
                        <th>Commentaire</th>
                        <th>Métiers</th>
                        <th>Url</th>
                    </thead>
                    <br />
			        <tbody>
    					<?php 
                            //on inclut notre fichier de connection 
                            include 'database.php'; 	
    					    
                            //on se connecte à la base 
                            $pdo = Database::connect();

    					    //on formule notre requete
                            $sql = 'SELECT * FROM testcrudphp ORDER BY id DESC';
                            
                            foreach ($pdo->query($sql) as $row) {  			  
    							
                                //on créé les lignes du tableau avec chaque valeur retournée
    							echo '<tr>';
                                    echo '<td>';
                                        // un autre td pour le bouton d'edition
                                        echo '<a class="btn btn-light btn-block" href="edit.php?id=' . $row['id'] . '">Éditer</a>';
                                  
                                        // un autre td pour le bouton d'update
                                        echo '<a class="btn btn-secondary btn-block" href="update.php?id=' . $row['id'] . '">Mettre à Jour</a>';
                                    
                                        // un autre td pour le bouton de suppression
                                        echo '<a class="btn btn-danger btn-block" href="delete.php?id=' . $row['id'] . ' ">Effacer</a>';
                                    echo '</td>';
                                    echo'<td>' . $row['name'] . '</td>';
                                    echo'<td>' . $row['firstname'] . '</td>';
                                    echo'<td>' . $row['age'] . '</td>';                            
                                    echo'<td>' . $row['tel'] . '</td>';
                                    echo'<td>' . $row['email'] . '</td>';
                                    echo'<td>' . $row['country'] . '</td>';
                                    echo'<td>' . $row['comment'] . '</td>';
                                    echo'<td>' . $row['job'] . '</td>';
                                    echo'<td>' . $row['url'] . '</td>';
                                echo '</tr>';
                            }
                            //on se déconnecte de la base
                            Database::disconnect(); 
                        ?>       
			        </tbody>
                </table>    
		    </div>
	    </div>
	<!-- jQuery, Popper.js, Bootstrap.js -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Main Js -->
	<script src="js/main.js"></script>
</body>
</html>