<?php

class ModelUser {
    //ATTRIBUTS 
    private ?int $id_user;
    private ?string $name_user;
    private ?string $first_name_user;
    private ?string $login_user;
    private ?string $mdp_user;

    //CONSTRUCTEUR
    public function __construct(?int $id_user, ?string $name_user, ?string $first_name_user, ?string $login_user, ?string $mdp_user) {
        $this->id_user = $id_user;
        $this->name_user = $name_user;
        $this->first_name_user = $first_name_user;
        $this->login_user = $login_user;
        $this->mdp_user = $mdp_user;
    }

    //GETTERS
    public function getid():?int {
        return $this->id_user;
    } // ? -> si une valeur peut être null

    public function getNameUser():?string {
        return $this->name_user;
    }

    public function getFirstNameUser():?string {
        return $this->first_name_user;
    }

    public function getLoginUser():?string {
        return $this->login_user;
    }

    public function getMdpUser():?string {
        return $this->mdp_user;
    }

    //SETTERS
    public function setId(?int $id_user):ModelUser {
        $this->id_user = $id_user;
        return $this;
    }
    public function setNameUser(?string $name_user):ModelUser{
        $this->name_user = $name_user;
        return $this;
    }
    public function setFirstNameUser(?string $first_name_user):ModelUser{
        $this->name_user = $first_name_user;
        return $this;
    }
    public function setLoginUser(?string $login_user):ModelUser{
        $this->name_user = $login_user;
        return $this;
    }
    public function setMdpUser(?string $mdp_user):ModelUser{
        $this->name_user = $mdp_user;
        return $this;
    }

    //METHODES

    // Fonction pour "Créer un compte"
    public function createAccount():string {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
            $req = $bdd->prepare("INSERT INTO user (name_user,first_name_user,login_user,mdp_user) VALUES (?,?,?,?)");
    
            //Récupérer les datas
            $name_user = $this->getNameUser();
            $first_name_user = $this->getFirstNameUser();
            $login_user = $this->getLoginUser();
            $mdp_user = $this->getMdpUser();

            $req->bindParam(1,$name_user,PDO::PARAM_STR);
            $req->bindParam(2,$first_name_user,PDO::PARAM_STR);
            $req->bindParam(3,$login_user,PDO::PARAM_STR);
            $req->bindParam(4,$mdp_user,PDO::PARAM_STR);
    
            $req->execute();
            
            return "Votre compte a bien été créé";
    
        } catch(Exception $error) {
            return $error;
        }
    }

    //Fonction pour "Se connecter"
    public function loginUser():array|Exception{ //Préciser ce que renvoie la fonction
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
            $req = $bdd->prepare("SELECT * FROM user WHERE login_user = ?");
    
            //Récupérer le login
            $login_user = $this->getLoginUser();

            $req->bindParam(1,$login_user,PDO::PARAM_STR);
    
            $req->execute();
    
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $data; //retourne un tableau d'1 valeur
            
        }catch(Exception $error){
            return $error;
        }
    }

    //Fonction pour "Modifier le nom et le prénom de l'utilisateur sur la page Mon Compte"
    public function modifyProfil():array {
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $req = $bdd->prepare("UPDATE user SET name_user = ?, first_name_user = ? WHERE id_user = ?");

            //Récupérer les attributs name, firstname et id
            $name_user = $this->getNameUser();
            $first_name_user = $this->getFirstNameUser();
            $id = $this->getId();

            $req->bindParam(1,$name_user,PDO::PARAM_STR);
            $req->bindParam(2,$first_name_user,PDO::PARAM_STR);
            $req->bindParam(3,$id,PDO::PARAM_INT);

            $req->execute();
            
            return ["Mise à jour de vos infos",true];

        }catch(Exception $error){
            return [$error->getMessage(),false];
        }
    }

}




//AJOUTER UNE TACHE
function addTask($nom_task, $content_task, $date_task, $id_cat, $id_user) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $req = $bdd->prepare('INSERT INTO task (nom_task, content_task, date_task, id_cat, id_user) VALUES (?,?,?,?,?)');

        $req->bindParam(1,$nom_task,PDO::PARAM_STR);
        $req->bindParam(2,$content_task,PDO::PARAM_STR);
        $req->bindParam(3,$date_task,PDO::PARAM_STR);
        $req->bindParam(4,$id_cat,PDO::PARAM_INT);
        $req->bindParam(5,$id_user,PDO::PARAM_INT);

        $req->execute();


    } catch (Exception $error) {
        return $error->getMessage();
    }
}

// CREER LE BOUTON CHOIX DES CATEGORIES
function choiceCategories() {
    try {

        $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $req = $bdd->prepare('SELECT (name_cat) FROM category');

        $req->execute();

        $listCategories = $req->fetchAll(PDO::FETCH_ASSOC);

        return $listCategories;

    } catch (Exception $error) {
        $message = $error->getMessage();
        return $message;
    }
}

?>