<?php
//MODEL : Gérer les Datas et l'Accès à la BDD

function loginUser($login){
    //ETAPE 5 Du Diagramme de Sequence : demander à la BDD si l'utilisateur existe
    try{
        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Préparation de la requête
        $req = $bdd->prepare("SELECT * FROM user WHERE login_user = ?");

        //Binding de Paramètre
        $req->bindParam(1,$login,PDO::PARAM_STR);

        //ETAPE 6 Du Diagramme de Sequence : exécution de la requête
        $req->execute();

        //ETAPE 7 Du Diagramme de Sequence : récupérer la réponse de la BDD
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        return $data;

        
    }catch(Exception $error){
        return $error;
    }
}

function createAccount($name_user,$first_name_user,$login_user,$mdp_user,$message) {
    try {
        //Connexion BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Préparer la requête voulue
        $req = $bdd->prepare("INSERT INTO user (name_user,first_name_user,login_user,mdp_user) VALUES (?,?,?,?)");

        $req->bindParam(1,$name_user,PDO::PARAM_STR);
        $req->bindParam(2,$first_name_user,PDO::PARAM_STR);
        $req->bindParam(3,$login_user,PDO::PARAM_STR);
        $req->bindParam(4,$mdp_user,PDO::PARAM_STR);

        //Exécuter ma requête
        $req->execute();
        
        //Validation de création de compte
        $message = "Votre compte a bien été créé";

    } catch(Exception $error) {
        return $error;
    }
}

function modifyProfil($name_user, $first_name_user, $id) {
    try{
        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Préparation de la requête
        $req = $bdd->prepare("UPDATE user SET name_user = ?, first_name_user = ? WHERE id_user = ?");

        //Binding de Paramètre
        $req->bindParam(1,$name_user,PDO::PARAM_STR);
        $req->bindParam(2,$first_name_user,PDO::PARAM_STR);
        $req->bindParam(3,$id,PDO::PARAM_INT);

        //ETAPE 6 Du Diagramme de Sequence : exécution de la requête
        $req->execute();
        
        return "Mise à jour de vos infos";

    }catch(Exception $error){
        return $error->getMessage();
    }
}

//AJOUTER UNE CATEGORIE

function addCategory($name_cat) {
    try {
        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Préparer la requête 
        $req = $bdd->prepare('INSERT INTO category (name_cat) VALUES (?)');

        //Bind de Param
        $req->bindParam(1,$name_cat,PDO::PARAM_STR);

        //Exécuter la requête
        $req->execute();

        return "Ajout de la catégorie $name_cat";

    } catch (Exception $error) {
        return $error->getMessage();
    }
}

//RECUPERER ET AFFICHER LA LISTE DES CATEGORIES
function displayCategories() {
    try {

        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Préparer la requête 
        $req = $bdd->prepare('SELECT name_cat FROM category');

        //Exécuter la requête
        $req->execute();

        //Récupérer la liste de toutes les catégories
        $listCategories = $req->fetchAll(PDO::FETCH_ASSOC);

        return $listCategories;

    } catch (Exception $error) {
        $message = $error->getMessage();
        return $message;
    }
}

//AJOUTER UNE TACHE
function addTask($nom_task, $content_task, $date_task, $id_cat, $id_user) {
    try {
        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Préparer la requête 
        $req = $bdd->prepare('INSERT INTO task (nom_task, content_task, date_task, id_cat, id_user) VALUES (?,?,?,?,?)');

        //Bind de Param
        $req->bindParam(1,$nom_task,PDO::PARAM_STR);
        $req->bindParam(2,$content_task,PDO::PARAM_STR);
        $req->bindParam(3,$date_task,PDO::PARAM_STR);
        $req->bindParam(4,$id_cat,PDO::PARAM_INT);
        $req->bindParam(5,$id_user,PDO::PARAM_INT);

        //Exécuter la requête
        $req->execute();

        // return "Ajout de la catégorie $name_cat";

    } catch (Exception $error) {
        return $error->getMessage();
    }
}
// CREER LE BOUTON CHOIX DES CATEGORIES
function choiceCategories() {
    try {

        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Préparer la requête 
        $req = $bdd->prepare('SELECT (name_cat) FROM category');

        //Exécuter la requête
        $req->execute();

        //Récupérer la liste de toutes les catégories
        $listCategories = $req->fetchAll(PDO::FETCH_ASSOC);

        return $listCategories;

    } catch (Exception $error) {
        $message = $error->getMessage();
        return $message;
    }
}

?>