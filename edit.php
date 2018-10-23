<?php 
    require('database.php'); //on appelle notre fichier de config 

    $id = null; 

    if (!empty($_GET['id'])) { 
        $id = $_REQUEST['id']; 
    } 

    if (null == $id) { 
        header("location:index.php"); 
    } else { 
    //on lance la connection et la requete 
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM testcrudphp where id =?";
    $q   = $pdo->prepare($sql);
    
    $q->execute(array($id));
    
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Crud, voir plus.</title>
        <!-- Boostrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Main Css -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="span10 offset1">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Fiche de l'utilisateur n°<?php echo $data['id']; ?></h1>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <div class="control-group">
                                <label class="control-label">Nom :</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <?php echo $data['name']; ?>
                                    </label>
                                </div>
                                </div>            
                                <div class="control-group">
                                    <label class="control-label">Prénom :</label>
                                    <div class="controls">
                                        <label class="checkbox">
                                            <?php echo $data['firstname']; ?>
                                        </label>
                                    </div>
                                </div>            
                                <div class="control-group">
                                    <label class="control-label">Addresse E-mail :</label>                
                                    <div class="controls">
                                        <label class="checkbox">
                                            <?php echo $data['email']; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-4">
                                <div class="control-group">
                                    <label class="control-label">Téléphone :</label>               
                                    <div class="controls">
                                        <label class="checkbox">
                                            <?php echo $data['tel']; ?>
                                        </label>
                                    </div>
                                </div>            
                                <div class="control-group">
                                    <label class="control-label">Pays :</label>               
                                    <div class="controls">
                                        <label class="checkbox">
                                            <?php echo $data['country']; ?>
                                        </label>
                                    </div>
                                </div>            
                                <div class="control-group">
                                    <label class="control-label">Métier :</label>                
                                    <div class="controls">
                                        <label class="checkbox">
                                            <?php echo $data['job']; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="control-group">
                                    <label class="control-label">Url :</label>                
                                    <div class="controls">
                                        <label class="checkbox">
                                            <?php echo $data['url']; ?>
                                        </label>
                                    </div>
                                </div>            
                                <div class="control-group">
                                    <label class="control-label">Commentaire :</label>                
                                    <div class="controls">
                                        <label class="checkbox">
                                            <?php echo $data['comment']; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a class="btn btn-light btn-block" href="index.php">Retour</a>
                        </div>
                    </div>
                </div>    
            </div>
        </div><!-- /container -->
        <!-- jQuery, Popper.js, Bootstrap.js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Main Js -->
        <script src="js/main.js"></script>
    </body>
</html>