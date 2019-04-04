<?php

/* -------------------------------------------- SECURISATION DE LA PAGE PHP -------------------------------------------- */
//Si la page login.php est appelée sans méthode post (Tentative d'accès par l'URL par exemple):
if($_SERVER["REQUEST_METHOD"] != "POST"){
    //On redirige vers l'index.
        header('Location: ../../index.html');
    }


/* -------------------------------------------- VERIFICATION DES CHAMPS SI ENVOYES-------------------------------------------- */
    //Création d'un array de deux cases, une vide, et une avec un boolean.
    $array = array("info" => "", "isSuccess" => false);
    //On envois les champs du formulaire à la fonction "verifyInput()" afin de les sécuriser.
    $id = verifyInput($_POST["identifiant"]);
    $pwd = verifyInput($_POST["password"]);
    //On appel le fichier de connexion à la base de données.
    require_once 'inc/db.php';
    //On prépare et execute la requête SQL pour vérifier l'identifiant.
    $req = $pdo->prepare('SELECT * FROM users WHERE (pseudo = :pseudo)');
    $req->execute(['pseudo'=> $id]);
    //On stock dans la variable $user les informations de l'utilisateur correspondant à l'identifiant.
    $user = $req->fetch();

/* -------------------------------------------- TRAITEMENT DES DONNEES -------------------------------------------- */
//Si $user n'est pas vide et que le mot de passe envoyé correspond au mot de passe de $user :
    if(!empty($user) && $pwd == $user->password){
        //On passe l'élément du array "isSuccess" sur true.
        $array["isSuccess"] = true;
        //Le mot de passe, étant pour cet ECF, stocké sans être crypté dans la base de données on le crypte car il sera après stocké dans un cookie Javascript.
        $user->password = password_hash($pwd, PASSWORD_BCRYPT);
        //On stock dans l'élément "info" du array la variable $user afin de l'envoyé à AJAX ensuite.
        $array["info"] = $user;
        //On converti le boolean admin de l'utilisateur en chaîne de caractères afin que le code soit plus compréhensible ensuite.
        if($user->admin == 1){
            $user->admin = 'administrateur';
        } else {
            $user->admin = 'utilisateur';
        }
    }
//On envois le array à AJAX.
    echo json_encode($array);


/* --------------------------------------------- FONCTION VERIFICATIONS DES CHAMPS --------------------------------------------- */
 function verifyInput($var){
     //Suppression des espaces en début et en fin de la chaîne de caractères.
    $var = trim($var);
    //Suppression des antislash présents dans la chaîne de caractères.
    $var = stripslashes($var);
    //Remplacement des caractères spéciaux de la chaîne de caractères par des entités HTMl.
    $var = htmlspecialchars($var);
    return $var;
   }
?>