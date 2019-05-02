
<?php
    if(empty($_POST)){
        echo '<div class="ecfPHP col-md-12">
                <h2>ECF PHP<h2>
              </div>
              <div class="ecfPHP col-md-12">PETROVIC DAVID</div>';
    }

    if(!empty($_POST)){
        require_once 'Ressources/PHP/filtres.php';
        require_once 'Ressources/PHP/db.php';
        $pdo = Database::connect();
        //Afficher toutes les photos
        if(isset($_POST['btnSubmit']) &&  $_POST['btnSubmit'] == 'btnAllPic'){
            if(!empty($_POST['date'])){
                filtreDate();
            } else {
                $arrayCat = array(4,5,6);
                $categories = Database::query('SELECT nom FROM photos WHERE ID_categorie IN (' . implode(',', $arrayCat) . ') ORDER BY Date DESC');
                $count = Database::query('SELECT COUNT(*) as count FROM photos WHERE ID_categorie IN (' . implode(',', $arrayCat) . ')');
                echo '<span class="msgInfo"><h3>Voici les <b>' . $count[0]->count . '</b> photos disponible : 
                      <br>
                      <br>
                      (Photos de la catégorie Stock non incluses car la catégorie est protégée par un mot de passe)</h3></span>';
                    foreach($categories as $categorie){
                        echo '<div class="col-md-3 pic">
                                <img class="img-fluid imgsize" alt="' . $categorie->nom . '" title="' . $categorie->nom . '" src="Ressources/IMG/' .  $categorie->nom . '">
                            </div>';
                    }
            }
        }
        
        //Afficher les photos par catégories
        if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == 'btnCatPic'){
            switch ($_POST['categorie']) {
                case 'Employés':
                    $valCat = 4;
                    break;
                case 'Contacts client':
                    $valCat = 5;
                    break;
                case 'Produit':
                    $valCat = 6;
                    break;
                case 'Stock':
                    $valCat = 7;
                    break;
        }
        if($valCat == 7){
            if(isset($_SESSION['mdp'])){
                echo '<form class="form-group col-md-12" method="post" action="#">
                        <br><br>
                        <button type="submit" id="forgetMDP" name="forgetMDP" value="forgetMDP" class="btn btn-danger btn-lg">Oublier le mot de passe</button>
                      </form>';
                $reqPic = Database::query('SELECT * FROM photos WHERE ID_categorie=:ID_categorie', array('ID_categorie'=> $valCat));
                $reqStr = Database::query('SELECT COUNT(*) as count FROM photos WHERE ID_categorie=:ID_categorie', array('ID_categorie'=> $valCat));
                echo '<span class="msgInfo"><h3>Voici les <b>' . $reqStr[0]->count . '</b> photos de la catégorie <b>' . $_POST['categorie'] . '</b> :</h3></span>';
                foreach($reqPic as $reqPics){
                    echo '<div class="col-md-3 pic">
                            <img class="img-fluid imgsize" title="' . $reqPics->nom . '" alt="' . $reqPics->nom . '" src="Ressources/IMG/' . $reqPics->nom . '">
                        </div>';
                }
            } else {
            echo '<div class="col-md-12">
                    <form id="formMDP" action="#" method="post">
                        <label id="labelMDP" for="mdp"><i class="fas fa-lock"></i> Merci de renseigner le mot de passe pour accéder aux photos de cette catégorie :</label>
                        <div class="form-group">
                            <input id="mdp" name="mdp" type="password">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="StayCo" id="StayCo" value="StayCo">
                                <label class="form-check-label" for="StayCo"><b>Retenir le mot de passe</b></label>
                            </div>
                        </div>
                        <button type="submit" id="btnSubmit" name="btnSubmit" value="btnMDP" class="btn btn-success btn-lg">Valider</button>
                    </form>
                </div>';
            }
        } else {
            $reqPic = Database::query('SELECT * FROM photos WHERE ID_categorie=:ID_categorie', array('ID_categorie'=> $valCat));
            $reqStr = Database::query('SELECT COUNT(*) as count FROM photos WHERE ID_categorie=:ID_categorie', array('ID_categorie'=> $valCat));
            echo '<span class="msgInfo"><h3>Voici les <b>' . $reqStr[0]->count . '</b> photos de la catégorie <b>' . $_POST['categorie'] . '</b> :</h3></span>';
            foreach($reqPic as $reqPics){
                echo '<div class="col-md-3 pic">
                        <img class="img-fluid imgsize" title="' . $reqPics->nom . '" alt="' . $reqPics->nom . '" src="Ressources/IMG/' . $reqPics->nom . '">
                    </div>';
            }
        }
    }


        //Mot de passe pour Stock
        if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == 'btnMDP'){
            if(!empty($_POST['mdp'])){
                $reqMDP = $pdo->prepare('SELECT passwd FROM photocategories WHERE nom = ?');
                $reqMDP->execute(array($_POST['mdp']));
                $mdp = $reqMDP->fetch();
                if(!empty($mdp) && $_POST['mdp'] == password_verify($_POST['mdp'], $mdp->passwd)){
                    if(isset($_POST['StayCo']) &&  $_POST['StayCo'] == 'StayCo'){
                        $_SESSION['mdp'] = $mdp->passwd;
                        echo '<form class="form-group col-md-12" method="post" action="#">
                                <br><br>
                                <button type="submit" id="forgetMDP" name="forgetMDP" value="forgetMDP" class="btn btn-danger btn-lg">Oublier le mot de passe</button>
                              </form>';
                    }
                    $reqPic = Database::query('SELECT * FROM photos WHERE ID_categorie=:ID_categorie', array('ID_categorie'=> '7'));
                    $reqStr = Database::query('SELECT COUNT(*) as count FROM photos WHERE ID_categorie=:ID_categorie', array('ID_categorie'=> '7'));
                    echo '<span class="msgInfo"><h3>Voici les <b>' . $reqStr[0]->count . '</b> photos de la catégorie <b>Stock</b></h3></span>';
                    foreach($reqPic as $reqPics){
                        echo '<div class="col-md-3 pic">
                                <img class="img-fluid imgsize" title="' . $reqPics->nom . '" alt="' . $reqPics->nom . '" src="Ressources/IMG/' . $reqPics->nom . '">
                            </div>';
                    }
                } else {
                    echo '<div class="col-md-12"><span class="errMDP"><i class="fas fa-exclamation-triangle"></i> Mot de passe incorrect, veuillez réessayer.</span></div>';
                }
            } elseif(isset($_POST['mdp'])){
                    echo '<div class="col-md-12"><span class="errMDP"></i> Merci de renseigner le mot de passe.</span></div>';
            }
        }


        //Afficher les photos par tags
        if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == 'btnTagPic'){
            filtreAvion();
        }

        //Oublier le mot de passe
        if(isset($_POST['forgetMDP']) && $_POST['forgetMDP'] == 'forgetMDP'){
            unset($_SESSION['mdp']);
            echo "<div class='col-md-12'><span class='errMDP'><i class='fas fa-check'></i> Le mot de passe à bien été oublié.
                  <br>
                  Vous devrez saisir le mot de passe la prochaine fois que vous essayerais d'acccéder à la catégorie Stock.</span></div>";
        }
        
        Database::disconnect();
    }
?>