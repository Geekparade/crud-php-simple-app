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
			<h1>C.R.U.D en P.H.P</h1>
		</div>
		<div class="row">
			<a href="add.php" class="btn btn-success">Ajouter un utilisateur</a>
			<div class="table-responsive">
				<table class="table table-hover table-bordered" "></table>
				<thead>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Age</th>
					<th>Téléphone</th>
					<th>E-mail</th>
					<th>Pays</th>
					<th>Commentaire</th>
					<th>Métier</th>
					<th>Url</th>
					<th>Édition</th>
				</thead>
				<tbody>
					<?php include 'database.php'; 	//on inclut notre fichier de connection $pdo = Database::connect(); 
					 								//on se connecte à la base $sql = 'SELECT * FROM user ORDER BY id DESC'; 
					 								//on formule notre requete foreach ($pdo->query($sql) as $row){  
					 								//on cree les lignes du tableau avec chaque valeur retournée}
							echo '<br /><tr>';
	                			echo '<td>' . $row['name'] . '</td><p>';
	                			echo '<td>' . $row['firstname'] . '</td><p>';
	                    		echo '<td>' . $row['age'] . '</td><p>';
	                    		echo '<td>' . $row['tel'] . '</td><p>';
	                    		echo '<td>' . $row['email'] . '</td><p>';
	                    		echo '<td>' . $row['pays'] . '</td><p>';
		                        echo '<td>' . $row['comment'] . '</td><p>';
		                        echo '<td>' . $row['metier'] . '</td><p>';
		                        echo '<td>' . $row['url'] . '</td><p>';
		                        echo '<td>';
		                        	echo '<a class="btn" href="edit.php?id=' . $row['id'] . '">Read</a>';// un autre td pour le bouton d'edition
		                        echo '</td><p>';
		                        echo '<td>';
		                        	echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '">Update</a>';// un autre td pour le bouton d'update
		                        echo '</td><p>';
		                        echo'<td>';
		                        	echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . ' ">Delete</a>';// un autre td pour le bouton de suppression
		                        echo '</td><p>';
	                        echo '</tr><p>';
                        
                        }
                    
                    	Database::disconnect(); //on se deconnecte de la base
                        
                        ;
                    ?>        
					
				</tbody>
			</div>
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