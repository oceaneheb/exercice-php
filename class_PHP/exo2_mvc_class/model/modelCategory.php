<?php

class ModelCategory {
    private ?string $name_cat;

    //CONSTRUCTEUR
    public function __construct(?string $name_cat) {
        $this->name_cat = $name_cat;
    }

    //SETTERS
    public function setNameCat(string $name_cat):ModelCategory{
        $this->name_cat = $name_cat;
        return $this;
    }

    //GETTERS
    public function getNameCat():string {
        return $this->name_cat;
    }

    //METHODES

    //Fonction "Ajouter une catégorie"
    public function addCategory() {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $req = $bdd->prepare('INSERT INTO category (name_cat) VALUES (?)');

            $name_cat = $this->name_cat;

            $req->bindParam(1,$name_cat,PDO::PARAM_STR);

            $req->execute();

            return "Ajout de la catégorie $name_cat";

        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    //Fonction "Récupérer et afficher la liste des catégories"
    public function displayCategories() {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $req = $bdd->prepare('SELECT name_cat FROM category');

            $req->execute();

            $listCategories = $req->fetchAll(PDO::FETCH_ASSOC);

            return $listCategories;

        } catch (Exception $error) {
            $message = $error->getMessage();
            return $message;
        }
    }
}


?>