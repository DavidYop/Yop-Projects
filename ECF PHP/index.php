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

  		<title>ECF PHP - PETROVIC</title>
  		
	</head>
	
	<body class="text-center">
        <h1>Formulaire d'affichage d'images</h1>
        <br>
            <button id="showForm" class="btn btn-warning btn-lg chooseIMG"><i class="fas fa-angle-down btn-lg"></i> Afficher le formulaire <i class="fas fa-angle-down btn-lg"></i></button>
        <br>
        <br>
        <div class="formulaire">
            <br>
            <br>
            <div class="container">
                <form id="form" method="post" action="#">
                    <div id="divAllPic">
                    <div class="form-check form-check">
                            <input class="form-check-input" type="checkbox" name="date" id="date" value="date">
                            <label class="form-check-label" for="date">Afficher les photos les plus anciennes en priorité</label>
                        </div>
                        <br>
                        <button id="btnAllPic" type="submit" name="btnSubmit" value="btnAllPic" class="btn btn-lg btn-info btnSubmit">Afficher toutes les photos</button>
                    </div>
                    <br>
                    <div id="divCatPic">
                        <div class="form-group">
                            <select id="listCat" name="categorie" class="form-control sel">
                                <option>Employés</option>
                                <option>Contacts client</option>
                                <option>Produit</option>
                                <option>Stock</option>
                            </select>
                        </div>
                        <button id="btnCatPic" type="submit" name="btnSubmit" value="btnCatPic" class="btn btn-lg btn-danger btnSubmit">Afficher les photos de la catégorie selectionnée</button>
                    </div>
                    <br>
                    <div id="divTagPic">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Avion" id="Avion" value="Avion">
                            <label class="form-check-label" for="Avion">Avion</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Bateau" id="Bateau" value="Bateau">
                            <label class="form-check-label" for="Bateau">Bateau</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Bus" id="Bus" value="Bus">
                            <label class="form-check-label" for="Bus">Bus</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Camion" id="Camion" value="Camion">
                            <label class="form-check-label" for="Camion">Camion</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Helicoptere" id="Helicoptere" value="Helicoptere">
                            <label class="form-check-label" for="Helicoptere">Helicoptere</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Moto" id="Moto" value="Moto">
                            <label class="form-check-label" for="Moto">Moto</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Paquebot" id="Paquebot" value="Paquebot">
                            <label class="form-check-label" for="Paquebot">Paquebot</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Portrait" id="Portrait" value="Portrait">
                            <label class="form-check-label" for="Portrait">Portrait</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Voilier" id="Voilier" value="Voilier">
                            <label class="form-check-label" for="Voilier">Voilier</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Train" id="Train" value="Train">
                            <label class="form-check-label" for="Train">Train</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Voiture" id="Voiture" value="Voiture">
                            <label class="form-check-label" for="Voiture">Voiture</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Autres" id="Autres" value="Autres">
                            <label class="form-check-label" for="Autres">Autres</label>
                        </div>
                        <br>
                        <br>
                        <button id="btnTagPic" type="submit" name="btnSubmit" value="btnTagPic" class="btn btn-lg btn-success btnSubmit">Afficher les photos des tags séléctionnés</button>
                    </div>
                    <br>
                </form>
                <a class="btn btn-warning btnSubmit btn-lg" id="btnAdd" href="add.php"><i class="fas fa-plus"></i> Ajouter une photo <i class="fas fa-camera"></i></a>
                <br>
            </div>
        </div>
        <div id="showPic" class="row container-fluid">
            <?php require_once 'Ressources/PHP/photos.php' ?>
        </div>



<!-- SCRIPTS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> <!-- Popper.js -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> <!-- JavaScript -->
		<script src="Ressources/JS/script.js"></script> <!-- Script.js -->        

	</body>
	
</html>