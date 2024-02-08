<?php
//RECUP TOUTES LES CATGORIES
function getAllCategory(){
    try{
        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Preparer la requête
        $req=$bdd->prepare('SELECT name_cat FROM category ORDER BY id_cat');

        //Exécution de la requête
        $req->execute();

        //Récupère la réponse
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        //Returner un message de confirmation
        return $data;

    }catch(Exception $error){
        return $error->getMessage();
    }
}

//RECUP QU'UNE SEULE CATEGORIE
function getCategory($category){
    try{
        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Preparer la requête
        $req=$bdd->prepare('SELECT name_cat FROM category WHERE name_cat = ? limit 1');

        //Binding
        $req->bindParam(1,$category,PDO::PARAM_STR);

        //Exécution de la requête
        $req->execute();

        //Récupère la réponse
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        //Returner un message de confirmation
        return $data;


    }catch(Exception $error){
        return $error->getMessage();
    }
}

//Fonction pour Enregistrer une Catégorie en BDD
function addCategory($category){
    try{
        //Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Preparer la requête
        $req=$bdd->prepare('INSERT INTO category (name_cat) VALUES(?)');

        //Binding de Param
        $req->bindParam(1,$category,PDO::PARAM_STR);

        //Exécution de la requête
        $req->execute();

        //Returner un message de confirmation
        return "$category a été enregistrée avec succès.";


    }catch(Exception $error){
        return $error->getMessage();
    }
}
?>