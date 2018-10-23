<?php 
	require 'database.php'; 

	if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){ 
	
		//on initialise nos messages d'erreurs; 
		$nameError      = ''; 
		$firstnameError = ''; 
		$ageError = ''; 
		$telError = ''; 
		$emailError   = ''; 
		$countryError = ''; 
		$commentError = ''; 
		$jobError = ''; 
		$urlError = ''; 
		
		// on recupère nos valeurs 
		$name      = htmlentities(trim($_POST['name'])); 
		$firstname = htmlentities(trim($_POST['firstname'])); 
		$age       = htmlentities(trim($_POST['age'])); 
		$tel   = htmlentities(trim($_POST['tel'])); 
		$email = htmlentities(trim($_POST['email'])); 
		$country = htmlentities(trim($_POST['country'])); 
		$comment = htmlentities(trim($_POST['comment'])); 
		$job = htmlentities(trim($_POST['job'])); 
		$url = htmlentities(trim($_POST['url'])); 

		// on vérifie nos champs 
		$valid = true; 

		if (empty($name)) { 
			$nameError = 'Please enter Name'; 
			$valid = false; 
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) { 
			$nameError = "Only letters and white space allowed"; 
		} 

		if(empty($firstname)) { 
			$firstnameError ='Please enter firstname'; 
			$valid= false; 
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) { 
			$nameError = "Only letters and white space allowed"; 
		} 

		if (empty($email)) {
			$emailError = 'Please enter Email Address'; 
			$valid = false; 
		} else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) { 
			$emailError = 'Please enter a valid Email Address'; 
			$valid = false; 
		} 

		if (empty($age)) { 
			$ageError = 'Please enter your age'; 
			$valid = false; 
		} 

		if (empty($tel)) { 
			$telError = 'Please enter phone'; 
			$valid = false; 
		} else if (!preg_match("#^0[1-68]([-./ ]?[0-9]{2}){4}$#",$tel)) { 
			$telError = 'Please enter a valid phone'; 
			$valid = false; 
		} 

		if (!isset($country)) { 
			$countryError = 'Please select a country'; 
			$valid = false; 
		} 

		if (empty($comment)) { 
			$commentError ='Please enter a description'; 
			$valid= false; 
		} 

		if (empty($job)) { 
			$jobError ='Please select a job'; 
			$valid= false; 
		} 

		if (empty($url)) { 
			$urlError ='Please enter website url'; 
			$valid= false; 
		} else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) { 
			$urlError='Enter a valid url'; 
			$valid=false; 
		} 

		// si les données sont présentes et bonnes, on se connecte à la base 
		if ($valid) { 
			$pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO testcrudphp (name,firstname,age,tel, email, country,comment, job,url) values(?, ?, ?, ? , ? , ? , ? , ?, ?)";
            $q = $pdo->prepare($sql);
            
            $q->execute(array($name,$firstname,$age,$tel,$email,$country,$comment,$job,$url));
            
            Database::disconnect();
            
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
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
			<h1 class="col-12 text-center">Crud en Php</h1>
			<br />
			<h2 class="col-12 text-center">Ajouter un contact</h2>
		</div>
		<br />
		<form class="col-12" method="post" action="add.php">
			<div class="row">
				<div class="col-md-4">
					<div class="control-group <?php echo !empty( $nameError )?'error':''; ?>" >
		                <label class="control-label">Nom :</label>
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
		                <label class="control-label">Prénom :</label>
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
		                <label class="control-label">Age :</label>
						<br />
						<div class="controls">
		                    <input type="text" name="age" value="<?php echo !empty($age)?$age:''; ?>" >
		                    <?php if ( !empty( $ageError ) ): ?>
		                        <span class="help-inline"><?php echo $ageError ; ?></span>
						    <?php endif; ?>
						</div>
					</div>
					<br />
				</div>
				<div class="col-md-4">
					<div class="control-group <?php echo !empty($emailError)?'error':''; ?>" >
		                <label class="control-label">Addresse E-mail :</label>
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
		                <label class="control-label">Téléphone :</label>
						<br />
						<div class="controls">
		                    <input name="tel" type="text" placeholder="01/02/03/04/05" value="<?php echo !empty( $tel ) ? $tel:''; ?>" >
		                    <?php if ( !empty( $telError ) ): ?>
		                        <span class="help-inline"><?php echo $telError; ?></span>
						    <?php endif; ?>
						</div>
					</div>
					<br />
					<div class="control-group<?php echo !empty( $countryError )?'error':''; ?>" >
						<label class="control-label">Pays :</label>
						<br />
		                <select name="country">
							<option value="France">France</option>
							<option value="Belgique">Belgique</option>
							<option value="Pays-Bas">Pays-Bas</option>
							<option value="Angleterre">Angleterre</option>
							<option value="Etats-Unis">États-Unis</option>
							<option value="Japon">Japon</option>
						</select>
		               	<?php if ( !empty( $countryError ) ): ?>
		                    <span class="help-inline"><?php echo $countryError; ?></span>
		                <?php endif; ?>
					</div>
					<br />
					</div>
				<div class="col-md-4">
					<div class="control-group<?php echo !empty( $jobError )?'error':''; ?>" >
		                <label class="checkbox-inline">Métiers :</label>
						<br />
						<div class="controls">
		                    Développeur <input type="checkbox" name="job" value="Developpeur" <?php if ( isset( $job ) && $job == "dev" ) echo "checked"; ?> >
		                    <br />
		                    Intégrateur <input type="checkbox" name="job" value="Integrateur" <?php if ( isset( $job ) && $job == "integrateur" ) echo "checked"; ?> >
		                    <br />
		                    Admin-Réseau <input type="checkbox" name="job" value="Admin-Reseau" <?php if ( isset( $job ) && $job == "reseau" ) echo "checked"; ?> >
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
				</div>
				<div class="form-actions col-12">
					<div class="row justify-content-around">
						<input type="submit" class="col-4 btn btn-success" name="submit" value="Ajouter">
	                	<a class="col-4 col btn btn-light" href="index.php">Retour</a>
					</div>
				</div>
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