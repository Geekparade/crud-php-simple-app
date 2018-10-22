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