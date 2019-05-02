
<!DOCTYPE html>

<html lang="fr">

	<head>
	
		<meta charset="UTF-8"/> <!-- Encodage en UTF-8-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/> <!-- FontAwesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/> <!-- Bootstrap -->
		<link rel="stylesheet" href="../css/style.css"/> <!-- CSS -->
		<meta name="viewport" content="width=device-width, initial-scale=1"/> <!-- Responsive design -->
		<meta name="theme-color" content="code couleur"/> <!-- Couleur navigateur Chrome Mobile -->

  		<title>ECF PHP - PETROVIC</title>
  		
    </head>


    <body class="text-center">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php
            if(!empty($_POST)){
                $categorie = $_POST['imageCat'];
                $image = $_FILES['image']['name'];
                $tag = $_POST['Autres'];
                $imagePath = 'C:/Apache24/htdocs/ECF PHP/Ressources/IMG/' . basename($image);
                $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
                $isSuccess = true;
                $isUploadSuccess = false;

            if($categorie == 'Selectionnez une catégorie'){
                echo '<span class="errMDP"><i class="fas fa-exclamation-triangle"></i> Veuillez choisir une catégorie.</span><br>';
                $isSuccess = false;
                echo '<br>
                      <a class="btn btn-warning btn-lg" href="../../add.php" id="btnAdd"><i class="fas fa-arrow-left"></i> Retour</a>
                      <a class="btn btn-danger btn-lg btnHome" href="../../index.php" id="btnHome"><i class="fas fa-home"></i> Accueil</a>';
                die();
            }

            switch ($categorie){
                case 'Employés':
                    $valCat = 4;
                    break;
                case 'Contacts Clients':
                    $valCat = 5;
                    break;
                case 'Produit':
                    $valCat = 6;
                    break;
                case 'Stock':
                    $valCat = 7;
                    break;
            }

            if(empty($image)){
                echo '<span class="errMDP"><i class="fas fa-exclamation-triangle"></i> Veuillez selectionner une image</span><br>';
                $isSuccess = false;
            } else {
                $isUploadSuccess = true;
                if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif"){
                    echo "<span class='errMDP'><i class='fas fa-exclamation-triangle'></i> Les formats d'images autorisés sont : .jpeg, .jpg, .png, .gif</span><br>";
                    $isUploadSuccess = false;
                }
                if(file_exists($imagePath)){
                    echo "<span class='errMDP'><i class='fas fa-exclamation-triangle'></i> L'image existe deja</span>";
                    $isUploadSuccess = false;
                }
                if($_FILES["image"]["size"] > 600000){
                    echo "<span class='errMDP'><i class='fas fa-exclamation-triangle'></i> La taille de l'image ne doit pas depasser les 500KB</span><br>";
                    $isUploadSuccess = false;
                }
                if($isUploadSuccess){
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)){
                        echo "<span class='errMDP'><i class='fas fa-exclamation-triangle'></i> Erreur lors de l'importation de l'image.</span><br>";
                        $isUploadSuccess= false;
                    }

                    $size = getimagesize($imagePath);

                }   

            }

            if($isSuccess && $isUploadSuccess){
                require_once 'db.php';
                $pdo = Database::connect();
                $req = $pdo->prepare("INSERT INTO photos (nom, ID_Categorie, hauteur, largeur, date, tags) VALUES(?, ?, ?, ?, NOW(), ?)");
                $req->execute(array($image, $valCat, $size[0], $size[1], $tag));
                Database::disconnect();
                echo '<span class="msgSuccess"><h3><i class="fas fa-check"></i> La photo à bien été ajoutée</h3></span>';
            }

            }
        ?>
        <br>
        <br>
        <a class="btn btn-warning btn-lg" href="../../add.php" id="btnAdd"><i class="fas fa-arrow-left"></i> Retour</a>
        <a class="btn btn-danger btn-lg btnHome" href="../../index.php" id="btnHome"><i class="fas fa-home"></i> Accueil</a>

        </body>