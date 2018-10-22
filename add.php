<?php
	require 'database.php';

	//On commence par traiter la méthode de notre formulaire puis s’il a été soumis. Alors, dans ce cas on teste un a un les inputs :
	if( $_SERVER ["REQUESTED_METHOD"] == "POST" && !empty($_POST) )
	{

		$nameError = null;								//On assigne une variable d’erreur
		$name = htmlentities( trim( $_POST['name'] ) ); //On récupère notre valeur
		
		//On crée notre message d’erreur
		$valid = true;
       	
       	if ( empty($name) ) 							
       	{
           $nameError = 'Please enter Name';
           $valid = false;
       	}



	}

	if ( $_SERVER["REQUESTED_METHOD"] == "POST" && !empty( $_POST ) )
	{

		$sql   = "INSERT INTO user ( name, firstname, age, tel, email, country, comment, job, url) values( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$query = $pdo->prepare($sql);
		
		$query->execute( array( $name, $firstname, $age, $tel, $email, $country, $comment, $job, $url ) );
		
		Database::disconnect();
		
		header("Location: index.php");
	
	}

?>
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
			<br />
			<h2>Ajouter un contact</h2>
		</div>
		<br />
		<form method="post" action="add.php">
			<div class="control-group <?php echo !empty( $nameError )?'error':''; ?>" >
                <label class="control-label">Nom</label>
				<br />
				<div class="controls">
                    <input  type="text" name="name" value="<?php echo !empty($name)?$name:''; ?>" >
                    <?php if ( !empty( $nameError ) ): ?>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    <?php endif; ?>
				</div>
			</div>
			<br />
			<div class="control-group<?php echo !empty( $firstnameError )?'error':''; ?>" >
                <label class="control-label">Prénom</label>
				<br />
				<div class="controls">
                    <input type="text" name="firstname" value="<?php echo !empty($firstname)?$firstname:''; ?>" >
                    <?php if ( !empty( $firstnameError ) ): ?>
                	    <span class="help-inline"><?php echo $firstnameError ; ?></span>
                    <?php endif; ?>
				</div>
			</div>
			<br />
			<div class="control-group<?php echo !empty( $ageError )?'error':''; ?>" >
                <label class="control-label">Age</label>
				<br />
				<div class="controls">
                    <input type="date" name="age" value="<?php echo !empty($age)?$age:''; ?>" >
                    <?php if ( !empty( $ageError ) ): ?>
                        <span class="help-inline"><?php echo $ageError ; ?></span>
				    <?php endif; ?>
				</div>
			</div>
			<br />
			<div class="control-group <?php echo !empty($emailError)?'error':''; ?>" >
                <label class="control-label">Addresse E-mail</label>
				<br />
				<div class="controls"> 
				    <input name="email" type="text" placeholder="adresse@domaine.??" value="<?php echo !empty($email)?$email:''; ?>" >
					<?php if ( !empty( $emailError ) ): ?>
				        <span class="help-inline"><?php echo $emailError; ?></span>
		            <?php endif; ?>
				</div>
			</div>              
			<br />
			<div class="control-group <?php echo !empty( $telError )?'error':''; ?>" >
                <label class="control-label">Téléphone</label>
				<br />
				<div class="controls">
                    <input name="tel" type="text" placeholder="0102030405" value="<?php echo !empty( $tel ) ? $tel:''; ?>" >
                    <?php if ( !empty( $telError ) ): ?>
                        <span class="help-inline"><?php echo $telError; ?></span>
				    <?php endif; ?>
				</div>
			</div>
			<br />
			<div class="control-group<?php echo !empty( $countryError )?'error':''; ?>" >
                <select name="country">
					<option value="france">France</option>
					<option value="belgium">Belgique</option>
					<option value="netherland">Pays-Bas</option>
					<option value="england">Angleterre</option>
					<option value="america">États-Unis</option>
					<option value="japan">Japon</option>
				</select>
               	<?php if ( !empty( $countryError ) ): ?>
                    <span class="help-inline"><?php echo $countryError; ?></span>
                <?php endif; ?>
			</div>
			<br />
			<div class="control-group<?php echo !empty( $jobError )?'error':''; ?>" >
                <label class="checkbox-inline">Métiers :</label>
				<br />
				<div class="controls">
                    Développeur : <input type="checkbox" name="job" value="developper" <?php if ( isset( $job ) && $job == "dev" ) echo "checked"; ?> >
                    <br />
                    Intégrateur :<input type="checkbox" name="job" value="integrator" <?php if ( isset( $job ) && $job == "integrateur" ) echo "checked"; ?> >
                    <br />
                    Admin-Réseau :<input type="checkbox" name="job" value="network" <?php if ( isset( $job ) && $job == "reseau" ) echo "checked"; ?> >
				</div> 
				<?php if ( !empty( $jobError ) ): ?>
                    <span class="help-inline"><?php echo $jobError; ?></span>
                <?php endif;?>
			</div>
			<br />
			<div class="control-group  <?php echo !empty($urlError)?'error':'';?>">
                <label class="control-label">Siteweb</label>
                <br />
				<div class="controls">
                    <input name="url" type="text" placeholder="entrée l'url de votre site" value="<?php echo !empty($url)? $url:'' ; ?>" >
                    <?php if ( !empty( $urlError ) ): ?>
                        <span class="help-inline"><?php echo $urlError; ?></span>
                    <?php endif; ?>
				</div>
			</div>
			<br />
			<div class="control-group <?php echo !empty( $commentError )?'error':'' ; ?>" >
                <label class="control-label">Commentaire</label>
				<br />
				<div class="controls">
                   <textarea rows="4" cols="30" name="comment" ><?php if( isset( $comment ) ) echo $comment; ?></textarea>    
                    <?php if( !empty( $commentError ) ): ?>
                        <span class="help-inline"><?php echo $commentError; ?></span>
                    <?php endif;?>
				</div>
			</div>
			<br />
			<div class="form-actions">
                <input type="submit" class="btn btn-success" name="submit" value="submit">
                <a class="btn" href="index.php">Retour</a>
			</div>
        </form>     
	</div>

	<!-- jQuery, Popper.js, Bootstrap.js -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Main Js -->
	<script src="js/main.js"></script>

</body>
</html>