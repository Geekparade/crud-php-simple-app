 <?php 
    require 'database.php'; 

    $id = null; 

    if ( !empty( $_GET['id'] ) ) { 
        $id = $_REQUEST['id']; 
    } 

    if ( null==$id ) { 
        header( "Location: index.php" ); 
    } 

    if ( $_SERVER["REQUEST_METHOD"] == "POST" && !empty( $_POST ) ) { 
        // on initialise nos erreurs 
        $nameError      = null; 
        $firstnameError = null; 
        $ageError       = null; 
        $telError       = null; 
        $emailError     = null; 
        $countryError   = null; 
        $commentError   = null; 
        $jobError       = null; 
        $urlError       = null; 

        // on assigne nos valeurs 
        $name       = $_POST['name'];
        $firstname  = $_POST['firstname']; 
        $age        = $_POST['age']; 
        $tel        = $_POST['tel']; 
        $email      = $_POST['email']; 
        $country    = $_POST['country']; 
        $comment    = $_POST['comment']; 
        $job        = $_POST['job']; 
        $url        = $_POST['url']; 

        // on verifie que les champs sont remplis 
        $valid = true; 
        if ( empty( $name ) ) { 
            $nameError = 'Please enter Name'; 
            $valid     = false; 
        } 

        if ( empty( $firstname ) ) { 
            $firstnameError = 'Please enter firstname'; 
            $valid          = false; 
        } 

        if ( empty( $email ) ) { 
            $emailError = 'Please enter Email Address';
            $valid      = false; 
        } else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $emailError = 'Please enter a valid Email Address'; 
            $valid      = false; 
        } 

        if ( empty( $age ) ) { 
            $ageError = 'Please enter your age'; 
            $valid    = false; 
        } 

        if ( empty( $tel ) ) { 
            $telError = 'Please enter phone'; 
            $valid    = false; 
        } 

        if ( !isset( $country ) ) { 
            $countryError = 'Please select a country'; 
            $valid        = false; 
        } 

        if ( empty( $comment ) ) { 
            $commentError = 'Please enter a description'; 
            $valid        = false; 
        } 

        if ( !isset( $job ) ) { 
            $jobError = 'Please select a job'; 
            $valid    = false; 
        } 

        if ( empty( $url ) ) { 
            $urlError = 'Please enter website url'; 
            $valid    = false; 
        } 

        // mise à jour des donnés 
        if ( $valid ) { 
            $pdo = Database::connect(); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            
            $sql = "UPDATE testcrudphp SET name = ?,firstname = ?,age = ?,tel = ?, email = ?, country = ?, comment = ?, job = ?, url = ? WHERE id = ?";
            $q   = $pdo->prepare($sql);
            $q->execute(array($name,$firstname, $age, $tel, $email,$country,$comment, $job, $url,$id));
            
            Database::disconnect();
            
            header("Location: index.php");
        } 
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "SELECT * FROM testcrudphp where id = ?";
        $q   = $pdo->prepare($sql);
        $q->execute(array($id));
        
        $data      = $q->fetch(PDO::FETCH_ASSOC);
        $name      = $data['name'];
        $firstname = $data['firstname'];
        $age       = $data['age'];
        $tel       = $data['tel'];
        $email     = $data['email'];
        $country   = $data['country'];
        $comment   = $data['comment'];
        $job       = $data['job'];
        $url       = $data['url'];
        
        Database::disconnect();
    }        
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Crud, mise à jour.</title>
        <!-- Boostrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Main Css -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Mettre à jour les données de l'utilisateur n°<?php echo $data['id']?></h1>
            </div>
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
                        <label class="control-label">Site web :</label>
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
                        <label class="control-label">Commentaire :</label>
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
                        <input type="submit" class="col-4 btn btn-success" name="submit" value="Mettre à jour">
                        <a class="col-4 col btn btn-light" href="index.php">Retour</a>
                    </div>
                </div>
            </div>  
        </form>     
    </div><!-- container -->
    <!-- jQuery, Popper.js, Bootstrap.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Main Js -->
    <script src="js/main.js"></script>
    </body>
</html>