<?php session_start() ?>

<!DOCTYPE html>

<html lang="fr">

	<head>
	
		<meta charset="UTF-8"/> <!-- Encodage en UTF-8-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/> <!-- FontAwesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/> <!-- Bootstrap -->
		<link rel="stylesheet" href="Ressources/css/style.css"/> <!-- CSS -->
		<meta name="viewport" content="width=device-width, initial-scale=1"/> <!-- Responsive design -->
		<meta name="theme-color" content="code couleur"/> <!-- Couleur navigateur Chrome Mobile -->

  		<title>ECF PHP - PETROVIC - Ajouter une photo</title>
  		
	</head>
	
	<body class="text-center">

        <h1>Ajouter une photo</h1>
        <div class="container">
            <br>
            <br>
            <form role="form" action="Ressources/PHP/addPic.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <b><h4><label for='image'>Selectionner une Image: </label></h4></b>
                    <input class="btn btn-warning btn-lg chooseIMG" type="file" id="image" name="image" value="image">
                    <input type="hidden" name="Autres" id="Autres" value="Autres">
                </div>
                <br>
                <div class="form-group">
                    <b><h4><label for='imageName'>Categorie de l'image : </label></h4></b>
                    <select class="sel form-control" id="imageCat" name="imageCat" value="imageCat">
                        <option>Selectionnez une catégorie</option>
                        <option>Employés</option>
                        <option>Contacts Clients</option>
                        <option>Produit</option>
                        <option>Stock</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-lg chooseIMG"><i class="fas fa-check"></i> Ajouter l'image</button>
            </form>
        </div>
        <br>
        <a class="btn btn-warning btn-lg" href="index.php" id="btnAdd"><i class="fas fa-arrow-left"></i> Retour</a>



<!-- SCRIPTS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> <!-- Popper.js -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> <!-- JavaScript -->

	</body>
	
</html>