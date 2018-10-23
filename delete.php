<?php 
  require 'database.php'; 

  $id=0; 

  if( !empty( $_GET['id'] ) ) { 
    $id = $_REQUEST['id']; 
  } 

  if( !empty( $_POST ) ) { 
    $id  = $_POST['id']; 
    $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM testcrudphp  WHERE id = ?";
    $q   = $pdo->prepare( $sql );
    $q->execute( array( $id ) );
    
    Database::disconnect();
    header( "Location: index.php" );
    
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Crud, effacer un utilisateur.</title>
        <!-- Boostrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Main Css -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Modérer l'utilisateur n°<?php echo $id; ?></h1>  
                </div>
            </div>    
            <br />
            <form class="form-horizontal" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <h2 class="text-center">Êtes-vous sûr de vouloir effacer l'utilisateur n°<?php echo $id; ?></h2>
                <div class="form-actions row justify-content-around">
                    <button type="submit" class="btn btn-danger btn-block">Oui</button>
                    <a class="btn btn-success btn-block" href="index.php">Non</a>
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