<?php
//trier par date
    function filtreDate(){
        $pdo = Database::connect();
        $arrayCat = array(4,5,6);
        $categories = Database::query('SELECT nom FROM photos WHERE ID_categorie IN (' . implode(',', $arrayCat) . ') ORDER BY Date ASC');
        $count = Database::query('SELECT COUNT(*) as count FROM photos WHERE ID_categorie IN (' . implode(',', $arrayCat) . ')');
        echo '<span class="msgInfo"><h3>Voici les <b>' . $count[0]->count . '</b> photos disponible (photos les plus anciennes affichées en premières)  :
              <br>
              <br>
              (Photos de la catégorie Stock non incluses la catégorie est protégée par un mot de passe)</h3></span>';
            foreach($categories as $categorie){
                echo '<div class="col-md-3 pic">
                        <img class="img-fluid imgsize" title="' . $categorie->nom . '" alt="' . $categorie->nom . '" src="Ressources/IMG/' .  $categorie->nom . '">
                      </div>';
            }
        }

//trier par tag
        function filtreAvion(){
            $pdo = Database::connect();
            $arrayTag = array();
            if(!empty($_POST['Avion'])){
                array_push($arrayTag, '"' . $_POST['Avion'] . '"');
            }
            if(!empty($_POST['Bateau'])){
                array_push($arrayTag, '"' . $_POST['Bateau'] . '"');
            }
            if(!empty($_POST['Bus'])){
                array_push($arrayTag, '"' . $_POST['Bus'] . '"');
            }
            if(!empty($_POST['Camion'])){
                array_push($arrayTag, '"' . $_POST['Camion'] . '"');
            }
            if(!empty($_POST['Helicoptere'])){
                array_push($arrayTag, '"' . $_POST['Helicoptere'] . '"');
            }
            if(!empty($_POST['Moto'])){
                array_push($arrayTag, '"' . $_POST['Moto'] . '"');
            }
            if(!empty($_POST['Paquebot'])){
                array_push($arrayTag, '"' . $_POST['Paquebot'] . '"');
            }
            if(!empty($_POST['Portrait'])){
                array_push($arrayTag, '"' . $_POST['Portrait'] . '"');
            }
            if(!empty($_POST['Voilier'])){
                array_push($arrayTag, '"' . $_POST['Voilier'] . '"');
            }
            if(!empty($_POST['Train'])){
                array_push($arrayTag, '"' . $_POST['Train'] . '"');
            }
            if(!empty($_POST['Voiture'])){
                array_push($arrayTag, '"' . $_POST['Voiture'] . '"');
            }
            if(!empty($_POST['Autres'])){
                array_push($arrayTag, '"' . $_POST['Autres'] . '"');
            }

            $emptyArrayTag = count($arrayTag);
            if($emptyArrayTag == 0){
                echo "<div class='col-md-12'><span class='errMDP'><i class='fas fa-exclamation-triangle'></i> Merci de choisir un des tags afin d'afficher les photos par tags</span></div>";
            } else {
                $tag = Database::query('SELECT nom FROM photos WHERE tags IN (' . implode(',', $arrayTag) . ')');
                $tagCount = Database::query('SELECT COUNT(nom) as count FROM photos WHERE tags IN (' . implode(',', $arrayTag) . ')');
                echo '<span class="msgInfo"><h3>Voici les <b>' . $tagCount[0]->count . '</b> photos disponible qui correspondent aux tags : ' . implode(',', $arrayTag) . ' :</h3></span>';
                foreach($tag as $tags){
                    echo '<div class="col-md-3 pic">
                            <img class="img-fluid imgsize" title="' . $tags->nom . '" alt="' . $tags->nom . '" src="Ressources/IMG/' .  $tags->nom . '">
                        </div>';
                }
            }
        }
?>